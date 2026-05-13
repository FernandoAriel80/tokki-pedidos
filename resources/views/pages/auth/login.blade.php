<div class="form-containt">
    <div class="form-register">
        <h1>Inicia sesión</h1>
        <form method="POST" action="/login">
            @csrf
            <x-common.auth.form-input
                name="email"
                type="email"
                label="Correo:"
                value=""
                placeholder="Ingrese un correo valido" />
            <x-common.auth.form-input
                name="password"
                type="password"
                label="Contraseña:"
                value=""
                placeholder="Ingrese contraseña de 8 digitos" />

            <x-common.auth.btn-submit text="Inicia sesión" color="red" hover_color="green" />
        </form>
        <a href="/register">register</a>
    </div>

</div>

<style>
    :root {
        --primary-color: #f88080;
        --hover-primary-color: #fd5d5d;
    }

    .form-containt {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        width: 100%;
    }

    .form-register {
        padding: 20px;
        width: 500px;
        margin: 50px;
        border-radius: 20px;
        box-shadow: 1px 5px 5px rgba(54, 54, 54, 0.5);
        text-align: center;
    }

    .form-register form {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 20px;
        padding: 20px;
        text-align: left;
        /*border: 1px solid var(--primary-color);*/
    }

    .form-register form input {
        width: 400px;
    }
</style>