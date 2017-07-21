<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Unit;
use App\Forum;
use App\Thread;
use App\Post;
use Carbon\Carbon;

class ForumController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the forum page.
     *
     * @return \Illuminate\Http\Response
     */
    public function thread_index(Request $request)
    {
        $unit = Unit::find($request->unit_id);
        $forum = Forum::where('unit_id', $unit->id)
            ->first();
        $forum->threads = $this->threads($forum);

        $data['unit'] = $unit;
        $data['forum'] = $forum;

        return view('forum', ['data' => $data]);
    }

    /**
     * Show the create thread page.
     *
     * @return \Illuminate\Http\Response
     */
    public function thread_create(Request $request)
    {
        $unit = Unit::find($request->unit_id);
        $data['unit'] = $unit;

        return view('create_thread', ['data' => $data]);
    }

    /**
     * Store the thread
     *
     * @return \Illuminate\Http\Response
     */
    public function thread_store(Request $request)
    {
        $user = Auth::user();
        $unit = Unit::find($request->unit_id);
        $forum = Forum::where('unit_id', $unit->id)
            ->first();

        $thread = Thread::create([
            'user_id' => $user->id,
            'forum_id' => $request->unit_id,
            'title' => $request->title,
        ]);
        $post = Post::create([
            'user_id' => $user->id,
            'thread_id' => $thread->id,
            'body' => $request->body,
        ]);

        $forum->threads = $this->threads($forum);

        $data['unit'] = $unit;
        $data['forum'] = $forum;

        return view('forum', ['data' => $data]);
    }

    /**
     * Delete the thread.
     *
     * @return void
     */
    public function thread_delete(Request $request)
    {
        Post::where('thread_id', $request->thread_id)
            ->delete();
        Thread::find($request->thread_id)
            ->delete();
    }

    /**
     * Show the thread page.
     *
     * @return \Illuminate\Http\Response
     */
    public function post_index(Request $request)
    {
        $user = Auth::user();
        
        $unit = Unit::find($request->unit_id);
        $thread = $this->get_thread($request);
        $thread = $this->set_thread($user, $thread);

        $data['unit'] = $unit;
        $data['thread'] = $thread;

        return view('thread', ['data' => $data]);
    }

    private function get_thread($request)
    {
        $thread = Thread::find($request->thread_id);

        return $thread;
    }

    private function set_thread($user, $thread)
    {
        $thread->user = $user;
        $thread->posts = $this->posts($thread);

        return $thread;
    }

    /**
     * Store the post
     *
     * @return \Illuminate\Http\Response
     */
    public function post_store(Request $request)
    {
        $user = Auth::user();

        $this->validate($request, [
            'body' => 'required',
        ]);

        $post = Post::create([
            'user_id' => $user->id,
            'thread_id' => $request->thread_id,
            'body' => $request->body,
        ]);
    }

    /**
     * Edit the post.
     *
     * @return \Illuminate\Http\Response
     */
    public function post_update(Request $request)
    {
        $this->validate($request, [
            'body' => 'required',
        ]);

        $post = Post::find($request->post_id)
            ->update(['body' => $request->body]);
    }

    /**
     * Delete the post.
     *
     * @return \Illuminate\Http\Response
     */
    public function post_delete(Request $request)
    {
        Post::find($request->post_id)
            ->delete();
    }

    /**
     * Get thread details
     *
     * @return App\Thread
     */
    private function threads($forum)
    {
        $threads = Thread::where('forum_id', $forum->id)
            ->get();
        foreach ($threads as $thread)
        {
            $thread->user = User::find($thread->user_id);
            $thread->posts = Post::where('thread_id', $thread->id)
                ->get();
            $thread->created_by_date = Carbon::parse($thread->created_at)->toDateTimeString();
        }
        return $threads;
    }

    /**
     * Get post details
     *
     * @return App\Post
     */
    private function posts($thread)
    {
        $posts = Post::where('thread_id', $thread->id)
            ->get();
        foreach ($posts as $post)
        {
            $post->user = User::find($post->user_id);
            $post->created_by_date = Carbon::parse($post->created_at)->toDateTimeString();
        }
        return $posts;
    }
}
