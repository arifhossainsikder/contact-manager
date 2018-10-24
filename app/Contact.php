<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
	protected $fillable = [
		'name',
		'email',
		'phone',
		'company',
		'group_id',
		'address',
	];

    public function group(){
    	return $this->belongsTo('App\Group');
    }
}
