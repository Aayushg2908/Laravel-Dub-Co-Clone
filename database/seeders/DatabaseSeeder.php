<?php

namespace Database\Seeders;

use App\Models\Shortlink;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Shortlink::create([
            'slug' => 'try',
            'original_url' => 'http://url-shortener.test/register',
            'user_id' => 1,
        ]);
    }
}
