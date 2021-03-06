<?php

namespace App;

use Esensi\Model\Model;

class Request extends Model {

    protected $rules = [
        'ris_number'            => ['required'],
        'requested_by_user'     => ['required'],
        'requested_by_section'  => ['required']
    ];


    public function items() {
    	return $this->belongsToMany('App\Item', 'items_requests')->withPivot('quantity_requested');
    }

    public function section() {
    	return $this->belongsTo('App\Section', 'requested_by_section');
    }


}