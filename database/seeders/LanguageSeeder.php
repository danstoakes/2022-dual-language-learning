<?php

namespace Database\Seeders;

use App\Models\Language;
use App\Models\LanguageCode;
use App\Models\AvailableLanguageVariant;
use App\Models\Region;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Start creation of language codes

        $swedishCode = "sv-SE";

        $germanCode = "de-DE";

        $englishCodes = [
            "en-GB",
            "en-US",
            "en-AU",
            "en-IE",
            "en-ZA"
        ];

        // End creation of language codes

        // Start creation of available languages

        $swedish = Language::create([
            "name" => "Swedish",
            "slug" => "swedish",
            "excerpt" => "A North Germanic language spoken natively by 10 million people.",
            "description" => "A North Germanic language spoken natively by at least 10 million people, predominantly in Sweden and in parts of Finland. It is largely mutually intelligible with Norwegian and Danish, although intelligibility is largely dependent on the dialect and accent of the speaker.",
            "flag_svg" => '<svg xmlns="http://www.w3.org/2000/svg" id="flag-icons-se" viewBox="0 0 640 480"><path fill="#066aa7" d="M0 0h640v480H0z"/><path fill="#fecc00" d="M0 192h640v96H0z"/><path fill="#fecc00" d="M176 0h96v480h-96z"/></svg>'
        ]);

        $german = Language::create([
            "name" => "German",
            "slug" => "german",
            "excerpt" => "A West Germanic language mainly spoken in Central Europe.",
            "description" => "A West Germanic language mainly spoken in Central Europe. It is the most widely spoken and official or co-official language in Germany, Austria, Switzerland, Liechtenstein, and the Italian province of South Tyrol.",
            "flag_svg" => '<svg xmlns="http://www.w3.org/2000/svg" id="flag-icons-de" viewBox="0 0 640 480"><path fill="#ffce00" d="M0 320h640v160H0z"/><path d="M0 0h640v160H0z"/><path fill="#d00" d="M0 160h640v160H0z"/></svg>'
        ]);

        $english = Language::create([
            "name" => "English",
            "slug" => "english",
            "excerpt" => "A West Germanic language mainly spoken in Central Europe.",
            "description" => "A West Germanic language mainly spoken in Central Europe. It is the most widely spoken and official or co-official language in Germany, Austria, Switzerland, Liechtenstein, and the Italian province of South Tyrol.",
            "flag_svg" => '<svg xmlns="http://www.w3.org/2000/svg" id="flag-icons-gb" viewBox="0 0 640 480"><path fill="#012169" d="M0 0h640v480H0z"/><path fill="#FFF" d="m75 0 244 181L562 0h78v62L400 241l240 178v61h-80L320 301 81 480H0v-60l239-178L0 64V0h75z"/><path fill="#C8102E" d="m424 281 216 159v40L369 281h55zm-184 20 6 35L54 480H0l240-179zM640 0v3L391 191l2-44L590 0h50zM0 0l239 176h-60L0 42V0z"/><path fill="#FFF" d="M241 0v480h160V0H241zM0 160v160h640V160H0z"/><path fill="#C8102E" d="M0 193v96h640v-96H0zM273 0v480h96V0h-96z"/></svg>'
        ]);

        // End creation of available languages

        // Start creation of language variants

        Region::create([
            "language_id" => $swedish->id,
            "language_code" => $swedishCode
        ]);

        Region::create([
            "language_id" => $german->id,
            "language_code" => $germanCode
        ]);

        for ($i = 0; $i < count($englishCodes); $i++) {
            Region::create([
                "language_id" => $english->id,
                "language_code" => $englishCodes[$i]
            ]);
        }

        // End creation of language variants
    }
}