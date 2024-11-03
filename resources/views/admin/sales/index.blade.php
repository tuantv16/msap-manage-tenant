@extends('admin.sales.layout')
@section('content')
    @include('layouts.title_content', ['breadcrumb' => 'EXV / Users', 'title' => 'Sale Management'])
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session()->has('success'))
                <div class="alert alert-success" id="success-message">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-3">
                <a href="{{route('users.create')}}" class="btn btn-success">Create sale management <i
                        class="fa-solid fa-plus"></i></a>
            </div>
                @if(count($sales) > 0)
                    <table class="table table-bordered">
                        <thead>
                        <tr class="text text-center">
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Created Time</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sales as $sale)
                            <tr class="text-center">
                                <td>{{$sale->id}}</td>
                                <td>{{$sale->name}}</td>
                                <td>{{$sale->email}}</td>
                                <td>{{$sale->created_at}}</td>
                                <td>
                                    <a href="{{route('users.show', $sale->id)}}" class="btn btn-primary"><i
                                            class="fa-solid fa-pen-to-square"></i></a>
                                    @if(! ($sale->id == \Illuminate\Support\Facades\Auth::user()->id))
                                        <a id="deleteUserBtn" href="{{route('users.deleteUser', $sale->id)}}"
                                           class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                                    @endif
                                </td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-center">No Sale Data record <i class="fa-solid fa-database"></i></p>
                @endif
            {{$sales->links()}}
        </div>
    </div>

    <script>
        //hide alert session after 2s
        $(document).ready(function () {
            setTimeout(function () {
                $('#success-message').fadeOut('slow');
            }, 2500);
        });
    </script>
@endsection
