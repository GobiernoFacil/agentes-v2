<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class AspirantDash extends Controller
{
    //

    public function dashboard(){

      $user = Auth::user();

    }
}
