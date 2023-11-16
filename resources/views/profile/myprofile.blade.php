@extends('layouts.app')
@section('content')
    <section style="background-color: #eee;">
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Name</p>
                                </div>
                                <div class="col-sm-3">
                                    <p class="text-muted mb-0">{{ Auth::user()->name }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Email</p>
                                </div>
                                <div class="col-sm-3">
                                    <p class="text-muted mb-0">{{ Auth::user()->email }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <main>
        <div class="container-fluid px-4">
            <h3 class="mt-4">{{ Auth::user()->name }}'s Tasks</h3>

            <div class="card">
                <div class="card-body">
                    <table id="myTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Task Status</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Task Status</th>
                                <th>Action</th>

                            </tr>
                        </tfoot>
                        <tbody>
                            {{-- @dd($users); --}}
                            @foreach ($tasks as $task)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $task->title }}</td>
                                    <td>{{ $task->description }}</td>
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
