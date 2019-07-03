@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <table class="table thead-light">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">Deadline</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tasks as $task)
                                <tr>
                                    <td>{{ $task->id }}</td>
                                    <td>{{ $task->title }}</td>
                                    <td>{{ $task->description }}</td>
                                    <td>{{ $task->deadline }}</td>

                                    <td>
                                        @if($task->status != 'done')
                                        <select name="" class="changeStatus" task-id="{{ $task->id }}">
                                            <option value="assigned" @if($task->status == 'assigned') selected @endif>Assigned</option>
                                            <option value="in_progress" @if($task->status == 'in_progress') selected @endif>In progress</option>
                                            <option value="done" @if($task->status == 'done') selected  @endif>Done</option>
                                        </select>
                                        @else
                                            Done
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.changeStatus').change(function () {
            var status = $(this).val();
            var taskId = $(this).attr('task-id');
            var url = '{{ url('dashboard/developer/tasks/') }}' + '/' +  taskId;

            if(status != '') {
                $.ajax({
                    type:'POST',
                    url: url,
                    data: {status: status},
                    success:function(data){
                        if(data.status == 'success') {
                            alert('Successfully was changed status');
                        } else {
                            alert('Status didn\'t changed');
                        }
                    }
                });
            }
        });
    });
</script>
@endpush
