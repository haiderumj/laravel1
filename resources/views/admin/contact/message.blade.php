@extends('admin.admin_master')



@section('admin')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
             <div class="container">
                 <div class="row">
                    <h4>Admin Message</h4>
                    <a href="{{ route('add.contact')}}"><button class="btn btn-info">Add Contact</button></a>
                    <br><br>
                                <div class="col-md-12">
                                    <div class="card">
                                        @if(session('success'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <strong>{{ session('success') }}</strong>
                                            <button type="button" class="btn-close text-dark" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>


                                        @endif
                                        <div class="card-header">All Message Data</div>
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th scope="col" class="text-center" style="width: 5%;">SL</th>
                                                    <th scope="col" style="width: 15%;">Name</th>
                                                    <th scope="col" style="width: 15%;">Email</th>
                                                    <th scope="col" style="width: 15%;">subject</th>
                                                    <th scope="col" style="width: 15%;">Message</th>
                                                    <th scope="col" style="width: 15%;">Action</th>
                                                </tr>

                                                </thead>
                                                
                                                <tbody>
                                                    @php($i = 1)
                                                @foreach($messages as $mess)
                                                    <tr>
                                                        <th scope="row">{{ $i++ }}</th>
                                                        <td>{{ $mess->name }}</td>
                                                        <td>{{ $mess->email }}</td>
                                                        <td>{{ $mess->subject }}</td>
                                                        <td>{{ $mess->message }}</td>
                                                       
                                                        <td>
                                                      
                                                            <a href="{{ url('message/delete/'.$mess->id) }}" onclick="return confirm('Are you sure you want to delete?')" class="btn btn-danger">Delete</a>
                                                        </td>
                                                        
                                                    </tr>
                                                @endforeach

                                                </tbody>
                                            </table>
                                            

                                    </div>
                                </div>

                                @endsection('admin')