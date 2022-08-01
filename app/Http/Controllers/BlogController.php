<?php

namespace App\Http\Controllers;

use App\Models\{
    Blog,
    BlogComment
};
use App\Http\Requests\{
    StoreBlogRequest,
    UpdateBlogRequest
};
use Illuminate\{
    Database\Eloquent\SoftDeletes,
    Support\Facades\Auth,
    Http\Request
};

class BlogController extends Controller
{
    use SoftDeletes;

    public function __construct()
    {
        $this->middleware(['auth', 'verified'])->except(['index', 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blog =  Blog::paginate(10);
        return view('blog.index', compact('blog'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBlogRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlogRequest $request)
    {
        Blog::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'body' => $request->body
        ]);
        return redirect(route('blog.index'))->with('message', 'Blog created successful!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        return view('blog.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        return view('blog.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBlogRequest  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        $blog->update([
            'body' => $request->body
        ]);
        return redirect(route('blog.show', compact('blog')))->with('message', 'Blog details updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect(route('blog.index'))->with('message', 'Blog deleted!');
    }

    public function comment(Request $request, Blog $blog) {
        $request->validate([
            'comment' => ['required', 'string', 'max:500']
        ]);
        BlogComment::create([
            [
                'blog_id' => $blog->id,
                'user_id' => Auth::id(),
                'comment' => $request->input('comment')
            ]
        ]);
        return back()->with('success', 'Comment saved');
    }
    public function search($keyword) {
        $blog = Blog::where('title', 'LIKE', "%{$keyword}%")
            ->latest()
            ->paginate(10);
        return view('blog.search', [
            'blog' => $blog
        ]);
    }

}
