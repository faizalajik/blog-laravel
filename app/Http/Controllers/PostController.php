<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
use App\Coment;
use DB;
class PostController extends Controller
{
    //
      public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('post.create');
//         return redirect('/home');
// // 
    }

    public function store(Request $request)
    {
    	$request->validate([
            'title' => 'required|unique:blogs|max:255',
            'content' => 'required',
        ]);
        $title = $request->input('title');
        $content = $request->input('content');

        $post = new Blog;
        $post->title = $title;
        $post->content = $content;
        $post->like = 0 ; 
        $post->save();

        $request
            ->session()
            ->flash('success_message', 'Success create new post!');

        return redirect('/home');
    }
    public function destroy(Request $request, $id)
    {
        Blog::destroy($id);

        $request
            ->session()
            ->flash('success_message', 'Post deleted!');

        return redirect('/home');
    }

    public function edit($id)
    {
        $data = [
            'post' => Blog::findOrFail($id)
        ];
        return view('post.edit', $data);
    }

     public function update(Request $request, $id)
    {
    	$request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);
        $post = Blog::findOrFail($id);
        $post->title = $request->title;
        $post->content = $request->content;
        $post->save();

        $request
            ->session()
            ->flash('success_message', 'Post updated!');

        return redirect('/home');
    }

    public function show($id){
    	$data = [
            'post' => Blog::findOrFail($id),
            'koment' => DB::table('coments')->select('*')->join('users', 'coments.user_id', '=', 'users.id')
            ->where('coments.post_id', $id)
            ->get()
        ];
        return view('post.detail', $data);
    }

    public function addComment(Request $request){

        // $comment = $request->input('comment');
       	// dd($comment);
       	Coment::create([
       		'post_id' => $request->input('id'),
       		'user_id'=> auth()->id(),
       		'koment'=> $request->input('comment')
       	]);
       	return redirect()->back();
    }

    public function getBlog($id){
		$blog = DB::table('blogs')->where('id', $id)->first();
		$blog->like = $blog->like + 1 ; 
        $like = DB::table('blogs')->where('id', $id)->update(['like'=> $blog->like]);
        return redirect()->back();
    }

    
}
