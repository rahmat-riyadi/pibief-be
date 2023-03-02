<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseController;
use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    
    public function index(){
        $data = Purchase::latest()->get();
        return ResponseController::create($data, 'success', 'get all purchase success', 200);
    }

}
