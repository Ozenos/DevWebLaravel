<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\Ticket;
use App\Models\User;
use App\Models\Collaborator;

class TicketsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users= [
            [
                'name' => 'Marius Pozo',
                'password' => "Marius",
                'email' => 'Marius@example.com'
            ],
            [
                'name' => 'Jean Michel-Tartin',
                'password' => "JMT",
                'email' => 'JMT@example.com'
            ],
            [
                'name' => 'Aude Clamal',
                'password' => "Aude",
                'email' => 'Aude@example.com'
            ],
            [
                'name' => "François Troulou",
                'password' => "Franc",
                'email' => 'Franc@example.com'
            ],
            [
                'name' => "Maxence Gautier--Grall",
                'password' => "1234",
                'email' => '1234@example.com'
            ],
            [
                'name' => 'Aurèle LeJ',
                'password' => "123",
                'email' => '123@example.com'
            ],
            [
                'name' => 'Ilan Ruband',
                'password' => "ILAN",
                'email' => 'ILAN@example.com'
            ],
        ];
        foreach ($users as $user) {
            User::create($user);
        }
        $tickets = [
            [
                'title' => "Dysfonctionnement de l export PDF",
                'time' => 2,
                'advancement' => 'progress',
                'facturation' => 'included',
                'user_id' => 1
            ],
            [
                'title' => "VIDE",
                'time' => 1,
                'advancement' => 'progress',
                'facturation' => 'facturable',
                'user_id' => 1
            ],
            [
                'title' => "VIDE",
                'time' => 1,
                'advancement' => 'completed',
                'facturation' => 'facturable',
                'user_id' => 1
            ],
            [
                'title' => "VIDE",
                'time' => 1,
                'advancement' => 'progress',
                'facturation' => 'facturable',
                'user_id' => 3
            ],
            [
                'title' => "DESTRUCTION",
                'time' => 1,
                'advancement' => 'progress',
                'facturation' => 'facturable',
                'user_id' => 6
            ],
        ];
        foreach ($tickets as $ticket) {
            Ticket::create($ticket);
        }
        $collaborators = [
            [
                'ticket_id' => 1,
                'user_id' => 5,
            ],
            [
                'ticket_id' => 1,
                'user_id' => 6,
            ],
            [
                'ticket_id' => 5,
                'user_id' => 2,
            ],
            [
                'ticket_id' => 5,
                'user_id' => 1,
            ],
        ];
        foreach ($collaborators as $collaborator) {
            Collaborator::create($collaborator);
        }
    }
}
