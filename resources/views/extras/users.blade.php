@extends('layouts.app')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h3 class="mt-4">All Users</h3>

        <div class="card">
            <div class="card-body">
                <table id="myTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Total Task <small>By user</small></th>
                            <th>Task Completed</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Total Task <small>By user</small></th>
                            <th>Task Completed</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $loop->index+1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->tasks->count() }}</td>
                            <td>{{ $user->tasks->where('is_completed', 1)->count() }}</td>
                            <td>
                                @if(Auth::user()->id == $user->id)
                                    {{-- <a href="javascript:void(0);" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-pen-to-square"></i></a> --}}
                                    <a href="javascript:void(0);" class="btn btn-info btn-sm edit-user-btn"
                                        data-bs-toggle="modal" data-bs-target="#exampleModal"
                                        data-user-id="{{ $user->id }}" data-user-name="{{ $user->name }}" data-user-email="{{ $user->email }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{ route('delete-Users', $user->id) }}" method="post" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm fa-solid fa-trash-can"></button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update User</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="container">
                <form action="{{ route('update-user', $user->id) }}" method="POST" id="updateUserForm">
                    @csrf
                    @method('PUT')
                    {{-- <input type="hidden" value="{{ $user->id }}" name="id"> --}}
                    <div class="row">
                        <div class="col-lg-12">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" value="{{ $user->name }}" name="name" id="modal-name">
                        </div>

                        <div class="col-lg-12">
                            <label class="form-label">Email</label>
                            <input type="text" class="form-control" value="{{ $user->email }}" name="email" id="modal-email">
                        </div>

                        {{-- <div class="col-lg-12">
                            <label class="form-label">Password</label>
                            <input type="text" class="form-control" value="{{ $user->password }}" name="password" id="password">
                        </div> --}}

                        <div class="col-lg-12 mt-3">
                            <div class="d-grid">
                                <input type="submit" class="btn btn-primary" value="Update">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var editButtons = document.querySelectorAll('.edit-user-btn');

        editButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                var userId = button.getAttribute('data-user-id');
                var userName = button.getAttribute('data-user-name');
                var userEmail = button.getAttribute('data-user-email');

                document.getElementById('modal-name').value = userName;
                document.getElementById('modal-email').value = userEmail;
                document.getElementById('updateUserForm').action = '/update-user/' + userId;
            });
        });
    });
</script>
@endsection
