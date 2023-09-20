<?php

namespace App\Http\Controllers;

use App\Models\BookingRequest;
use App\Models\Hall;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    // public function index(User $user)
    // {
    //     $requests = BookingRequest::where('id', '=', $user->id);
    //     return view('user.requests', compact('requests'));
    // }
    // public function requestStatus(BookingRequest $request, $status)
    // {
    //     if ($status === 'approved') {
    //         $request->update([
    //             'status' => 'approved',

    //         ]);
    //     } else {
    //         $request->update([
    //             'status' => 'denied',
    //         ]);
    //     }
    // }
    public function create(Hall $hall)
    {
        return view('users.makeRequest', compact('hall'));
    }
    public function store(Request $request, $id)
    {
        // dd('request');
            $request->validate([
                'start_time' => 'required',
                'end_time' => 'required',
                'comment' => 'nullable',
            ]);
       
        $bookingRequest = new BookingRequest();
        $bookingRequest->user_id = Auth::id() ?? 1;
        $bookingRequest->hall_id = $id;
        $bookingRequest->start_time = $request->start_time;
        $bookingRequest->end_time = $request->end_time;
        $bookingRequest->status = 'submitted';
        $bookingRequest->created_at = now();
        $bookingRequest->updated_at = now();

        $bookingRequest->save();
        // BookingRequest::create($request->all());
        return redirect(route('user.showUserRequests'));
    }
    public function showUserRequests(User $user)
    {
        $bookingRequests = BookingRequest::with('hall')->where('user_id', $user->id)->get();
        return view('users.requests', compact('bookingRequests'));
    }
    public function edit()
    {

    }
    public function update()
    {

    }
    public function delete()
    {

    }

    public function rooms()
    {
        $halls = Hall::paginate(3);
        return view('users.rooms', compact('halls'));
    }
}
