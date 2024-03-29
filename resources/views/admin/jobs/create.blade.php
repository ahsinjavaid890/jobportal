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
                            <h5 class="text-dark font-weight-bold my-1 mr-5">Add New Job</h5>
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
                                    <a href="javascript::void(0)" class="text-muted">Add New Job</a>
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
                	<form action="{{ route('admin.jobs.store') }}" method="post" enctype="multipart/form-data">
                  @csrf
            <div class="row">
              <div class="col-lg-12">


                <div class="card card-custom mt-5">
                    <div class="card-header flex-wrap py-5">
                        <div class="card-title">
                            <h3 class="card-label">
                                Add New Job (Basic Details)
                                <div class="text-muted pt-2 font-size-sm">Basic Details</div>
                            </h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                              <label for="title" class="col-form-label text-secondary">Job Title*</label>
                              <input type="text" name="title" id="title"
                                class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}"
                                required autofocus>
                              @error('title')
                              <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                            </div>
                            <div class="col-lg-4">
                              <label for="category" class="col-form-label text-secondary">Category*</label>
                              <select name="category" id="category"
                                class="select2 form-control @error('category') is-invalid @enderror" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                <option @if(old('category')==$category->id) selected @endif
                                  value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                              </select>
                              @error('category')
                              <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                            </div>
                            <div class="col-lg-4">
                              <label for="type" class="col-form-label text-secondary">Job Type*</label>
                              <select name="type" id="type" class="select2 form-control @error('type') is-invalid @enderror"
                                required>
                                <option value="">Select Job Type</option>
                                <option @if(old('type')==App\Models\Job::FULL_TIME) selected @endif
                                  value="{{ App\Models\Job::FULL_TIME }}">Full Time</option>
                                <option @if(old('type')==App\Models\Job::PART_TIME) selected @endif
                                  value="{{ App\Models\Job::PART_TIME }}">Part Time</option>
                                <option @if(old('type')==App\Models\Job::CONTRACT) selected @endif
                                  value="{{ App\Models\Job::CONTRACT }}">Contract</option>
                                <option @if(old('type')==App\Models\Job::INTERNSHIP) selected @endif
                                  value="{{ App\Models\Job::INTERNSHIP }}">Internship</option>
                                <option @if(old('type')==App\Models\Job::OFFICE) selected @endif
                                  value="{{ App\Models\Job::OFFICE }}">Office</option>
                              </select>
                              @error('type')
                              <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                            </div>
                            <div class="col-lg-4">
                              <div class="mb-3">
                                <label for="location" class="col-form-label text-secondary">Job Location*</label>
                                <select name="location" id="location"
                                  class="select2 form-control @error('location') is-invalid @enderror">
                                  <option value="">Select Job Location</option>
                                  @foreach ($locations as $location)
                                  <optgroup label="{{ $location->name }}">
                                    @foreach ($location->city as $city)
                                    <option @if(old('location')==$city->id) selected @endif
                                      value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endforeach
                                  </optgroup>
                                  @endforeach
                                </select>
                                @error('location')
                                <span class="invalid-feedback">
                                  <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                              </div>
                            </div>
                            <div class="col-lg-6">
                              <div class="mb-3">
                                <label for="qualification"
                                  class="col-form-label text-secondary">Qualification/Eligibility*</label>
                                <select name="qualification[]" id="qualification"
                                  class="form-control select2 @error('qualification') is-invalid @enderror" required multiple>
                                  @foreach ($qualifications as $qualification)
                                  @php
                                      $old_q = old('qualification') ? old('qualification') : [];
                                  @endphp
                                  <option @if(in_array($qualification->id, $old_q)) selected @endif
                                    value="{{ $qualification->id }}">{{ $qualification->name }}</option>
                                  @endforeach
                                </select>
                                @error('qualification')
                                <span class="invalid-feedback">
                                  <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                              </div>
                            </div>

                            <div class="col-lg-6">
                              <div class="mb-3">
                                <label for="hiring" class="col-form-label text-secondary">Hiring Process*</label>
                                <select name="hiring[]" id="hiring"
                                  class="form-control select2 @error('hiring') is-invalid @enderror" multiple>
                                  @php
                                      $old_hiring = old('hiring') ? old('hiring') : [];
                                  @endphp
                                  <option @if(in_array(App\Models\Job::FACE_TO_FACE, $old_hiring)) selected @endif
                                    value="{{ App\Models\Job::FACE_TO_FACE }}">Face to Face</option>
                                  <option @if(in_array(App\Models\Job::WRITTEN_TEST, $old_hiring)) selected @endif
                                    value="{{ App\Models\Job::WRITTEN_TEST }}">Written-test</option>
                                  <option @if(in_array(App\Models\Job::TELEPHONIC, $old_hiring)) selected @endif
                                    value="{{ App\Models\Job::TELEPHONIC }}">Telephonic</option>
                                  <option @if(in_array(App\Models\Job::GROUP_DISCUSSION, $old_hiring)) selected @endif
                                    value="{{ App\Models\Job::GROUP_DISCUSSION }}">Group Discussion</option>
                                  <option @if(in_array(App\Models\Job::WALK_IN, $old_hiring)) selected @endif
                                    value="{{ App\Models\Job::WALK_IN }}">Walk In</option>
                                </select>
                                @error('hiring')
                                <span class="invalid-feedback">
                                  <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                              </div>
                            </div>

                            <div class="col-lg-4">
                              <div class="mb-3">
                                <label for="deadline" class="col-form-label text-secondary">Application Deadline</label>
                                <input type="date" name="deadline" id="deadline" value="{{ old('deadline') }}"
                                  class="form-control @error('deadline') is-invalid @enderror" />
                                @error('deadline')
                                <span class="invalid-feedback">
                                  <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                              </div>
                            </div>
                            <div class="col-lg-4">
                              <label for="monthly_salary_min" class="col-form-label text-secondary">Monthly Salary
                                (Min)*</label>
                              <input type="number" name="monthly_salary_min" id="monthly_salary_min"
                                class="form-control @error('monthly_salary_min') is-invalid @enderror" min="1000"
                                value="{{ old('monthly_salary_min') }}" required>
                              @error('monthly_salary_min')
                              <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                            </div>

                            <div class="col-lg-4">
                              <label for="monthly_salary_max" class="col-form-label text-secondary">Monthly Salary
                                (Max)*</label>
                              <input type="number" name="monthly_salary_max" id="monthly_salary_max"
                                class="form-control @error('monthly_salary_max') is-invalid @enderror" min="1500"
                                value="{{ old('monthly_salary_max') }}" required />
                              @error('monthly_salary_max')
                              <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                            </div>

                            <div class="col-lg-12">
                              <div class="mb-3">
                                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                  required>{{ old('description') }}</textarea>
                                @error('description')
                                <span class="invalid-feedback">
                                  <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                              </div>
                            </div>

                            <div class="col-lg-12">
                              <div class="mb-3">
                                <label for="company_name">Company Name</label>
                                <input id="company_name" class="form-control  @error('company_name') is-invalid @enderror"
                                type="text" name="company_name" value="{{ old('company_name') }}" />

                                @error('company_name')
                                <span class="invalid-feedback">
                                  <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-custom mt-5">
                    <div class="card-header flex-wrap py-5">
                        <div class="card-title">
                            <h3 class="card-label">
                                Additional Details Optional
                                <div class="text-muted pt-2 font-size-sm">Additional Details Optional</div>
                            </h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                             <div class="col-lg-3">
                              <div class="mb-3">
                                <label for="year_passing_from">Year of Passing (From)</label>
                                <select name="year_passing_from" id="year_passing_from"
                                  class="form-control select2 @error('year_passing_from') is-invalid @enderror">
                                  {{ renderYearOptions(old('year_passing_from')) }}
                                </select>

                                @error('year_passing_from')
                                <span class="invalid-feedback">
                                  <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                              </div>
                            </div>

                            <div class="col-lg-3">
                              <div class="mb-3">
                                <label for="year_passing_to">Year of Passing (To)</label>
                                <select name="year_passing_to" id="year_passing_to"
                                  class="form-control select2 @error('year_passing_to') is-invalid @enderror">
                                  {{ renderYearOptions(old('year_passing_to')) }}
                                </select>

                                @error('year_passing_to')
                                <span class="invalid-feedback">
                                  <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                              </div>
                            </div>

                            <div class="col-lg-3">
                              <div class="mb-3">
                                <label for="experience_from">Experience (From)</label>
                                <select name="experience_from" id="experience_from"
                                  class="form-control select2 @error('experience_from') is-invalid @enderror">
                                  {{ renderExperienceOptions(old('experience_from')) }}
                                </select>

                                @error('experience_from')
                                <span class="invalid-feedback">
                                  <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                              </div>
                            </div>

                            <div class="col-lg-3">
                              <div class="mb-3">
                                <label for="experience_to">Experience (To)</label>
                                <select name="experience_to" id="experience_to"
                                  class="form-control select2 @error('experience_to') is-invalid @enderror">
                                  {{ renderExperienceOptions(old('experience_to')) }}
                                </select>

                                @error('experience_to')
                                <span class="invalid-feedback">
                                  <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                              </div>
                            </div>  
                            <div class="col-lg-6">
                        <div class="mb-3">
                          <label for="skills">Skills</label>
                          <select name="skills[]" id="skills"
                            class="select2 form-control @error('skills') is-invalid @enderror" multiple>
                            @php
                                $old_skills = old('skills') ? old('skills') : [];
                            @endphp
                            @foreach ($skills as $skill)
                            <option {{ (in_array($skill->id, $old_skills)) ? "selected" : "" }} value="{{ $skill->id }}">{{ $skill->name }}</option>
                            @endforeach
                          </select>

                          @error('skills')
                          <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-lg-6">
                        <div class="mb-3">
                          <label for="gender">Gender</label>
                          <select name="gender" id="gender" class="form-control select2">
                            <option {{ old('gender') == APP\Models\Job::BOTH ? "selected" : "" }}
                              value="{{ APP\Models\Job::BOTH }}">Both</option>
                            <option {{ old('gender') == APP\Models\Job::MALE ? "selected" : "" }}
                              value="{{ APP\Models\Job::MALE }}">Male</option>
                            <option {{ old('gender') == APP\Models\Job::FEMALE ? "selected" : "" }}
                              value="{{ APP\Models\Job::FEMALE }}">Female</option>
                          </select>
                        </div>
                      </div> 
                      <div class="col-lg-6">
                        <div class="mb-3">
                          <button class="btn btn-success" type="submit">Submit</button>
                        </div>
                      </div>                       
                        </div>
                    </div>
                </div>
                <!-- ./card -->
              </div>
              <!-- ./col-lg-12 -->
            </div>
          </form>
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
  $(document).ready(function() {
    $('.select2').select2({
      width: '100%',
    });
  });
</script>
@endsection