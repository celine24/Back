<?php namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Requests;
use App\Http\Controllers\Controller as Controller;
use App\Job;
use App\Post;
use App\Techno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\User;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
//        $req = Post::with('user')->with('category')->with('job')->orderBy('updated_at', 'desc');
//        if ($request->has('filterBy')) {
//            $req->where($request->get('filterBy') . '_id', $request->get('id'));
//        }
//        $posts = $req->get();

        $user = Auth::user();

        $posts = Post::all();
        $posts_on = Post::where('published', 'on')->orderBy('updated_at', 'desc')->get();
        $posts_uc = Post::where('published', 'uc')->orderBy('updated_at', 'desc')->get();
        $posts_off = Post::where('published', '0')->orderBy('updated_at', 'desc')->get();

        $post_user = Post::where('user_id', $user->id)->get();
        $post_on_user = Post::where('published', 'on')->where('user_id', $user->id)->get();
        $post_off_user = Post::where('published', '0')->where('user_id', $user->id)->get();
        $post_uc_user = Post::where('published', 'uc')->where('user_id', $user->id)->get();
        
        return view('admin.posts.index', compact('posts', 'posts_on', 'posts_uc', 'posts_off', 'post_user', 'post_on_user', 'post_off_user', 'post_uc_user'));

    }

    /**
     * Montre la vue pour créer un article
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $auth_id = Auth::user()->id;
        $categories = Category::lists('name', 'id');
        $jobs = Job::lists('name', 'id');
        $technos = Techno::orderBy('name', 'asc')->get();

        return view('admin.posts.create', compact('auth_id', 'categories', 'jobs', 'technos'));
    }

    /**
     * Permet d'enregistrer un article
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'resume' => 'required',
            'techno' => 'required'
        ]);

        if($validator->fails()) {
            return redirect(route('admin.posts.create'))->withErrors($validator);
        }

        else {
            $post = Post::create($request->all());

            if (isset($request->techno[0])) {
                $techno1_id = $request->techno[0];
                $post->techno1_id = $techno1_id;
            }
            if (isset($request->techno[1])) {
                $techno2_id = $request->techno[1];
                $post->techno2_id = $techno2_id;
            }
            if (isset($request->techno[2])) {
                $techno3_id = $request->techno[2];
                $post->techno3_id = $techno3_id;
            }
            
            $post->save();
            return redirect(route('admin.posts.index'));
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Permet de voir la page d'édition
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $auth_id = Auth::user()->id;
        $categories = Category::lists('name', 'id');
        $jobs = Job::lists('name', 'id');
        $technos = Techno::orderBy('name', 'asc')->get();

        return view('admin.posts.edit', compact('auth_id', 'categories', 'jobs', 'post', 'technos'));
    }

    /**
     * Permet de mettre à jour
     *
     * @param  int $id
     * @return Response
     */
    public function update($id, Request $request)
    {
        $post = Post::findOrFail($id);

        if ($request->has('publication')) 
        {
            $post->published = $request->get('publication');
            $post->save();
        }

        else 
        { 
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'resume' => 'required',
                'techno' => 'required'
            ]);

            if($validator->fails()) 
            {
                return redirect(route('admin.posts.edit'))->withErrors($validator);
            }

            else 
            {
                if (isset($request->techno[0])) 
                {
                    $techno1_id = $request->techno[0];
                    $post->techno1_id = $techno1_id;
                }
                else 
                {
                    $post->techno1_id = null;
                }
                if (isset($request->techno[1])) 
                {
                    $techno2_id = $request->techno[1];
                    $post->techno2_id = $techno2_id;
                }
                else 
                {
                    $post->techno2_id = null;
                }
                if (isset($request->techno[2])) 
                {
                    $techno3_id = $request->techno[2];
                    $post->techno3_id = $techno3_id;
                }
                else 
                {
                    $post->techno3_id = null;
                }

                $post->update($request->all());
                return redirect(route('admin.posts.index'));
            }
        }

        return redirect(route('admin.posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();

        return redirect(route('admin.posts.index'));
    }
}