<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupplierRequest;
use App\Models\Supplier;
use App\Traits\HttpResponses;

use Illuminate\Http\Request;

class SuppliersController extends Controller
{
    use HttpResponses; 
    public function addSupplier(SupplierRequest $request , $productId) {
         try { 
             $user= auth()->user() ;
             $validatedData = $request->validated(); 
             $supplier = new Supplier() ;
             $supplier->supplier_name = $validatedData['supplier_name'] ; 
             $supplier->contact =  $validatedData['contact'] ; 
             $supplier->address =  $validatedData['address'] ; 
             $supplier->description =  $validatedData['description'] ; 
             $supplier->product_id = $productId ; 
             $supplier->user_id = $user->user_id ; 
             $supplier->save() ;
             return  $this->success($supplier, 200);
            } catch (\Exception $e) {
                 return  $this->error('Failed to create new supplier', ['details' => $e->getMessage()], 500);
    }
    //
}
}