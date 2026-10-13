<x-app-layout>
    <div class="min-h-screen bg-slate-50 py-10">
        <div class="mx-auto max-w-4xl px-4 sm:px-6">
            <a href="{{ route('workspaces.index') }}">
                <x-back-workspace>← Volver a mis workspaces</x-back-workspace>
            </a>

            <div class="mt-6 rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">
                <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h1 class="mt-2 text-3xl font-bold text-slate-900">
                            {{ __($workspace->title) }}
                        </h1>
                        <p class="mt-3 text-sm text-slate-500">
                            Creado el {{ __($workspace->created_at->format('d/m/Y')) }}
                        </p>
                    </div>

                    @can('manageMembers', $workspace)
                        <div>
                            <a href="{{ route('workspaces.edit', $workspace) }}">
                                <x-primary-button>
                                    Editar workspace
                                </x-primary-button>
                            </a>
                        </div>
                    @endcan
                </div>

                @can('manageMembers', $workspace)
                    <section class="rounded-xl bg-white p-6 shadow-sm">
                        <h2 class="mb-4 text-lg font-semibold text-gray-900">
                            Añadir miembro
                        </h2>

                        <form method="POST" action="{{ route('workspaces.members.store', $workspace) }}" class="space-y-4">
                            @csrf

                            <div>
                                <x-input-label for="member_username" value="Username" />

                                <x-text-input id="member_username" name="username" type="text" class="mt-1 block w-full"
                                    :value="old('username')" required />

                                <x-input-error :messages="$errors->get('username')" class="mt-2" />
                            </div>

                            <div>
                                <label for="member_role" class="block text-sm font-medium text-slate-700">
                                    Rol
                                </label>

                                <select id="member_role" name="role" required class="mt-1 block w-full rounded-md border-slate-300">

                                    @foreach ($roles as $role)
                                        <option value="{{ $role->value }}" @selected(old('role') === $role->value)>
                                            {{ $role->label() }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('role')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <x-primary-button>
                                Añadir miembro
                            </x-primary-button>
                        </form>
                    </section>
                @endcan

                <section class="rounded-xl bg-white p-6 shadow-sm">
                    <div class="border-b">
                        <h2 class="mb-2 text-lg font-semibold text-gray-900 ">
                            Propietario
                        </h2>
                        <div class="mb-4">
                            {{ $workspace->user->username }}
                        </div>
                    </div>
                    <h2 class="mb-2 text-lg font-semibold text-gray-900">
                        Miembros
                    </h2>

                    @forelse ($workspace->members as $member)
                        <div class="flex flex-wrap items-center justify-between gap-3 py-3">
                            <div class="w-full flex items-center justify-between">
                                <p class="font-medium text-gray-900">
                                    {{ $member->username }}
                                </p>

                                <p class="text-sm text-gray-600">
                                    {{ $member->pivot->role->label() }}
                                </p>
                            </div>
                            @can('manageMembers', $workspace)
                                <form method="POST"
                                    action="{{ route('workspaces.members.destroy', [
                                        'workspace' => $workspace,
                                        'member' => $member,
                                    ]) }}"
                                    onsubmit="return confirm('¿Retirar a este miembro del workspace?')">
                                    @csrf
                                    @method('DELETE')

                                    <x-danger-button>
                                        Retirar
                                    </x-danger-button>
                                </form>
                            @endcan
                        </div>
                    @empty
                        <p class="text-sm text-gray-600">
                            Todavía no hay miembros añadidos.
                        </p>
                    @endforelse
                </section>
                @can('leave', $workspace)
                    <form method="POST" action="{{ route('workspaces.members.leave', $workspace) }}"
                        onsubmit="return confirm('¿Salir de este workspace?')">
                        @csrf
                        @method('DELETE')

                        <x-danger-button>
                            Salir del workspace
                        </x-danger-button>
                    </form>
                @endcan

                <div class="mt-10 border-t border-slate-100 pt-6 flex items-start justify-between">

                    @can('manageMembers', $workspace)
                        <form action="{{ route('workspaces.destroy', $workspace) }}" method="POST"
                            onsubmit="return confirm('¿Eliminar este workspace?')">
                            @csrf
                            @method('DELETE')

                            <x-danger-button>
                                Eliminar workspace
                            </x-danger-button>
                        </form>
                    @endcan
                    <p class="mt-3 text-sm text-slate-500">
                        Estado: <span
                            class="{{ $workspace->status->labelColor() }}">{{ __($workspace->status->label()) }}</span>
                    </p>
                </div>
            </div>

            <section class="mt-6 rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-bold text-slate-900">Alumnos</h2>

                    @can('manageStudents', $workspace)
                        <a href="{{ route('workspaces.students.create', $workspace) }}">
                            <x-primary-button>
                                + Añadir alumno
                            </x-primary-button>
                        </a>
                    @endcan
                </div>

                <div class="mt-6 space-y-3">
                    @forelse ($students as $student)
                        <div class="flex items-center justify-between rounded-xl border border-slate-200 px-4 py-3">
                            <span class="text-slate-800">{{ __($student->name) }}</span>

                            @can('manageStudents', $workspace)
                                <form method="POST"
                                    action="{{ route('workspaces.students.destroy', [$workspace, $student]) }}"
                                    onsubmit="return confirm('¿Eliminar a este alumno?')">
                                    @csrf
                                    @method('DELETE')

                                    <x-danger-button>
                                        Eliminar
                                    </x-danger-button>
                                </form>
                            @endcan
                        </div>
                    @empty
                        <p class="text-sm text-slate-500">
                            Este workspace todavía no tiene alumnos.
                        </p>
                    @endforelse
                </div>
            </section>

            <section class="mt-6 rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold">Sesiones</h2>

                    @can('manageTrainingSessions', $workspace)
                        <a href="{{ route('training-sessions.create', $workspace) }}">
                            <x-primary-button>
                                Nueva sesión
                            </x-primary-button>
                        </a>
                    @endcan
                </div>

                <div class="mt-6 grid gap-4 sm:grid-cols-2">
                    @forelse ($trainingSessions as $trainingSession)
                        <a href="{{ route('training-sessions.show', [$workspace, $trainingSession]) }}"
                            class="block rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:border-gray-800 hover:shadow-md">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-600">
                                        {{ __($trainingSession->date->format('d/m/Y')) }}
                                    </p>

                                    <h3 class="mt-2 text-lg font-semibold text-slate-900">
                                        {{ __($trainingSession->title) }}
                                    </h3>

                                    @if ($trainingSession->summary)
                                        <p class="mt-3 text-sm text-slate-600">
                                            {{ __($trainingSession->summary) }}
                                        </p>
                                    @endif
                                </div>
                                <div class="{{ $trainingSession->status->color() }} w-4 h-4 rounded-full inline-block">
                                </div>
                            </div>
                        </a>
                    @empty
                        <p class="text-sm text-slate-500">
                            Todavía no hay sesiones en este workspace.
                        </p>
                    @endforelse
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
