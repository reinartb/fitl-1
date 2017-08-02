<?php

namespace App;

use Esensi\Model\Model;

class SEPP extends Model
{
	protected $rules = [
    	'q1_quantity'				=> ['required'],
    	'q2_quantity'               => ['required'],
        'q3_quantity'               => ['required'],
        'q4_quantity'               => ['required'],
        'year'						=> ['required'],
        'item_id'                   => ['required'],
        'section_id'                => ['required']

    ];

	public $table = "sepp";

    public function item() {
    	return $this->belongsTo('App\Item', 'item_id');
    }

    public function section() {
    	return $this->belongsTo('App\Section', 'section_id');
    }

}
