<?php

namespace App\Http\Controllers;

class IndexController extends Controller
{
    public function index()
    {
        $data['title'] = 'Task Mesh group';

        return view('index', $data);
    }
}
