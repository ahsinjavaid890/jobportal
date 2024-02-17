@extends('admin.layouts.main-layout')
@section('title','Job Skills')
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
                            <h5 class="text-dark font-weight-bold my-1 mr-5">Job Skills</h5>
                            <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                                <li class="breadcrumb-item">
                                    <a href="{{ url('admin/dashboard') }}" class="text-muted">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="javascript::void(0)" class="text-muted">Manage Skills</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ url('admin/skills') }}" class="text-muted">Job Skills</a>
                                </li>
                                @if(isset($_GET['skill_id']))
                                <li class="breadcrumb-item">
                                    <a href="javscript::void(0)" class="text-danger">Update Category : {{ DB::table('skills')->where('id' , $_GET['skill_id'])->first()->name }}</a>
                                </li>
                                @endif
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
                                    Job Skills
                                    <div class="text-muted pt-2 font-size-sm">Manage Job Skills</div>
                                </h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($skills as $r)
                                        <tr>                                
                                            <td>
                                                {{ $r->name }}
                                            </td>
                                             <td class="text-center">
                                               <a class="btn btn-primary btn-sm" href="{{ url('admin/skills') }}?skill_id={{ $r->id }}"><i class="fa fa-edit"></i>Edit</a>
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
                                                        <a href="{{ url('admin/skills/deleteskill') }}/{{ $r->id }}" class="btn btn-danger font-weight-bold">Yes, Delete it</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                            <div style="margin-top:10px;" class="row">
                                {!! $skills->links('frontend.pagination') !!}
                            </div>
                        </div>
                    </div>
                </div>
                @if(isset($_GET['skill_id']))
                <div class="col-md-5">
                    <div class="card card-custom mt-5">
                        <div class="card-header flex-wrap py-5">
                            <div class="card-title">
                                <h3 class="card-label">
                                    Update Skill
                                    <div class="text-muted pt-2 font-size-sm">Update Skill</div>
                                </h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('admin/skills/updateskill') }}" id="editForm" method="POST">
                              @csrf
                                <input type="hidden" value="{{ $_GET['skill_id'] }}" name="id">
                                <div class="mb-3">
                                  <label for="name" class="col-form-label text-secondary">Skill Name</label>
                                  <input type="text" name="name" value="{{ DB::table('skills')->where('id' , $_GET['skill_id'])->first()->name }}" class="form-control" required autofocus />
                                </div>
                                <div class="mb-3">
                                  <label for="description" class="col-form-label text-secondary">Description</label>
                                  <textarea name="description" class="form-control">{{ DB::table('skills')->where('id' , $_GET['skill_id'])->first()->description }}</textarea>
                                </div>
                                <button id="editBtn" type="submit" class="btn btn-primary">Update
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @else
                <div class="col-md-5">
                    <div class="card card-custom mt-5">
                        <div class="card-header flex-wrap py-5">
                            <div class="card-title">
                                <h3 class="card-label">
                                    Add New Skill
                                    <div class="text-muted pt-2 font-size-sm">Add New Skill</div>
                                </h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('admin/skills/createskill') }}" id="editForm" method="POST">
                              @csrf
                                <div class="mb-3">
                                  <label for="name" class="col-form-label text-secondary">Skill Name</label>
                                  <input type="text" name="name" class="form-control" required autofocus />
                                </div>
                                <div class="mb-3">
                                  <label for="description" class="col-form-label text-secondary">Description</label>
                                  <textarea name="description" class="form-control"></textarea>
                                </div>
                                <button id="editBtn" type="submit" class="btn btn-primary">Add Skill
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
@endsection