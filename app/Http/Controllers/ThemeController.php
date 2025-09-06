<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class ThemeController extends Controller
{
    public function toggle(Request $request)
    {
        $theme = $request->cookie('theme', 'light');
        $newTheme = $theme === 'light' ? 'dark' : 'light';
        Cookie::queue('theme', $newTheme, 60*24*30); // 30 days
        return back();
    }
}
