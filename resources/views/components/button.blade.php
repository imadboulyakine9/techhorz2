<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-primary']) }}>
    {{ $slot }}
</button>

<style>
    .btn {
        padding: 10px 20px;
        background-color: #000;
        color: #fff;
        border: none;
        border-radius: 50px;
        cursor: pointer;
        transition: background-color 0.3s, color 0.3s;
    }
    .btn:hover {
        background-color: #333;
        color: #fff;
    }
    .btn:active {
        background-color: #555;
        color: #fff;
    }
    .btn:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.2);
    }
</style>