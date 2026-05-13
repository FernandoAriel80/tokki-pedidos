@props([
'name',
'value',
'label',
'type',
'placeholder'=>''
])
<div class="input-form">
    <label for="{{ $name }}">{{ $label }}</label>
    <input type="{{ $type }}" name="{{ $name }}" value="{{ $value != "" ? $value : old($name)  }}" placeholder="{{ $placeholder }}">
    @error($name)
    <span>{{ $message }}</span>
    @enderror

</div>
<style>
    :root {
        --border-color-input: #f88080;
    }

    .input-form {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .input-form span {
        color: #f81a1a;
    }

    .input-form input {
        width: 100%;
        height: 30px;
        padding: 2px 10px;
        border: 1px solid #c2c1c1;
        border-radius: 5px;
    }

    .input-form input:hover {
        border: 1px solid var(--border-color-input);
    }

    .input-form input:focus {
        border: 2px solid var(--border-color-input);
        outline: none;

    }
</style>