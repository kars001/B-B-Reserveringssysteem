<?php

namespace Database\Seeders;

use App\Models\RoomsAndHalls;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomsAndHallsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rooms = [
            [
                'name' => '001',
                'type' => 'room',
                'capacity' => 2,
                'price' => 20,
                'room_type' => 'standard',
                'floor' => 'begane grond',
            ],
            [
                'name' => '002',
                'type' => 'room',
                'capacity' => 2,
                'price' => 25,
                'room_type' => 'deluxe',
                'floor' => 'begane grond',
            ],
            [
                'name' => '003',
                'type' => 'room',
                'capacity' => 2,
                'price' => 25,
                'room_type' => 'deluxe',
                'floor' => 'begane grond',
            ],
            [
                'name' => '004',
                'type' => 'room',
                'capacity' => 3,
                'price' => 30,
                'room_type' => 'deluxe',
                'floor' => 'begane grond',
            ],
            [
                'name' => '101',
                'type' => 'room',
                'capacity' => 2,
                'price' => 20,
                'room_type' => 'standard',
                'floor' => '1e verdieping',
            ],
            [
                'name' => '102',
                'type' => 'room',
                'capacity' => 2,
                'price' => 25,
                'room_type' => 'deluxe',
                'floor' => '1e verdieping',
            ],
            [
                'name' => '103',
                'type' => 'room',
                'capacity' => 2,
                'price' => 25,
                'room_type' => 'deluxe',
                'floor' => '1e verdieping',
            ],
            [
                'name' => '104',
                'type' => 'room',
                'capacity' => 2,
                'price' => 25,
                'room_type' => 'deluxe',
                'floor' => '1e verdieping',
            ],
            [
                'name' => '105',
                'type' => 'room',
                'capacity' => 2,
                'price' => 20,
                'room_type' => 'standard',
                'floor' => '1e verdieping',
            ],
            [
                'name' => '106',
                'type' => 'room',
                'capacity' => 2,
                'price' => 25,
                'room_type' => 'deluxe',
                'floor' => '1e verdieping',
            ],
            [
                'name' => '107',
                'type' => 'room',
                'capacity' => 2,
                'price' => 25,
                'room_type' => 'deluxe',
                'floor' => '1e verdieping',
            ],
            [
                'name' => '108',
                'type' => 'room',
                'capacity' => 2,
                'price' => 25,
                'room_type' => 'deluxe',
                'floor' => '1e verdieping',
            ],
        ];

        $halls = [
            [
                'name' => 'Atrium',
                'type' => 'hall',
                'capacity' => 120,
                'price' => 100,
                'floor' => '1e verdieping',
            ],
            [
                'name' => 'Athene',
                'type' => 'hall',
                'capacity' => 30,
                'price' => 30,
                'floor' => '1e verdieping',
            ],
            [
                'name' => 'Antwerpen',
                'type' => 'hall',
                'capacity' => 15,
                'price' => 15,
                'floor' => '1e verdieping',
            ],
            [
                'name' => 'Amsterdam',
                'type' => 'hall',
                'capacity' => 50,
                'price' => 50,
                'floor' => '1e verdieping',
            ],
            [
                'name' => 'Barcelona',
                'type' => 'hall',
                'capacity' => 10,
                'price' => 10,
                'floor' => '1e verdieping',
            ],
            [
                'name' => 'Brussel',
                'type' => 'hall',
                'capacity' => 14,
                'price' => 14,
                'floor' => '1e verdieping',
            ],
            [
                'name' => 'Berlijn',
                'type' => 'hall',
                'capacity' => 15,
                'price' => 15,
                'floor' => '1e verdieping',
            ],
            [
                'name' => 'Chicago',
                'type' => 'hall',
                'capacity' => 30,
                'price' => 30,
                'floor' => 'begane grond',
            ],
            [
                'name' => 'Casablanca',
                'type' => 'hall',
                'capacity' => 8,
                'price' => 8,
                'floor' => 'begane grond',
            ],
            [
                'name' => 'Cairo',
                'type' => 'hall',
                'capacity' => 50,
                'price' => 50,
                'floor' => 'begane grond',
            ],
            [
                'name' => 'Dubai',
                'type' => 'hall',
                'capacity' => 10,
                'price' => 10,
                'floor' => 'begane grond',
            ],
            [
                'name' => 'Dublin',
                'type' => 'hall',
                'capacity' => 10,
                'price' => 10,
                'floor' => 'begane grond',
            ],
        ];

        foreach ($rooms as $room) {
            RoomsAndHalls::create($room);
        }

        foreach ($halls as $hall) {
            RoomsAndHalls::create($hall);
        }
    }
}
