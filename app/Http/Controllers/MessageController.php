<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Models\Message;
use App\Models\MessageUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();

        $sendSubquery = Message::select(DB::raw('MAX(id) as id'))
            ->where('user_id', $userId)
            ->groupBy('receiver_id');

        $sendChats = Message::whereIn('id', $sendSubquery)
            ->with('receiver')
            ->with(['messageUser'])
            ->get();

        $receivedSubquery = Message::select(DB::raw('MAX(id) as id'))
            ->where('receiver_id', $userId)
            ->groupBy('user_id');

        $receivedChats = Message::whereIn('id', $receivedSubquery)
            ->with(['user'])
            ->with(['messageUser'])
            ->get();

        // Merge and filter to keep only the latest message when user and message_user are the same person
        $allChats = $sendChats->merge($receivedChats)->unique('id')->sortByDesc('created_at')->values();

        // Group by user_id and receiver_id
        $groupedChats = $allChats->groupBy(function ($item) use ($userId) {
            return $item->user_id == $userId ? $item->receiver_id : $item->user_id;
        })->map(function ($messages) {
            return $messages->first();
        })->values();

        return response()->json([
            'chats' => $groupedChats
        ], Response::HTTP_OK);
    }

    public function chatRoom(string $id)
    {
        $myId = Auth::id();
        //marking them as read
        $messages = Message::where('user_id', $myId)
            ->where('receiver_id', $id)
            ->whereHas('messageUser', function ($query) {
                $query->where('is_read', false);
            })
            ->get();
        foreach ($messages as $message) {
            $messageStatus = MessageUser::find($message->id);
            $messageStatus->is_read = true;
            $messageStatus->update();
        }

        $sendChats = Message::where('user_id', $myId)
            ->where('receiver_id', $id)
            ->get();
        $receivedChats = Message::where('receiver_id', $myId)
            ->where('user_id', $id)
            ->get();

        $allChats = $sendChats->merge($receivedChats)->unique('id')->values();

        return response()->json([
            'chats' => $allChats
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(string $id, MessageRequest $request)
    {
        $message = Message::create([
            'content' => $request->input('message'),
            'user_id' => Auth::id(),
            'receiver_id' => $id,
            'group_id' => null,
        ]);

        MessageUser::create([
            'is_read' => false,
            'user_id' => Auth::id(),
            'message_id' => $message->id,
        ]);

        return response()->json([
            'message' => 'Message send'
        ], Response::HTTP_OK);
    }
}
