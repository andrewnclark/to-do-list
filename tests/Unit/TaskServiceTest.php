<?php

namespace Tests\Unit;

use App\Contracts\TaskServiceInterface;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskServiceTest extends TestCase
{
    use RefreshDatabase;

    private TaskServiceInterface $taskService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->taskService = new TaskService();
    }

    /**
     * Test creating a new task.
     */
    public function test_can_create_task(): void
    {
        $taskData = [
            'description' => 'This is a test task',
        ];

        $task = $this->taskService->create($taskData);

        $this->assertInstanceOf(Task::class, $task);
        $this->assertEquals('This is a test task', $task->description);
        $this->assertFalse($task->is_completed);
        $this->assertDatabaseHas('tasks', [
            'description' => 'This is a test task',
            'is_completed' => false,
        ]);
    }

    /**
     * Test marking a task as complete.
     */
    public function test_can_mark_task_as_complete(): void
    {
        $task = Task::create([
            'description' => 'Test Description',
            'is_completed' => false,
        ]);

        $completedTask = $this->taskService->markAsComplete($task->id);

        $this->assertTrue($completedTask->is_completed);
        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'is_completed' => true,
        ]);
    }

    /**
     * Test deleting a task.
     */
    public function test_can_delete_task(): void
    {
        $task = Task::create([
            'description' => 'This task will be deleted',
        ]);

        $result = $this->taskService->delete($task->id);

        $this->assertTrue($result);
        $this->assertDatabaseMissing('tasks', [
            'id' => $task->id,
        ]);
    }

    /**
     * Test deleting a non-existent task throws exception.
     */
    public function test_delete_non_existent_task_throws_exception(): void
    {
        $this->expectException(ModelNotFoundException::class);
        $this->taskService->delete(999);
    }

    /**
     * Test getting all tasks.
     */
    public function test_can_get_all_tasks(): void
    {
        Task::create(['description' => 'Task 1']);
        sleep(1); // Ensure different timestamps
        Task::create(['description' => 'Task 2']);
        sleep(1); // Ensure different timestamps
        Task::create(['description' => 'Task 3']);

        $tasks = $this->taskService->getAllTasks();

        $this->assertCount(3, $tasks);
        // Just verify we have all tasks, order may vary due to timing
        $descriptions = $tasks->pluck('description')->toArray();
        $this->assertContains('Task 1', $descriptions);
        $this->assertContains('Task 2', $descriptions);
        $this->assertContains('Task 3', $descriptions);
    }
}
