<?php

namespace App\Contracts;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

interface TaskServiceInterface
{
    /**
     * Create a new task.
     *
     * @param array $data
     * @return Task
     */
    public function create(array $data): Task;

    /**
     * Delete a task by ID.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;

    /**
     * Mark a task as complete.
     *
     * @param int $id
     * @return Task
     */
    public function markAsComplete(int $id): Task;

    /**
     * Get all tasks.
     *
     * @return Collection
     */
    public function getAllTasks(): Collection;
}
