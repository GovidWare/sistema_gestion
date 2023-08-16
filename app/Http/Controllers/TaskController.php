<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Alert;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TasksExport;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::where('user_id', Auth::id())
        ->where('status','<>','PR')
        ->orderBy('status')
        ->orderBy('id','DESC')
        ->paginate(15);

        $tasks_pr = Task::where('user_id', Auth::id())
        ->where('status','PR')
        ->orderBy('id','DESC')
        ->paginate(15);

        return view('tasks.index', compact('tasks','tasks_pr'));
    }

    public function allTasks()
    {
        $tasks = Task::paginate(15);

        return view('tasks.all', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|max:50',
            'description' => 'nullable|max:200',
            'start_date'  => 'required|date',
            'end_date'    => 'required|date|after_or_equal:start_date',
            'file'        => 'nullable|mimes:pdf,xlsx,docx,txt,pptx|max:2048',
        ], [
            'end_date.after_or_equal' => 'La fecha final debe ser mayor o igual que la fecha inicial.',
        ]);

        $task = new Task();
        $task->user_id = Auth::id();

        $task->fill($request->all());

        if($request->hasFile('file')){
            $file = time() . '_' . $request->file->getClientOriginalName();
            $request->file('file')->storeAs('uploads', $file);
            $task->file = $file;
        }

        if ($task->save()) {
            Alert::success(__('Tareas'), __('Se ha registrado la información'))->persistent('Close');
            return redirect()->route('tasks.index');
        }else{
            Alert::warning(__('Tareas'), __('Ha surgido un error, por favor intente nuevamente'))->persistent('Close');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        $data = $task;
        return view('tasks.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $data = $task;
        return view('tasks.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title'       => 'required|max:50',
            'description' => 'nullable|max:200',
            'start_date'  => 'required|date',
            'end_date'    => 'required|date|after_or_equal:start_date',
            'file'        => 'nullable|mimes:pdf,xlsx,docx,txt,pptx|max:2048',
        ], [
            'end_date.after_or_equal' => 'La fecha final debe ser mayor o igual que la fecha inicial.',
        ]);

        $task->fill($request->all());

        if($request->hasFile('file')){
            $file = time() . '_' . $request->file->getClientOriginalName();
            $request->file('file')->storeAs('uploads', $file);
            $task->file = $file;
        }

        if ($task->save()) {
            Alert::success(__('Tareas'), __('Se ha registrado la información'))->persistent('Close');
            return redirect()->route('tasks.index');
        }else{
            Alert::warning(__('Tareas'), __('Ha surgido un error, por favor intente nuevamente'))->persistent('Close');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        if ($task->delete()) {
            Alert::success(__('Tareas'), __('Se ha eliminado el registro'))->persistent('Close');
            return redirect()->route('tasks.index');
        }else{
            Alert::warning(__('Tareas'), __('Ha surgido un error, por favor intente nuevamente'))->persistent('Close');
            return redirect()->back();
        }
    }

    public function download(Task $task)
    {
        $filePath = storage_path('app/uploads/' . $task->file);

        if (file_exists($filePath)) {
            return response()->download($filePath, $task->file);
        } else {
            Alert::warning(__('Tareas'), __('Ha surgido un error, por favor intente nuevamente'))->persistent('Close');
            return redirect()->back();
        }
    }
    public function completed(Task $task)
    {
        $task->status = 'CO';
        if ($task->save()) {
            Alert::success(__('Tareas'), __('Se ha registrado la información'))->persistent('Close');
            return redirect()->route('tasks.index');
        }else{
            Alert::warning(__('Tareas'), __('Ha surgido un error, por favor intente nuevamente'))->persistent('Close');
            return redirect()->back();
        }
    }


    public function downloadReport(){
        return Excel::download(new TasksExport, 'Reporte_Tareas.xlsx');
    }
}
