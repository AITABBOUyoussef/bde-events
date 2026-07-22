<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
        protected $fillable = [
            'titre',
            'description',
            'date',
            'heure',
            'lieu',
            'prix',
            'jauge_maximale',

            ];
 public function admin()
    {
        return $this->belongsTo(User::class);
    }

public function reservations()
    {
         return $this->hasMany(Reservation::class);
    }
            }
