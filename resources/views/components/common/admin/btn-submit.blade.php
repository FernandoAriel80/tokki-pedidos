@props([
'text',
])

<button class="btn-submit" type="submit">
    {{ $text }}
</button>

<style>
    a {
        text-decoration: none;
        color: #111;
    }

    :root {
        --primary-color: #f88080;
        --hover-primary-color: #fd5d5d;
    }

    .btn-submit {
        border: none;
        cursor: pointer;
        border-radius: 2px;
        background-color: var(--primary-color);
        color: #fff;
        padding: 10px;
        width: 100%;
    }

    .btn-submit:hover {
        background-color: var(--hover-primary-color);
        transition: all 0.4s ease;
    }
</style>