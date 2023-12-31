@extends('admin.admin_master')
@section('admin')
      
    @if(session('success'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <strong>{{ session('success') }}</strong>
                                            <button type="button" class="btn-close text-dark" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>


                                        @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">Edit Brand</div>
                            <div class="card-body">
                                <form action="{{ url('brand/update/'.$brands->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="old_image" value="{{ $brands->brand_image }}">
                                    <div class="mb-3">
                                        <label for="brand_name" class="form-label">Update Brand Name</label>
                                        <input type="text" name="brand_name" class="form-control" id="brand_name" aria-describedby="emailHelp" value="{{ $brands->brand_name }}">
                                        @error('brand_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="brand_image" class="form-label">Update Brand Image</label>
                                        <input type="file" name="brand_image" class="form-control" id="brand_image" aria-describedby="emailHelp">
                                        @error('brand_image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <img src="{{ asset($brands->brand_image) }}" style="width:400px; height:200px;" alt="">
                                    </div>
                                    <button type="submit" class="btn btn-primary bg-primary">Update Brand</button>
                                </form>
                            </div>     
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
