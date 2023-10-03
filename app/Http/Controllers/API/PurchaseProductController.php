<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseController;
use App\Models\PurchaseProduct;
use Exception;
use Illuminate\Http\Request;

class PurchaseProductController extends Controller
{
    
    public function index(){
        $data = PurchaseProduct::latest()->get();
        return ResponseController::create($data, 'success', 'get all purchase product success', 200);
    }

    public function destroy(PurchaseProduct $purchaseProduct){

        try {
            PurchaseProduct::destroy($purchaseProduct->id);
            return ResponseController::create(null, 'success', 'delete purchase product success', 200);   
        } catch (Exception $err){
            return ResponseController::create($err->getMessage(), 'error', 'delete purchase error', 500);   
        }
        
    }

}
