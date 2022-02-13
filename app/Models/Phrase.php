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
}
