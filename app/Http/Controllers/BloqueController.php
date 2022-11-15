<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bloque;

class BloqueController extends Controller
{
    
    public function index(){   
        
    }

    public function create(){   
        return view('bloque.create');
    }

    public function store(Request $request){

    }
    public function edit(){
        
    }

    public function update(Request $request){

    }
}
