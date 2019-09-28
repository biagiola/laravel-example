<?php

namespace App\Http\Controllers;
//read the differents libraries fom laravel in the documentacion
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;//nombre del namespace del providers/Post.php el cual es ''App'' con el nombre de la clase a usar, Post en este caso; así extendemos todas las funcionalidades de Model en este archivo ej Post::all()
use DB; //usar sql puro


class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *This is for block guests posts
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', [ 'except' => ['index', 'show'] ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
       //$posts = Post::orderBy('title', 'desc')->get();
       //$posts = Post::orderBy('title', 'desc')->take(1)->get(); //para agarrar solo uno
       // $posts = Post::all();//this is fetch all the date in this table - eloquent
       //$post = Post::where('title', 'Post Two')->get(); //solo retorna lo que especificamos
       //$posts = DB::select('SELECT * FROM posts');

        $posts = Post::orderBy('title', 'asc')->paginate(10);//si tenes por ej 11 posts, mostrará solo 10 y luego siguiente
        return view ('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required' , 
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);

        // Handle file upload
        if ($request->hasFile('cover_image')) { //we check if the user upload the file
            // Get file name with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME); //this is just php, extracting the name without extension
            // Get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension(); //this is laravel
            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension; //para darle un nombre unico
            // Upload image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore); //where and the name of the image
        } else {
            $fileNameToStore = 'noimage.jpg';
        } 
            
        //Create post
        $post = new Post;//podemos usar este obj porque trajimos linea 6
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        $post->save();

        return redirect('/posts')->with('success', 'Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        // Check for correct user
        if(auth()->user()->id !==$post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }
        
        return view('posts.edit')->with('post', $post);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $this->validate($request, [
            'title' => 'required' , 
            'body' => 'required'
        ]);

        // Handle file upload
        if ($request->hasFile('cover_image')) { //we check if the user upload the file
            // Get file name with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME); //this is just php, extracting the name without extension
            // Get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension(); //this is laravel
            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension; //para darle un nombre unico
            // Upload image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore); //where and the name of the image
        } 
            
        //Create post
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
         if ($request->hasFile('cover_image')) {
             $post->cover_image = $fileNameToStore;
         }
        $post->save();

        return redirect('/posts')->with('success', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        if(auth()->user()->id !==$post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }
        // in case someone uploads a new post without an image
        if ($post->cover_image != 'noimage.jpg'){
            // Delete image
            Storage::delete('public/cover_images/'.$post->cover_image);
        }
        
        $post->delete();
        return redirect('/posts')->with('success', 'Post Removed');
    }
}
