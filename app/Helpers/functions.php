<?php
function getTicketUsers(PDO $pdo, int $ticketID): array {

    // 1. Récupérer l'owner du ticket
    $stmt = $pdo->prepare("SELECT owner FROM tickets WHERE ID = ?");
    $stmt->execute([$ticketID]);
    $ownerID = $stmt->fetchColumn();

    // 2. Récupérer les utilisateurs liés dans la table relation
    $stmt = $pdo->prepare("SELECT userID FROM tickets_collaborators WHERE ticketID = ?");
    $stmt->execute([$ticketID]);
    $collabsIDs = $stmt->fetchAll(PDO::FETCH_COLUMN);

    // Supprimer les doublons
    $collabsIDs = array_unique($collabsIDs);

    // 3. Récupérer le username de l'owner
    $ownerName = null;
    if ($ownerID) {
        $stmt = $pdo->prepare("SELECT username FROM users WHERE ID = ?");
        $stmt->execute([$ownerID]);
        $ownerName[0] = $stmt->fetchColumn();
    }

    $rows = [];
    if ($collabsIDs) {
        $placeholders = implode(',', array_fill(0, count($collabsIDs), '?'));
        $stmt = $pdo->prepare("SELECT username FROM users WHERE ID IN ($placeholders)");
        $stmt->execute($collabsIDs);
        $rows = $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    $userIDs = array_merge($ownerName, $rows);
    return $userIDs;
}
?>