@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 card-body">
                <form method="POST" action="{{ route('tasks.store') }}">
                    @csrf
                    <div class="form-group row">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control  @error('title') is-invalid @enderror" id="title" >

                        @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label for="description">description</label>
                        <textarea name="description" id="description" cols="30" rows="10" class="form-control  @error('description') is-invalid @enderror"></textarea>
                        @error('description')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label for="deadline">Deadline</label>
                        <input type="datetime-local" name="deadline" class="form-control @error('deadline') is-invalid @enderror" id="deadline" >

                        @error('deadline')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
