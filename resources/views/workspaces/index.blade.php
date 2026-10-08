<x-app-layout>
    <div class="min-h-screen bg-slate-50 py-10">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="mb-8 flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <h1 class="text-3xl font-bold tracking-tight text-slate-900">
                        Mis workspaces
                    </h1>

                    <p class="mt-2 text-slate-600">
                        Organiza aquí el trabajo con tus alumnos.
                    </p>
                </div>

                <div>
                    
                </div>
                <a href="{{ route('workspaces.create') }}">
                    <x-primary-button>
                        + Nuevo workspace
                    </x-primary-button>
                </a>
            </div>
            <livewire:workspace-list />
        </div>
    </div>
</x-app-layout>
