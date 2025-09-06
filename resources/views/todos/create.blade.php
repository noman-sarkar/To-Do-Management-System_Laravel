@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 dark:bg-gray-900">
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-8 w-full max-w-md">
        <h1 class="text-2xl font-bold mb-6 text-center text-gray-900 dark:text-white">Add Task</h1>

        {{-- Laravel Collective Form --}}
        {!! Form::open(['route' => 'todos.store']) !!}

            {{-- Title Field --}}
            <div class="mb-4">
                {!! Form::label('title', 'Task Title', ['class' => 'block mb-2 text-gray-700 dark:text-gray-200']) !!}
                {!! Form::text('title', old('title'), [
                    'class' => 'w-full px-4 py-2 mb-1 rounded border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white',
                    'required'
                ]) !!}
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Description Field --}}
            <div class="mb-4">
                {!! Form::label('description', 'Description', ['class' => 'block mb-2 text-gray-700 dark:text-gray-200']) !!}
                {!! Form::textarea('description', old('description'), [
                    'class' => 'w-full px-4 py-2 mb-1 rounded border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white'
                ]) !!}
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submit Button --}}
            {!! Form::submit('Save Task', ['class' => 'w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded']) !!}

        {!! Form::close() !!}
    </div>
</div>
@endsection
