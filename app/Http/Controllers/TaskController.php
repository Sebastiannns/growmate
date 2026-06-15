<?php

// Controller: TaskController — handle task management (to do list.png)
namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Tampilkan daftar tugas
    public function index()
    {
        $tasks = Task::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('task.index', compact('tasks'));
    }

    // Simpan tugas baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'deadline' => ['nullable', 'date'],
        ]);

        Task::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $request->deadline,
        ]);

        return redirect()->route('task.index')->with('success', 'Tugas berhasil ditambahkan!');
    }

    // Update status & detail tugas
    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);

        $request->validate([
            'status' => ['nullable', 'in:pending,in_progress,completed'],
            'title' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'deadline' => ['nullable', 'date'],
        ]);

        $task->update($request->only(['status', 'title', 'description', 'deadline']));

        return redirect()->route('task.index')->with('success', 'Tugas diperbarui!');
    }

    // Hapus tugas
    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);
        $task->delete();

        return redirect()->route('task.index')->with('success', 'Tugas berhasil dihapus!');
    }
}
