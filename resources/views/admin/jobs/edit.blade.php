@extends('admin.layouts.main-layout')
@section('title','Update Job')
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
                            <h5 class="text-dark font-weight-bold my-1 mr-5">Update Job</h5>
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
            <form action="{{ route('admin.jobs.update', $job->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-custom mt-5">
                        <div class="card-header flex-wrap py-5">
                            <div class="card-title">
                                <h3 class="card-label">
                                    Update Job : {{ $job->title }}
                                    <div class="text-muted pt-2 font-size-sm">Manage Update Job</div>
                                </h3>
                            </div>
                        </div>
                        <div class="card-body">
                        	<div class="row">
		                      <div class="col-12">
		                        <div class="mb-3">
		                          <label for="title" class="col-form-label text-secondary">Job Title*</label>
		                          <input type="text" name="title" id="title"
		                            class="form-control @error('title') is-invalid @enderror"
		                            value="{{ old('title', $job->title) }}" required autofocus>
		                          @error('title')
		                          <span class="invalid-feedback">
		                            <strong>{{ $message }}</strong>
		                          </span>
		                          @enderror
		                        </div>
		                      </div>

		                      <div class="col-lg-4">
		                        <label for="category" class="col-form-label text-secondary">Category*</label>
		                        <select name="category" id="category"
		                          class="select2 form-control @error('category') is-invalid @enderror" required>
		                        @foreach($categories as $category)
		                        <option @if(old('category', $job->category_id) == $category->id) selected @endif
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
		                          <option></option>
		                          <option @if(old('type', $job->type) == App\Models\Job::FULL_TIME) selected @endif
		                            value="{{ App\Models\Job::FULL_TIME }}">Full Time</option>
		                          <option @if(old('type', $job->type) == App\Models\Job::PART_TIME) selected @endif
		                            value="{{ App\Models\Job::PART_TIME }}">Part Time</option>
		                          <option @if(old('type', $job->type) == App\Models\Job::CONTRACT) selected @endif
		                            value="{{ App\Models\Job::CONTRACT }}">Contract</option>
		                          <option @if(old('type', $job->type) == App\Models\Job::INTERNSHIP) selected @endif
		                            value="{{ App\Models\Job::INTERNSHIP }}">Internship</option>
		                          <option @if(old('type', $job->type) == App\Models\Job::OFFICE) selected @endif
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
		                            <option></option>
		                            @foreach ($locations as $location)
		                            <optgroup label="{{ $location->name }}">
		                              @foreach ($location->city as $city)
		                              <option @if(old('location', $job->city_id) == $city->id) selected @endif
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
		                            <option></option>
		                            @foreach ($qualifications as $qualification)
		                            <option @if(old('qualification')==$qualification->id || in_array($qualification->id,
		                              $qualification_ids)) selected @endif
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
		                            <option></option>
		                            <option @if(old('hiring')==App\Models\Job::FACE_TO_FACE ||
		                              in_array(App\Models\Job::FACE_TO_FACE, json_decode($job->hiring, true))) selected @endif
		                              value="{{ App\Models\Job::FACE_TO_FACE }}">Face to Face</option>
		                            <option @if(old('hiring')==App\Models\Job::WRITTEN_TEST ||
		                              in_array(App\Models\Job::WRITTEN_TEST, json_decode($job->hiring, true))) selected @endif
		                              value="{{ App\Models\Job::WRITTEN_TEST }}">Written-test</option>
		                            <option @if(old('hiring')==App\Models\Job::TELEPHONIC ||
		                              in_array(App\Models\Job::TELEPHONIC, json_decode($job->hiring, true))) selected @endif
		                              value="{{ App\Models\Job::TELEPHONIC }}">Telephonic</option>
		                            <option @if(old('hiring')==App\Models\Job::GROUP_DISCUSSION ||
		                              in_array(App\Models\Job::GROUP_DISCUSSION, json_decode($job->hiring, true))) selected
		                              @endif
		                              value="{{ App\Models\Job::GROUP_DISCUSSION }}">Group Discussion</option>
		                            <option @if(old('hiring')==App\Models\Job::WALK_IN || in_array(App\Models\Job::WALK_IN,
		                              json_decode($job->hiring, true))) selected @endif
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
		                          <input type="date" name="deadline" id="deadline"
		                            class="form-control @error('deadline') is-invalid @enderror"
		                            value="{{ old('deadline', $job->deadline) }}" />
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
		                          class="form-control @error('monthly_salary_min') is-invalid @enderror" min="1000" step="500"
		                          value="{{ old('monthly_salary_min', $job->monthly_salary_min) }}" required>
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
		                          class="form-control @error('monthly_salary_max') is-invalid @enderror" min="1500" step="500"
		                          value="{{ old('monthly_salary_max', $job->monthly_salary_max) }}" required />
		                        @error('monthly_salary_max')
		                        <span class="invalid-feedback">
		                          <strong>{{ $message }}</strong>
		                        </span>
		                        @enderror
		                      </div>
		                      <div class="col-lg-12">
		                        <div class="mb-3">
		                          <label for="description" class="col-form-label text-secondary">Job Details*</label>
		                          <div id="quill-editor"></div>
		                          <textarea name="description" id="description"
		                            class="q-editor d-none form-control @error('description') is-invalid @enderror"
		                            required>{{ old('description', $job->description) }}</textarea>
		                          <input type="hidden" name="description_ql" id="qlDescription"
		                            value="{{ old('description_ql', $job->description_ql)}}" class="ql-input-hidden">
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
		                          <input id="company_name" class="form-control  @error('company_name') is-invalid @enderror" type="text" name="company_name" value="{{ old('company_name', $job->company_name) }}" />

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
		                          <label for="year_passing_from" class="col-form-label text-secondary">Year of Passing
		                            (From)</label>
		                          <select name="year_passing_from" id="year_passing_from"
		                            class="form-control select2 @error('year_passing_from') is-invalid @enderror">
		                            <option></option>
		                            {{ renderYearOptions(old('year_passing_form', $job->year_passing_from)) }}
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
		                          <label for="year_passing_to" class="col-form-label text-secondary">Year of Passing
		                            (To)</label>
		                          <select name="year_passing_to" id="year_passing_to"
		                            class="form-control select2 @error('year_passing_to') is-invalid @enderror">
		                            <option></option>
		                            {{ renderYearOptions(old('year_passing_to', $job->year_passing_to)) }}
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
		                          <label for="experience_from" class="col-form-label text-secondary">Experience (From)</label>
		                          <select name="experience_from" id="experience_from"
		                            class="form-control select2 @error('experience_from') is-invalid @enderror">
		                            <option></option>
		                            {{ renderExperienceOptions(old('experience_from', $job->experience_from)) }}
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
		                          <label for="experience_to" class="col-form-label text-secondary">Experience (To)</label>
		                          <select name="experience_to" id="experience_to"
		                            class="form-control select2 @error('experience_to') is-invalid @enderror">
		                            <option></option>
		                            {{ renderExperienceOptions(old('experience_to', $job->experience_to)) }}
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
		                          <label for="skills" class="col-form-label text-secondary">Skills</label>
		                          <select name="skills[]" id="skills"
		                            class="select2 form-control @error('skills') is-invalid @enderror" multiple>
		                            <option></option>
		                            @foreach ($skills as $skill)
		                            <option {{ in_array($skill->id, $skill_ids) ? "selected" : "" }} value="{{ $skill->id }}">
		                              {{ $skill->name }}</option>
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
		                          <label for="gender" class="col-form-label text-secondary">Gender</label>
		                          <select name="gender" id="gender" class="form-control select2">
		                            <option></option>
		                            <option {{ old('gender', $job->gender) == APP\Models\Job::MALE ? "selected" : "" }}
		                              value="{{ APP\Models\Job::MALE }}">Male</option>
		                            <option {{ old('gender', $job->gender) == APP\Models\Job::FEMALE ? "selected" : "" }}
		                              value="{{ APP\Models\Job::FEMALE }}">Female</option>
		                            <option {{ old('gender', $job->gender) == APP\Models\Job::BOTH ? "selected" : "" }}
		                              value="{{ APP\Models\Job::BOTH }}">Both</option>
		                          </select>
		                        </div>
		                      </div>
		                      <div class="mt-3 row">
			                      <div class="text-right col-lg-12">
			                        <button type="submit" class="btn btn-success">Save</button>
			                      </div>
			                    </div>
		                    </div>               
	                    </div>
                    </div>
                </div>
                </div>
            </div>
            </form>
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