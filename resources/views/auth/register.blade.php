<x-navbar />

<form method="POST" action="{{ route('register') }}" class="form-container">
    @csrf

    <x-input id="name" name="name" type="text" label="Name" required autofocus />
    <x-input id="email" name="email" type="email" label="Email" required />
    <x-input id="password" name="password" type="password" label="Password" required />
    <x-input id="password_confirmation" name="password_confirmation" type="password" label="Confirm Password" required />

    <x-button>Register</x-button>
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
</style>