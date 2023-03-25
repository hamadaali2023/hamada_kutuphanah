@extends('layout.front_main')
@section('content') 

    <!-- start banner  -->
    <section class="parallax banner">
        <div class="container">
            <div class="row justify-content-center">

                <h3 class="text-white font-weight-600">My Profile</h3>

            </div>
        </div>
    </section>
    <!-- end banner -->


    <!-- start My Profile -->
    <section class="bg-light">
        <div class="container">
            <div class="row">
                <aside class="col-12 col-lg-3 float-left">
                    <div class="bg-light p-3 pt-4 mb-3 bg-white text-center">
                        <img src="{{asset('img/profiles/'.$user->photo) }}" class="img-thumbnail profile-img-edit">
                        <div class="image-upload">
                            <label for="file-input">
                                <i class="fas fa-pen"></i>
                            </label>
                            <input id="file-input" type="file" />
                        </div>
                        <p class="text-bold-500 text-dark text-extra-large mb-3">{{$user->name}}</p>
                        <p class="text-medium2">u{{$user->email}}</p>
                    </div>
                    <div class="margin-45px-bottom sm-margin-25px-bottom bg-white p-4">
                        <!-- <a class="profile-links" href="mycourses.html">
                            <i class="fas fa-video pr-2"></i> My Courses
                        </a> -->

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

                <main class="col-12 col-lg-9 left-sidebar bg-white mb-5">

                    <div class="form-section form-section-edit">

                        <h6>Personal Information
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

                          <form action="{{route('updateprofile')}}" method="POST" 
                                    name="le_form"  enctype="multipart/form-data">
                                    @csrf



                            <div class="row mb-3">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>User Name</label>
                                        <input type="text" name="name" class="form-control" value="{{$user->name}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" disabled class="form-control" value="{{$user->email}}">
                                    </div>
                                </div>                                
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Mobile</label>
                                        <input type="text" name="mobile" class="form-control" value="{{$user->mobile}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>dateOfBirth</label>
                                        <input type="date" name="dateOfBirth" class="form-control" value="{{$user->dateOfBirth}}">
                                        
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" name="address" class="form-control" value="{{$user->address}}">
                                        
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Photo</label>
                                        <input type="file" name="photo" class="form-control" value="{{$user->address}}">
                                        
                                    </div>
                                </div>
                                
                            </div>

                            <!-- <div class="row mb-3">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Country:</label>
                                        <select class="form-control" name="" id="">
                                            <option value="">Cairo</option>
                                            <option value="">United States</option>
                                        </select>
                                    </div>
                                </div>

                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>State:</label>
                                        <select  class="form-control" name="" id="">
                                            <option value="">Cairo</option>
                                            <option value="">United States</option>
                                        </select>
                                    </div>
                                </div>

                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>City:</label>
                                        <select  class="form-control" name="" id="">
                                            <option value="">Cairo</option>
                                            <option value="">United States</option>
                                        </select>
                                    </div>
                                </div>

                               

                            </div> -->

                            <div class="row mb-3">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Author Bio</label>
                                        <textarea rows="5" name="detail" class="form-control">{{$user->detail}}
                                            </textarea>
                                    </div>
                                </div>

                            </div>

                            <div class="row mb-3">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="checkbox" name="" id=""  onclick="showpassword();">
                                        <label class="text-large font-weight-bold">Update Password</label>
                                    </div>
                                </div>

                            </div>

                            <div class="row mb-3" id="HiddenField">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control" value="123">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Confirm Password</label>
                                        <input type="password" class="form-control" value="123">
                                    </div>
                                </div>

                            </div>

                            <div class="row mb-3 justify-content-end mr-2">

                                <button type="submit" class="btn header-btn text-medium font-weight-600">
                                Update Profile    
                                </button>
                            </div>





                        </form>



                    </div>

                </main>

            </div>
        </div>
    </section>
    <!-- end My Profile -->


@endsection