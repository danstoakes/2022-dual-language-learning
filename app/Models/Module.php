<?php

namespace App\Models;

/**
 * A Module is assigned to a Language. Each language may have different modules, depending on requirements.
 * The purpose of a module is to contain similar Phrases which are related in some way.
 */

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $table = "modules";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "language_id",
        "name",
        "description",
        "icon_svg"
    ];

    public function phrases ()
    {
        return $this->belongsToMany(Phrase::class, 'module_phrase');
    }

    public function hasBatch ($batchId)
    {
        $phrases = $this->phrases->where("batch_id", $batchId);

        if (isset($phrases) && count($phrases) > 0)
            return true;
        
        return false;
    }
}