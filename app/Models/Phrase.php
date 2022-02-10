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

    public function modules ()
    {
        return $this->belongsToMany(Module::class, 'module_phrase');
    }
}
