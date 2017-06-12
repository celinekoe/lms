<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Message;
use Carbon\Carbon;

class MessageController extends Controller
{
    /**
     * Show the messages page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $messages = $this->getMessages($user);

        $data['user'] = $user;
        $data['messages'] = $messages;
        
        return view('messages', ['data' => $data]);
    }

    /**
     * Show the create message page.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
		$data = null;

        return view('create_message', ['data' => $data]);
    }

    /**
     * Store message.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $message = Message::create([
        	'receiver_id' => $request->receiver_id,
        	'sender_id' => $user->id,
        	'body' => $request->body,
        ]);
        $messages = $this->getMessages($user);

        $data['user'] = $user;
        $data['messages'] = $messages;
        
        return view('messages', ['data' => $data]);
    }

    /**
     * Get messages.
     *
     * @return \Illuminate\Http\Response
     */
    public function getMessages($user)
    {
        $user = Auth::user();
        $messages = Message::where('receiver_id', $user->id)
        					->orWhere('sender_id', $user->id)
        					->orderBy('created_at', 'desc')
        					->get();
       	foreach ($messages as $message)
       	{
       		$message->sender = User::find($message->sender_id);
       		$message->receiver = User::find($message->receiver_id);
       		$message->created_at_date = Carbon::parse($message->created_at)->toDateString();
       	}

        return $messages;
    }
}
