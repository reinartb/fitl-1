<?php

namespace App;

use Esensi\Model\Model;

class Section extends Model
{
    protected $rules = [
    	'short_name'	=>	['required'],
    	'long_name'		=>	['required']
    ];

    public function requests () {
    	return $this->hasMany('App\Request');
    }

    public function sepp() {
    	return $this->hasMany('App\SEPP');
    }

}
