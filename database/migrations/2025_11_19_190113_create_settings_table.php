<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('settings', function (Blueprint $table) {
        $table->string('website_name')->default('Electro')->after('id');
        $table->string('logo')->nullable()->after('description');
        $table->string('telephone')->nullable()->after('website_name');
        $table->string('address')->nullable()->after('telephone');
        $table->string('email')->nullable()->after('address');
        $table->string('website_link')->nullable()->after('email');
        $table->string('facebook_link')->nullable()->after('website_link');
        $table->string('instagram_link')->nullable()->after('facebook_link');
        $table->string('twitter_link')->nullable()->after('instagram_link');
        $table->string('youtube_link')->nullable()->after('twitter_link');
        $table->text('description')->nullable()->after('youtube_link');
    });
}

public function down(): void
{
    Schema::table('settings', function (Blueprint $table) {
        $table->dropColumn([
            'website_name',
            'logo',
            'telephone',
            'address',
            'email',
            'website_link',
            'facebook_link',
            'instagram_link',
            'twitter_link',
            'youtube_link',
            'description',
        ]);
    });
}
};