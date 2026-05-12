<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hebergement extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];

    public function participant()
    {
        return $this->belongsTo(Participent::class, 'participent_id');
    }
}
