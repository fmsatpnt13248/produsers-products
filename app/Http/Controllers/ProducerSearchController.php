<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Models\Producer;
use Illuminate\Http\Request;

class ProducerSearchController extends Controller
{
    public function index()
    {
        return response()->json(Producer::all());
    }
}
