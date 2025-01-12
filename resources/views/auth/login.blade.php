<x-navbar />

<form method="POST" action="{{ route('login') }}" class="form-container">
    @csrf

    <x-input id="email" name="email" type="email" label="Email" required autofocus />
    <x-input id="password" name="password" type="password" label="Password" required />

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
</style>