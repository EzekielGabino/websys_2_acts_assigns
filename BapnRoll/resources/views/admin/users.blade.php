@extends('layouts.master')

@section('title', 'Users')

@section('content')

<div class="container-fluid px-4 py-4">

    @if(session('success'))
        <div class="alert alert-success mb-3">{{ session('success') }}</div>
    @endif

    <div class="products-topbar mb-3">
        <p class="topbar-title">Users</p>
        <button type="button" class="btn-peach" data-bs-toggle="modal" data-bs-target="#addUserModal">
            <i class="bi bi-plus-lg"></i> Add User
        </button>
    </div>

    <div class="users-table-wrap">
        <table class="users-table">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>
                            <span class="user-avatar">{{ strtoupper(substr($user->username, 0, 1)) }}</span>
                            <span class="username">{{ $user->username }}</span>
                        </td>
                        <td>
                            @if($user->role == 'admin')
                                <span class="role-badge role-admin">Admin</span>
                            @elseif($user->role == 'manager')
                                <span class="role-badge role-manager">Manager</span>
                            @else
                                <span class="role-badge role-staff">Staff</span>
                            @endif
                        </td>
                        <td>
                            <button type="button"
                                class="act-btn act-edit"
                                data-bs-toggle="modal"
                                data-bs-target="#editUserModal{{ $user->id }}">
                                <i class="bi bi-pencil"></i> Edit
                            </button>
                            <button type="button"
                                class="act-btn act-del"
                                data-bs-toggle="modal"
                                data-bs-target="#deleteUserModal{{ $user->id }}">
                                <i class="bi bi-trash"></i> Delete
                            </button>
                        </td>
                    </tr>

                    {{-- EDIT Modal --}}
                    <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('user.update', $user->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit User</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Username</label>
                                            <input type="text" name="username" class="form-control" value="{{ $user->username }}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Password <span class="text-muted">(leave blank to keep current)</span></label>
                                            <input type="password" name="password" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Role</label>
                                            <select name="role" class="form-select">
                                                <option value="admin"   {{ $user->role == 'admin'   ? 'selected' : '' }}>Admin</option>
                                                <option value="manager" {{ $user->role == 'manager' ? 'selected' : '' }}>Manager</option>
                                                <option value="staff"   {{ $user->role == 'staff'   ? 'selected' : '' }}>Staff</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn-peach-modal">Update User</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- DELETE Modal --}}
                    <div class="modal fade" id="deleteUserModal{{ $user->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Delete User</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body" style="font-size:14px;color:#444;">
                                    Are you sure you want to delete
                                    <strong>{{ $user->username }}</strong>?
                                    This action cannot be undone.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <form action="{{ route('user.delete', $user->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-order btn-delete">
                                            <i class="bi bi-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach
            </tbody>
        </table>
    </div>

</div>

{{-- ADD User Modal --}}
<div class="modal fade" id="addUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('user.add') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" value="{{ old('username') }}">
                        @error('username') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control">
                        @error('password') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <select name="role" class="form-select">
                            <option value="">Select a role</option>
                            <option value="admin"   {{ old('role') == 'admin'   ? 'selected' : '' }}>Admin</option>
                            <option value="manager" {{ old('role') == 'manager' ? 'selected' : '' }}>Manager</option>
                            <option value="staff"   {{ old('role') == 'staff'   ? 'selected' : '' }}>Staff</option>
                        </select>
                        @error('role') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn-peach-modal">Add User</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection