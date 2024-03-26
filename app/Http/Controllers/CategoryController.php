<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\HttpResponses;
use App\Http\Requests\AddCategoryrequest;

class CategoryController extends Controller
{
     use HttpResponses;
     public function createCategory(AddCategoryrequest $request)
     {

          try {
               $validatedData = $request->validated();
               $user = auth()->User();
               $category = new Category();
               $category->name = $validatedData['name'];
               $category->user_id = $user->user_id;
               $category->status = 'active';
               $category->save();
               return  $this->success($category, 200);
          } catch (\Exception $e) {
               return  $this->error('Failed to create category', ['details' => $e->getMessage()], 500);
          }
     }
     public function getCategories()
     {
          try {
               $user  = auth()->user();
               $categories = Category::where('user_id', $user->user_id)
                    ->orderBy('created_at', 'desc')->get();
               return $this->success($categories);
          } catch (\Exception $e) {
               return  $this->error('Failed to retrieve categories', ['details' => $e->getMessage()], 500);
          }
     }

     public function updateCategory(AddCategoryrequest $request, $categoryId)
     {

          try {
               $user  = auth()->user();
               $category = Category::where('user_id', $user->user_id)->findOrFail($categoryId);
               $request->validated();
               $category->update($request->only(['name']));


               return $this->success($category, 'Category updated successfully!');
          } catch (\Exception $e) {
               return $this->error('Failed to update Category!', $e->getMessage(), 500);
          }
     }   

     public function deleteCategory($categoryId) {

           try{
               $user  = auth()->user(); 
               $category = Category::where('user_id', $user->user_id)->findOrFail($categoryId);
                $category->delete() ;
                return $this->success('Category deleted successfully!');
               
           }catch (\Exception $e) {
               return $this->error('Failed to delete Category!', $e->getMessage(), 500);
          }
     }


}
