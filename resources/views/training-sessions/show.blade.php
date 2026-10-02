<x-app-layout>
    <div class="min-h-screen bg-slate-50 py-10">
        <div class="mx-auto max-w-3xl px-4 sm:px-6">
            <a href="{{ route('workspaces.show', $workspace) }}"
                class="text-sm font-medium text-indigo-600 hover:text-indigo-800">
                ← Volver al workspace
            </a>

            <article class="mt-6 rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-indigo-600">
                            {{ $trainingSession->date->format('d/m/Y') }}
                        </p>

                        <h1 class="mt-2 text-2xl font-bold text-slate-900">
                            {{ $trainingSession->title }}
                        </h1>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="{{ $trainingSession->status->color() }} w-4 h-4 rounded-full inline-block"></div>
                        <p class="text-slate-500">{{ $trainingSession->status->label() }}</p>
                    </div>
                </div>

                <div class="mt-8 border-t border-slate-200 pt-6">
                    <h2 class="font-semibold text-slate-900">Resumen</h2>

                    @if ($trainingSession->summary)
                        <p class="mt-3 whitespace-pre-line text-slate-700">{{ $trainingSession->summary }}</p>
                    @else
                        <p class="mt-3 text-slate-500">Aún no hay un resumen para esta sesión.</p>
                    @endif
                </div>

                <div class="mt-2 pt-6">
                    @if ($trainingSession->category)
                    
                        <span
                            class="inline-flex rounded-full bg-emerald-100 px-3 py-1 text-sm font-medium text-emerald-800">
                            {{ $trainingSession->category->label() }}
                        </span>
                    @endif
    
                    @if ($trainingSession->resource_url)
                        <a href="{{ $trainingSession->resource_url }}" target="_blank" rel="noopener noreferrer"
                            class="inline-flex text-sm font-medium text-emerald-700 underline">
                            Abrir material ↗
                        </a>
                    @endif
                </div>

                <div class="mt-8 border-t border-slate-200 pt-6 flex items-center gap-4">
                    
                    <a href="{{ route('training-sessions.edit', [$workspace, $trainingSession]) }}"
                        class="inline-flex justify-center rounded-xl bg-indigo-600 px-5 py-3 font-semibold text-white hover:bg-indigo-700">
                        Editar Sesion
                    </a>
    
                    <form method="POST" action="{{ route('training-sessions.destroy', [$workspace, $trainingSession]) }}"
                        onsubmit="return confirm('¿Eliminar a esta sesion?')">
                        @csrf
                        @method('DELETE')
    
                        <button type="submit" class="text-sm font-semibold text-red-700 hover:text-red-900">
                            Eliminar
                        </button>
                    </form>
                </div>
            </article>
        </div>
    </div>
</x-app-layout>
