<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    use HasFactory;   
    public $timestamps = false;
    protected $guarded = [];
    
    public function animateurs() {
        return $this->belongsToMany(Animater::class, 'pivots', 'formation_id', 'animater_id');
    }

    public function themes() {
        return $this->belongsToMany(Theme::class, 'pivots', 'formation_id', 'theme_id');
    }
}
