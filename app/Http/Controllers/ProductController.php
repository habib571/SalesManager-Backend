<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;

class ProductController extends Controller
{
     use HttpResponses;
     public function addProduct(ProductRequest $request, $categoryId , $supplierId)
     {
          try { 
               
               $validatedData = $request->validated(); 
               if($validatedData['purshase_price'] > $validatedData['sales_price']) {
                     
                    return  $this->error('sales price must be greater than purshase price');
               }
               $user  = auth()->user();
               $product = new Product();
               $product->user_id = $user->user_id;
               $product->name = $validatedData['name'];
               $product->category_id = $categoryId;
               $product->model = $validatedData['model'];
               $product->sales_price = $validatedData['sales_price'];
               $product->serial_number = $validatedData['serial_number'];
               $product->tax = $validatedData['tax'];
               $product->purshase_price = $validatedData['purshase_price'] ;
               $product->supplier_id = $supplierId ;
               /* $category = Category::where('id' ,  $product->category_id)->first(); 
               if($category) {
                    $product->category_name = $category->name ;
               }*/
           
                 
               $product->save();
               return  $this->success($product, 200);
          } catch (\Exception $e) {
               return  $this->error('Failed to create category', ['details' => $e->getMessage()], 500);
          }
     }

     public function getProducts()
     {
          try {
               $user  = auth()->user();

               $products = Product::with('category')->with('supplier')
                    ->where('user_id', $user->user_id)
                    ->orderBy('created_at', 'desc')->get();
               $transformedProducts = $products->map(function ($product) {
                    return [
                         'id' => $product->id,
                         'name' => $product->name,
                         'category_name' => $product->category->name,
                         'serial_number' => $product->serial_number, 
                         'supplier' => $product->supplier->suplier_name ,
                         'model' => $product->model,
                         'sales_price' => $product->sales_price,
                         'tax' => $product->tax

                    ];
               });
               return $this->success(['products' => $transformedProducts]);
          } catch (\Exception $e) {
               return  $this->error('Failed to retrieve products', ['details' => $e->getMessage()], 500);
          }
     }

     public function deleteProducts($productId)
     {
          try {
               $user = auth()->user();
               $product = Product::where('user_id', $user->user_id)->findOrFail($productId);
               $product->delete();
               return $this->success('Product deleted successfully!');
          } catch (\Exception $e) {
               return $this->error('Failed to delete Product!', $e->getMessage(), 500);
          }
     }
     public function updateproducts(ProductRequest $request, $productId)
     {
          try {
               $user = auth()->user();
               $product = Product::where('id', $user->user_id)->findOrFail($productId);
               $product->update(
                    $request->only(
                         ['name', 'category_name', 'serial_number', 'sales_price', 'tax', 'model' ,'purshase_price']
                    )
               );
               return $this->success('Product update successfully!');
          } catch (\Exception $e) {
               return $this->error('Failed to update Product!', $e->getMessage(), 500);
          }
     }
}
