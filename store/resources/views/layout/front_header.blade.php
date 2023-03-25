
        <!-- start navigation -->
@php  
    if(session()->get('locale')){
        $langg=session()->get('locale');
    }else{
        $langg=app()->getLocale();
    }
@endphp 

@if($langg == 'ar')
    <style type="text/css">
         
    </style>
@else
@endif
       
        <?php 
            $instructors=Auth::guard('instructors')->user();  
        ?>
        @if($instructors)
        <nav class="navbar navbar-default bootsnav navbar-top header-dark background-transparent white-link navbar-expand-lg">
            <div class="container nav-header-container">
                <!-- start logo -->
                <div class="col-auto pl-lg-0">
                    <a href="{{url('/')}}" title="" class="logo">
                        <!-- <h1>Online Courses </h1> -->
                        <img src="{{asset('assets_admin/img/settings/'.$contact->logo) }}" width="175px">
                    </a>
                </div>
                <!-- end logo -->
                <div class="col accordion-menu pr-2 pr-md-3">
                    <button type="button" class="navbar-toggler collapsed" data-toggle="collapse"
                        data-target="#navbar-collapse-toggle-1">
                        <span class="sr-only">toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="navbar-collapse collapse justify-content-start" id="navbar-collapse-toggle-1">

                        <ul id="accordion" class="nav navbar-nav no-margin #course- text-normal">
                            <li class="dropdown simple-dropdown"><a href="#"> {{__('front.categories')}} </a>
                                <i class="fas fa-angle-down dropdown-toggle" data-toggle="dropdown"
                                    aria-hidden="true"></i>
                                <!-- start sub menu -->
                               
                                    <ul class="dropdown-menu" role="menu">
                                         @foreach ($allcategories as $_item)
                                        <li class="dropdown simple-dropdown">
                                            <a class="dropdown-toggle" data-toggle="dropdown" href="{{url('category/'.$_item->id)}}">
                                                {{$_item->title}} 
                                                @if($langg == 'ar')
                                                    <i class="fas fa-angle-left dropdown-toggle" data-toggle="dropdown" aria-hidden="true"></i>
                                                @else
                                                    <i class="fas fa-angle-right dropdown-toggle" data-toggle="dropdown" aria-hidden="true"></i>
                                                @endif        
                                            </a>
                                            @foreach ($_item->subcategorye as $sub)
                                            <ul class="dropdown-menu" role="menu">
                                                <li class="dropdown simple-dropdown">
                                                    <a class="dropdown-toggle" data-toggle="dropdown" href="{{url('subcategory/'.$_item->id)}}">
                                                        {{$sub->title}} 
                                                        @if($langg == 'ar')
                                                            <i class="fas fa-angle-left dropdown-toggle"
                                                            data-toggle="dropdown" aria-hidden="true"></i>
                                                        @else
                                                             <i class="fas fa-angle-right dropdown-toggle"
                                                            data-toggle="dropdown" aria-hidden="true"></i>
                                                        @endif    
                                                    </a>
                                                    @foreach ($_item->childcategory as $child)
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li class="dropdown">
                                                            <a class="dropdown-toggle" data-toggle="dropdown" href="{{url('childcategory/'.$_item->id)}}">
                                                                {{$child->title}}</a>
                                                        </li>
                                                    </ul>
                                                    @endforeach 
                                                </li>
                                            </ul>
                                            @endforeach 
                                        </li>
                                          @endforeach 

                                    </ul>
                            </li>
                            <div class="header-search-div d-lg-none d-md-block d-block">
                                <form method="get" action="{{url('searchcourse')}}"  class="header-search">
                                    <input placeholder="Search for anythinggggg" class="header-search-input">
                                    <button type="submit" class="header-search-submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </form>
                            </div>
                        </ul>

                        <div class="header-search-div">

                            <form method="get" action="{{url('searchcourse')}}" class="header-search">
                                <input placeholder="Search for anything" name="title" class="header-search-input">
                                <button type="submit" class="header-search-submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </form>

                        </div>


                    </div>
                </div>
                <div class="col-auto d-lg-flex pl-0">


                    <a href="{{url('/')}}" class="d-lg-flex d-md-none d-none mr-2 mt-3 main-color text-extra-large">
                        <i class="fas fa-home"></i>
                    </a>  
                     &nbsp;&nbsp;
                    <div class="notification dropdown d-lg-flex d-md-none d-none">
                        <!--<a class="dropdown-toggle mr-4  main-color text-extra-large" id="dropdownMenuButton"-->
                        <!--    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
                        <!--    <i class="far fa-bell"></i>-->
                        <!--    <span class="number">1</span>-->
                        <!--</a>-->
                        <div class="dropdown-menu pb-0" aria-labelledby="dropdownMenuButton">
                            <div class="pt-2 pb-1">
                                <p class="pl-2">Notifications</p>
                                @foreach ($notifications as $_item) 
                                @foreach ($_item->unreadnotifications as $_items) 
                                    <div class="bg-light p-2">
                                        <div class="row">
                                            <div class="col-5">
                                                <img src="{{asset('img/profiles//'.$_item->photo) }}" class="img-fluid">
                                            </div>
                                            <div class="col-7 pl-0">
                                                <p class="text-small">
                                                    {{$_items->data['name']}}
                                                </p>
                                            </div>

                                        </div>
                                    </div>
                                   @endforeach
                                @endforeach
                               
                            </div>
                            <hr>


                            <div class=" bg-light text-center pb-2">
                                <a class="dropdown-item main-color font-weight-600 text-medium" href="#">
                                    Clear all
                                </a>
                            </div>
                        </div>
                    </div>

                
                    <a href="{{url('my-wishlist')}}" class="d-lg-flex d-md-none d-none mr-2 mt-3 main-color text-extra-large"><i
                            class="far fa-heart"></i>
                    </a>


                    <div class="profile-menu mt-1">

                        <div class="dropdown">
                            <button class="btn btn-transparent dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="{{asset('img/profiles/'.$instructors->photo) }}" alt="">
                            </button>
                            <div class="dropdown-menu pb-0" aria-labelledby="dropdownMenuButton">
                                <div class="pl-3 pr-3 pt-2 pb-1">
                                    <img src="{{asset('img/profiles/'.$instructors->photo) }}" class="profile-img">
                                    <span class="text-medium2 pl-2"> {{$instructors->name}}  </span>
                                    <!-- <p class="text-small ml-5 pl-2"> {{$instructors->email}}  </p> -->
                                </div>
                                <hr>
                                @if($instructors->type=="instructor")
                                    <a class="dropdown-item" href="{{url('instructor/dashboard')}}">
                                       <i class="fas fa-user pr-2"></i>  {{__('front.instructor dashboard')}}
                                    </a>
                                @else
                                    <!-- <a class="dropdown-item" href="mycourses.html">
                                        <i class="fas fa-video pr-2"></i> My Courses
                                    </a> -->
                                    <a class="dropdown-item" href="{{url('my-wishlist')}}">
                                        <i class="fas fa-heart pr-2"></i>{{__('front.my wishlist')}}
                                    </a>
                                    <a class="dropdown-item" href="{{url('my-profile')}}">
                                        <i class="fas fa-user pr-2"></i>{{__('front.my profile')}}
                                    </a>
                                @endif

                                <div class=" bg-light text-center mt-2 pt-2 pb-2">
                                    <a class="dropdown-item main-color font-weight-600 text-medium" href="{{ route('signoutinstructors') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="fal fa-sign-out"></i>
                                        
                                            {{__('front.logout')}}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                               

                            </div>
                        </div>

                    </div>
                    <div class="profile-menu mt-1">

                        <div class="dropdown">
                            <button class="btn btn-transparent dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 12px">
                                <!-- <img src="{{asset('img/profiles/'.$instructors->photo) }}" alt=""> -->
                                @switch($langg)
                                    @case('fr')
                                        <img src="{{asset('img/en.png')}}" width="10px" height="10px"> 
                                        {{__('home.en')}} 
                                    @break

                                    @case('ar')
                                        <img src="{{asset('img/ar.png')}}" width="10px" height="10px"> {{__('home.ar')}} 
                                    @break
                                   
                                    @default
                                        <img src="{{asset('img/en.png')}}" width="10px" height="10px"> {{__('home.en')}} 
                                @endswitch
                            </button>
                            <div class="dropdown-menu pb-0" aria-labelledby="dropdownMenuButton">
                                    <!-- <a class="dropdown-item" href="{{url('my-wishlist')}}">
                                        <i class="fas fa-heart pr-2"></i> My Wishlist
                                    </a> -->
                                    <a class="dropdown-item" href="{{url('lang/en')}}">
                                        <img src="{{asset('img/en.png')}}" width="10px" height="10px"> - {{__('home.en')}}
                                    </a>
                                    <a class="dropdown-item" href="{{url('lang/ar')}}">
                                        <img src="{{asset('img/ar.png')}}" width="10px" height="10x"> - {{__('home.ar')}} 
                                    </a>
                            </div>
                        </div>

                    </div>


                </div>
            </div>
        </nav>
        @else        
            <nav class="navbar navbar-default bootsnav navbar-top header-dark background-transparent white-link navbar-expand-lg">
                <div class="container nav-header-container">
                    <!-- start logo -->
                    <div class="col-auto pl-lg-0">
                        <a href="index.html" title="" class="logo">
                           <!--  <h1>Online Courses</h1> -->
                           <img src="{{asset('assets_admin/img/settings/'.$contact->logo) }}" width="175px">
                        </a>
                    </div>
                    <!-- end logo -->
                    <div class="col accordion-menu pr-2 pr-md-3">
                        <button type="button" class="navbar-toggler collapsed" data-toggle="collapse"
                            data-target="#navbar-collapse-toggle-1">
                            <span class="sr-only">toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <div class="navbar-collapse collapse justify-content-start" id="navbar-collapse-toggle-1">
                            <ul id="accordion" class="nav navbar-nav no-margin #course- text-normal">
                                <li class="dropdown simple-dropdown"><a href="#">{{__('front.categories')}} </a>
                                    <i class="fas fa-angle-down dropdown-toggle" data-toggle="dropdown"
                                        aria-hidden="true"></i>
                                    <!-- start sub menu -->
                                    <ul class="dropdown-menu" role="menu">
                                        @foreach ($allcategories as $_item)
                                            <li class="dropdown simple-dropdown">
                                                <a class="dropdown-toggle" data-toggle="dropdown" href="{{url('courses/'.$_item->slug)}}">
                                                    {{$_item->title}} 
                                                    @if($langg == 'ar')
                                                        <i class="fas fa-angle-left dropdown-toggle" data-toggle="dropdown" aria-hidden="true"></i>
                                                    @else
                                                        <i class="fas fa-angle-right dropdown-toggle" data-toggle="dropdown" aria-hidden="true"></i>
                                                    @endif      
                                                </a>
                                                @foreach ($_item->subcategorye as $sub)
                                                <ul class="dropdown-menu" role="menu">
                                                    <li class="dropdown simple-dropdown">
                                                        <a class="dropdown-toggle" data-toggle="dropdown" href="{{url('courses/'.$_item->slug)}}">
                                                            {{$sub->title}} 
                                                            @if($langg == 'ar')
                                                                <i class="fas fa-angle-left dropdown-toggle" data-toggle="dropdown" aria-hidden="true"></i>
                                                            @else
                                                                 <i class="fas fa-angle-right dropdown-toggle" data-toggle="dropdown" aria-hidden="true"></i>
                                                            @endif  
                                                        </a>
                                                        @foreach ($_item->childcategory as $child)
                                                        <ul class="dropdown-menu" role="menu">
                                                            <li class="dropdown">
                                                                <a class="dropdown-toggle" data-toggle="dropdown" href="{{url('courses/'.$_item->slug)}}">
                                                                    {{$child->title}}</a>
                                                            </li>
                                                        </ul>
                                                        @endforeach 
                                                    </li>
                                                </ul>
                                                @endforeach 
                                            </li>
                                        @endforeach 

                                        </ul>
                                </li>

                                <li class="d-lg-none d-md-block d-block">
                                    <a href="{{url('create/acount')}}"> <i class="fas fa-user pr-1 pt-2"></i>  {{__('front.sign up')}}</a>
                                </li>

                                <li class="d-lg-none d-md-block d-block">
                                    <a href="{{url('login/user')}}"> <i class="fas fa-sign-in-alt pr-1 pt-2"></i> {{__('front.log in')}}</a>
                                </li>

                                <div class="header-search-div d-lg-none d-md-block d-block">
                                    <form method="get" action="{{url('searchcourse')}}" class="header-search">
                                        <input placeholder="Search for anything" class="header-search-input">
                                        <button type="submit" class="header-search-submit">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </form>
                                </div>
                                <!-- <a href="#" class="btn header-btn  d-lg-none d-md-block d-block">Subscribe</a> -->

                            </ul>

                            <div class="header-search-div">

                                <form method="get" action="{{url('searchcourse')}}" class="header-search">
                                    <input placeholder="Search for anything" class="header-search-input">
                                    <button type="submit" class="header-search-submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </form>

                            </div>


                        </div>
                    </div>
                    <div class="col-auto pr-lg-0 d-lg-flex d-md-none d-none">

                        <a href="{{url('create/acount')}}" class="btn header-btn2 mr-2"> {{__('front.sign up')}}</a>

                        <a href="{{url('login/user')}}" class="btn header-btn2 mr-2">{{__('front.log in')}}</a>
                        <div class="profile-menu mt-1">

                            <div class="dropdown">
                                <button class="btn btn-transparent dropdown-toggle" type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 12px">
                                    @switch($langg)
                                        @case('fr')
                                            <img src="{{asset('img/en.png')}}" width="10px" height="10px"> 
                                            {{__('home.en')}} 
                                        @break

                                        @case('ar')
                                            <img src="{{asset('img/ar.png')}}" width="10px" height="10px"> {{__('home.ar')}} 
                                        @break
                                       
                                        @default
                                            <img src="{{asset('img/en.png')}}" width="10px" height="10px"> {{__('home.en')}} 
                                    @endswitch
                                </button>
                                <div class="dropdown-menu pb-0" aria-labelledby="dropdownMenuButton">
                                        <!-- <a class="dropdown-item" href="{{url('my-wishlist')}}">
                                            <i class="fas fa-heart pr-2"></i> My Wishlist
                                        </a> -->
                                        <a class="dropdown-item" href="{{url('lang/en')}}">
                                            <img src="{{asset('img/en.png')}}" width="10px" height="10px"> - {{__('home.en')}}
                                        </a>
                                        <a class="dropdown-item" href="{{url('lang/ar')}}">
                                            <img src="{{asset('img/ar.png')}}" width="10px" height="10x"> - {{__('home.ar')}} 
                                        </a>
                                </div>
                            </div>

                        </div>


                        <!-- <a href="#" class="btn header-btn">Subscribe</a> -->


                    </div>
                </div>
            </nav>
        @endif
        
        <!-- end navigation -->
    