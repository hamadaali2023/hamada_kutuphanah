@extends('layout.front_main')
@section('content') 
 <!-- start slider section -->
    <article class="slider">
        @foreach ($sliders as $_item)
        <section class="slide">
            <img src="{{asset('img/sliders/'.$_item->image) }}" alt="">

            <div class="slide-content">
                <h2 class="slide-title">{{ $_item->title }}</h2>
                <p>
                    {{ $_item->description }}                   
                    <br>
                    <!-- Lorem Ipsum has been the industry's. -->
                </p>
            </div>

        </section>
        @endforeach
      
        <nav class="slider-nav">
            <span class="prev-slide"></span>
            <span class="next-slide"></span>
        </nav>
    </article>
    <!-- end slider section -->

    <!-- start Recently added courses -->
    <section class="courses-slider">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h6 class="text-extra-dark-gray font-weight-600 title-bg">
                         {{__('front.recently added courses')}}
                    </h6>

                </div>
            </div>


            <div class="row tab-style2 mt-2">
                <div class="col-12 p-0">
                    <!-- start tab navigation -->
                    <ul
                        class="nav nav-tabs  text-uppercase text-small text-center font-weight-600 justify-content-center">
                        @foreach ($categories as $_item)
                        <li class="nav-item">
                            <a class="nav-link " href="#category{{$_item->title}}" data-toggle="tab" id="{{$_item->id}}" id="{{$_item->id}}" onClick="getcourses(this.id)">
                            {{$_item->title}}</a>
                        </li>
                         @endforeach 
                        <!-- <li class="nav-item"><a class="nav-link" href="#tab_sec2" data-toggle="tab">Photography</a></li>
                        <li class="nav-item"><a class="nav-link" href="#tab_sec3" data-toggle="tab">Health & Fitness</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="#tab_sec4" data-toggle="tab">Development</a></li>
                        <li class="nav-item"><a class="nav-link" href="#tab_sec5" data-toggle="tab">Lifestyle</a></li>
                         -->
                    </ul>
                    <!-- end tab navigation -->
                </div>
            </div>

            <div class="row mt-3">

                <div class="tab-content">                    
                    <!-- start tab content -->
                    <div class="tab-pane med-text fade in active show" id="tab_sec1" >
                        <div class="row featured-courses" id="courses">
                            <!-- start features box item -->
                            @foreach ($courses as $_item)
                                <div class="col-12 col-lg-3 col-md-6">
                                    <a href="{{url('courses/'.$_item->slug)}}">
                                        <img src="{{asset('assets_admin/img/courses/'.$_item->image) }}" class="img-fluid">
                                    </a>
                                    <a href="{{url('courses/'.$_item->slug)}}">
                                        <div class="bg-light">
                                            <p class="text-dark font-weight-bold mb-2"> {{$_item->title}}</p>

                                            <div class="featured-date mb-2">
                                                <i class="fas fa-calendar-alt"></i>
                                                <span> {{$_item->date}} </span>
                                            </div>

                                            <div class="featured-date mb-2">
                                                <!-- <i class="fas fa-money-bill-alt"></i> -->
                                                <i class="fas fa-clock"></i>
                                                <span>{{$_item->duration}}  {{__('front.hours')}}</span>
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
                                </div>
                            @endforeach
                            <!-- end features box item -->

                        </div>
                        <!-- <div class="row justify-content-center">
                            <a href="#" class="btn header-btn">View more</a>
                        </div> -->
                    </div><br>
                    <!-- end tab content -->
                    

                    
                </div>

            </div>

        </div>
    </section>
    <!-- End Recently added courses -->
    <section class="courses-slider">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h6 class="text-extra-dark-gray font-weight-600 title-bg">
                         {{__('front.zoom meetings')}}
                    </h6>
                </div>
            </div>
           
            <div class="row mt-3">
                <div class="tab-content">                    
                    <!-- start tab content -->
                    <div class="tab-pane med-text fade in active show" id="tab_sec1" >
                        <div class="row featured-courses" id="courses">
                            <!-- start features box item -->
                            @foreach ($lives as $_item)
                                <div class="col-12 col-lg-3 col-md-6">
                                    <a href="{{url('lives/'.$_item->slug)}}">
                                        <img src="{{asset('assets_admin/img/livecourses/'.$_item->image) }}" class="img-fluid">
                                    </a>
                                    <a href="{{url('lives/'.$_item->slug)}}">
                                        <div class="bg-light">
                                            <p class="text-dark font-weight-bold mb-2"> {{$_item->title}}</p>

                                            <div class="featured-date mb-2">
                                                <i class="fas fa-calendar-alt"></i>
                                                <span> {{$_item->date}}</span>
                                            </div>

                                            <div class="featured-date mb-2">
                                                <i class="fas fa-money-bill-alt"></i>
                                                <span>{{$_item->price}} $</span>
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
                                </div>
                            @endforeach
                            <!-- end features box item -->

                        </div>
                        <!-- <div class="row justify-content-center">
                            <a href="#" class="btn header-btn">View more</a>
                        </div> -->
                    </div><br>
                    <!-- end tab content -->
                    

                    
                </div>

            </div>

        </div>
    </section>

    <!-- start featured-courses -->
    <section class="featured-courses">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h6 class="#course- text-extra-dark-gray font-weight-600 title-bg">
                        {{__('front.featured courses')}}
                    </h6>
                </div>
            </div>
            <div class="row">
                <div class="swiper-slider-clients swiper-container">
                    <div class="swiper-wrapper">
                         @foreach ($courses as $_item)
                        <div class="swiper-slide">
                            <div class="featured-courses">
                                <!-- start features box item -->
                                <a href="{{url('courses/'.$_item->slug)}}">
                                    <img src="{{asset('assets_admin/img/courses/'.$_item->image) }}" class="img-fluid">
                                </a>
                                <a href="{{url('courses/'.$_item->slug)}}">
                                    <div class="bg-light">
                                        <p class="text-dark font-weight-bold mb-2"> {{$_item->title}}</p>
                                        <div class="featured-date mb-2">
                                            <i class="fas fa-calendar-alt"></i>
                                            <span>{{$_item->date}}</span>
                                        </div>
                                        <div class="featured-date mb-2">
                                            <i class="fas fa-money-bill-alt"></i>
                                            <span>{{$_item->duration}} {{__('front.hours')}}</span>
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
                                <!-- end features box item -->


                            </div>
                        </div>
                        @endforeach
                     
                     

                    </div>
                    <div class="swiper-pagination d-none"></div>
                    <div class="swiper-button-next slider-long-arrow-white"></div>
                    <div class="swiper-button-prev slider-long-arrow-white"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- end featured-courses -->



    <!-- start Zoom Meetings -->
    <!-- <section class="featured-courses">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h6 class="#course- text-extra-dark-gray font-weight-600 title-bg">
                        Zoom Meetings</h6>

                </div>
            </div>
            <div class="row">
                <div class=" swiper-slider-clients swiper-container">
                    <div class="swiper-wrapper">

                        <div class="swiper-slide">
                            <div class="featured-courses">
                                <a href="#">
                                    <img src="front/img/courses/word.jpg" class="img-fluid">
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


                            </div>
                        </div>


                        <div class="swiper-slide">
                            <div class="featured-courses">
                                <a href="#">
                                    <img src="front/img/courses/excel.webp" alt="">
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


                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="featured-courses">
                                <a href="#">
                                    <img src="front/img/courses/PowerPoint.jpg" alt="">
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
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="featured-courses">
                                <a href="#">
                                    <img src="front/img/courses/access.png" alt="">
                                </a>

                                <a href="#">

                                    <div class="bg-light">
                                        <p class="text-dark font-weight-bold mb-2"> Access
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
                            </div>
                        </div>


                        <div class="swiper-slide">
                            <div class="featured-courses">
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


                            </div>
                        </div>


                        <div class="swiper-slide">
                            <div class="featured-courses">
                                <a href="#">
                                    <img src="front/img/courses/excel.webp" alt="">
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


                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="featured-courses">
                                <a href="#">
                                    <img src="front/img/courses/PowerPoint.jpg" alt="">
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
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="featured-courses">
                                <a href="#">
                                    <img src="img/courses/access.png" alt="">
                                </a>

                                <a href="#">

                                    <div class="bg-light">
                                        <p class="text-dark font-weight-bold mb-2"> Access
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
                            </div>
                        </div>








                    </div>
                    <div class="swiper-pagination d-none"></div>
                    <div class="swiper-button-next slider-long-arrow-white"></div>
                    <div class="swiper-button-prev slider-long-arrow-white"></div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- end Zoom Meetings -->


    <!-- start Featured Categories -->
    <!-- <section class="featured-courses">`
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h6 class="#course- text-extra-dark-gray font-weight-600 title-bg">
                        Featured Categories


                    </h6>

                </div>
            </div>

            <div class="row">

                <div class="col-12 col-lg-3 col-md-6">
                    <div class="image-container">
                        <a href="#">

                            <div class="image-overlay">
                                <h6>Design</h6>

                            </div>

                            <img src="front/img/categories/design.jpg">
                        </a>
                    </div>
                </div>

                <div class="col-12 col-lg-3 col-md-6">
                    <div class="image-container">
                        <a href="#">

                            <div class="image-overlay">
                                <h6>Photography</h6>

                            </div>

                            <img src="front/img/categories/development.jpg">
                        </a>
                    </div>
                </div>

                <div class="col-12 col-lg-3 col-md-6">
                    <div class="image-container">
                        <a href="#">

                            <div class="image-overlay">
                                <h6>Health & Fitness</h6>

                            </div>

                            <img src="front/img/categories/design.jpg">
                        </a>
                    </div>
                </div>

                <div class="col-12 col-lg-3 col-md-6">
                    <div class="image-container">
                        <a href="#">

                            <div class="image-overlay">
                                <h6>Development</h6>

                            </div>

                            <img src="front/img/categories/development.jpg">
                        </a>
                    </div>
                </div>


                <div class="col-12 col-lg-3 col-md-6">
                    <div class="image-container">
                        <a href="#">

                            <div class="image-overlay">
                                <h6>Marketing</h6>

                            </div>

                            <img src="front/img/categories/development.jpg">
                        </a>
                    </div>
                </div>

                <div class="col-12 col-lg-3 col-md-6">
                    <div class="image-container">
                        <a href="#">

                            <div class="image-overlay">
                                <h6>Business</h6>

                            </div>

                            <img src="front/img/categories/design.jpg">
                        </a>
                    </div>
                </div>


                <div class="col-12 col-lg-3 col-md-6">
                    <div class="image-container">
                        <a href="#">

                            <div class="image-overlay">
                                <h6>Teaching</h6>

                            </div>

                            <img src="front/img/categories/development.jpg">
                        </a>
                    </div>
                </div>

                <div class="col-12 col-lg-3 col-md-6">
                    <div class="image-container">
                        <a href="#">

                            <div class="image-overlay">
                                <h6>Office Productivity</h6>

                            </div>

                            <img src="front/img/categories/design.jpg">
                        </a>
                    </div>
                </div>



            </div>
        </div>


        </div>
    </section> -->
    <!-- end Featured Categories -->



    <!-- start  Trusted by companies -->
    <!-- <section>
        <div class="container text-center">
            <div class="row text-left">
                <div class="col-12 ">

                    <h6 class="#course- text-extra-dark-gray font-weight-600 title-bg">
                        Trusted by companies


                    </h6>

                </div>
            </div>
            <div class="row">
                <div class="swiper-slider-clients swiper-container black-move">
                    <div class="swiper-wrapper">
                        
                        <div class="swiper-slide text-center"><a href="#"><img src="front/img/clients/logo-1.png" alt=""></a>
                        </div>
                       
                        <div class="swiper-slide text-center"><a href="#"><img src="front/img/clients/logo-2.png" alt=""></a>
                        </div>
                     
                        <div class="swiper-slide text-center"><a href="#"><img src="front/img/clients/logo-3.png" alt=""></a>
                        </div>
                        
                        <div class="swiper-slide text-center"><a href="#"><img src="front/img/clients/logo-4.png" alt=""></a>
                        </div>
                       
                        <div class="swiper-slide text-center"><a href="#"><img src="front/img/clients/logo-5.png" alt=""></a>
                        </div>
                        
                        <div class="swiper-slide text-center"><a href="#"><img src="front/img/clients/logo-6.png" alt=""></a>
                        </div>
                        
                        <div class="swiper-slide text-center"><a href="#"><img src="front/img/clients/logo-7.png" alt=""></a>
                        </div>
                        
                        <div class="swiper-slide text-center"><a href="#"><img src="front/img/clients/logo-8.png" alt=""></a>
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- end  Trusted by companies -->
       



        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
         
        <script type="text/javascript">

            function getcourses(categoryId)
            {
                    // alert(categoryId);
                    
                    // var query = $(this).val(); 
                    console.log(categoryId);
                    $.ajax({
                        url:"{{ route('getcoursesbycategory') }}",
                        type:"GET",
                        data:{'categoryId':categoryId},
                        success:function (response) {
                            console.log(response); 
                             console.log('fff');
                                $('#courses').empty();

                            
                            // console.log(response); 
                            if (response.length == 0) {
                                console.log("erfreferfrnono");
                                $('#courses').append(`
                                    <p class="" style="font-size: 15px;">لا يوجد نتائج مطابقة لهذا البحث     </p>
                                `);

                            }else {        
                                console.log("yes");
                            
                                response.forEach(element => {
                                    $('#courses').append(`
                                        <div class="col-12 col-lg-3 col-md-6">
                                            <a href="courses/${element['slug']}">
                                                <img src="assets_admin/img/courses/${element['image']}" class="img-fluid">
                                            </a>
                                            <a href="courses/${element['slug']}">
                                                <div class="bg-light">

                                                    <p class="text-dark font-weight-bold mb-2"> ${element['title']}</p>

                                                    <div class="featured-date mb-2">
                                                        <i class="fas fa-calendar-alt"></i>
                                                        <span>${element['date']}</span>
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
                                        </div>

                                        
                                    `);
                                    
                                });
                            }
                            // $('#searchbooks').html(data);
                        }
                    })
               
                    
            }
           
        </script>
@endsection


<!-- 
console.log(categoryId); 
                    
                    var query = $(this).val(); 
                    console.log("response");
                    $.ajax({
                        url:"{{ route('getcoursesbycategory') }}",
                        type:"GET",
                        data:{'categoryId':categoryId},
                        success:function (response) {
                            console.log(response); 
                            $('#courses').empty(); -->

