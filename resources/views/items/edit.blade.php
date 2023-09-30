@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card custom-card">
        <div class="card-body">
            <h2 class="card-title">Edit Item</h2>
            <form action="{{ route('items.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ $item->name }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email" value="{{ $item->email }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea class="form-control" name="content" id="content" required>{{ $item->content }}</textarea>
                </div>

                <div class="form-group mb-3">
                    <label for="age" class="form-label">Age</label>
                    <input type="number" step="0.1" min="2.5" max="99" class="form-control" name="age" id="age" value="{{ $item->age }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control-file" name="image" id="image">
                </div>

                <div class="form-group mb-3">
                    @error('image')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
</div>

<style>
    .container {
        margin-top: 20px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .custom-card {
        background-color: #f4f4f4;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .custom-card .card-title {
        text-align: left;
        font-size: 24px;
        margin-bottom: 20px;
    }

    .form-control {
        width: 20%;
    }
</style>
@endsection
