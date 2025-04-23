<?php

namespace App\Http\Controllers;

class WelcomeController extends Controller{
    public function landing(){
        
        $breadcrumb = (object) [
            // 'title' => 'Selamat Datang di Traveloke',
            
            'list' => ['Home', 'Landing']
        ];

        // $activeMenu = 'dashboard';
        return view('landing',['breadcrumb'=> $breadcrumb]);
    }
    public function index(){
        
        $breadcrumb = (object) [
            'title' => 'Selamat Datang di Traveloke',
            
            'list' => ['Home', 'Welcome']
        ];

        $activeMenu = 'dashboard';
        return view('welcome',['breadcrumb'=> $breadcrumb, 'activeMenu' => $activeMenu]);
    }
}