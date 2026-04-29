@props([
'text',
])

<button class="btn-submit-accept" type="submit">
    {{ $text }}
</button>

<style>
    a {
        text-decoration: none;
        color: #111;
    }

    .btn-submit-accept {
        border: none;
        cursor: pointer;
        border-radius: 2px;
        background-color: var(--primary-color);
        color: #fff;
        padding: 10px;
        width: 100%;
    }

    .btn-submit-accept:hover {
        background-color: var(--hover-primary-color);
        transition: all 0.4s ease;
    }
</style>