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
    </style>
</head>
<body>
    <x-navbar />
    <div class="container">
        <h1>Edit Profile</h1>
        <form method="POST" action="">
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
</body>
</html>