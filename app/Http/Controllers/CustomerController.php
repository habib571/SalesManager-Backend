<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use App\Traits\HttpResponses;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    use HttpResponses;

    public function addCustomer(CustomerRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $user = auth()->User();
            $customer = new Customer();
            $customer->name = $validatedData['name'];
            $customer->contact = $validatedData['contact'];
            $customer->address = $validatedData['address'];
            $customer->details = $validatedData['details'];
            $customer->email = $validatedData['email'];
            $customer->user_id = $user->user_id;
            $customer->save(); 
            return  $this->success($customer);
        } catch (\Exception $e) {
            return  $this->error('Failed to create new customer', ['details' => $e->getMessage()], 500);
        }
    }

    public function getCustomers()
    {
        try {
            $user  = auth()->user();
            $customers = Customer::where('user_id', $user->user_id)
                ->orderBy('created_at', 'desc')->get();
            return $this->success($customers);
        } catch (\Exception $e) {
            return  $this->error('Failed to retrieve Customers', ['details' => $e->getMessage()], 500);
        }
    }
    public function deleteCustomer($customerId)
    {
        try {
            $user  = auth()->user();
            $customer = Customer::where('user_id', $user->user_id)->findOrfail($customerId);
            $customer->delete();
            return $this->success();
        } catch (\Exception $e) {
            return  $this->error('Failed to delete Customers', ['details' => $e->getMessage()], 500);
        }
    }
    public function updateCustomer(CustomerRequest $customer, $customerId)
    {
        try {
            $user  = auth()->user();
            $customer = Customer::where('user_id', $user->user_id)->findOrfail($customerId);
            $customer->update(
                $customer->only(
                    ['name', 'address', 'contact', 'email', 'details']
                )

            );
        } catch (\Exception $e) {
            return  $this->error('Failed to update Customers', ['details' => $e->getMessage()], 500);
        }
    }
}
