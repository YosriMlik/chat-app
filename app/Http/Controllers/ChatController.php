<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatRoom;
use App\Models\ChatMessage;
use Illuminate\Support\Facades\Auth;
use App\Events\NewChatMessage;
use Carbon\Carbon;

class ChatController extends Controller
{
    public function rooms(Request $request){
        return ChatRoom::all();
    }

    public function messages(Request $request, $roomId){
        return ChatMessage::where("chat_room_id", $roomId)->with("user")->orderBy("created_at", "DESC")->get();
    }

    public function newMessage(Request $request, $roomId){
        $newMessage = new ChatMessage;
        $newMessage->user_id = Auth::id();
        $newMessage->chat_room_id = $roomId;
        $newMessage->message = $request->message;
        $newMessage->created_at = Carbon::now()->addHours(1);
        $newMessage->updated_at = Carbon::now()->addHours(1);
        $newMessage->save();

        broadcast(new NewChatMessage($newMessage))->toOthers();

        return $newMessage;
    }
}
