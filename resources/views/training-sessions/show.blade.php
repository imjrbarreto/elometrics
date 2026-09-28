<x-app-layout>
    <div class="min-h-screen bg-slate-50 py-10">
        <div class="mx-auto max-w-3xl px-4 sm:px-6">
            <a href="{{ route('workspaces.show', $workspace) }}"
               class="text-sm font-medium text-indigo-600 hover:text-indigo-800">
                ← Volver al workspace
            </a>

            <article class="mt-6 rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">
                <p class="text-sm font-medium text-indigo-600">
                    {{ $trainingSession->date->format('d/m/Y') }}
                </p>

                <h1 class="mt-2 text-2xl font-bold text-slate-900">
                    {{ $trainingSession->title }}
                </h1>

                <div class="mt-8 border-t border-slate-200 pt-6">
                    <h2 class="font-semibold text-slate-900">Resumen</h2>

                    @if ($trainingSession->summary)
                        <p class="mt-3 whitespace-pre-line text-slate-700">{{ $trainingSession->summary }}</p>
                    @else
                        <p class="mt-3 text-slate-500">Aún no hay un resumen para esta sesión.</p>
                    @endif
                </div>
            </article>
        </div>
    </div>
</x-app-layout>