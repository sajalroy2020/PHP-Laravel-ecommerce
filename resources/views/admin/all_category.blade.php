@extends('admin.layouts.templeate')

@section('content')
    <h1 class="h3 mb-3"><strong>Product</strong> All-category</h1>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{session()->get('message')}}
        </div>
    @endif
    <div class="row">
        <div class="col-12  d-flex">
            <div class="card flex-fill">
                <table class="table table-hover my-0 text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th class="d-none d-xl-table-cell">Category Name</th>
                            <th class="d-none d-xl-table-cell">Sub Categori</th>
                            <th class="d-none d-md-table-cell">Product</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categoryes as $key => $category)
                        <tr>
                            <td class="d-none d-xl-table-cell">{{$key+1}}</td>
                            <td class="d-none d-xl-table-cell">{{$category->catName}}</td>
                            <td class="d-none d-xl-table-cell">{{$category->subCatCount}}</td>
                            <td class="d-none d-xl-table-cell">{{$category->productCount}}</td>
                            <td class="d-none d-md-table-cell">
                                <a class="btn btn-primary" href="{{route('categoryEdit', $category->id)}}">Edit</a>
                                <a class="btn btn-danger" href="{{route('categoryDelete', $category->id)}}">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
