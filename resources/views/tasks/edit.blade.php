@extends('layouts.app')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h4 class="mt-4">Update Task</h4>
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <div class="card shadow-lg border-0 rounded-lg">
                            <div class="card-body">
                                <form action="{{ route('update-post', $task->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Title</label>
                                        <input type="text" class="form-control" value="{{ $task->title }}" name="title" id="title">
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Description</label>
                                        <input type="text" class="form-control" value="{{ $task->description }}" name="description" id="description">
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Durations</label>
                                        <input type="number" class="form-control" value="{{ $task->days }}" name="days" id="days" disabled>
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Status</label>
                                        <select class="form-select" aria-label="Default select example" name="is_completed" id="is_completed">
                                            <option {{ isset($task->is_completed) && $task->is_completed == '0' ? 'selected' : '' }} value="0">Pending</option>
                                            <option {{ isset($task->is_completed) && $task->is_completed == '1' ? 'selected' : '' }} value="1">Completed</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Assigned To:</label>
                                        <select class="form-select" aria-label="Default select example" name="assigned_to" id="assigned_to">
                                            @if(count($users)>0)
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}" {{ $user->id == $task->assigned_to ? 'selected' : '' }}>{{ $user->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>

                                    <div class="mt-4 mb-0">
                                        <div class="d-grid">
                                            <input type="submit" class="btn btn-primary" value="Update Post">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</main>
@endsection

