<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Update the Existing Task') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form method="POST" action={{ route('update', $task->slug) }}>
                        @csrf
                        <div class="mb-4">
                            <label for="title" class="block text-white text-sm font-bold mb-2">Title</label>
                            <input type="text" name="title" id="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter title" value="{{ $task->title }}" required>
                            @error('title')
                            <span class="text-red-500 text-xs italic">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="body" class="block text-white text-sm font-bold mb-2">Description</label>
                            <input type="text" name="body" id="body" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter description" value="{{ $task->body }}" required>
                            @error('body')
                            <span class="text-red-500 text-xs italic">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="starting_time" class="block text-white text-sm font-bold mb-2">Starting Time</label>
                            <input type="datetime-local" name="starting_time" id="starting_time" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter starting time" value="{{ $task->starting_time }}" required>
                            @error('starting_time')
                            <span class="text-red-500 text-xs italic">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="finishing_time" class="block text-white text-sm font-bold mb-2">Finishing Time</label>
                            <input type="datetime-local" name="finishing_time" id="end_time" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter finishing time" value="{{ $task->finishing_time }}" required>
                            @error('finishing_time')
                            <span class="text-red-500 text-xs italic">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="status" class="block text-white text-sm font-bold mb-2">Status</label>
                            <input type="checkbox" name="status" id="status" value="1" {{ old('status', $task->status) ? 'checked' : '' }}">
                            <span class="container text-white text-sm">Task Completed</span>
                            @error('status')
                            <span class="text-red-500 text-xs italic">{{ $message }}</span>
                            @enderror
                        </div>
                        <style>
                            .container {
                                margin-left: 5px;
                            }
                        </style>
                        <div class="mb-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Update Task</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
