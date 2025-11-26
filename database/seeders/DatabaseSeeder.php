<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\Hash;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
            // إنشاء مستخدم افتراضي للتجربة
        User::updateOrCreate(
        ['email' => 'test@example.com'],
        [
            'name' => 'Test User',
            'password' => Hash::make('123456'),
        ]
    );

        // استدعاء Seeder الأصناف
        $this->call([
            CategorySeeder::class,
        ]);

        $this->call([
            CategorySeeder::class,
            ProductSeeder::class,
        ]);

    }
}
