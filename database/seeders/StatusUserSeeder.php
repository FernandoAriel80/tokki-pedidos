<?php

namespace Database\Seeders;

use App\Models\StatusUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $statuses = [
            [
                'name' => 'enabled',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'disabled',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($statuses as $status) {
            StatusUser::updateOrCreate(
                ['name' => $status['name']], // Evita duplicados por nombre
                $status
            );
        }
    }
}
