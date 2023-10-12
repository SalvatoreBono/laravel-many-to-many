<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = ["HTML", "CSS", "JavaScript", "SASS", "Vue.js", "PHP", "MySQL", "Laravel"];
        foreach ($languages as $language) {
            $newLanguage = new Technology();
            $newLanguage->name = $language;
            $newLanguage->save();
        }
    }
}
