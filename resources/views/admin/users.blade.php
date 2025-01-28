<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Users</title>
    <style>
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        .actions { display: flex; gap: 10px; }
        .btn { padding: 5px 10px; border-radius: 4px; cursor: pointer; }
        .btn-block { background-color: #dc3545; color: white; }
        .btn-unblock { background-color: #28a745; color: white; }
    </style>
</head>
<body>
    <x-navbar />
    <div class="container">
        <h1>User Management</h1>
        
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                    @if($user->role !== 'admin')
                        <form action="{{ route('admin.users.role', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="role" onchange="this.form.submit()">
                                <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                                <option value="theme_manager" {{ $user->role === 'theme_manager' ? 'selected' : '' }}>Theme Manager</option>
                            </select>
                        </form>
                        @else
                        <span> Administrator </span>
                        @endif
                    </td>
                    <td>{{ $user->is_blocked ? 'Blocked' : 'Active' }}</td>
                    <td class="actions">
                        @if($user->role !== 'admin')
                    <form action="{{ route('admin.users.role', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <select name="role" onchange="this.form.submit()">
                            <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                            <option value="theme_manager" {{ $user->role === 'theme_manager' ? 'selected' : '' }}>Theme Manager</option>
                        </select>
                    </form>

                    @if($user->is_blocked)
                        <form action="{{ route('admin.users.unblock', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button class="btn btn-unblock">Unblock</button>
                        </form>
                    @else
                        <form action="{{ route('admin.users.block', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button class="btn btn-block">Block</button>
                        </form>
                    @endif

                    @else
                    <span> Admin user </span>
                    @endif
                </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>