<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrintController extends Controller
{
    public function PrintLabel(Request $request)
    {
        str_replace("world","Peter","Hello world!");
    }

    public function PrintReceipt(Request $request)
    {

    }
}
