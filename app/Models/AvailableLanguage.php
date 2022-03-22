<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvailableLanguage extends Model
{
    use HasFactory;

    protected $table = "available_language";

    public function codes ($id)
    {
        $variants = AvailableLanguageVariant::where('available_language_id', $id)
            ->pluck('language_code_id')
            ->all();

        $codes = LanguageCode::whereIn("id", $variants)
            ->pluck('code', 'id')
            ->all();
        
        return $codes;
    }

    public function variants ()
    {
        return $this->hasMany(AvailableLanguageVariant::class);
    }
}
