<?php

namespace App\Http\Controllers;

use App\Http\Transforms\PostTransformer;
use App\Http\Transforms\UserTransform;
use App\Models\User;
use App\Models\UserPost\Post;
use App\Transformers\TransformerUser;
use Illuminate\Http\Request;
use App\SessionMessage\SessionMessage;

class TestController extends Controller
{
    use SessionMessage;
//    function __construct()
//    {
//        $this->authorizeResource(Post::class,'post');
//    }

    public function delete(Request $request)
    {
        $post = Post::find($request->id);
//        $this->authorize('delete', $post);
        return
            auth()->user()->can('delete', $post) ?
                $this->processStatus('post was deleted successfully', 'success')
                : $this->processStatus('You must be the owner of this post to be able to delete this post.', 'warning');
    }

    public function index()
    {
//        $users=User::with(['posts','detail'])->withCount('posts')->get();
//        return fractal()->collection($users,new UserTransform())->parseIncludes(['posts','detail'])->toArray();
        $user=User::withCount('posts')->with(['posts','detail'])->get();
        return fractal()->collection($user,new UserTransform())->parseIncludes(['posts','detail'])->toArray();
        return view('welcome');
    }
}
