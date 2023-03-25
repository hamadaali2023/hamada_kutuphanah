@extends('layout.admin_main')
@section('content')	

		<div class="content-header row">
			        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
			          <h3 class="content-header-title mb-0 d-inline-block">الشرائح</h3><br>
			          <div class="row breadcrumbs-top d-inline-block">
			            <div class="breadcrumb-wrapper col-12">
			              <ol class="breadcrumb">
			                <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">الرئيسية</a>
			                </li>
			                
			                <li class="breadcrumb-item active">الشرائح
			                </li>
			              </ol> 
			            </div>
			          </div>
			        </div>
			        <div class="content-header-right col-md-6 col-12">
			          <div class="dropdown float-md-right">
			            
			               <a href="#Add_Specialities_details" data-toggle="modal" class="btn btn-primary float-right mt-2">أضافة اسليد جديد</a>
			            
			          </div>
			        </div>
			        
			         
			        @if(session()->has('message'))
                        @include('admin.includes.alerts.success')
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
                  <h4 class="card-title">إضافة شريحة جديدة</h4>
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
                    <p class="card-text"></p>
                        <table class="table table-striped table-bordered keytable-integration">

		                        <thead>
									<tr>													
													<th>الصورة</th>
													<th>العنوان </th>
													<th>الوصف </th>
													<th class="text-right">أكشن</th>
												</tr>
											</thead>
											<tbody>
												
											@foreach ($sliders as $_item)
												<tr>
													<td>
														<a href="profile" class="avatar avatar-sm mr-2">
															<img class="avatar-img" src="{{asset('img/sliders/'.$_item->image) }}" alt="Speciality">
														</a>
													</td>
													<td>
														{{ $_item->title }}
													</td>
													
													<td>														
														{{ $_item->description }}
														<!-- ddd{{$_item->getTranslation('description','en')}} -->
														
													</td>
													
													
												
													<td class="text-right">
														<div class="actions">
															<a class="btn btn-sm bg-success-light" data-toggle="modal"
															data-title_ar ="{{ $_item->title }}" 
															data-title_en ="{{$_item->getTranslation('title','ar')}}" 
															data-description_ar ="{{ $_item->description }}" 
															data-description_en ="{{$_item->getTranslation('description','ar')}}"
															data-image ="{{ $_item->image }}" 
															data-catid="{{ $_item->id }}" 
															data-target="#edit{{$_item->id}}">
																<i class="fe fe-pencil"></i> تعديل
															</a>
															<a  data-toggle="modal" data-catid="{{ $_item->id }}" data-target="#delete{{$_item->id}}" class="btn btn-sm bg-danger-light">
																<i class="fe fe-trash"></i> Delete
															</a>
														</div>
													</td>
												</tr>
												
			
                                    			<!-- Edit Details Modal -->
                                    			<div class="modal fade" id="edit{{$_item->id}}" aria-hidden="true" role="dialog">
                                    				<div class="modal-dialog modal-dialog-centered" role="document" >
                                    					<div class="modal-content">
                                    						<div class="modal-header">
                                    							<h5 class="modal-title">تعديل المقال</h5>
                                    							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    								<span aria-hidden="true">&times;</span>
                                    							</button>
                                    						</div>
                                    						<div class="modal-body">
                                    
                                    							 <form  method="post" action="{{route('sliders.update','test')}}" enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('put')
                                                                   
                                    								<div class="row form-row">
                                    									<input type="hidden" name="id" value="{{$_item->id}}" >
                                    									<input type="hidden" name="author" value=" {{Auth::user()->name}}" >
                                    									<div class="col-12 col-sm-6">
                                    										<div class="form-group">
                                    											<label>العنوان عربي</label>
                                    											<input type="text" name="title_ar" class="form-control" value="{{$_item->getTranslation('title','ar')}}">
                                    										</div>
                                    									</div>
                                    									<div class="col-12 col-sm-6">
                                    										<div class="form-group">
                                    											<label>العنوان انجليزي</label>
                                    											<input type="text" name="title_en" class="form-control" value="{{$_item->getTranslation('title','en')}}">
                                    										</div>
                                    									</div>
                                    									<div class="col-12 col-sm-6">
                                    										<div class="form-group">
                                    											<label>الوصف عربي</label>
                                    											<input type="text" name="description_ar" class="form-control" value="{{$_item->getTranslation('description','ar')}}">
                                    										</div>
                                    									</div>
                                    									<div class="col-12 col-sm-6">
                                    										<div class="form-group">
                                    											<label>الوصف انجليزي</label>
                                    											<input type="text" name="description_en" class="form-control" value="{{$_item->getTranslation('description','en')}}">
                                    										</div>
                                    									</div>
                                    									<div class="col-12 col-sm-12">
                                    										<div class="form-group">
                                    											<label>الصوره </label>
                                    											<input type="file" name="image" class="form-control" accept=".JPEG,.JPG,.PNG,.GIF,.TIF,.TIFF">
                                    											<input type="hidden" name="url"  class="form-control" id="image">
                                    										</div>
                                    									</div>
                                    									
                                    								</div>
                                    								<button type="submit" class="btn btn-primary btn-block">حفظ التغيير</button>
                                    							</form>
                                    						</div>
                                    					</div>
                                    				</div>
                                    			</div>
                                    			<!-- /Edit Details Modal -->

												<!-- Delete Modal -->
												<div class="modal fade" id="delete{{$_item->id}}" aria-hidden="true" role="dialog">
													<div class="modal-dialog modal-dialog-centered" role="document" >
														<div class="modal-content">
													
															<div class="modal-body">
																<div class="form-content p-2">
																	<h4 class="modal-title">Delete</h4>
																	<p class="mb-4">هل انت متأكد من حذف هذا العنصر</p>
																	<div class="row text-center">
																		<div class="col-sm-3">
																		</div>
																		<div class="col-sm-2">
																			<form method="post" action="{{route('sliders.destroy','test')}}">
										                                   		 @csrf
										                                         @method('delete')
										                                         <input type="hidden" name="id" value="{{ $_item->id }}">
										                                    	<button type="submit" class="btn btn-primary">حذف </button>
										                                    </form>
																		</div>
																		<div class="col-sm-2">
																			<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
																		</div>
																	</div>
																	
																</div>
															</div>
														</div>
													</div>
												</div>
												<!-- /Delete Modal -->

											@endforeach
												
											</tbody>
		                                    
		                                </table>
		                            </div>
                     
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>


          	<!-- Add Modal -->
			<div class="modal fade" id="Add_Specialities_details" aria-hidden="true" role="dialog">
				<div class="modal-dialog modal-dialog-centered" role="document" >
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">أضافة مقال جديد</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form action="{{route('sliders.store')}}" method="POST" 
                                name="le_form"  enctype="multipart/form-data">
                                @csrf
								<div class="row form-row">
									<input type="hidden" name="author" value=" {{Auth::user()->name}}">
									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label>العنوان عربي</label>
											<input type="text" name="title_ar" class="form-control" value="{{old('title_ar')}}">
										</div>
									</div>
									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label>العنوان انجليزي</label>
											<input type="text" name="title_en" class="form-control" value="{{old('title_en')}}">
										</div>
									</div>
									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label>الوصف عربي</label>
											<input type="text" name="description_ar" class="form-control" value="{{old('description_ar')}}">
										</div>
									</div>
									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label>الوصف انجليزي</label>
											<input type="text" name="description_en" class="form-control" value="{{old('description_en')}}">
										</div>
									</div>
									<div class="col-12 col-sm-12">
										<div class="form-group">
											<label>الصوره </label>
											<input type="file" name="image" class="form-control" accept=".JPEG,.JPG,.PNG,.GIF,.TIF,.TIFF">
										</div>
									</div>
									
									
								</div>
								<button type="submit" class="btn btn-primary btn-block">حفظ </button>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- /ADD Modal -->
			
		
        </section>
		

   
	<!--
	$('#delete').on('show.bs.modal', function (event) {

		      var button = $(event.relatedTarget) 

		      var cat_id = button.data('catid') 
		      var modal = $(this)

		      modal.find('.modal-body #cat_id').val(cat_id);
		})


		</script> -->
@endsection