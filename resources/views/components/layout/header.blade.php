@props(['name'])
<header class="header">

    <a href="/">Inicio</a>

    @if(auth()->user()?->isAdmin())
    <a href="/view-admin">admin</a>
    @endif
    <div>
        <p>{{ $name }}</p>

        <form action="/logout" method="post">
            @csrf
            <button class="btn-logout" type="submit">
                cerrar sesión
            </button>
        </form>
    </div>

</header>

<style>
    .header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 30px;
        background-color: #f88080;
        color: #fff;
        min-height: 35px;
    }

    .header div {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .header a {
        color: #fff;
    }

    .btn-logout {
        text-decoration: none;
        padding: 5px;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.4s ease;
    }

    .btn-logout:hover {
        /*  background-color: #f88080; */
        color: #f88080;
    }
</style>