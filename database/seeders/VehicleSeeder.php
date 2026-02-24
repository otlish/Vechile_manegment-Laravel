<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class VehicleSeeder extends Seeder
{
    /**
     * Seed sample vehicles with images.
     */
    public function run(): void
    {
        // Ensure the vehicles storage directory exists
        Storage::disk('public')->makeDirectory('vehicles');

        $vehicles = [
            [
                'name' => 'Corolla',
                'brand' => 'Toyota',
                'model' => 'Sedan',
                'year' => 2023,
                'plate_number' => 'BA-1-KA-1234',
                'daily_rent_price' => 3500.00,
                'status' => 'available',
                'seed_image' => 'corolla-ogi.webp',
            ],
            [
                'name' => 'Civic',
                'brand' => 'Honda',
                'model' => 'Sedan',
                'year' => 2022,
                'plate_number' => 'BA-2-KA-5678',
                'daily_rent_price' => 4000.00,
                'status' => 'available',
                'seed_image' => 'civic.avif',
            ],
            [
                'name' => 'Swift',
                'brand' => 'Suzuki',
                'model' => 'Hatchback',
                'year' => 2024,
                'plate_number' => 'BA-3-KA-9012',
                'daily_rent_price' => 2500.00,
                'status' => 'available',
                'seed_image' => 'swift.jpg',
            ],
            [
                'name' => 'Fortuner',
                'brand' => 'Toyota',
                'model' => 'SUV',
                'year' => 2023,
                'plate_number' => 'BA-4-KA-3456',
                'daily_rent_price' => 7000.00,
                'status' => 'available',
                'seed_image' => 'fortuner.webp',
            ],
            [
                'name' => 'Creta',
                'brand' => 'Hyundai',
                'model' => 'SUV',
                'year' => 2024,
                'plate_number' => 'BA-5-KA-7890',
                'daily_rent_price' => 5000.00,
                'status' => 'available',
                'seed_image' => 'creta.avif',
            ],
        ];

        foreach ($vehicles as $vehicleData) {
            $seedImage = $vehicleData['seed_image'];
            unset($vehicleData['seed_image']);

            // Copy image from public/seed-images to storage/app/public/vehicles
            $sourcePath = public_path('seed-images/' . $seedImage);
            $storagePath = 'vehicles/' . $seedImage;

            if (File::exists($sourcePath)) {
                Storage::disk('public')->put($storagePath, File::get($sourcePath));
                $vehicleData['image'] = $storagePath;
            }

            Vehicle::updateOrCreate(
                ['plate_number' => $vehicleData['plate_number']],
                $vehicleData
            );
        }
    }
}
