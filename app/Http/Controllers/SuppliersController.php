<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupplierRequest;
use App\Models\Supplier;
use App\Traits\HttpResponses;

use Illuminate\Http\Request;

class SuppliersController extends Controller
{
    use HttpResponses;
    public function addSupplier(SupplierRequest $request)
    {
        try {
            $user = auth()->user();
            $validatedData = $request->validated();
            $supplier = new Supplier();
            $supplier->suplier_name = $validatedData['supplier_name'];
            $supplier->contact =  $validatedData['contact'];
            $supplier->address =  $validatedData['address'];
            $supplier->description =  $validatedData['description'];
            $supplier->user_id = $user->user_id; 

            $supplier->save();
            return  $this->success($supplier, 200);
        } catch (\Exception $e) {
            return  $this->error('Failed to create new supplier', ['details' => $e->getMessage()], 500);
        }
    }
    public function getSuppliers()
    {
        try {
            $user = auth()->user();
            $suppliers = Supplier::where('user_id', $user->user_id)
                ->orderBy('created_at', 'desc')->get();
            return $this->success(
                ["suppliers" =>  $suppliers]
            );
        } catch (\Exception $e) {
            return  $this->error('Failed to create new supplier', ['details' => $e->getMessage()], 500);
        }
    }  
    public function deleteSupplier($supplierId) {  

     try {  
        $user =auth()->user() ; 
        $supplier = Supplier::where('user_id' , $user->user_id)->findOrfail($supplierId) ;
         $supplier->delete() ; 
          return  $this->success();
        
     }catch (\Exception $e) {
        return  $this->error('Failed to delete supplier', ['details' => $e->getMessage()], 500);
    }
         

    } 
    public function updateSupplier($supplierId) { 
        try {  
            $validatedData = $request->validated();
            $user =auth()->user() ; 
            
        $supplier = Supplier::where('user_id' , $user->user_id)->findOrfail($supplierId) ;
        $supplier->update(
            $request->only(
                 ['supplier_name', 'contact', 'address', 'description']
            )
       );
        } 
        
         
    catch (\Exception $e) {
        return  $this->error('Failed to update supplier', ['details' => $e->getMessage()], 500);
    }


}
}