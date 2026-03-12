@extends('common/layout')

<head><title>Cross Tickets - Tickets</title></head>

@section('aside')
    <?php
    $advancementStyles = [
        "Ouvert" => "bg-blue-100 text-blue-700",
        "En cours" => "bg-orange-100 text-orange-700",
        "Terminé" => "bg-purple-100 text-purple -700",
    ];

    $facturationStyles = [
        "Inclus" => "bg-lime-100 text-lime-700",
        "Facturable" => "bg-yellow-100 text-yellow-700",
    ];
    ?>
    <script src="{{ asset('specific/listTicket.js') }}" defer></script>
    <form method="get" class="space-y-6">

        <!-- Facturation -->
        <div>
            <h2 class="text-md font-semibold text-accent uppercase mb-3">
                Facturation
            </h2>
            <div class="flex flex-col gap-2">
                <label class="px-3 py-2 rounded-md border border-tertiary bg-lime-100">
                    <input type="checkbox" name="facturation[]" value="Inclus" data-filter="Inclus"
                        <?= in_array("Inclus", $_GET["facturation"] ?? []) ? "checked" : "" ?>>
                    <span class="text-md text-lime-700">Inclus</span>
                </label>

                <label class="px-3 py-2 rounded-md border border-tertiary bg-yellow-100">
                    <input type="checkbox" name="facturation[]" value="Facturable" data-filter="Facturable"
                        <?= in_array("Facturable", $_GET["facturation"] ?? []) ? "checked" : "" ?>>
                    <span class="text-md text-yellow-700">Facturable</span>
                </label>
            </div>
        </div>

        <!-- Avancement -->
        <div>
            <h2 class="text-md font-semibold text-accent uppercase mb-3">
                Avancement
            </h2>
            <div class="flex flex-col gap-2">
                <?php foreach (["Ouvert", "En cours", "Terminé"] as $status): ?>
                    <label class="px-3 py-2 rounded-md border border-tertiary
                    <?= $advancementStyles[$status] ?? "bg-gray-100 text-gray-700"   ?>">
                        <input type="checkbox" data-filter="<?= $status ?>" name="advancement[]" value="<?= $status ?>"
                            <?= in_array($status, $_GET["advancement"] ?? []) ? "checked" : "" ?>>
                        <span class="text-md <?= $advancementStyles[$status] ?? "bg-gray-100 text-gray-700" ?>">
                            <?= $status ?></span>
                    </label>
                <?php endforeach; ?>
            </div>
        </div>

        <div>
            <button class="w-full bg-primary text-white py-2 rounded-lg font-semibold">
                Filtrer (par URL)
            </button>
            <a href="/tickets"
                class="block text-center mt-3 text-sm text-accent underline">
                Réinitialiser les filtres
            </a>
        </div>

    </form>
@endsection

@section('content')
    <?php
    try {
        $pdo = new PDO('sqlite:' . base_path('database/database.sqlite'));
    } catch (PDOException $e) {
        die("Erreur connexion : " . $e->getMessage());
    }

    // Pull data
    $sql = "SELECT * FROM tickets";
    $stmt = $pdo->query($sql);
    $tableau = $stmt->fetchAll();
    ?>
    <div class="mt-5 grid
        grid-cols-[repeat(auto-fill,340px)]
        justify-center gap-6
        w-full min-w-0 py-4">
        <?php

        $filteredTickets = array_filter($tableau, function ($ticket) {

            // Facturation
            if (!empty($_GET["facturation"])) {
                if (!in_array($ticket["facturation"], $_GET["facturation"])) {
                    return false;
                }
            }

            // Avancement
            if (!empty($_GET["advancement"])) {
                if (!in_array($ticket["advancement"], $_GET["advancement"])) {
                    return false;
                }
            }

            return true;
        });
        ?>
        <?php foreach ($filteredTickets as $ticket): ?>
            <div class="ticket bg-background rounded-xl shadow-lg p-8 space-y-6 w-[340px] max-w-[340px] self-start"
            data-tags="<?= $ticket["advancement"] ?> <?= $ticket["facturation"] ?>">

                <!-- En-tête -->
                <div class="flex justify-center">
                    <h1 class="text-2xl font-bold text-text text-center">
                        <?= htmlspecialchars($ticket["title"]) ?>
                    </h1>
                </div>

                <!-- Temps passé -->
                <div class="flex mb-2 justify-between gap-2">
                    <div>
                        <h2 class="text-sm font-semibold text-accent">
                            Temps passé
                        </h2>
                        <p class="text-text">
                            <?= $ticket["time"] ?> heure<?= $ticket["time"] > 1 ? "s" : "" ?>
                        </p>
                    </div>

                    <div class="text-right">
                    <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full
                        <?= $advancementStyles[$ticket["advancement"]] ?? "bg-gray-100 text-gray-700" ?>">
                        <?= $ticket["advancement"] ?>
                    </span>
                    <span class="inline-block px-3 mt-1 py-1 text-sm font-semibold rounded-full
                        <?= $facturationStyles[$ticket["facturation"]] ?? "bg-gray-100 text-gray-700" ?>">
                        <?= $ticket["facturation"] ?>
                    </span>
                </div>
                </div>

                <!-- Propriétaire et Collaborateurs -->
                <div>
                    <h2 class="text-sm font-semibold text-accent mb-2">
                        Propriétaire et collaborateurs
                    </h2>
                    <ul class="flex gap-2 flex-wrap">
                        <?php $collabs = getTicketUsers($pdo, $ticket["ID"]); ?>
                            <li class="px-3 py-1 text-sm rounded-full bg-tertiary text-text">
                                <?= htmlspecialchars($collabs[0]) ?>
                            </li>
                        <?php foreach (array_slice($collabs, 1) as $collab): ?>
                                        <!-- ignorer premier élément -->
                            <li class="px-3 py-1 text-sm rounded-full bg-secondary text-text">
                                <?= htmlspecialchars($collab) ?>
                            </li>
                        <?php endforeach; ?>
                        
                            
                    </ul>
                </div>

            </div>
        <?php endforeach; ?>

    </div>
@endsection