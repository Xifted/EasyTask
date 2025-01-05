<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskDetail;
use App\Models\TaskStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user()->id;

        // Handle filters
        $search = $request->input('search', '');
        $orderBy = $request->input('order_by', 'created_at'); // Default sorting by date
        $sortOrder = $request->input('sort_order', 'desc'); // Default order descending
        $perPage = $request->input('per_page', 10); // Default pagination
        // dd($search);
        // Fetch tasks with filters
        $tasks = Task::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%");
        })
            ->where('user_id', $user)
            ->orderBy($orderBy, $sortOrder)
            ->paginate($perPage);

        return view('todo-list', compact('tasks', 'orderBy', 'sortOrder', 'search', 'perPage'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user()->id;

        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        // Simpan data ke database
        Task::create([
            'name' => $request->title,
            'user_id' => $user,
            'created_at' => Carbon::now(),
        ]);

        return redirect()->route('dashboard.index')->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, Request $request)
    {
        $userId = Auth::user()->id;
        $userIdCheck = Task::where('id', $id)->first();

        if ($userId != $userIdCheck->user_id) {
            return redirect()->back()->with('alert', "You dont have access");
        } else {
            // Handle filters
            $search = $request->input('search');
            $statusFilter = $request->input('status');
            $orderBy = $request->input('order_by', 'deadline'); // Default sorting by date
            $sortOrder = $request->input('sort_order', 'asc'); // Default order descending
            $perPage = $request->input('per_page', 10); // Default pagination

            // Fetch tasks with filters
            $taskDetails = TaskDetail::select('task_details.*', 'task_status.name as status_name')
                ->when($search, function ($query, $search) {
                    return $query->where('task_details.title', 'like', "%{$search}%");
                })
                ->when($statusFilter, function ($query, $statusFilter) {
                    return $query->where('task_details.status_id', $statusFilter);
                })
                ->where('task_details.task_id', $id)
                ->join('task_status', 'task_details.status_id', '=', 'task_status.id')
                ->orderBy($orderBy, $sortOrder)
                ->paginate($perPage);

            $taskStatus = TaskStatus::all();
            return view('todo-details', compact('taskStatus', 'taskDetails', 'orderBy', 'sortOrder', 'search', 'perPage', 'id'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $taskIds = $request->input('task_ids'); // ID tasks yang akan dihapus

        if ($taskIds != null) {
            foreach ($taskIds as $id) {
                $task = Task::find($id);
                if ($task) {
                    // Hapus data terkait di task_details
                    $task->details()->delete();
                    // Hapus task
                    $task->delete();
                }
            }
        }

        return redirect()->route('user-list.index')->with('success', 'Tasks deleted successfully.');
    }

    public function showTaskDetail(Request $request, string $id)
    {
        $userId = Auth::user()->id;
        $taskIdCheck = TaskDetail::where('id', $id)->first();
        $userIdCheck = Task::where('id', $taskIdCheck->task_id)->first();

        if ($userId != $userIdCheck->user_id) {
            return redirect()->back()->with('alert', "You dont have access");
        } else {
            $taskDetailId = $id;
            $taskDetails = TaskDetail::select('task_details.*', 'task_status.name as status_name')
                ->join('task_status', 'task_details.status_id', '=', 'task_status.id')
                ->findOrFail($id);
            $taskStatus = TaskStatus::all();
            return view('task-details', compact('taskDetails', 'taskStatus', 'taskDetailId'));
        }
    }

    public function addTaskDetail(Request $request, String $id)
    {
        $taskId = $id;
        $title = $request->input('title');
        $statusId = $request->input('status');
        $deadline = $request->input('deadline');
        $description = $request->input('description');
        // dd($request->all());

        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required|exists:task_status,id',
            'deadline' => 'required|date_format:Y-m-d\TH:i',
            'description' => 'nullable|string',
        ]);
        // Simpan data ke database
        TaskDetail::create([
            'task_id' => $taskId,
            'title' => $title,
            'status_id' => $statusId,
            'deadline' => $deadline,
            'description' => $description,
        ]);

        return redirect()->route('dashboard.show', $taskId)->with('success', 'Task detail created successfully.');
    }

    public function destroyTaskDetail(Request $request)
    {
        $taskIds = $request->input('task_ids'); // ID tasks yang akan dihapus

        if ($taskIds != null) {
            foreach ($taskIds as $id) {
                $task = TaskDetail::find($id);
                if ($task) {
                    // Hapus data terkait di task_details
                    $task->details()->delete();
                    // Hapus task
                    $task->delete();
                }
            }
        }

        return redirect()->back()->with('success', 'Tasks deleted successfully.');
    }

    public function updateTaskDetail(Request $request, string $id)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required',
            'deadline' => 'required|date_format:Y-m-d\TH:i',
            'description' => 'nullable|string',
        ]);

        // Update level user
        $task = TaskDetail::findOrFail($id);
        $task->title = $request->title;
        $task->status_id = $request->status;
        $task->deadline = $request->deadline;
        $task->description = $request->description;
        $task->save();

        return redirect()->back()->with('success', 'Task detail updated successfully.');
    }
}
