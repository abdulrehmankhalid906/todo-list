@extends('layouts.app')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h4 class="mt-4">Create Task</h4>
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <div class="card shadow-lg border-0">
                            <div class="card-body">
                                <form action="{{ route('store-task') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Title</label>
                                        <input type="text" class="form-control" id="title" name="title" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Description</label>
                                        <input type="text" class="form-control" id="description" name="description" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Durations</label>
                                        <input type="number" class="form-control" id="days" name="days" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Assigned To:</label>
                                        <select class="form-select" aria-label="Default select example" name="assigned_to" id="assigned_to">
                                            @if(count($users)>0)
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}" {{ Auth::user()->id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>

                                    <div class="mt-4 mb-0">
                                        <div class="d-grid">
                                            <input type="submit" class="btn btn-primary" value="Create Task">
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

    <hr>

    <div class="container-fluid px-4">
        <h4 class="mt-4">All Tasks</h4>

        <div class="card">
            <div class="card-body">
                <table id="myTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Created By</th>
                            <th>Assigned To</th>
                            <th>Task Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                        <tr>
                            <td>{{ $loop->index+1 }}</td>
                            <td>{{ $task->title }}</td>
                            <td>{{ $task->description }}</td>
                            <td>{{ $task->users->name }}</td>
                            <td>{{ $task->assignedTo->name }}</td>

                            <td>
                                @if($task->is_completed == 0)
                                    <span style="color: red; font-weight: bold;">Pending</span>
                                @elseif($task->is_completed == 1)
                                    <span style="color: green; font-weight: bold;">Completed</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('view-task', $task->id) }}" class="btn btn-info btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                <form action="{{ route('delete-Tasks', $task->id) }}" method="post" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm fa-solid fa-trash-can"></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection

