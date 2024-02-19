<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Job;
use App\Models\Role;
use App\Models\User;
use App\Models\blogs;
use App\Models\blogcategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
class DashboardController extends Controller
{
  public function index()
  {
    $jobCount = Job::active()->count();
    $applicationsCount = Application::count();
    $userRole = Role::withCount('users')->whereName('user')->first();
    $superAdminRole = Role::withCount('users')->whereName(['superadmin'])->first();
    $adminRole = Role::withCount('users')->whereName(['admin'])->first();
    $userCount = $userRole->users_count;
    $superAdminCount = $superAdminRole->users_count;
    $adminCount = $adminRole->users_count;
    $adminCount += $superAdminCount;
    return view('admin.dashboard.index', compact('jobCount', 'applicationsCount', 'userCount', 'adminCount'));
  }
  public function messages()
  {
      $data = DB::table('contactus_messages')->orderby('created_at', 'desc')->paginate(10);
      return view('admin/contact/messages')->with(array('data' => $data));
  }
  public function viewmessage($id)
  {
      $data = DB::table('contactus_messages')->where('id', $id)->first();
      return view('admin/contact/viewmessage')->with(array('data' => $data));
  }
  public function deletemessage($id)
  {
      DB::table('contactus_messages')->where('id', $id)->delete();
      return redirect()->back()->with('message', 'Message Deleted Successfully');
  }
  public function blogcategories()
    {
        $data = DB::table('blogcategories')->where('website', 'lifeadvice')->get();
        return view('admin.blogs.categories')->with(array('data' => $data));
    }
    public function deleteblogcategory($id)
    {
        blogs::where('category_id', $id)->delete();
        blogcategories::where('id', $id)->delete();
        return redirect()->back()->with('message', 'Blog Category Deleted Successfully');
    }
    public function allblogs()
    {
        $data = DB::table('blogs')->get();
        $categories = blogcategories::where('website', 'lifeadvice')->get();
        return view('admin.blogs.addblog')->with(array('data' => $data, 'categories' => $categories));
    }
    public function addnewblogcategory(Request $request)
    {
        $saveblog = new blogcategories;
        $saveblog->name = $request->name;
        $saveblog->status = 1;
        $saveblog->url = Cmf::shorten_url($request->name);
        $saveblog->save();
        return redirect()->back()->with('message', 'Blog Category Successfully Inserted');
    }
    public function updatblogcategory(Request $request)
    {
        $saveblog = blogcategories::find($request->id);
        $saveblog->name = $request->name;
        $saveblog->status = $request->status;
        $saveblog->url = Cmf::shorten_url($request->name);
        $saveblog->save();
        return redirect()->back()->with('message', 'Blog Category Updated Successfully');
    }
    public function createblog(Request $request)
    {
        $add = new blogs();
        $add->website = 'lifeadvice';
        $add->category_id = $request->category_id;
        $add->title = $request->title;
        $add->url = Cmf::shorten_url($request->title);
        $add->content = $request->content;
        $add->image = Cmf::sendimagetodirectory($request->image);
        $add->save();
        return redirect()->back()->with('message', 'Blog Added Successfully');
    }
    public function updateblog(Request $request)
    {
        $add = blogs::find($request->id);
        $add->category_id = $request->category_id;
        $add->title = $request->title;
        $add->url = Cmf::shorten_url($request->title);
        $add->content = $request->content;
        if ($request->image) {
            $add->image = Cmf::sendimagetodirectory($request->image);
        }
        $add->save();
        return redirect()->back()->with('message', 'Blog Updated Successfully');
    }
    public function deleteblog($id)
    {
        blogs::where('id', $id)->delete();
        return redirect()->back()->with('message', 'Blog Deleted Successfully');
    }
}
