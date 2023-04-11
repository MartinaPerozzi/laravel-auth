<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // La funzione che era in web.php dove ho sostituito con l'AdminHomeController::class
    public function index()
    {
        return view('guest.welcome');
    }
}
