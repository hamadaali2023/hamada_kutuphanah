@extends('layout.front_main')
@section('content') 
    <!-- start banner  -->
    <section class="parallax banner">
        <div class="container">
            <div class="row justify-content-center">

                <h3 class="text-white font-weight-600">My Wishlist</h3>

            </div>
        </div>
    </section>
    <!-- end banner -->


    <!-- start My Wishlist -->


    <section class="bg-light">
        <div class="container">
            <div class="row">

                <aside class="col-12 col-lg-3 float-left">



                    <div class="bg-light p-3 pt-4 mb-3   bg-white text-center">

                        <img src="{{asset('img/profiles/'.$user->photo) }}" class="img-thumbnail profile-img-edit">

                        <p class="text-bold-500 text-dark text-extra-large mt-3">User Name</p>

                    </div>

                    <div class="margin-45px-bottom sm-margin-25px-bottom bg-white p-4">
                        
                        <a class="profile-links" href="{{url('my-wishlist')}}">
                            <i class="fas fa-heart pr-2"></i> My Wishlist
                        </a>

                        <a class="profile-links" href="{{url('my-profile')}}">
                            <i class="fas fa-user pr-2"></i> My Profile
                        </a>

                        <a class="profile-links" href="{{url('become-instructor')}}">
                            <i class="fas fa-chalkboard-teacher pr-2"></i> Become an Instructor
                        </a>

                        <a class="profile-links" href="{{url('bank-details')}}">
                            <i class="fas fa-money-check pr-2"></i> Bank Details
                        </a>
                    </div>



                </aside>


                    <!-- start My Wishlist -->

                <main class="col-12 col-lg-9 left-sidebar bg-white mb-5 pt-5 pb-5">


                    <div class="row">
                        <div class="col-12">
                            <h6 class="#course- text-extra-dark-gray font-weight-600 title-bg">
                                My Wishlist</h6>
        
                        </div>
                    </div>
                    <div class="row featured-courses">
                        <!-- start features box item -->
                        <div class="col-12 col-lg-4 col-md-6">
                            <a href="#">
                                <img src="img/courses/word.jpg" class="img-fluid">
                            </a>
                            <a href="#">
                                <div class="bg-light">
        
                                    <p class="text-dark font-weight-bold mb-2"> Introduction And WORD</p>
        
                                    <div class="featured-date mb-2">
                                        <i class="fas fa-calendar-alt"></i>
                                        <span>30 Jun</span>
                                    </div>
        
        
                                    <div class="featured-date mb-2">
                                        <i class="fas fa-money-bill-alt"></i>
                                        <span>1000 EGP</span>
                                    </div>
        
                                    <div>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                    </div>
        
        
        
                                </div>
                            </a>
                            <div class="row mt-3 justify-content-center text-center">
                                <div class="col-6">
                                    <a href="#" class="btn header-btn">Subscribe</a>
                                </div>
        
                                <div class="col-6">
                                    <a href="#" class="btn header-btn">Remove</a>
                                </div>
                            </div>
                        </div>
                        <!-- end features box item -->
        
                        <!-- start features box item -->
                        <div class="col-12 col-lg-4 col-md-6">
        
                            <a href="#">
                                <img src="img/courses/excel.webp" alt="">
                            </a>
        
                            <a href="#">
        
                                <div class="bg-light">
                                    <p class="text-dark font-weight-bold mb-2"> Excel
                                    </p>
        
                                    <div class="featured-date mb-2">
                                        <i class="fas fa-calendar-alt"></i>
                                        <span>30 Jun</span>
                                    </div>
        
        
                                    <div class="featured-date mb-2">
                                        <i class="fas fa-money-bill-alt"></i>
                                        <span>1000 EGP</span>
                                    </div>
        
                                    <div>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                    </div>
        
        
                                </div>
                            </a>
        
                            <div class="row mt-3 justify-content-center text-center">
                                <div class="col-6">
                                    <a href="#" class="btn header-btn">Subscribe</a>
                                </div>
        
                                <div class="col-6">
                                    <a href="#" class="btn header-btn">Remove</a>
                                </div>
                            </div>
                        </div>
                        <!-- end features box item -->
        
                        <!-- start features box item -->
                        <div class="col-12 col-lg-4 col-md-6">
        
                            <a href="#">
                                <img src="img/courses/PowerPoint.jpg" alt="">
                            </a>
        
                            <a href="#">
        
                                <div class="bg-light">
                                    <p class="text-dark font-weight-bold mb-2"> PowerPoint
                                    </p>
        
                                    <div class="featured-date mb-2">
                                        <i class="fas fa-calendar-alt"></i>
                                        <span>30 Jun</span>
                                    </div>
        
        
                                    <div class="featured-date mb-2">
                                        <i class="fas fa-money-bill-alt"></i>
                                        <span>1000 EGP</span>
                                    </div>
        
                                    <div>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                    </div>
        
        
                                </div>
        
                            </a>
        
        
                            <div class="row mt-3 justify-content-center text-center">
                                <div class="col-6">
                                    <a href="#" class="btn header-btn">Subscribe</a>
                                </div>
        
                                <div class="col-6">
                                    <a href="#" class="btn header-btn">Remove</a>
                                </div>
                            </div>
                        </div>
                        <!-- end features box item -->
        
        
        
                    </div>

                    </main>

                        <!-- end My Wishlist -->



                </div>

                </div>

                </section>


@endsection