<?php

namespace App\Http\Controllers;

use App\Http\Requests\HallRequest;
use App\Models\BookingRequest;
use App\Models\Hall;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HallController extends Controller
{
    public function index()
    {
       $halls =  Hall::paginate(2);
       return view('admins.spaces',compact('halls'));
    }
    public function create()
    {
        return view('halls.add'); // add Hall
    }
    public function store(HallRequest $request)
    {
        // dd('testing');
        $request->validated();
        $request['days_of_works'] = $request->from_day . " to " . $request->to_day;
        Hall::create($request->all());
        $success = session('success');
        return redirect(route('hall.index',$success));
    }
    public function show(){
        return view('admins.spaces');
    }
    public function edit(Hall $hall)
    {
            $days = explode(' ',$hall->days_of_works);
        // dd($days);
        $from_day = $days[0];
        $to_day = $days[2] ?? "";
        // dd($from_day );
        return view('halls.edit',compact('hall','from_day','to_day'));
    }
    public function update(HallRequest $request,Hall $hall)
    {
        $request->validated();
        $hall->update($request->all());
        $success = session('success');
        return redirect(route('hall.index',$success));

    }
    public function destroy(Hall $hall)
    {
        Hall::destroy($hall->id);
        return redirect(route('hall.index'));

    }

    public function showRequests(){
        $bookingRequests = BookingRequest::with('hall','user')->where('status', 'submitted')->get();
        return view('admins.showRequests',compact('bookingRequests'));
    }
}
