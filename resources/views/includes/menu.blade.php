<ul class="list-group">
    @if(auth()->user()->role == 'manager')
        <li class="list-group-item">
            <a href="{{ route('tasks.create') }}">New Taks</a>
        </li>
        <li class="list-group-item">
            <a href="{{ route('tasks.index') }}">Taks</a>
        </li>
        <li class="list-group-item">
            <a href="{{ route('tasks.assigned') }}">Assigned Tasks</a>
        </li>
    @endif

    @if(auth()->user()->role == 'developer')
        <li class="list-group-item">
            <a href="{{ route('tasks.developers') }}">Tasks</a>
        </li>
    @endif
</ul>