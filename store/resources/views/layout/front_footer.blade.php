 <!-- start footer -->

    <footer class="footer-classic-dark bg-white pb-3 pt-3 mt-5">


        <div class="footer-widget-area">
            <div class="container">
                <div class="row">
                    <!-- start about -->
                    <div class="col-lg-3 col-md-6 widget">
                        <a href="index.html" title="" class="logo">
                            <h1>Online Courses</h1>
                        </a>
                        <p>Lorem Ipsum is simply dummy text of the printing and
                            typesetting industry.</p>
                    </div>
                    <!-- end about -->
                   
                    <div class="col-lg-5 offset-lg-1 col-md-6 widget">
                        <div class="widget-title">
                            {{__('front.quick links')}}</div>

                        <div class="row">

                            <div class="col-6">

                                <a href="{{url('about')}}" class="d-block mt-3">{{__('front.about us')}}</a>

                                <a href="{{url('contact')}}" class="d-block mt-3">{{__('front.contact us')}}</a>
                            </div>

                            <div class="col-6">

                                <a href="{{url('terms/conditions')}}" class="d-block mt-3">{{__('front.terms of User')}}</a>

                                <a href="{{url('policy')}}" class="d-block mt-3">{{__('front.privacy policy')}}</a>
                            </div>

                        </div>



                    </div>
                   

                    <div class="col-lg-3 col-md-6 widget mt-5">


                        <!-- Default dropup button -->
                        <div class="btn-group dropup">
                            <button type="button" class="btn header-btn dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                {{__('front.language')}}
                            </button>
                            <div class="dropdown-menu p-2">
                                <!-- Dropdown menu links -->

                                <p> <a href="{{url('lang/ar')}}" class="text-dark">{{__('home.ar')}} </a></p>
                                <p><a href="{{url('lang/en')}}" class="text-dark">{{__('home.en')}}</a></p>
                               

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </footer>
    <a class="scroll-top-arrow" href="javascript:void(0);"><i class="fas fa-arrow-up"></i></a>
    <!-- javascript libraries -->
    <script type="text/javascript" src="{{asset('front/js/jquery.js')}}"></script>
    <script type="text/javascript" src="{{asset('front/js/bootstrap.bundle.js')}}"></script>
    <!-- menu navigation -->
    <script type="text/javascript" src="{{asset('front/js/bootsnav.js')}}"></script>
    <script type="text/javascript" src="{{asset('front/js/jquery.nav.js')}}"></script>
    <!-- magnific-popup -->
    <script src="{{asset('front/js/jquery.magnific-popup.min.js')}}"></script>
    <!-- swiper carousel -->
    <script type="text/javascript" src="{{asset('front/js/swiper.min.js')}}"></script>
    <!-- main slider -->
    <script src="{{asset('front/js/slider.js')}}"></script>

    <!-- Data table -->
     <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
     <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.bootstrap4.min.css">
    <!-- setting -->
    







     <!-- Data Tables -->
     <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
     <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
     <script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>
     <script src="https://cdn.datatables.net/responsive/2.2.7/js/responsive.bootstrap4.min.js"></script>
 

<script type="text/javascript" src="{{asset('front/js/main.js')}}"></script>








