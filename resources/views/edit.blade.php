@extends('layout')

@section('content')
    <div class="d-flex justify-content-between mb-4">
        <h2>Edit Employee</h2>
        <a class="btn btn-secondary" href="{{ route('employees.index') }}"> Back</a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('employees.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <div class="mb-3">
            <label class="form-label">Name:</label>
            <input type="text" name="name" value="{{ $employee->name }}" class="form-control" placeholder="Name">
        </div>

        <div class="mb-3">
            <label class="form-label">Email:</label>
            <input type="email" name="email" value="{{ $employee->email }}" class="form-control" placeholder="Email">
        </div>

        <div class="mb-3">
            <label class="form-label">Phone:</label>
            <input type="text" name="phone" value="{{ $employee->phone }}" class="form-control" placeholder="Phone">
        </div>

        <div class="mb-3">
            <label class="form-label">Description:</label>
            <textarea class="form-control" name="description" placeholder="Description">{{ $employee->description }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Current Image:</label><br>
            @if($employee->image)
                <img src="/images/{{ $employee->image }}" width="100px" class="img-thumbnail mb-2">
            @else
                <p>No Image Found</p>
            @endif

            <input type="file" name="image" class="form-control">
            <small class="text-muted">Leave blank if you don't want to change the image.</small>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
