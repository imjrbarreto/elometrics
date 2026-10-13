<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Elometrics</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-stone-50 text-slate-900 antialiased">
    <main class="flex min-h-screen items-center justify-center px-6">
        <div class="max-w-xl text-center">
            <h1 class="text-5xl font-bold tracking-tight text-emerald-800">
                Elometrics
            </h1>

            <p class="mt-5 text-lg text-slate-600">
                Organiza tus alumnos, sesiones y entrenamiento de ajedrez.
            </p>

            <div class="mt-8 flex flex-wrap justify-center gap-4">
                @auth
                    <a
                        href="{{ route('workspaces.index') }}"
                        class="rounded-lg bg-emerald-800 px-6 py-3 font-semibold text-white hover:bg-emerald-900"
                    >
                        Mis workspaces
                    </a>
                @else
                    <a
                        href="{{ route('login') }}"
                        class="rounded-lg bg-emerald-800 px-6 py-3 font-semibold text-white hover:bg-emerald-900"
                    >
                        Iniciar sesión
                    </a>

                    <a
                        href="{{ route('register') }}"
                        class="rounded-lg border border-emerald-800 px-6 py-3 font-semibold text-emerald-800 hover:bg-emerald-50"
                    >
                        Registrarse
                    </a>
                @endauth
            </div>
        </div>
    </main>
</body>
</html>