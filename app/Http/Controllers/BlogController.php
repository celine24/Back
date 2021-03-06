<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Illuminate\Http\Request;
use App\Post;
use App\Job;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $jobs = Job::all();

        $posts = Post::published()
            ->orderBy('updated_at', 'desc')
            ->where('category_id', '1')
            ->get()
            ->take(3);

        $vignettes = Post::published()
            ->orderBy('updated_at', 'desc')
            ->where('category_id', '1')
            ->skip(3)
            ->take(1000)
            ->get();

        if(isset($_GET['jobid']) && ($_GET['jobid'] > '0' && $_GET['jobid'] < '8')  ){

            $jobid = $_GET['jobid'];

            $posts = Post::published()
                ->take(3)
                ->orderBy('updated_at', 'desc')
                ->where('job_id', $_GET['jobid'])
                ->where('category_id', '1')
                ->get();

            $vignettes = Post::published()
                ->orderBy('updated_at', 'desc')
                ->where('job_id', $_GET['jobid'])
                ->where('category_id', '1')
                ->skip(3)
                ->take(1000)
                ->get();
        }

//        si jobid <1 ou >7 is_int

        return view('pages.blog.index', compact('posts', 'vignettes', 'jobs'));
    }

    /**
     * @param $id
     * @return \Illuminate\View\View
     */
    public function article($id)
    {
        $post = Post::findOrFail($id);

        $userPosts = Post::published()
            ->orderByRaw('RAND()')
            ->where('user_id', $post->user->id)
            ->where('id', '!=', $post->id)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        $jobPosts = Post::published()
            ->orderByRaw('RAND()')
            ->where('job_id', $post->job->id)
            ->where('id', '!=', $post->id)
            ->get()
            ->take(2);

        $postSticky = Post::published()
            ->orderByRaw('RAND()')
            ->where('is_sticky', 'on')
            ->where('id', '!=', $post->id)
            ->take(1)
            ->get();

        return view('pages.blog.article', compact('post', 'userPosts', 'jobPosts', 'postSticky'));
    }

    public function allArticlesUser($id)
    {

        $user = User::findOrFail($id);

        $vignettes = Post::published()->where('user_id', $user->id)->where('category_id', '1')->orderBy('created_at', 'desc')->get();

        return view('pages.blog.all-articles-user', compact('user', 'vignettes'));
    }
}
