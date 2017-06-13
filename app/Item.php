<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public function requests() {
    	return $this->belongsToMany('App\Request', 'items_requests');
    }
}
