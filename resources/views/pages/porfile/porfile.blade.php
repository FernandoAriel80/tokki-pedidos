    <x-layout.layout :name="$user['name']">

        @if(session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="error-message">
            {{ session('error') }}
        </div>
        @endif

        <section>

            <h2>Perfil de {{ $user['name'] }}</h2>
            <div>
                <h4>Datos:</h4>
                <div>
                    <p>Nombre: {{ $user['name'] }}</p>
                    <p>Correo: {{ $user['email'] }}</p>
                </div>
            </div>
        </section>
        <section class="section-container">
            <div class="form-container">
                <p class="password-title">Cambiar de contraseña</p>
                <form action="/change-password" method="post" class="form-change-password">
                    @csrf
                    @method('PUT')
                    <x-common.auth.form-input
                        type="password"
                        name="current_password"
                        value=""
                        label="Contraseña actual"
                        placeholder="Coloque la contraseña actual" />
                    <x-common.auth.form-input
                        type="password"
                        name="password"
                        value=""
                        label="Contraseña nueva"
                        placeholder="Coloque la nueva contraseña" />
                    <x-common.auth.form-input
                        type="password"
                        name="password_confirmation"
                        value=""
                        label="Contraseña de verificación"
                        placeholder="Vuelva a ingresar la nueva contraseña" />

                    <x-common.auth.btn-submit text="actualizar" color="red" hover_color="green" />
                </form>
            </div>
        </section>
        
    </x-layout.layout>

    <style>
        .section-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 100%;

            margin-top: 60px;
        }

        .password-title {
            margin-bottom: 30px;
        }

        .form-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            width: auto;
        }

        .form-change-password {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 12px 20px;
            border-radius: 8px;
            border-left: 4px solid #28a745;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .error-message {
            background-color: #d4edda;
            color: #571515;
            padding: 12px 20px;
            border-radius: 8px;
            border-left: 4px solid #a72828;
            margin-bottom: 20px;
            font-weight: 500;
        }
    </style>