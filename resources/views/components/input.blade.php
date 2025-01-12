<div class="form-group">
    <label for="{{ $attributes['id'] }}">{{ $label }}</label>
    <input {{ $attributes->merge(['class' => 'form-control']) }}>
</div>

<style>
    .form-group {
        margin-bottom: 15px;
    }
    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
</style>