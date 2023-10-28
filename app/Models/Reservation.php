<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    public function getScooter(){
        return $this->belongsTo(Scooter::class, 'scooter_id', 'id');
    }
}
