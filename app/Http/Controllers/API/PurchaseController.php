<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseController;
use App\Http\Requests\ValidatePurchaseRequest;
use App\Models\Purchase;
use App\Models\PurchaseProduct;
use Illuminate\Support\Str;
use Exception;

class PurchaseController extends Controller
{
    
    public function index(){
        $data = Purchase::latest()->get();
        return ResponseController::create($data, 'success', 'get all purchase success', 200);
    }

    public function store(ValidatePurchaseRequest $request){

        try {

            $data = [
                ...request()->all(),
                'id' => Str::uuid()->toString(),
                'payment_status' => (request('payment_type') == 'Credit') ? 'waiting' : 'paid'
            ];

            Purchase::create($data);
        } catch (Exception $err){
            return ResponseController::create($err->getMessage(), 'error', 'create purchase error', 500);   
        }

        $purchase = Purchase::latest()->first();

        try {

            foreach(request()->get('products') as $product){
                PurchaseProduct::create([
                    'id' => Str::uuid()->toString(),
                    'product_name' => $product['product_name'],
                    "unit" => $product['unit'],
                    "taxes" => $product['taxes'],
                    "price" => $product['price'],
                    "total_price" => $product['total_price'],
                    "quantity" => $product['quantity'],
                    'purchase_id' => $purchase->id
                ]);
            }
        } catch (Exception $err) {
            Purchase::latest()->first()->delete();
            return ResponseController::create($err->getMessage(), 'error', 'create purchase error', 500);   
        }

        $purchase = Purchase::latest()->first();

        return ResponseController::create($purchase, 'success', 'create purchase success', 200);
    }

    public function getWaitingPurchase(){
        $data = Purchase::latest()->where('payment_status', 'waiting')->get();
        return ResponseController::create($data, 'success', 'get all waiting purchase success', 200);
    }

    public function getMissingPurchase(){
        $data = Purchase::latest()->where('payment_status', 'missing')->get();
        return ResponseController::create($data, 'success', 'get all missing purchase success', 200);
    }

    public function getPaidPurchase(){
        $data = Purchase::latest()->where('payment_status', 'paid')->get();
        return ResponseController::create($data, 'success', 'get all paid purchase success', 200);
    }

    public function getPurchaseBill(){
        $data = Purchase::latest()->where('payment_type', 'credit')->orWhere('payment_type', 'Kredit')->get();
        return ResponseController::create($data, 'success', 'get all purchase bill', 200);
    }

    public function delete(Purchase $purchase){

        try {
            Purchase::destroy($purchase->id);
            return ResponseController::create(null, 'success', 'delete purchase success', 200);
        } catch (Exception $err) {
            return ResponseController::create($err->getMessage(), 'error', 'delete purchase error', 500);   
        }

    }



}