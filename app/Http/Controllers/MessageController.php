<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\User;
use App\MessageThread;
use App\Message;
use Carbon\Carbon;

class MessageController extends Controller
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
     * Show the messages page.
     *
     * @return \Illuminate\Http\Response
     */
    public function messages(Request $request)
    {
        $user = Auth::user();
        $message_threads = $this->get_message_threads($user);
        $message_threads = $this->set_message_threads($user, $message_threads);

        $data['message_threads'] = $message_threads;

        return view('messages', ['data' => $data]);
    }

    /**
     * Show the message page.
     *
     * @return \Illuminate\Http\Response
     */
    public function message(Request $request)
    {
        $user = Auth::user();
        $message_thread = $this->get_message_thread($request);
        $message_thread = $this->set_message_thread_with_messages($user, $message_thread);

        $data['user'] = $user;
        $data['message_thread'] = $message_thread;

        return view('message', ['data' => $data]);
    }

    /**
     * Show the contacts page.
     *
     * @return \Illuminate\Http\Response
     */
    public function contacts(Request $request)
    {
        $user = Auth::user();
        $contacts = $this->get_contacts($user);
        $contacts = $this->set_contacts($user, $contacts);

        $data['user'] = $user;
        $data['contacts'] = $contacts;
        
        return view('contacts', ['data' => $data]);
    }

    private function get_contacts($user)
    {
        $contacts = User::all()->except($user->id);

        return $contacts;
    }

    private function set_contacts($user, $contacts)
    {
        foreach ($contacts as $contact)
        {
            $contact = $this->set_contact($user, $contact);
        }

        return $contacts;
    }

    private function set_contact($user, $contact)
    {
        $message_thread = $this->get_message_thread_where_contact($user, $contact);
        $contact = $this->set_message_thread_where_contact($contact, $message_thread);

        return $message_thread;
    }

    private function get_message_thread_where_contact($user, $contact)
    {
        $message_thread = MessageThread::where('user_id_1', $user->id)
            ->where('user_id_2', $contact->id)
            ->first();
        if ($message_thread == null)
        {
            $message_thread = MessageThread::where('user_id_1', $contact->id)
                ->where('user_id_2', $user->id)
                ->first();
        }
        if ($message_thread == null)
        {
            $message_thread = MessageThread::create([
                'user_id_1' => $user->id,
                'user_id_2' => $contact->id,
                'preview' => '',
            ]);
        }

        return $message_thread;
    }

    private function set_message_thread_where_contact($contact, $message_thread)
    {
        $contact->message_thread = $message_thread;

        return $message_thread;
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
        $messages = $this->get_messages($user);

        $data['user'] = $user;
        $data['messages'] = $messages;
        
        return view('messages', ['data' => $data]);
    }

    private function get_message_threads($user)
    {
        $message_threads = MessageThread::where('user_id_1', $user->id)
            ->orWhere('user_id_2', $user->id)
            ->get();
        return $message_threads;
    }

    private function set_message_threads($user, $message_threads)
    {
        foreach ($message_threads as $message_thread)
        {

            $message_thread = $this->set_message_thread($user, $message_thread);
        }
        
        return $message_threads;
    }

    private function set_message_thread($user, $message_thread)
    {
        $other_user = $this->get_other_user($user, $message_thread);
        $message_thread = $this->set_other_user($message_thread, $other_user);

        return $message_thread;
    }

    private function get_other_user($user, $message_thread)
    {
        if ($message_thread->user_id_1 == $user->id)
        {
            $other_user = User::find($message_thread->user_id_2);
        } 
        else
        {
            $other_user = User::find($message_thread->user_id_1);
        }

        return $other_user;
    }

    private function set_other_user($message_thread, $other_user)
    {
        $message_thread->other_user = $other_user;

        return $message_thread;
    }

    // Message Page Helper Functions

    private function get_message_thread($request)
    {
        $message_thread = MessageThread::find($request->message_thread_id);

        return $message_thread;
    }

    private function set_message_thread_with_messages($user, $message_thread)
    {
        $other_user = $this->get_other_user($user, $message_thread);
        $message_thread = $this->set_other_user($message_thread, $other_user);

        $messages_grouped_by_date = $this->get_messages_grouped_by_date($user, $message_thread);
        $message_thread = $this->set_messages_grouped_by_date($message_thread, $messages_grouped_by_date);

        return $message_thread;
    }

    private function get_messages_grouped_by_date($user, $message_thread)
    {
        $messages_grouped_by_date = Message::where('message_thread_id', $message_thread->id)
            ->get()
            ->groupBy(function($date) {
                return Carbon::parse($date->created_at)->format('D, d M');
            });

        return $messages_grouped_by_date;
    }

    private function set_messages_grouped_by_date($message_thread, $messages_grouped_by_date)
    {
        foreach ($messages_grouped_by_date as $date => $messages)
        {
            foreach ($messages as $message)
            {
                $message = $this->set_message($message);
            }
        }
        $message_thread->messages_grouped_by_date = $messages_grouped_by_date;

        return $message_thread;
    }

    private function set_message($message)
    {
        $formatted_time = $this->get_formatted_time($message);
        $message = $this->set_formatted_time($message, $formatted_time);

        return $message;
    }

    private function get_formatted_time($message)
    {
        $formatted_time = Carbon::parse($message->created_at)->format("h:m");

        return $formatted_time;
    }

    private function set_formatted_time($message, $formatted_time)
    {
        $message->formatted_time = $formatted_time;

        return $message;
    }
}
