<?php

namespace App\Http\Controllers;

use App\Contracts\TaskServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function __construct(
        private TaskServiceInterface $taskService
    ) {}

    /**
     * Display the main tasks page.
     */
    public function index(): View
    {
        $tasks = $this->taskService->getAllTasks();
        
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Store a new task.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'description' => 'required|string|max:255',
        ]);

        $this->taskService->create([
            'description' => $request->description,
        ]);

        return redirect()->route('tasks.index')
            ->with('success', 'Task created successfully!');
    }

    /**
     * Mark a task as complete.
     */
    public function complete(int $id): RedirectResponse
    {
        $this->taskService->markAsComplete($id);

        return redirect()->route('tasks.index')
            ->with('success', 'Task marked as complete!');
    }

    /**
     * Delete a task.
     */
    public function destroy(int $id): RedirectResponse
    {
        $this->taskService->delete($id);

        return redirect()->route('tasks.index')
            ->with('success', 'Task deleted successfully!');
    }
}
