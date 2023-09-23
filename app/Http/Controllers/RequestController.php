<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
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
    public function requestStatus(Request $request, BookingRequest $bookingRequest)
    {
        // dd($bookingRequest,$request);
        if ($request->status === 'approved') {
            $bookingRequest->update([
                'status' => 'approved',
                'admin_id' => Auth::id(),
            ]);
            Appointment::create([
                'hall_id' => $bookingRequest->hall_id,
                'appointed_id' => $bookingRequest->user_id,
                'appointed_type' => 'App\Models\User',
                'start_time' => $bookingRequest->start_time,
                'end_time' => $bookingRequest->end_time,
                'comment' => $bookingRequest->comment,
            ]);
            //  ******************************** //
            // event('RequestAccepted');
            //  ******************************** //
        } else {
            $bookingRequest->update([
                'status' => 'denied',
                'reason' => $request->reason,
                'admin_id' => Auth::id(),
            ]);
        }
        return redirect(route('showRequests'));
    }
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
        $bookingRequest->user_id = Auth::id();
        $bookingRequest->hall_id = $id;
        $bookingRequest->start_time = $request->start_time;
        $bookingRequest->end_time = $request->end_time;
        $bookingRequest->status = 'submitted';
        $bookingRequest->created_at = now();
        $bookingRequest->updated_at = now();

        $bookingRequest->save();
        // BookingRequest::create($request->all());
        return redirect(route('user.showUserRequests',Auth::id()));
    }
    public function showUserRequests(User $user)
    {
        $bookingRequests = BookingRequest::with('hall')->where('user_id', $user->id)->get();
        return view('users.requests', compact('bookingRequests'));
    }
    public function edit(Hall $hall, BookingRequest $bookingRequest)
    {
        // dd($bookingRequest);
        return view('users.editRequest', compact('bookingRequest', 'hall'));
    }
    public function update(Request $request,$hall,$bookingRequest)
    {
        // dd($bookingRequest);
        $bookingRequest = BookingRequest::find((intval($bookingRequest)));
        // dd($bookingRequest);
        $bookingRequest->update($request->all());
        return redirect(route('user.showUserRequests',Auth::id()));

    }
    public function delete(BookingRequest $bookingRequest)
    {
        $bookingRequest->delete();
        return redirect(route('users.showUserRequests', Auth::id()));
    }

    public function rooms()
    {
        $halls = Hall::paginate(3);
        return view('users.rooms', compact('halls'));
    }
}
