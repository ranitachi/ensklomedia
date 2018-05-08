<?php

namespace App\Http\Controllers;
use App\Message;
use Illuminate\Http\Request;
use App\Events\MessageSent;
class ChatsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('chat');
    }

    public function fetch()
    {
        return Message::with('user')->get();
    }

    public function sendMessage(Request $request)
    {
        $user = Auth::user();

        $message = $user->messages()->create([
            'message' => $request->input('message')
        ]);

        broadcast(new MessageSent($user, $message));

        // return ['status' => 'Message Sent!'];
    }
}
