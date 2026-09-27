<x-app-layout>
  <h1>WORKSPACES</h1>

  <a href="{{ route('workspaces.create')}}">Crear Workspace</a>

  @forelse ($workspaces as $workspace)
    <a href="{{ route('workspaces.show', $workspace) }}">
      <p>{{ $workspace->title }}</p>
    </a>
  @empty
    <p>Todavia no tienes workspaces.</p>
  @endforelse
</x-app-layout>
