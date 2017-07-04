<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\ItemCart;

class PageController extends Controller {

    public function about() {
        return view('pages/about');
    }



    public function sample() {	

    	// When sample page loads, all temporary request cart data gets deleted.
    	ItemCart::getQuery()->delete();


    	return view ('pages/sample');

    }




}






?>