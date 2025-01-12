<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-primary']) }}>
    {{ $slot }}
</button>

<style>
    .btn {
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    .btn:hover {
        background-color: #0056b3;
    }
</style>