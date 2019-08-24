@extends('layouts.app')

@section('content')
    <header class="flex items-center mb-3 py-4">
        <div class="flex justify-between items-end w-full">
            <h2 class="text-grey text-sm font-normal">
                <a href="/projects" class="text-grey text-sm font-normal no-underline">
                    My Projects
                </a> / {{ $project->title }}
            </h2>
            <a href="{{ $project->path() . '/edit' }}" class="button">
                Edit Project
            </a>
        </div>
    </header>

    <main>
        <div class="lg:flex -mx-3">
            <div class="lg:w-3/4 px-3">
                <div class="mb-6">
                    <h2 class="text-grey font-normal text-lg mb-3">Tasks</h2>

                    @foreach ($project->tasks as $task)
                        <div class="card mb-3">
                            <form method="POST" action="{{ $task->path() }}">
                                @method('PATCH')
                                @csrf

                                <div class="flex">
                                    <input type="text" name="body" value="{{ $task->body }}" class="w-full {{ $task->completed ? 'text-grey' : '' }}">
                                    <input type="checkbox" name="completed" onChange="this.form.submit()" {{ $task->completed ? 'checked' : '' }} >
                                </div>
                            </form>
                        </div>
                    @endforeach

                    <div class="card mb-3">
                        <form action="{{ $project->path() . '/tasks' }}" method="POST">
                            @csrf

                            <input class="w-full" placeholder="Add a new task..." name="body">
                        </form>
                    </div>
                </div>

                <div>
                    <h2 class="text-grey font-normal text-lg mb-3">General Notes</h2>

                    <form action="{{ $project->path() }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <textarea
                            name="notes"
                            class="card w-full mb-6"
                            style="min-height: 200px"
                            placeholder="Anything special that you want to make a note off..."
                        >{{ $project->notes }}</textarea>

                        <button type="submit" class="button">Save</button>
                    </form>
                </div>
            </div>

            <div class="lg:w-1/4 px-3 lg:py-8">
                @include('projects.card')
                @include('projects.activity.card')
            </div>
        </div>
    </main>
@endsection
