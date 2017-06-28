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
        $forum = Forum::where('unit_id', $unit->id)
            ->first();

        $threads = Thread::where('forum_id', $forum->id)
            ->get();
        foreach ($threads as $thread)
        {
            $thread->user = User::find($thread->user_id);
            $thread->posts = Post::where('thread_id', $thread->id)
                ->get();
            $thread->created_by_date = Carbon::parse($thread->created_at)->toDateTimeString();
        }
        $forum->threads = $threads;

        $data['unit'] = $unit;
        $data['forum'] = $forum;

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

        $posts = Post::where('thread_id', $thread->id)
            ->get();
        foreach ($posts as $post)
        {
            $post->user = User::find($post->user_id);
            $post->created_by_date = Carbon::parse($post->created_at)->toDateTimeString();
        }
        $thread->posts = $posts->splice(1);
        $thread->first_post = $posts->first();

        $data['unit'] = $unit;
        $data['thread'] = $thread;

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
