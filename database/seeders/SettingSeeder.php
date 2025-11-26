<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    public function run()
    {
        Setting::create([
            'website_name' => 'My Website',
            'telephone' => '0123456789',
            'address' => 'My Address',
            'email' => 'example@example.com',
            'website_link' => 'https://mywebsite.com',
            'facebook_link' => 'https://facebook.com',
            'instagram_link' => 'https://instagram.com',
            'twitter_link' => 'https://twitter.com',
            'youtube_link' => 'https://youtube.com',
            'description' => 'Website description here',
        ]);
    }
}
