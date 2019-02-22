@extends('layouts.app')

@section('content')
    <form method="POST" action="/projects">
        <h1 class="heading is-1">Create Project</h1>

        <div class="field">
            <label for="title">Title</label>

            <div class="control">
                <input type="text" class="input" name="title" placeholder="title">
            </div>
        </div>

        <div class="field">
            <label for="description">Description</label>

            <div class="control">
                <textarea name="description" class="textarea"></textarea>
            </div>
        </div>

        <div class="field">
            <div class="control">
                <button class="button is-link">
                    Create Project
                </button>
                <a href="/projects">Cancel</a>
            </div>
        </div>
    </form>
@endsection