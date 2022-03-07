<?php

namespace App\Http\Controllers\Admin;
use App\Model\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Model\Category;
use App\Model\Tag;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    protected $ruleValidation =  [
        'title' => 'required|max:255',
        // 'author' => 'required|max:255',
        'content' => 'required',
        'image'=> 'nullable|image',
        'category_id' => 'exists:App\Model\Category,id'

    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(20);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexUser()
    {
        $posts = Post::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //passiamo le categorie alla pagina create
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create',  [ 'categories' => $categories, 'tags' => $tags]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        // dd($data);
        $data['user_id'] = Auth::user()->id;
        $data['author'] = Auth::user()->name;

        $validateData = $request->validate([
            'title' => 'required|max:255',
            // 'author' => 'required|max:255',
            'content' => 'required',
            'image'=> 'nullable|image',
            'category_id' => 'exists:App\Model\Category,id',
            'tags.*' => 'nullable|exists:App\Model\Tag,id'
        ]);


        // variabili upload per img
        if(!empty($data['image'])){
            $img_path = Storage::put('uploads', $data['image']);
            $data['image'] = $img_path;
        }

        $newPost = new Post();

        $newPost->fill($data);
        $newPost->slug = $newPost->createSlug($data['title']);
        $newPost->save();

        if (!empty($data['tags'])) {
            $newPost->tags()->attach($data['tags']);
        }

        
        return redirect()->route('admin.posts.show', $newPost);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        // dd($post);
        $data = [
            'post' =>$post
        ];
        return view('admin.posts.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        // dd($post);
        if (Auth::user()->id != $post->user_id) {
            abort('403');
        }
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.edit', ['post' => $post, 'categories' => $categories, 'tags' => $tags]);

        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $validateData = $request->validate($this->ruleValidation);
        $data = $request->all();
        $updated = $post->update($data);

        if (Auth::user()->id != $post->user_id) {
            abort('403');
        }

        if(!$updated){
            dd('update non riuscito');
        }

        if ($data['title'] != $post->title) {
            $post->title = $data['title'];
            $post->slug = $post->createSlug($data['title']);
        }
        if ($data['content'] != $post->content) {
            $post->content = $data['content'];
        }
        if ($data['category_id'] != $post->category_id) {
            $post->category_id = $data['category_id'];
        }


        $post->update();

        if (!empty($data['tags'])) {
            $post->tags()->sync($data['tags']);
        } else {
            $post->tags()->detach();
        }

        return redirect()->route('admin.posts.show', $post)
        ->with('status', "post $post->title Saved!");
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        
        $post->tags()->detach();
        $post->delete();

        return redirect()->route('admin.posts.index')
        ->with('status', "Post id $post->id deleted");
    }
}
