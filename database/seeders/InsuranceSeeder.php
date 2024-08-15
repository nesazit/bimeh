<?php

namespace Database\Seeders;

use App\Models\Insurance;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InsuranceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $insurances = [
            [
                'title' => 'Home',
                'description' => 'Your home is your castle, and we want to make sure it\'s protected. Our Home Insurance covers your home, personal property, and liability.',
                'image' => 'home.png',
                'icon' => 'heroicons:home-20-solid',
                'price' => 400,
                'status' => true,
                'duration' => 12,
            ],
            [
                'title' => 'Auto',
                'description' => 'Your Personal Auto Insurance is a must-have for any driver. It protects you from financial loss in the event of an accident, theft, or other covered events.',
                'image' => 'auto.jpeg',
                'icon' => 'heroicons:cog-6-tooth-16-solid',
                'price' => 300,
                'status' => true,
                'duration' => 12,
            ],
            [
                'title' => 'Recreational Vehicle',
                'description' => 'Your boat RV, motorcycle, or ATV is an investment, and we want to make sure it\'s protected. Our Recreational Vehicle Insurance covers your vehicle, liability, and more.',
                'image' => 'recreational.jpg',
                'icon' => 'heroicons:truck-solid',
                'price' => 200,
                'status' => true,
                'duration' => 12,
            ],
        ];

        foreach ($insurances as $insurance) {
            Insurance::create($insurance);
        }
    }
}
