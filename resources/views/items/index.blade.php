@extends('layouts.app')

@section('content')
<div class="home">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card custom-card">
                    <div class="card-body">
                        <h2 class="card-title">Create Item</h2>
                        <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <div class="input-wrap">
                                    <input type="text" class="form-control" name="name" id="name" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <div class="input-wrap">
                                    <input type="email" class="form-control" name="email" id="email" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="content">Content</label>
                                <div class="input-wrap">
                                    <textarea class="form-control" name="content" id="content" required></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="age">Age</label>
                                <div class="input-wrap">
                                    <input type="number" step="0.1" min="2.5" max="99" class="form-control" name="age" id="age" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="image">Image</label>
                                <p>(If the image bigger than 2MB, it will failed to upload)</p>
                                <div class="input-wrap">
                                    <input type="file" class="form-control" name="image" id="image">
                                </div>
                            </div>

                                                        
                              
                            <div class="form-group">
                                @error('image')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Create</button>
                        </form>
                    </div>
                </div>
            </div>
                      
            </div>
            <div class="col-md-6">
                <h2 class="list-item" > Items List</h2>
                <table class="table table-striped custom-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Content</th>
                            <th>Age</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->content }}</td>
                            <td>{{ $item->age }}</td>
                            <td>
                                @if($item->image_path)
                                    @php
                                        $imageExtensions = ['png', 'jpg', 'jpeg'];
                                        $extension = pathinfo($item->image_path, PATHINFO_EXTENSION);
                                    @endphp
                            
                                    @if(in_array($extension, $imageExtensions))
                                        <img src="{{ asset('storage/' . $item->image_path) }}" alt="Item Image" class="img-fluid" style="max-width: 100px; max-height: 100px;">
                                    @else
                                        <button onclick="validateAndDisplayImage('{{ asset('storage/' . $item->image_path) }}', '{{ $extension }}')" class="btn btn-link">View Image</button>
                                    @endif
                                @endif

                            </td>
                            
                       
                            <td>
                                <a href="{{ route('items.edit', $item->id) }}" class="btn btn-primary btn-action">Edit</a>
                                <form action="{{ route('items.destroy', $item->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-action">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<style>

    .home {
        margin-top: 20px;
    }
    .form-group {
        margin-bottom: 20px;
    }
    .table {
        background-color: #fff;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .table th, .table td {
        text-align: center;
        vertical-align: middle;
    }
    .btn-link {
        text-decoration: underline;
        color: #007bff;
        cursor: pointer;
    }
    .btn-link:hover {
        text-decoration: none;
    }

    .custom-card {
    background-color: #f4f4f4;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .custom-card .card-title {
        text-align: center;
        font-size: 24px;
        margin-bottom: 20px;
    }            
.list-item {
    text-align: center;
    padding-top: 20px;
}
    .form-control {
        width: 100%;
    }
    .input-wrap {
        margin-bottom: 20px;
    }

    .custom-table {
        width: 100%;
        border-collapse: collapse;
        border-radius: 5px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .custom-table th, .custom-table td {
        padding: 10px;
        text-align: left;
    }

    .custom-table thead {
        background-color: #333;
        color: #fff;
    }

    .custom-table th {
        font-weight: bold;
    }

    .custom-table tbody tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .custom-table tbody tr:hover {
        background-color: #ddd;
    }

    .btn-action {
        margin-right: 15px;
    }
</style>
@endsection
