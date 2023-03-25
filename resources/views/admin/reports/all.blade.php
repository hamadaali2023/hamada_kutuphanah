
@extends('layout.admin_main')
@section('content')	

@toastr_css

<div class="content-header row">
	<div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
        <h3 class="content-header-title mb-0 d-inline-block">التقارير</h3><br>
		<div class="row breadcrumbs-top d-inline-block">
			<div class="breadcrumb-wrapper col-12">
		        <ol class="breadcrumb">
		            <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">الرئيسية</a></li>
		            <li class="breadcrumb-item active"> التقارير </li>
			    </ol> 
			</div>
	    </div>
    </div>

    @if (session('message'))
		<div class="alert alert-success">
			{{ session('message') }}
        </div>
	@endif
    @if (count($errors) > 0)
	    <div class="alert alert-danger">
	        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
			    <span aria-hidden="true">&times;</span>
            </button>
			<strong>خطا</strong>
            <ul>
			    @foreach ($errors->all() as $error)
			      <li>{{ $error }}</li>
			    @endforeach
            </ul>
		</div>
	@endif
</div>

<section id="keytable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">قائمة تقارير المستخدمين</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                          <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                          <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                          <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                          <li><a data-action="close"><i class="ft-x"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered keytable-integration">
									<thead>
										<tr>													
											<th>الكاتب</th>
											<th>اجمالي المبيعات	</th>
											<th>اجمالي التحويلات</th>
											<th class="text-right">الرصيد المتبقي	</th>
											<th class="text-right">العمليات	</th>
											<!-- <th class="text-right">طباعة</th> -->
										</tr>
									</thead>
									<tbody>						
										@foreach ($users as $_item)
										<tr>						
											<td class="text-center">
												{{ $_item->name }}
											</td>
											<td class="text-center">
												{{ $_item->total_sales }}
											</td>
											<td class="text-center">
												{{ $_item->total_received }}
											</td>
											<td class="text-center">
												{{ $_item->total_balance }}
											</td>
											
											<td class="text-center">
											<div class="actions">
												<!-- <a class="btn btn-sm bg-success-light" href="#">
													<i class="fe fe-pencil"></i> تحويل
												</a>
												<a href="#" class="btn btn-sm bg-danger-light"><i class="fe fe-trash"></i> التحويلات
												</a>
												<a href="#" class="btn btn-sm bg-danger-light"><i class="fe fe-trash"></i> المبيعات
												</a>
												<a href="#" class="btn btn-sm bg-danger-light"><i class="fe fe-trash"></i> طباعة
												</a> -->

												<!-- <a href="#">
													<button type="button" class="btn btn-info" data-toggle="tooltip" data-original-title="Hover Triggered">
					                              تحويل
					                            </button>
					                        	</a> -->
					                        	<a href="#">
						                            <div class="badge btn-info label-square">
							                            <!-- <i class="la la-paperclip font-medium-2"></i> -->
							                            <span> تحويل</span>
							                        </div>
						                    	</a>
					                            <!-- <a href="#">
					                            <button type="button" class="btn btn-success" data-toggle="tooltip" data-original-title="Click Triggered" data-trigger="click">
					                              التحويلات
					                            </button>
					                        	</a> -->
					                        	<a href="#">
						                            <div class="badge btn-success label-square">
							                            <!-- <i class="la la-paperclip font-medium-2"></i> -->
							                            <span> التحويلات</span>
							                        </div>
						                    	</a>
					                        	<!-- <a href="#">
					                            <button type="button" class="btn btn-danger manual" data-toggle="tooltip" data-original-title="Manual Triggered" data-trigger="manual">
					                              المبيعات
					                            </button>
					                        	</a> -->
					                        	<a href="#">
						                            <div class="badge btn-danger label-square">
							                            <!-- <i class="la la-paperclip font-medium-2"></i> -->
							                            <span> المبيعات</span>
							                        </div>
						                    	</a>
					                        	<a href="#">
					                            <div class="badge badge-primary label-square">
						                            <!-- <i class="la la-paperclip font-medium-2"></i> -->
						                            <span>طباعة</span>
						                        </div>
						                    	</a>



											</div>
											</td>
										</tr>
									@endforeach
								</tbody>   
                                </table>
                            </div>          
                        </div>
                    </div>
                </div>
              </div>
            </div>
        </div>			
	
	<!-- /Delete Modal -->
</section>



@endsection

								
