<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'startTime', 'endTime'
    ];
    
	public function car() {
		return $this->hasOne('App\Cars');
	}
	
	public function user() {
		return $this->hasOne('App\User');
	}
}
