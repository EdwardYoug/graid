<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\TestServiceInterface;
use Illuminate\Support\Facades\Http;

class MainController extends Controller
{

    public function serviceProvider(TestServiceInterface $service)
    {
        echo $service->test();
    }

    public function http()
    {
        dd(Http::get('fgdfgdfg'));
    }
}
