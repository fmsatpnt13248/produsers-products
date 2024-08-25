<?php

namespace App\Http\Controllers\old;

use App\Http\Controllers\Controller;
use App\Models\Producer;

class ProducerSearchController extends Controller
{
    public function index()
    {
        return response()->json(Producer::all());
    }
}
