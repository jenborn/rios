<?php

namespace App\Http\Controllers;

use App\Models\ToDo;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;


class ToDoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todos = ToDo::all();
    
        return view('todos.index',compact('todos'))
            ->with('i', (request()->input('page', 1) - 1) * 5);        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('todos.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required'
        ]);
        //$now = Carbon::now();
        $request['insertDT'] = "2023-01-24 17:05:00";
        //$request->merge(['insertDT' => "2023-01-24 17:05:00"]);
        //dd($request->all());
        Log::info(json_encode($request));
    
        ToDo::create($request->all());
     
        return redirect()->route('todos.index')
                        ->with('success','ToDo created successfully.');        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ToDo  $toDo
     * @return \Illuminate\Http\Response
     */
    public function show(ToDo $todo)
    {
        return view('todos.show',compact('todo'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ToDo  $toDo
     * @return \Illuminate\Http\Response
     */
    public function edit(ToDo $todo)
    {
        return view('todos.edit',compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ToDo  $toDo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ToDo $todo)
    {
        $request->validate([
            'name' => 'required'
        ]);
    
        $todo->update($request->all());
    
        return redirect()->route('todos.index')
                        ->with('success','ToDo updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ToDo  $toDo
     * @return \Illuminate\Http\Response
     */
    public function destroy(ToDo $todo)
    {
        $todo->delete();
    
        return redirect()->route('todos.index')
                        ->with('success','ToDo deleted successfully');
    }

    public function up(ToDo $todo){
        return view('todos.edit',compact('todo'));
    }
}
