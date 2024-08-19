<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(){

    }
    public function index(){

        $config = [
            'seo' => config('apps.users')
        ];
        $template = 'dashboard.home.index';
        
        return view('dashboard.layout', compact(
            'template',
            'config',
        ));
    }
}
