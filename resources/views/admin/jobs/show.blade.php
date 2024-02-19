@extends('admin.layouts.main-layout')
@section('title','Add New Job')
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
                            <h5 class="text-dark font-weight-bold my-1 mr-5">View Job Details</h5>
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
                                <li class="breadcrumb-item">
                                    <a href="javascript::void(0)" class="text-muted">{{ $job->title }}</a>
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
                          <div class="flex-wrap py-5 pl-5" style="border-bottom: 1px solid #ddd;">
                                  
                                  <div class="row">
                                    <div class="col-md-11">
                                      <h3 class="card-label">
                                      {{ $job->title }}
                                      <div class="text-muted pt-2 font-size-sm">View Job Details</div>
                                  </h3>
                                    </div>
                                    <div class="col-md-1 text-right">
                                      <div class="btn-group">
                                        <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                                          <span class="material-symbols-outlined">more_horiz</span>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" role="menu">
                                          <a href="{{ route('admin.jobs.edit', $job->id) }}" class="dropdown-item">Edit</a>
                                          <a class="dropdown-divider"></a>
                                          <a href="#" class="dropdown-item" onclick="event.preventDefault();
                                            document.getElementById('toggleForm').submit();">
                                            {{ $job->status ? "Dactivate" : "Activate" }}
                                          </a>
                                          @if (auth()->user()->hasRole('superadmin'))
                                          <a href="#" onclick="event.preventDefault();
                                          document.getElementById('deleteForm').submit();" class="dropdown-item">Delete</a>
                                          <form id="deleteForm" method="POST" action="{{ route('admin.jobs.destroy', $job->id) }}">
                                            @csrf
                                            @method('DELETE')
                                          </form>
                                          @endif
                                        </div>

                                        <form id="toggleForm" method="POST" action="{{ route('admin.jobs.toggle-status', $job->id) }}">
                                          @csrf
                                          @method('PUT')
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                          </div>
                          <div class="card-body">
                              <div class="text-dark"><strong>Company Name:</strong> {{ $job->company_name }}</div>
                              <div class="text-dark"><strong>City Name:</strong> {{ $job->city->name }}</div>
                              <div class="d-flex justify-content-between align-items-center">
                                <div class="text-success">{{ $job->created_at->diffForHumans() }}</div>
                              </div>
                              <div class="job-box__html-content mt-4 mb-4">
                                {!! $job->description !!}
                              </div>
                              <div class="job-bottom-info">
                                <div class="row">
                                  <div class="col-md-6">
                                    <ul>
                                      <li><strong>Category:</strong> {{ $job->category->name }}</li>
                                      <li><strong>Job Type:</strong> {{ renderJobType($job->type) }}</li>
                                      <li><strong>Job Location:</strong> {{ $job->city->name }}</li>
                                      <li><strong>Salary:</strong> Rs. {{ thousandsCurrencyFormat($job->monthly_salary_min) .' to ' .
                                      thousandsCurrencyFormat($job->monthly_salary_max) }}</li>
                                      <li><strong>Posted:</strong> {{ $job->created_at->diffForHumans() }}</li>
                                    </ul>
                                  </div>
                                  <div class="col-md-6">
                                    <ul>
                                      <li><strong>Deadline Until:</strong> {!! date('j<\s\up>S</\s\up> F, Y', strtotime($job->deadline))
                                        !!}</li>
                                      <li><strong>Hiring Process:</strong> {{ renderHiringFromArray($job->hiring) }}</li>
                                      <li><strong>Eligibility Criteria:</strong> {{ renderGender($job->gender) }}</li>
                                      @if($job->experience_from && $job->experience_to)
                                      <li><strong>Experience:</strong> {{ renderExperience($job->experience_from) . ' to ' .
                                      renderExperience($job->experience_to) }}</li>
                                      @endif
                                      <li><strong>Status:</strong>: {{ $job->status ? 'Active': 'Inactive' }}</li>
                                    </ul>
                                  </div>
                                </div>
                              </div>

                          </div>
                      </div>
                      <div class="card card-custom mt-5">
                    <div class="card-header flex-wrap py-5">
                        <div class="card-title">
                            <h3 class="card-label">
                                Job Applicants
                                <div class="text-muted pt-2 font-size-sm">Job Applicants</div>
                            </h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row m-0">
                            @foreach ($job->applications as $appl)
                            <div class="col-12 user">
                              <div class="row">
                                <div class="col-sm-2">
                                  <img
                                    src="{{ ($appl->user->profile->image == 'avatar.jpg') ? asset('img/avatar.jpg') : asset('/storage/avatar/' . $appl->user->profile->image) }}"
                                    width="50" height="50" class="img-fluid img-circle img-bordered" alt="User Image">
                                </div>
                                <div class="col-sm-10">
                                  <div class="text-secondary">
                                    {{ $appl->user->name }}
                                  </div>
                                  <div class="text-secondary">
                                    {{ $appl->user->email }}
                                  </div>
                                  <div class="text-secondary">
                                    {{ $appl->user->profile->phone }}
                                  </div>
                                </div>
                              </div>
                              <div class="row mt-3">
                                <div class="col-sm-12">
                                  <a class="btn btn-primary btn-sm mr-2" href="{{ asset('storage/resume/'.$appl->resume) }}"
                                    download="">Download Resume</a>
                                  <a class="btn btn-info btn-sm" href="{{ route('admin.user.show', $appl->user->id) }}">View Profile</a>
                                </div>
                              </div>
                            </div>
                            @endforeach
                          </div>
                    </div>
                </div>
                      <!-- ./card -->
                    <!-- ./col-lg-12 -->
                </div>
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>

@endsection

@section('script')
<script type="text/javascript">

</script>
@endsection