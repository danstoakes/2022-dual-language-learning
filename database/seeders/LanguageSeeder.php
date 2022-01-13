<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Language;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Language::create([
            "name" => "German",
            "description" => "A West Germanic language mainly spoken in Central Europe. It is the most widely spoken and official or co-official language in Germany, Austria, Switzerland, Liechtenstein, and the Italian province of South Tyrol.",
            "module_count" => 0,
            "logo_path" => ""
        ]);

        Language::create([
            "name" => "Swedish",
            "description" => "A North Germanic language spoken natively by at least 10 million people, predominantly in Sweden and in parts of Finland. It is largely mutually intelligible with Norwegian and Danish, although intelligibility is largely dependent on the dialect and accent of the speaker.",
            "module_count" => 0,
            "logo_path" => ""
        ]);
    }
}
