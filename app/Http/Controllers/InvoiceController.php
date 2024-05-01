<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvoiceProductRequest;
use App\Models\Invoice;
use App\Models\Invoiceproduct;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    use HttpResponses;
    public function  addInvoice($custmomerId  ,$invoiceId , InvoiceProductRequest $request)
    {
        try{
            $user = auth()->user();
            $invoice = new Invoice();
            $invoice->cutomer_id = $custmomerId;
            $invoice->user_id = $user->user_id;
            $invoice->save();  
            $data = $request->validate() ;  
             
            foreach($data as $key=>$value) { 
                $invoiceProd =  new Invoiceproduct() ; 
                $invoiceProd->user_id = $user->user_id ; 
                $invoiceProd->invoice_id = $invoiceId ;
                $invoiceProd->product_id = $value['product_id'] ;

            }
             




        } catch (\Exception $e) {
            return  $this->error('Failed to create new Invoice', ['details' => $e->getMessage()], 500);
        }
    }
}
