<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participent extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];

    public function utilisator()
    {
        return $this->belongsTo(Utilisator::class);
    }

    public function formations()
    {
        return $this->belongsToMany(Formation::class, 'formation_participent');
    }
}
