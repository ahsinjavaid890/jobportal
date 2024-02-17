<?php

namespace App\Http\Controllers\Admin;
use App\Helpers\Cmf;
use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
  public function index()
  {
    $skills = Skill::latest()->paginate(10);
    return view('admin.skills.index', compact('skills'));
  }
  public function updateskill(Request $request)
  {
    $category = Skill::find($request->id);
    $category->name = $request->name;
    $category->description = $request->description;
    $category->slug = Cmf::shorten_url($request->name);
    $category->save();
    return redirect()->back()->with('message', 'Skill Updated Successfully');
  }
  public function createskill(Request $request)
  {
    $request->validate([
        'name' => 'required|string|unique:skills|max:255',
        'description' => 'nullable|string'
    ]);
    $category = new Skill();
    $category->name = $request->name;
    $category->description = $request->description;
    $category->slug = Cmf::shorten_url($request->name);
    $category->save();
    return redirect()->back()->with('message', 'Skill Added Successfully');
  }
  public function deleteskill($id)
  {
    Skill::where('id' , $id)->delete();
    return redirect()->back()->with('warning', 'Skill Deleted Successfully');
  }
}
