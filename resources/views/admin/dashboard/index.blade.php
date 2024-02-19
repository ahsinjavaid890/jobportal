@extends('admin.layouts.main-layout')
@section('title','Dashboard')
@section('content')

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class=" container-fluid ">
        	<div class="row">
				<div class="col-md-2 mb-4">
            		<div class="cards">
                		<div class="card-svg">
                            <a href="">
                                <span class="material-symbols-outlined design_services">work</span>
                            </a>
                        </div>
                		<div class="card-tittle">
                    		<h4>Active <br> Jobs</h4>
                		</div>
                		<div class="card-number">
                    		<h3>{{ $jobCount }}</h3>
                		</div>
            		</div>
        		</div>
        		<div class="col-md-2 mb-4">
            		<div class="cards">
                		<div class="card-svg">
                            <a href="">
                                <span class="material-symbols-outlined pending">inventory</span>
                            </a>
                        </div> 
                		<div class="card-tittle">
                    		<h4>Application <br> received</h4>
                		</div>
                		<div class="card-number">
                    		<h3>{{ $applicationsCount }}</h3>
                		</div>
            		</div>
        		</div>
        	</div>
        </div>
     </div>
</div>	
<style type="text/css">
	.mb-4, .my-4 {
		margin-bottom: 4rem !important;
		margin-top: -2rem;
	}

	.cards {
		padding: 20px;
		border-radius: 12px;
		background: var(--white, #FFF);
		box-shadow: 0px 4px 20px 0px rgba(0, 0, 0, 0.05);
		border: transparent !important;
	}
	.img {
		vertical-align: middle;
		border-style: none;
	}
	.card-tittle {
		margin-top: 10px;
	}
	.card-tittle h4 {
		font-size: 14px;
		color: #999999;
	}
	.card-number {
		margin-top: 10px;
	}
	.card-number h3 {
		font-size: 20px;
		font-weight: 700;
	}
</style>
@endsection