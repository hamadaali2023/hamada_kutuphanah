@extends('layout.web_main')
@section('content')

@php  
    use Stichoza\GoogleTranslate\GoogleTranslate;
    
    if(session()->get('locale')){
        $tr = new GoogleTranslate(session()->get('locale')); 
        $langg=session()->get('locale');
    }else{
        $tr = new GoogleTranslate(app()->getLocale()); 
        $langg=app()->getLocale();
    }

@endphp 
@if($langg == 'ar')
    <style type="text/css">
        .section{
            text-align: right; 
        }     
    </style>
@else
@endif
    <!-- start banner  -->
    <section class="parallax banner">
        <div class="container">
            <div class="row justify-content-center">

                <h3 class="text-white font-weight-600">{{__('home.my profile')}}</h3>

            </div>
        </div>
    </section>
    <!-- end banner -->
    
    <!-- start My Profile -->
    <div class="container">
    <div class="row">
        <div class="form-section form-section-edit col-md-8" style="text-align:right;">
                <h6> {{__('home.send report')}}
                </h6>
            <hr>
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

            <form action="{{route('send_report')}}" method="POST" name="le_form"  enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label> {{__('home.name')}}</label>
                            <input type="text" name="name" class="form-control" value="">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>{{__('home.email')}}</label>
                            <input type="text" name="email" class="form-control" value="">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>{{__('home.phone')}}</label>
                            <input type="text" name="mobile" class="form-control" value="">
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="form-group">
                            <label>{{__('home.report')}}</label>
                            <textarea name="report" rows="4" cols="50"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row mb-3 justify-content-end mr-2">
                    <button type="submit"  class="btn btn-primary btn-block">
                        {{__('home.send report')}}
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!-- end My Profile -->


@endsection