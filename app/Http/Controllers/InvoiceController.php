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
    public function  addInvoice($custmomerId, InvoiceProductRequest $request)
    {
        try {
            $user = auth()->user();
            $invoice = new Invoice();
            $invoice->customer_id = $custmomerId;
            $invoice->user_id = $user->user_id;
            $invoice->save();
            $data = $request->validated();
           
            foreach ($data['product_id'] as $key => $product_id) {
                $sale = new Invoiceproduct();
                $sale->quantity = $data['quantity'][$key];
                $sale->price = $data['price'][$key];
                $sale->discount = $data['discount'][$key];
                $sale->amount = $data['amount'][$key];
                $sale->product_id = $product_id;
                $sale->invoice_id = $invoice->id; 
                $sale->user_id = $user->user_id;
                 $sale->save();
            }
             
            return  $this->success();
        } catch (\Exception $e) {
            return  $this->error('Failed to create new Invoice', ['details' => $e->getMessage()], 500);
        }
    }
}
