<?php

namespace App;

use Esensi\Model\Model;

class Item extends Model
{

    protected $rules = [
    	'name'					=> ['required']

    ];

    public function requests() {
    	return $this->belongsToMany('App\Request', 'items_requests')->withPivot('quantity_requested');
    }
}
