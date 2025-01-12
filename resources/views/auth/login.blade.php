<x-navbar />

<form method="POST" action="{{ route('login') }}" class="form-container">
    @csrf

    <x-input id="email" name="email" type="email" label="Email" required autofocus />
    <x-input id="password" name="password" type="password" label="Password" required />

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <x-button>Login</x-button>
</form>

<style>
    .form-container {
        max-width: 400px;
        margin: 50px auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 8px;
        background-color: #fff;
    }
    .alert {
        color: red;
        margin-top: 10px;
    }
</style>