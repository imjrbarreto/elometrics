<x-app-layout>

    <div class="py-8">
        <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-3">
                @foreach ([
                    'Mis workspaces' => $totalWorkspaces,
                    'Mis workspaces activos' => $activeWorkspaces,
                    'Workspaces donde colaboro' => $joinedWorkspaces,
                    ] as $label => $count)
                    <div class="rounded-2xl border border-slate-200 bg-white p-6
                    shadow-sm">

                        <h3 class="text-base font-semibold text-slate-900">
                            {{ $label }}
                        </h3>

                        <p class="mt-3 text-3xl font-bold text-slate-900">
                            {{ $count }}
                        </p>
                    </div>
                @endforeach
            </div>

            {{-- Próximas sesiones --}}
            <section class="rounded-lg bg-white p-6 shadow-sm">
                <h3 class="mb-4 text-lg font-semibold text-gray-900">
                    Próximas sesiones
                </h3>

                <div class="space-y-3">
                    @forelse ($upcomingSessions as $session)
                        <a href="{{ route('training-sessions.show', [$session->workspace, $session]) }}"
                            class="block rounded-lg border border-gray-200 p-4
                                   hover:bg-gray-50 ">
                            <p class="font-medium text-gray-900">
                                {{ $session->title }}
                            </p>

                            <p class="text-sm text-gray-600">
                                {{ $session->workspace->title }}
                                · {{ $session->date->format('d/m/Y H:i') }}
                            </p>
                        </a>

                    @empty
                        <p class="text-gray-600">
                            No tienes próximas sesiones programadas.
                        </p>
                    @endforelse
                </div>
                <div class="mt-4">
                    {{ $upcomingSessions->links() }}
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
