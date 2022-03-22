<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvailableLanguageVariant extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = "available_language_variant";
}
