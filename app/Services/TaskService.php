<?php

namespace App\Services;

use App\Contracts\TaskServiceInterface;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TaskService implements TaskServiceInterface
{
    /**
     * Create a new task.
     *
     * @param array $data
     * @return Task
     */
    public function create(array $data): Task
    {
        return Task::create([
            'description' => $data['description'],
            'is_completed' => false,
        ]);
    }

    /**
     * Delete a task by ID.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $task = Task::find($id);
        
        if (!$task) {
            throw new ModelNotFoundException("Task with ID {$id} not found.");
        }

        return $task->delete();
    }

    /**
     * Mark a task as complete.
     *
     * @param int $id
     * @return Task
     */
    public function markAsComplete(int $id): Task
    {
        $task = Task::findOrFail($id);
        $task->markAsCompleted();
        
        return $task->fresh();
    }

    /**
     * Get all tasks.
     *
     * @return Collection
     */
    public function getAllTasks(): Collection
    {
        return Task::orderBy('created_at', 'desc')->get();
    }


}
