<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseController;
use App\Http\Requests\StoreVendorValidation;
use App\Models\Vendor;

class VendorController extends Controller
{
    
    public function index(){
        $vendor = Vendor::all();
        return ResponseController::create($vendor, 'success', 'get all vendor success', 200);
    }

    public function show(Vendor $vendor){
        return ResponseController::create($vendor, 'success', 'get all vendor success', 200);
    }

    public function store(StoreVendorValidation $storeVendorValidation){

        try {
            Vendor::create(request()->all());
        } catch (\Exception $e) {
            return ResponseController::create(null, 'error', $e->getMessage(), 200);
        }

        $latest = Vendor::latest()->first();

        return ResponseController::create($latest, 'success', 'create vendor success', 200);
    }

    public function update(Vendor $vendor){

        try {
            $vendor->update(request()->all());
        } catch (\Exception $e) {
            return ResponseController::create(null, 'error', $e->getMessage(), 200);
        }

        $latest = Vendor::latest()->first();

        return ResponseController::create($latest, 'success', 'update vendor success', 200);

    }

    public function destroy(Vendor $vendor){

        try {
            $vendor->delete();
        } catch (\Exception $e) {
            return ResponseController::create(null, 'error', $e->getMessage(), 200);
        }

        return ResponseController::create(null, 'success', 'delete vendor success', 200);
        

    }

}
