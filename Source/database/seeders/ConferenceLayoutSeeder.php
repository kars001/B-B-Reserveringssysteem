<?php

namespace Database\Seeders;

use App\Models\ConferenceLayout;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ConferenceLayoutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // \App\Models\ConferenceLayout::factory()->count(5)->create();
        $layouts = [
            [
                'uuid' => Str::uuid(),
                'name' => 'Theater'
            ],
            [   
                'uuid' => Str::uuid(),
                'name' => 'Classroom'
            ],
            [   
                'uuid' => Str::uuid(),
                'name' => 'U-Shape'
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'Boardroom'
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'Banquet'
            ],
        ];

        foreach ($layouts as $layout) {
            ConferenceLayout::create($layout);
        }
    }
}
