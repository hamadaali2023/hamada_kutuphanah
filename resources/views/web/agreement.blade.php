@extends('layout.web_main')
@section('content')
  

@php  
    
    if(session()->get('locale')){
        $langg=session()->get('locale');
    }else{
        $langg=app()->getLocale();
    }
@endphp 

@if($langg == 'ar')
    <style type="text/css">
        #privacy, #about{
            text-align: right; 
        }     
    </style>
@else
@endif
    <section id="privacy" class="" >        
        <!--<div class=" text-center">-->
        <!--    <h3>منصة كوتبانه لبيع الكتب العربية الرقمية حول العالم</h3>-->
        <!--      دليل المؤلف :  تعليمات انشاء حساب ونشر الكتب-->
        <!--</div>-->
        <div class="container">
        @if($langg == 'ar')
              {!! $contact->agreements_ar !!}
        @else
            {!! $contact->agreements_en !!}
        @endif
        </div>

    </section>
@endsection