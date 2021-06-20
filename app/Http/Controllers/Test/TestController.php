<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;

class TestController extends  Controller
{
    /**
     * Тестовый экшен
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('test.test');
    }
}



