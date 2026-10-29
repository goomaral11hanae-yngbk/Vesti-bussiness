<?php
 
namespace App\Http\Controllers;
 
class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            'brands' => config('vesti.brands'),
            'items'  => config('vesti.items'),
        ]);
    }
}
 