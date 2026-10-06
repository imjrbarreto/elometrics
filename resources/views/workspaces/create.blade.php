<x-app-layout>
    <div class="min-h-screen bg-slate-50 py-10">
        <div class="mx-auto max-w-2xl px-4 sm:px-6">
            <a href="{{ route('workspaces.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-800">
                ← Volver a mis workspaces
            </a>

            <div class="mt-6 rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">
                <h1 class="text-2xl font-bold text-slate-900">
                    Nuevo workspace
                </h1>
                <p class="mt-2 text-slate-600">
                    Dale un título para identificarlo fácilmente.
                </p>

                @if ($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                <form action="{{ route('workspaces.store') }}" method="POST" class="mt-8">
                    @csrf

                    <label for="title" class="block text-sm font-semibold text-slate-700">
                        Título
                    </label>

                    <input id="title" name="title" type="text" value="{{ old('title') }}" required autofocus
                        class="mt-2 block w-full rounded-xl border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

                    @error('title')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    <div class="mt-8 flex flex-wrap items-center gap-4">
                        <button type="submit"
                            class="rounded-xl bg-indigo-600 px-5 py-3 font-semibold text-white hover:bg-indigo-700">
                            Crear workspace
                        </button>

                        <a href="{{ route('workspaces.index') }}"
                            class="font-medium text-slate-600 hover:text-slate-900">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
