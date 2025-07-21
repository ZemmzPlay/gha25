<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Posts;
use Auth;

class AdminBlogController extends Controller
{
  public function list()
  {
    return view('admin.blog.list');
  }

  public function getData(Request $request)
  {
    $query = Posts::where('id', '>', 0);

    if ($request->has('search') && $request->search['value'] != '') {
      $query->where('title', 'like', "%" . $request->search['value'] . "%")->orwhere('text', 'like', "%" . $request->search['value'] . "%");
        // Add more conditions for other searchable columns
    }

    $totalData = $query->count();

    $data = $query->offset($request->start)->limit($request->length)->get();

    $formattedData = $data->map(function ($item) {
      return [
        'id' => $item->id,
        'title' => $item->title,
        'author' => $item->author,
        'text' => substr(strip_tags($item->text), 0, 50) . "..."
      ];
    });

    return [
      'draw' => intval($request->draw),
      'recordsTotal' => $totalData,
      'recordsFiltered' => $formattedData->count(),
      'data' => $formattedData
    ];
  }

  public function loadCreate()
  {
    return view('admin.blog.create');
  }

  public function create(Request $request)
  {
    $request->validate([
      'title' => 'required|max:191',
      'text' => 'required',
      'author' => 'required',
      'thumbnail' => 'required|mimes:jpeg,bmp,png,svg',
    ]);

    $post = new Posts();

    $post->slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->title)));
    $post->title = $request->title;
    $post->text = $request->text;
    $post->author = $request->author;

    $file = $request->file('thumbnail');
    $file_name = $request->title . '_' . time() . '.' . $file->getClientOriginalExtension();
    Storage::putFileAs('public/posts/', $file, $file_name);

    $post->thumbnail = $file_name;
    $post->admin_id = Auth::guard("admin")->user()->id;

    $post->save();

    return redirect()->route('blog.posts')->with('message', 'Post Added Successfully');
  }

  public function view($id)
  {
    $post = Posts::find($id);

    return view('admin.blog.view', ["post" => $post]);
  }

  public function update(Request $request, $id)
  {
    $request->validate([
      'title' => 'required|max:191',
      'text' => 'required',
      'author' => 'required',
      'thumbnail' => 'required|sometimes|mimes:jpeg,bmp,png,svg',
    ]);

    $post = Posts::find($id);

    $post->slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->title)));
    $post->title = $request->title;
    $post->text = $request->text;
    $post->author = $request->author;

    if($request->hasFile('thumbnail'))
    {
      $file = $request->file('thumbnail');
      $file_name = $request->title . '_' . time() . '.' . $file->getClientOriginalExtension();
      Storage::putFileAs('public/posts/', $file, $file_name);

      $post->thumbnail = $file_name;
    }
    // $post->admin_id = Auth::guard("admin")->user()->id;

    $post->save();

    return redirect()->route('blog.post.view', $id)->with('message', 'Post Updated Successfully');
  }

  /**
   * delete the Post
   */
  public function deletePost(Request $request)
  {
    // $id = Crypt::decrypt($id);
    $post = Posts::find($request->id);

    if($post)
    {
      $post->delete();
    }
  }
}
