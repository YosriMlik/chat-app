<?php

namespace App\Http\Controllers;

use App\Models\ChatRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class RoomController extends Controller
{

    public function index()
    {
        return ChatRoom::where("user_id", Auth::id())->with("user")->orderBy("created_at", "DESC")->get();
    }

    public function store(Request $request)
    {
        $newRoom = new ChatRoom;
        $newRoom->user_id = Auth::id();
        $newRoom->name = $request->name;
        $newRoom->created_at = Carbon::now()->addHours(1);
        $newRoom->updated_at = Carbon::now()->addHours(1);
        $newRoom->save();

        return $newRoom;
    }

    public function destroy(string $id)
    {
        $room = ChatRoom::find($id);
        $room->delete();
        return response()->json(["message" => "Room deleted successfully"], 201);;
    }


    public function show(string $id)
    {

    }


    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
}
