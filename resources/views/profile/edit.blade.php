<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8fafc;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        .form-group button {
            padding: 10px 15px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        .form-group button:hover {
            background-color: #0056b3;
        }
        .profile-section {
            margin-bottom: 30px;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .profile-picture {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 15px;
        }

        .danger-zone {
            background-color: #fff5f5;
            border: 1px solid #fc8181;
            padding: 20px;
            border-radius: 8px;
            margin-top: 30px;
        }

        .btn-danger {
            background-color: #e53e3e;
        }

        .btn-danger:hover {
            background-color: #c53030;
        }
        .profile-picture {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 15px;
            border: 2px solid #007bff;
        }
    </style>
</head>
<body>
    <x-navbar />
    <div class="container">
        <h1>Edit Profile</h1>
<form method="POST" action="">
        <!-- Profile Information -->
        <div class="profile-section">
            <h2>Profile Information</h2>
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PATCH')

                <div class="form-group">
                    <label for="name">Name</label>
                    <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}" required autofocus>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" required>
                </div>

                <div class="form-group">
                    <button type="submit">Update Profile</button>
                </div>
            </form>
        </div>

        <!-- Profile Picture -->
        <div class="profile-section">
            <h2>Profile Picture</h2>
            @if($user->profile_picture)
            @php
            $imagePath = 'storage/' . $user->profile_picture;
            $fullPath = public_path($imagePath);
            @endphp
            @if(file_exists($fullPath))
            <img src="{{ asset($imagePath) }}" alt="Profile Picture" class="profile-picture">
        @else
            <p>Image file not found: {{ $imagePath }}</p>
        @endif
    @else
        <img src="{{ asset('storage/default-profile.png') }}" alt="Default Profile Picture" class="profile-picture">
    @endif

            <form method="POST" action="{{ route('profile.picture') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="profile_picture">Upload New Picture</label>
                    <input type="file" id="profile_picture" name="profile_picture" accept="image/*">
                </div>
                <div class="form-group">
                    <button type="submit">Upload Picture</button>
                </div>
            </form>

            @if($user->profile_picture)
                <form method="POST" action="{{ route('profile.picture.remove') }}">
                    @csrf
                    @method('DELETE')
                    <div class="form-group">
                        <button type="submit">Remove Picture</button>
                    </div>
                </form>
            @endif
        </div>

        <!-- Update Password -->
        <div class="profile-section">
            <h2>Update Password</h2>
            <form method="POST" action="{{ route('profile.password') }}">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="current_password">Current Password</label>
                    <input id="current_password" type="password" name="current_password" required>
                </div>

                <div class="form-group">
                    <label for="password">New Password</label>
                    <input id="password" type="password" name="password" required>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required>
                </div>

                <div class="form-group">
                    <button type="submit">Update Password</button>
                </div>
            </form>
        </div>

        <!-- Delete Account -->
        <div class="danger-zone">
            <h2>Delete Account</h2>
            <p>Once your account is deleted, all of its resources and data will be permanently deleted.</p>
            <form method="POST" action="{{ route('profile.destroy') }}">
                @csrf
                @method('DELETE')

                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" required>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn-danger">Delete Account</button>
                </div>
            </form>
        </div>

        <!-- Display validation errors if any -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Display success message if any -->
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
    </div>
        <!-- 
            @csrf
            @method('PATCH')

            <div class="form-group">
                <label for="name">Name</label>
                <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}" required autofocus>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="form-group">
                <button type="submit">Update Profile</button>
            </div>
        </div> -->
        </form>
    
</body>
</html>