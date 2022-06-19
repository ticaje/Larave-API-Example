<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    /**
     * @param $id
     *
     * @return mixed
     */
    public function published($id)
    {
        $posts = Post::where('author_id', $id)->where('is_published', 1)->orderBy('created_at', 'desc')->paginate(5);
        $title = 'Published Posts';

        return view('home')->withPosts($posts)->withTitle($title);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function draft($id)
    {
        $posts = Post::where('author_id', $id)->where('is_published', 0)->orderBy('created_at', 'desc')->paginate(5);
        $title = 'Drafted Posts';

        return view('home')->withPosts($posts)->withTitle($title);
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function all(Request $request)
    {
        //
        $user = $request->user();
        $posts = Post::where('author_id', $user->id)->orderBy('created_at', 'desc')->paginate(5);
        $title = 'All Posts';

        return view('home')->withPosts($posts)->withTitle($title);
    }

    /**
     * @param Request $request
     * @param int     $id
     *
     * @return RedirectResponse
     */
    public function profile(Request $request, $id)
    {
        $loggedIn = auth()->user();
        if ($loggedIn && (int)$loggedIn->id !== (int)$id) {
            return redirect('/')->withErrors('Not allowed to see other profiles');
        }
        $data['user'] = User::find($id);
        if (!$data['user']) {
            return redirect('/');
        }
        if ($request->user() && $data['user']->id == $request->user()->id) {
            $data['author'] = true;
        } else {
            $data['author'] = null;
        }
        $data['comments_count'] = $data['user']->comments->count();
        $data['posts_count'] = $data['user']->posts->count();
        $data['posts_active_count'] = $data['user']->posts->where('is_published', '1')->count();
        $data['posts_draft_count'] = $data['posts_count'] - $data['posts_active_count'];
        $data['latest_posts'] = $data['user']->posts->where('is_published', '1')->take(5);
        $data['latest_comments'] = $data['user']->comments->take(5);

        return view('admin.profile', $data);
    }
}
