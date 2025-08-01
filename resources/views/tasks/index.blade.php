@extends('layouts.app')

@section('title', 'Tasks - MLP To-Do')

@section('content')
<div class="grid grid-cols-3 gap-8">
    <!-- Left Column: Task Input Form (1/3 width) -->
    <div class="col-span-1">
        <form action="{{ route('tasks.store') }}" method="POST" class="space-y-4">
            @csrf
            
            <input 
                type="text"
                name="description" 
                id="description" 
                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                placeholder="Insert task name"
                value="{{ old('description') }}"
                required
            >
            
            <button 
                type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
            >
                Add
            </button>
        </form>
    </div>

    <!-- Right Column: Tasks Table (2/3 width) -->
    <div class="col-span-2">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Tasks</h2>
            </div>
            
            @if($tasks->count() > 0)
                <div class="overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Description
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Created
                                </th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($tasks as $task)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 {{ $task->is_completed ? 'line-through text-gray-500' : '' }}">
                                            {{ $task->description }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($task->is_completed)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Completed
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                Pending
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $task->created_at->format('M j, Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex items-center justify-end space-x-2">
                                            @if(!$task->is_completed)
                                                <form action="{{ route('tasks.complete', $task->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button 
                                                        type="submit"
                                                        class="text-green-600 hover:text-green-900 transition duration-200"
                                                        title="Mark as Complete"
                                                    >
                                                        ✓ Complete
                                                    </button>
                                                </form>
                                            @endif
                                            
                                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button 
                                                    type="submit"
                                                    class="text-red-600 hover:text-red-900 transition duration-200"
                                                    onclick="return confirm('Are you sure you want to delete this task?')"
                                                    title="Delete Task"
                                                >
                                                    ✕ Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="px-6 py-12 text-center">
                    <div class="text-gray-500">
                        <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">No tasks yet</h3>
                        <p class="text-gray-500">Get started by adding your first task!</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
