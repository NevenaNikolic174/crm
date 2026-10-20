<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class TestPageController extends Controller
{
    public function __invoke(): View
    {
        return view('pages.test');
    }
}
