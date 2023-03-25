 @php  
    
    if(session()->get('locale')){
        $langg=session()->get('locale');
    }else{
        $langg=app()->getLocale();
    }
@endphp 
 <div class="index-footer">  
        <footer class="page-footer">
        <div class="container text-center text-md-center">
            <div class="row">
                <div class="col-md-5 mx-auto text-center">
                    <h5 class="font-weight-bold text-uppercase mt-3 mb-4">
                        {{__('home.about kutuphanah')}}
                    </h5>
                        <h6>
                        {{__('home.app desc')}}
                           
                        </h6><br>  
                       <img src="{{asset('web/asset/logo_band_colored2x.png')}}" height="30px"><br>     
                </div>
                <hr class="clearfix w-100 d-md-none">
                <div class="col-md-3 mx-auto">
                <h5 class="font-weight-bold text-uppercase mt-3 mb-4">
                    {{__('home.menus')}}
                </h5>
                    <ul class="list-unstyled">
                        <li>
                            <a href="{{url('policy')}}" id="privacy" style="color: #212529">
                                {{__('home.privacy policy')}}
                               
                            </a>
                        </li><br>
                        <li>
                            <a href="{{url('return_policy')}}" id="delivry" style="color: #212529">
                                {{__('home.Return delivery policy')}}
                                
                            </a>
                        </li><br>
                        <li>
                            <a href="{{url('reports')}}" id="delivry" style="color: #212529">
                                {{__('home.send report')}}
                                
                            </a>
                        </li>
                    </ul>
                </div>
                <hr class="clearfix w-100 d-md-none">
                <div class="col-md-3 mx-auto">
                    <h5 class="font-weight-bold text-uppercase mt-3 mb-4">
                        {{__('home.connect with us')}}
                        
                    </h5>
                    <ul class="list-unstyled">
                        
                        <li>
                            <a>
                                <i class="fas fa-globe-europe">{{$contact->email}} </i>
                            </a>
                        </li><br>                        
                        <!-- <li>
                            <a>
                                <i class="fa fa-phone">{{$contact->phone}} </i> 
                            </a>
                        </li> -->
                        <li>
                            <a> 
                                
                                <i class="fas fa-city">{{__('home.adress')}}:
                                    @if($langg == 'ar')
                                         {{$contact->address_ar}} 
                                    @else
                                        {{ $contact->address_en }}
                                    @endif
                                    

                                </i> 
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-copyright text-center py-3">© 2020 Copyright:
            <a> كوتبانه</a>
        </div>        
        </footer>
    </div>
   
    <script src="{{asset('web/asset/jquery.js')}}"></script>
    <script src="{{asset('web/asset/bootstrap.js')}}"></script>
    <script src="{{asset('web/asset/bootstrap-datepicker.js')}}"></script>
    <link href="{{asset('web/asset/bootstrap-datepicker.css')}}" rel="stylesheet">
    <script src="{{asset('web/asset/author.js')}}"></script>
    <!-- <script src="{{asset('web/asset/main_002.js')}}"></script> -->
    


