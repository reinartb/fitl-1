<?php

namespace App;

use Esensi\Model\Model;

class Request extends Model {

    protected $rules = [
        'ris_number'            => ['required'],
        'requested_by_user'     => ['required'],
        'requested_by_section'  => ['required']
    ];

    




}