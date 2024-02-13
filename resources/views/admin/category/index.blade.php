@extends('admin.layouts.main-layout')
@section('title','Job Categories')
@section('content')

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid mb-5">
        <!--begin::Container-->
        <div class=" container-fluid ">
            <div class="subheader py-2 py-lg-6  subheader-solid " id="kt_subheader">
                <div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                    <div class="d-flex align-items-center flex-wrap mr-1">
                        <div class="d-flex align-items-baseline flex-wrap mr-5">
                            <h5 class="text-dark font-weight-bold my-1 mr-5">Job Categories</h5>
                            <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                                <li class="breadcrumb-item">
                                    <a href="{{ url('admin/dashboard') }}" class="text-muted">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="javascript::void(0)" class="text-muted">Manage Jobs</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ url('admin/categories') }}" class="text-muted">Job Categories</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!--begin::Card-->
            @include('alerts.index')
            <div class="row">
                <div class="col-md-7">
                    <div class="card card-custom mt-5">
                        <div class="card-header flex-wrap py-5">
                            <div class="card-title">
                                <h3 class="card-label">
                                    Job Categories
                                    <div class="text-muted pt-2 font-size-sm">Manage Job Categories</div>
                                </h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th class="text-center">Jobs</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($categories as $r)
                                        <tr>                                
                                            <td>
                                                {{ $r->name }}
                                            </td>
                                            <td class="text-center">
                                                {{ DB::table('jobs')->where('category_id' , $r->id)->count() }}
                                            </td>
                                           <td class="text-center">
                                               <a class="btn btn-primary btn-sm" href="{{ url('admin/products/edit') }}/{{ $r->id }}"><i class="fa fa-edit"></i>Edit</a>
                                               <a  data-toggle="modal" data-target="#deleteModal{{ $r->id }}" href="javascript:;" title="Delete" class="btn btn-primary btn-sm"><i class="fa fa-trash"></i>Delete</a>
                                           </td>
                                        </tr>
                                        <div class="modal fade" id="deleteModal{{ $r->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Are you Sure?</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <i aria-hidden="true" class="ki ki-close"></i>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p style="color:red;">Are you Sure You want to delete this Category</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                                                        <a href="{{ url('admin/products/delete') }}/{{ $r->id }}" class="btn btn-danger font-weight-bold">Yes, Delete it</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                            <div style="margin-top:10px;" class="row">
                                {!! $categories->links('frontend.pagination') !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card card-custom mt-5">
                        <div class="card-header flex-wrap py-5">
                            <div class="card-title">
                                <h3 class="card-label">
                                    Add New Job Category
                                    <div class="text-muted pt-2 font-size-sm">Add New Job Category</div>
                                </h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="#" id="editForm" method="POST">
                              @csrf
                              @method('PUT')
                                <div class="mb-3">
                                  <label for="name" class="col-form-label text-secondary">Category Name</label>
                                  <input type="text" name="name" class="form-control" required autofocus />
                                </div>
                                <div class="mb-3">
                                  <label for="description" class="col-form-label text-secondary">Description</label>
                                  <textarea name="description" class="form-control"></textarea>
                                </div>
                                <button id="editBtn" type="submit" class="btn btn-primary">Add Category
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
@endsection