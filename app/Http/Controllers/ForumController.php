<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Unit;
use App\Forum;
use App\Thread;
use App\Post;
use Carbon\Carbon;

class ForumController extends Controller
{
    /**
     * Show the forum page.
     *
     * @return \Illuminate\Http\Response
     */
    public function threadindex(Request $request)
    {
        $unit = Unit::find($request->unit_id);
        $forum = Forum::where('unit_id', $unit->id)->first();
        $threads = Thread::where('forum_id', $forum->id)->get();
        foreach ($threads as $thread)
        {
            $thread->user = User::find($thread->user_id);
            $thread->created_by_date = Carbon::parse($thread->created_at)->toDateString();
        }
        $data['unit'] = $unit;
        $data['forum'] = $forum;
        $data['threads'] = $threads;
        return view('forum', ['data' => $data]);
    }

    /**
     * Show the thread page.
     *
     * @return \Illuminate\Http\Response
     */
    public function postindex(Request $request)
    {
        $unit = Unit::find($request->unit_id);
        $thread = Thread::find($request->thread_id);
        $posts = Post::where('thread_id', $thread->id)->get();
        foreach ($posts as $post)
        {
            $post->user = User::find($post->user_id);
            $post->created_by_date = Carbon::parse($post->created_at)->toDateString();
        }
        $other_posts = $posts->splice(1);
        $data['unit'] = $unit;
        $data['thread'] = $thread;
        $data['first_post'] = $posts->first();
        $data['posts'] = $other_posts;
        return view('thread', ['data' => $data]);
    }

    /**
     * Show the create thread page.
     *
     * @return \Illuminate\Http\Response
     */
    public function threadcreate(Request $request)
    {
        $data = null;

        return view('create_thread', ['data' => $data]);
    }
}
