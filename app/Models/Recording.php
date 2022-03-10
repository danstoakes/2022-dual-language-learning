<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recording extends Model
{
    use HasFactory;

    public function phrase ()
    {
        return $this->hasOne(Phrase::class)->first();
    }
}
