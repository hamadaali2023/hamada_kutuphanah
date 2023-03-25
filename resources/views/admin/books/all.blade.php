
@extends('layout.admin_main')
@section('content')	

@toastr_css

<div class="content-header row">
	<div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
        <h3 class="content-header-title mb-0 d-inline-block">الكتب</h3><br>
		<div class="row breadcrumbs-top d-inline-block">
			<div class="breadcrumb-wrapper col-12">
		        <ol class="breadcrumb">
		            <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">الرئيسية</a></li>
		            <li class="breadcrumb-item active"> الكتب </li>
			    </ol> 
			</div>
	    </div>
    </div>
	<!--<div class="content-header-right col-md-6 col-12">-->
 <!--       <div class="dropdown float-md-right">-->
 <!--           <a href="{{route('stories.create')}}"  class="btn btn-primary float-right mt-2"> قائمة الكتب</a>-->
 <!--       </div>-->
 <!--   </div>-->
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
                    <h4 class="card-title">قائمة جميع الكتب</h4>
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
                                            <th class="text-center"> صورة الكتاب </th>
                                            <th class="text-center"> عنوان الكتاب </th>
                                            <th class="text-center"> السعر </th>
                                            <th class="text-center"> تاريخ الإصدار </th>
                                            <th class="text-center">العمليات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($books as $_item)
                                            <tr>             
                                                <td class="text-center">
                                                    <img class="gallery-thumbnail card-img-top" src="{{asset('img/books/'.$_item->photo)}}"
                                                    width="50px" height="50px">
                                                </td>
                                                <td class="text-center">
                                                    {{ $_item->name }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $_item->price }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $_item->date }}
                                                </td>
                                                
                                                <td class="text-center">
                                                    <div class="actions">  
                                                     <a class="btn btn-sm bg-success-light" href="{{url('admin/book',$_item->id)}}"><i class="fe fe-pencil"></i> عرض الكتاب </a>
                                                    <!--<a  data-toggle="modal" data-catid="{{ $_item->id }}" data-target="#delete" class="btn btn-sm bg-danger-light">-->
                                                    <!--    <i class="fe fe-trash"></i> حذف-->
                                                    <!--</a>-->
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
	<!-- Delete Modal -->
	<div class="modal fade" id="delete" aria-hidden="true" role="dialog">
				<div class="modal-dialog modal-dialog-centered" role="document" >
					<div class="modal-content">
					<!--	<div class="modal-header">
							<h5 class="modal-title">Delete</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>-->
						<div class="modal-body">
							<div class="form-content p-2">
								<h4 class="modal-title">حذف</h4>
								<p class="mb-4">هل انت متأكد من حذف هذا العنصر ؟</p>
								<div class="row text-center">
									<div class="col-sm-3">
									</div>
									<div class="col-sm-2">
										<form method="post" action="{{route('stories.destroy','test')}}">
	                                   		 @csrf
	                                         @method('delete')
	                                         <input type="hidden" name="id" id="cat_id" >
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
</section>


<script>
	$('#delete').on('show.bs.modal', function (event) {
      	var button = $(event.relatedTarget) 
	   	var cat_id = button.data('catid') 
     	var modal = $(this)
    	modal.find('.modal-body #cat_id').val(cat_id);
	});
</script>

@endsection

								
