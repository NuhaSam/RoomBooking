<?php

namespace App\Http\Controllers;

use App\Http\Requests\HallRequest;
use App\Models\Hall;
use Illuminate\Http\Request;

class HallController extends Controller
{
    public function index()
    {
       $halls =  Hall::paginate(8);
        return view('halls.index',compact('halls'));
    }
    public function create()
    {
        return view('halls.create');
    }
    public function store(HallRequest $request){
        $request->validated();
        Hall::create($request->all());
        $success = session('success');
        return redirect(route('hall.index',$success));
    }
    public function show(){
        
    }
    public function edit()
    {
        return view('halls.edit');
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
    }
}
