@extends('admin.layouts.main-layout')
@section('title','All Jobs')
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
                            <h5 class="text-dark font-weight-bold my-1 mr-5">All Jobs</h5>
                            <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                                <li class="breadcrumb-item">
                                    <a href="{{ url('admin/dashboard') }}" class="text-muted">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="javascript::void(0)" class="text-muted">Manage Jobs</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ url('admin/jobs') }}" class="text-muted">All Jobs</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!--begin::Card-->
            @include('alerts.index')
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-custom mt-5">
                        <div class="card-header flex-wrap py-5">
                            <div class="card-title">
                                <h3 class="card-label">
                                    All Jobs
                                    <div class="text-muted pt-2 font-size-sm">Manage All Jobs</div>
                                </h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="datatable table table-bordered table-striped text-sm">
                               <thead>
                                 <tr>
                                   <th widith="25%">Job Title</th>
                                   <th width="10%">Category</th>
                                   <th width="15%">Created By</th>
                                   <th width="10%">Deadline</th>
                                   <th width="15%">Salary (Month)</th>
                                   <th width="5%">Status</th>
                                   <th width="5%" class="text-right">Applied</th>
                                   <th width="15%" class="text-center">Action</th>
                                 </tr>
                               </thead>
                               <tbody>
                                 @foreach ($jobs as $job)
                                 <tr>
                                   <td>{{ $job->title }}</td>
                                   <td>{{ $job->category->name }}</td>
                                   <td>{{ $job->user->name }}</td>
                                   <td>{{ date('jS M, y', strtotime($job->deadline)) }}</td>
                                   <td>Rs. {{ $job->monthly_salary_min . ' - Rs. ' . $job->monthly_salary_max }}</td>
                                   <td>{{ $job->status ? "Active" : "Deactive" }}</td>
                                   <td class="text-right">{{ $job->applications_count }}</td>
                                   <td class="text-center">
                                     <div class="d-flex justify-content-center align-items-center">
                                       <a href="{{ route('admin.jobs.show', $job->id) }}" class="btn btn-sm btn-info" title="View Details">
                                         <i class="fas fa-eye"></i>
                                       </a>
                                       <a href="{{ route('admin.jobs.edit', $job->id) }}" class="btn btn-success btn-sm ml-2" title="Edit">
                                         <i class="fas fa-edit"></i>
                                       </a>
                                       <form class="toggle-status-form" action="{{ route('admin.jobs.toggle-status', $job->id) }}"
                                         method="post">
                                         @csrf
                                         @method('PUT')
                                         <button type="submit"
                                           class="btn {{ $job->status ? "btn-danger" : "btn-primary" }} btn-sm ml-2"
                                           title="{{ $job->status ? "Deactivate" : "Activate" }}">
                                           @if ($job->status)
                                           <i class="fas fa-ban"></i>
                                           @else
                                           <i class="fas fa-check-circle"></i>
                                           @endif
                                         </button>
                                       </form>
                                       @if (auth()->user()->hasRole('superadmin'))
                                       <form class="delete-form" action="{{ route('admin.jobs.destroy', $job->id)}}" method="post"
                                         onsubmit="confirmDelete(this, event);">
                                         @csrf
                                         @method('delete')
                                         <button type="submit" class="btn btn-danger btn-sm ml-2" title="Delete">
                                           <i class="fas fa-trash"></i>
                                         </button>
                                       </form>
                                       @endif
                                     </div>
                                   </td>
                                 </tr>
                                 @endforeach
                               </tbody>
                             </table>
                            <div style="margin-top:10px;" class="row">
                                {!! $jobs->links('frontend.pagination') !!}
                            </div>
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