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
        border: 1px solid #070a0c;
        border-radius: 8px;
        background-color: #040c28;
        color:#fff;
    }
    body {
        margin: 0;
        padding: 0;
        min-height: 100vh;
        background-image: url('/images/Tech1copie.png'); /* Fixed path */
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
    }
    .alert {
        color: red;
        margin-top: 10px;
    }
</style>