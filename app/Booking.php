<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'startTime', 'endTime'
    ];
    
	public function cars() {
		return $this->belongsTo('App\Cars');
	}
	
	public function user() {
		return $this->belongsTo('App\User');
	}
}
