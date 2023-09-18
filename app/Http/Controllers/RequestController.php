<?php

namespace App\Http\Controllers;

use App\Models\BookingRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    public function index(User $user){
        $requests = BookingRequest::where('id', '=',$user->id);
        return view('user.requests',compact('requests'));
    }
    public function requestStatus(BookingRequest $request , $status){
        if($status === 'approved'){
            $request->update([
                'status' => 'approved',
                
            ]);
        }else{
            $request->update([
                'status' => 'denied',
            ]);
        }
    }
    public function create(){
        return view('users.request');
    }

    public function store(Request $request,$id){
        dd('request');
        try{
        $request->validate([
            'start_time' => 'required',
            'end_time' => 'required',
            'comment' => 'nullable',
        ]);
    }catch(Exception $e){
        return $e->getMessage();
    };
        $request['user_id'] = Auth::id() ?? 1;
        $request['hall_id'] = $id;

        BookingRequest::create($request->all());
        return "inserted";
    }

    public function rooms(){
        return view('users.rooms');
    }
}
