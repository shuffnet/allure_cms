<?php

namespace App\Http\Controllers;

class PagesController extends Controller {

//    Process variable data or params
//    talk to model
//    receive from the model
//    compile or process data from the model if needed
//    pass that data to the correct view


    public function getIndex(){

        return view('pages.welcome');
    }

    public function getAbout(){

        $first = 'Scott';
        $last = 'Huffman';
        $full = $first . " ". $last;

        return view('pages.about')->withFullname($full);
    }

    public function getContact(){

        return view('pages.contact');

    }

    public function getAdmin(){
        return view('admin.index');
    }

}



