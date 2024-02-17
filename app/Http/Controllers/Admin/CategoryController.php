<?php

namespace App\Http\Controllers\Admin;
use App\Helpers\Cmf;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
  public function index()
  {
    $categories = Category::latest()->paginate(10);
    return view('admin.category.index', compact('categories'));
  }
  public function updatecategory(Request $request)
  {
    $category = Category::find($request->id);
    $category->name = $request->name;
    $category->description = $request->description;
    $category->slug = Cmf::shorten_url($request->name);
    $category->save();
    return redirect()->back()->with('message', 'Category Updated Successfully');
  }
  public function createcategory(Request $request)
  {
    $request->validate([
        'name' => 'required|string|unique:categories|max:255',
        'description' => 'nullable|string'
    ]);
    $category = new Category();
    $category->name = $request->name;
    $category->description = $request->description;
    $category->slug = Cmf::shorten_url($request->name);
    $category->save();
    return redirect()->back()->with('message', 'Category Added Successfully');
  }
  public function deletecategory($id)
  {
    Category::where('id' , $id)->delete();
    return redirect()->back()->with('warning', 'Category Deleted Successfully');
  }
}
