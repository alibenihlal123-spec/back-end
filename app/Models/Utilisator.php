<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Utilisator extends Authenticatable

{
    use HasApiTokens , Notifiable,HasFactory;
    // protected $fillable = [];
    public $timestamps = false;
    protected $guarded = [];
}
