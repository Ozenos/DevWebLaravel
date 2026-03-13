<?php
function getTicketUsers(PDO $pdo, int $ticketID): array {

    // 1. Récupérer l'owner du ticket
    $stmt = $pdo->prepare("SELECT user_id FROM tickets WHERE id = ?");
    $stmt->execute([$ticketID]);
    $ownerID = $stmt->fetchColumn();

    // 2. Récupérer les utilisateurs liés dans la table relation
    $stmt = $pdo->prepare("SELECT user_id FROM ticket_user WHERE ticket_id = ?");
    $stmt->execute([$ticketID]);
    $collabsIDs = $stmt->fetchAll(PDO::FETCH_COLUMN);

    // Supprimer les doublons
    $collabsIDs = array_unique($collabsIDs);

    // 3. Récupérer le username de l'owner
    $ownerName = null;
    if ($ownerID) {
        $stmt = $pdo->prepare("SELECT name FROM users WHERE id = ?");
        $stmt->execute([$ownerID]);
        $ownerName[0] = $stmt->fetchColumn();
    }

    $rows = [];
    if ($collabsIDs) {
        $placeholders = implode(',', array_fill(0, count($collabsIDs), '?'));
        $stmt = $pdo->prepare("SELECT name FROM users WHERE id IN ($placeholders)");
        $stmt->execute($collabsIDs);
        $rows = $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    $userIDs = array_merge($ownerName, $rows);
    return $userIDs;
}
?>