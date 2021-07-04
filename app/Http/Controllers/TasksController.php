<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TasksController extends Controller
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $tasks = Tasks::all(['id', 'title', 'description','status','destination_date']);
        return response()->json($tasks);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $task = Tasks::create($request->post());
        return response()->json([
            'message'=>'Task Created Successfully!!',
            'task'=>$task
        ]);
    }


    public function show(Tasks $tasks)
    {
        return response()->json($tasks);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function edit(Tasks $tasks)
    {
        //
    }


    public function update(Request $request,$id)
    {
        $task = Tasks::find($id);
        $task->fill($request->post())->save();
        return response()->json([
            'message'=>'Task Updated Successfully!!',
            'task'=>$task
        ]);
    }


    public function destroy($id)
    {
        $task = Tasks::find($id);
        $dateNow = date("Y-m-d H:i:s");
        $newDate =  date('Y-m-d', strtotime($dateNow. ' + 6 days'));
        if($task->destination_date > $newDate){
            $task->delete();
            return response()->json([
                'status' => "success",
                'message'=>'Task Deleted Successfully!!'
            ]);
        }else{
            return response()->json([
                'status' => "failure",
                'message'=>'Task Deleted Successfully!!'
            ]);

        }

    }
}
