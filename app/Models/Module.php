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
}