<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Roilift\Admin\Models\PostMessage;
use Roilift\Admin\Models\PostMessageReply;
use Roilift\Admin\Interfaces\ConfigRepositoryInterface;

class MessageController extends Controller
{
    public function __construct(protected ConfigRepositoryInterface $configRepository)
    {
    }
    
    public function index()
    {
        $perPage = $this->configRepository->getConfigValueByKey('postperpage');
        if(!$perPage) {
            $perPage = 15;
        }

        $messages = PostMessage::where('from', auth()->user()->id)
            ->orWhere('to', auth()->user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
        
        return view('account.message.index', compact('messages'));
    }

    public function view()
    {
        $message = PostMessage::where('id', request('id'))->get()->first();
        if($message->from != auth()->user()->id) {
            $message->seen = 1;
            $message->save();
        }

        $message->replies = $message->replies()->orderBy('created_at', 'asc')->get();
        $message->fromUser->posts = $message->fromUser->posts()->orderBy('created_at', 'desc')->limit(5)->get();
        $message->toUser->posts = $message->toUser->posts()->orderBy('created_at', 'desc')->limit(5)->get();

        return view('account.message.view', compact('message'));
    }

    public function delete()
    {
        $replies = PostMessageReply::where('post_message_id', request('message_id'))->get();
        foreach($replies as $reply) {
            $reply->delete();
        }

        $message = PostMessage::where('id', request('message_id'))->get()->first();
        $message->delete();

        return redirect()->route('message')->with('message', 'Message deleted successfully');
    }

    public function send()
    {
        if(!request('message')) {
            return response()->json([
                'success' => false,
                'message' => 'Please enter a message'
            ]);
        }

        $message = PostMessage::create([
            'post_id' => request('post_id') ?? null,
            'from' => auth()->user()->id,
            'to' => request('user_to'),
            'message' => request('message'),
            'seen' => 0
        ]);
        
        try {
            Mail::to($message->toUser->email)->send(new \App\Mail\Message($message));

            return response()->json([
                'success' => true,
                'message' => 'Your message has been sent',
                'data' => $message
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Your message could not be sent'
                // 'message' => $e->getMessage()
            ]);
        }
    }

    public function reply()
    {
        // dd($reply->toUser->email);
        if(request('reply') == '') {
            return response()->json([
                'success' => false,
                'message' => 'Please enter a message'
            ]);
        }

        try {
            $reply = PostMessageReply::create([
                'post_message_id' => request('post_message_id'),
                'post_id' => request('post_id'),
                'from' => auth()->user()->id,
                'to' => request('to'),
                'comment' => request('reply'),
            ]);

            Mail::to($reply->toUser->email)->send(new \App\Mail\MessageReply($reply));

            return response()->json([
                'success' => true,
                'message' => 'Your reply has been sent',
                'data' => $reply
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage()
            ]);
        }
    }
}
