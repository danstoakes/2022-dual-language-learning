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
            "excerpt" => "A West Germanic language mainly spoken in Central Europe.",
            "description" => "A West Germanic language mainly spoken in Central Europe. It is the most widely spoken and official or co-official language in Germany, Austria, Switzerland, Liechtenstein, and the Italian province of South Tyrol.",
            "module_count" => 0,
            "logo_path" => "<svg xmlns='http://www.w3.org/2000/svg' id='flag-icons-de' viewBox='0 0 640 480'><path fill='#ffce00' d='M0 320h640v160H0z'/><path d='M0 0h640v160H0z'/><path fill='#d00' d='M0 160h640v160H0z'/></svg>"
        ]);

        Language::create([
            "name" => "Swedish",
            "excerpt" => "A North Germanic language spoken natively by 10 million people.",
            "description" => "A North Germanic language spoken natively by at least 10 million people, predominantly in Sweden and in parts of Finland. It is largely mutually intelligible with Norwegian and Danish, although intelligibility is largely dependent on the dialect and accent of the speaker.",
            "module_count" => 0,
            "logo_path" => "<svg xmlns='http://www.w3.org/2000/svg' id='flag-icons-se' viewBox='0 0 640 480'><path fill='#066aa7' d='M0 0h640v480H0z'/><path fill='#fecc00' d='M0 192h640v96H0z'/><path fill='#fecc00' d='M176 0h96v480h-96z'/></svg>"
        ]);
    }
}
