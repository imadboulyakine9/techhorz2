<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-primary']) }}>
    {{ $slot }}
</button>

<style>
    .btn {
        padding: 10px 20px;
        background-color:rgb(222, 168, 22);
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    .btn:hover {
        background-color:rgb(33, 151, 27);
    }
</style>