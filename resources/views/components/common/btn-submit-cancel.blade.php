@props([
'text',
'url',
])

<a href="{{ $url }}" class="btn-submit-cancel">
    <button type="button">
        {{ $text }}
    </button>
</a>

<style>
    a {
        text-decoration: none;
        color: #111;
    }

    .btn-submit-cancel {
        display: flex;
        width: 100%;
    }

    .btn-submit-cancel button {
        border: none;
        cursor: pointer;
        border-radius: 2px;
        background-color: #575757;
        color: #fff;
        padding: 10px;
        width: 100%;
    }

    .btn-submit-cancel button:hover {
        background-color: #a3a3a3;
        transition: all 0.4s ease;
    }
</style>