<?php

namespace App\Models;

/**
 * A Phrase is assigned to a Module. Once a Phrase is created, it has translations/entries 
 * across all available Languages. Phrases may be unassigned to a module, but may still be used
 * if the module of a different language contains it.
 */

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phrase extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "language_id",
        "batch_id",
        "phrase",
    ];

    public function modules ()
    {
        return $this->belongsToMany(Module::class, 'module_phrase');
    }

    public function relatedPhrases ()
    {
        return Phrase::all()->where('batch_id', $this->batch_id)->where('id', '!=', $this->id);
    }

    public function getLogoSVG ()
    {
        $language = Language::find($this->language_id);

        if (isset($language))
            return $language->logo_path;

        return ""; // some back up svg
    }

    public function getLanguageName ()
    {
        $language = Language::find($this->language_id);

        if (isset($language))
            return $language->name;

        return "N/A";
    }

    public function getLanguageSlug ()
    {
        $language = Language::find($this->language_id);

        if (isset($language))
            return $language->slug;

        return getLanguageName();
    }

    public function generateSlug (string $divider = '-')
    {
        // replace non letter or digits by divider
        $text = preg_replace('~[^\pL\d]+~u', $divider, $this->phrase);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, $divider);

        // remove duplicate divider
        $text = preg_replace('~-+~', $divider, $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        $positionOfSecondHyphen = strpos($text, '-', strpos($text, '-') + 1);

        if ($positionOfSecondHyphen !== false)
            return substr($text, 0, $positionOfSecondHyphen);

        return substr($text, 0, 10);
    }

    public function getLanguageFlag ()
    {
        $language = Language::find($this->language_id);

        if (isset($language))
            return $language->logo_path;

        return "N/A";
    }

    public function recording ()
    {
        return $this->belongsTo(Recording::class)->first();
    }
}
