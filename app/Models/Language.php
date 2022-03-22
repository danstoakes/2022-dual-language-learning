<?php

namespace App\Models;

use App\Models\Module;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "name",
        "slug",
        "excerpt",
        "description",
        "flag_svg"
    ];

    public function modules ()
    {
        return $this->hasMany(Module::class);
    }

    public function regions ()
    {
        return $this->hasMany(Region::class);
    }

    public function codes ()
    {
        $regions = $this->regions()->get();
        $codes = $regions->pluck('language_code', 'id')->all();
        
        return $codes;
    }

    /*     public function codes ()
    {
        $regions = $this->regions()->get();
        $codes = $regions->pluck('language_code', 'id')->all();
        
        return $codes;
    } */
}