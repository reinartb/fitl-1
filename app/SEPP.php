<?php

namespace App;

use Esensi\Model\Model;

class SEPP extends Model
{
	protected $rules = [
    	'quarter'					=> ['required'],
    	'year'						=> ['required'],
    	'sepp_quantity'				=> ['required']
    ];

	public $table = "sepp";

    public function item() {
    	return $this->belongsTo('App\Item', 'item_id');
    }

    public function section() {
    	return $this->belongsTo('App\Section', 'section_id');
    }

}
