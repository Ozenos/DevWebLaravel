<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tickets')->insert([
            [
                'title' => "Dysfonctionnement de l export PDF",
                'time' => 2,
                'advancement' => 'En cours',
                'facturation' => 'Inclus',
                'owner' => 1
            ],
            [
                'title' => "VIDE",
                'time' => 1,
                'advancement' => 'En cours',
                'facturation' => 'Facturable',
                'owner' => 1
            ],
            [
                'title' => "VIDE",
                'time' => 1,
                'advancement' => 'En cours',
                'facturation' => 'Facturable',
                'owner' => 1
            ],
            [
                'title' => "VIDE",
                'time' => 1,
                'advancement' => 'En cours',
                'facturation' => 'Facturable',
                'owner' => 1
            ],
            [
                'title' => "DESTRUCTION",
                'time' => 1,
                'advancement' => 'En cours',
                'facturation' => 'Facturable',
                'owner' => 6
            ],
        ]);
        DB::table('users')->insert([
            [
                'name' => 'Marius Pozo',
                'username' => "Marius Pozo",
                'password' => "Marius",
                'email' => 'Marius@example.com'
            ],
            [
                'name' => 'Jean Michel-Tartin',
                'username' => "Jean Michel-Tartin",
                'password' => "JMT",
                'email' => 'JMT@example.com'
            ],
            [
                'name' => 'Aude Clamal',
                'username' => "Aude Clamal",
                'password' => "Aude",
                'email' => 'Aude@example.com'
            ],
            [
                'name' => "François Troulou",
                'username' => "François Troulou",
                'password' => "Franc",
                'email' => 'Franc@example.com'
            ],
            [
                'name' => "Maxence Gautier--Grall",
                'username' => "Maxence Gautier--Grall",
                'password' => "1234",
                'email' => '1234@example.com'
            ],
            [
                'name' => 'Aurèle LeJ',
                'username' => "Aurèle LeJ",
                'password' => "123",
                'email' => '123@example.com'
            ],
            [
                'name' => 'Ilan Ruband',
                'username' => "Ilan Ruband",
                'password' => "ILAN",
                'email' => 'ILAN@example.com'
            ],
        ]);
        DB::table('tickets_collaborators')->insert([
            [
                'ticketID' => 1,
                'userID' => 5,
            ],
            [
                'ticketID' => 1,
                'userID' => 6,
            ],
            [
                'ticketID' => 5,
                'userID' => 2,
            ],
            [
                'ticketID' => 9,
                'userID' => 1,
                
            ],
            [
                'ticketID' => 9,
                'userID' => 2,
            ],
            [
                'ticketID' => 6,
                'userID' => 6,
            ],
        ]);
    }
}
