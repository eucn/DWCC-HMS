<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Manage_Room;

class ManageRoomController extends Controller
{
    // Manage Rooms
    public function index()
    {
        $rooms = Manage_Room::all();

        // return view('admin.admin_manage-rooms', compact('rooms'));
        return view('admin.admin_manage-rooms')->with('rooms', $rooms);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'room_number' => 'required|numeric',
            'room_type' => 'required',
            'room_description' => 'required',
            'max_capacity' => 'required|numeric',
            'amenities' => 'required',
            'status' => 'required',
            'rate' => 'required|numeric',
            'photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        $requestData = $request->all();
        $fileName = time().$request->file('photos')->getClientOriginalName();
        $path = $request->file('photos')->storeAs('images', $fileName, 'public');
        $requestData["photos"] = '/storage/'.$path;
        Manage_Room::create($requestData);
        return redirect()->route('admin.room.index')->with('success', 'The record has been successfully added.');
    }

    public function edit($id){
{ 
     
    $room = manage_room::findOrFail($id);
    return view('room_number', compact('room'));

}

    }
     public function destroy($id)
     {
         $room = manage_room::findOrFail($id);
         $room->delete();
         
         return redirect()->route('admin.room.index')->with('success', 'Room has been deleted.')->with('rooms', $room);;
     }

     public function update(Request $request, $id)
{
    $room = manage_room::findOrFail($id);

    if ($room) {
        $room->room_number = $request->input('room_number');
        $room->room_description = $request->input('room_description');
        $room->room_type = $request->input('room_type');
        $room->max_capacity = $request->input('max_capacity');
        $room->amenities = $request->input('amenities');
        $room->status = $request->input('status');
        $room->rate = $request->input('rate');
    $room->update($request->all());
        $room->save();

        return redirect()->route('admin.room.index')->with('success', 'Room has been updated.')->with('room', $room);
    }


}

}



