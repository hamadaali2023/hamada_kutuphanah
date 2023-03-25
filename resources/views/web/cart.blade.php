@extends('layout.web_main')
@section('content')
@php  
    use Stichoza\GoogleTranslate\GoogleTranslate;
    
    if(session()->get('locale')){
        $tr = new GoogleTranslate(session()->get('locale')); 
        $locale=session()->get('locale');
    }else{
        $tr = new GoogleTranslate(app()->getLocale()); 
        $locale=app()->getLocale();
    }
@endphp 
    <style type="text/css">
        @if($locale == 'ar')
            .containerwow{
                text-align: right;
            }
        @endif
    </style>

 <?php 
 use App\Cart;
    $instructors=Auth::guard('instructors')->user();
  
     $cartcount=0;
        if($instructors){
            $cont = Cart::where('userId',$instructors->id);
            $cartcount = $cont->count();
        }
        view()->share('cartcount', $cartcount);
        
?>


    <main class="" id="cart">
        <div class="containerwow fadeIn" style="padding-top: 1.5em;">
            <h3 class="my-5 h3 text-center">{{__('home.the pay')}}</h3>
            <div class="row">
                <div class="col-md-8 mb-4">
                    <div class="card">
                        <form id="payment-form" action="process_payment.php" accept-charset="UTF-8" method="POST" class="card-body ">
                            <div id="card-element">
                                <div class="field-row my-4">
                                   <!-- <img src="asset/logo_band_colored2x.png" height="30px"><br> -->
                            </div>
                                <div class="field-row my-4">
                                    <label> {{__('home.name on card')}}</label> <span id="card-holder-name-info" class="info"></span><br>
                                    <input class="form-control" type="text" id="name" name="name" required="">
                                </div>
                                
                                <div class="field-row my-4">
                                    <label>{{__('home.card number')}}</label> <span id="card-number-info" class="info"></span><br>
                                    <input type="text" class="form-control" id="card-number" name="cardnumber" required="">
                                </div>
                                <div class="field-row my-4">
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <div class="contact-row cvv-box">
                                                <label>CVC</label> <span id="cvv-info" class="info"></span><br>
                                                <input class="form-control" type="text" name="source[cvc]" id="cvc" required="">
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label> {{__('home.card expiry date')}}</label>
                                            <input type="text" class="form-control" name="source[month]" id="month" placeholder="MM" required="">
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label> {{__('home.card expiry date')}}</label>
                                            <input type="text" class="form-control" name="source[year]" id="year" placeholder="YY" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="field-row my-4" >
                                    <label>{{__('home.email')}}</label> <span id="email-info" class="info"></span><br>
                                    <input type="email" id="email" class="form-control" name="email" required="">
                                </div>                                                             
                                
                                <hr>
                                <div id="card-errors" role="alert"></div>
                                <div>
                                    <button type="submit" class="btn btn-primary form-control my-4" id="buttontn" disabled="disabled"> {{__('home.emphasis')}} </button>
                                        <div class="modal fade" id="myModal" role="dialog">
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">×</button>
                                                        <h4 class="modal-title">  </h4>
                                                    </div>
                                                    <div class="modal-body">  شكرا لثقتكم </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-success" data-dismiss="modal">  {{__('home.more booke')}}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <div id="loader" class="text-center d-none">
                                        <div class="spinner-border text-primary" role="status">
                                            <span class="sr-only">{{__('home.Loading')}}</span>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="amount" value="0">
                                <input type="hidden" name="callback_url" value="https://www.my-store.com/payments_redirect">
                                <input type="hidden" name="publishable_api_key" value="`your publishable api key here`">
                                <input type="hidden" name="source[type]" value="creditcard">
                                <input type="hidden" name="description" value="Order id 1234 by guest">
                            </div>
                        </form>
                    </div>
                </div>

                <?php 
                    $total = 0;
                    $cart = session()->get('cart');
                    if($cart){
                        $cartcount=count($cart);
                    }
                    
                    // dd($cartcount);
                ?>
                <div class="col-md-4 mb-4" >
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">{{__('home.cart')}}</span>
                        <span class="badge badge-primary badge-pill">{{$cartcount}}</span>
                    </h4>
                    <ul class="list-group mb-3 z-depth-1">
                       



                       <!--  <table id="cart" class="table table-hover table-condensed">
                            <thead>
                            <tr>
                                <th style="width:50%">Product</th>
                               
                                <th style="width:8%">Quantity</th>
                                
                            </tr>
                            </thead>
                            <tbody>
                            <?php $total = 0 ?>
                            @if(session('cart'))
                                @foreach(session('cart') as $id => $details)
                                    <?php $total += $details['price'] * $details['quantity'] ?>
                                    <tr>
                                        
                                        <td data-th="Product">
                                            {{ $details['name'] }} <br><br>
                                         ${{ $details['price'] }}</td>
                                        <td data-th="Quantity">
                                            <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity" />
                                        </td>
                                        <td class="actions" data-th="">
                                            <button class="btn btn-info btn-sm update-cart" data-id="{{ $id }}">
                                            +/-</button>
                                            <button class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $id }}">
                                                <i class="far fa-trash-alt"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                            
                        </table> -->
                        @if(session('cart'))
                            @foreach(session('cart') as $id => $details)
                                <?php $total += $details['price'] * $details['quantity'] ?>
                                <li class="list-group-item d-flex justify-content-between lh-condensed">
                                    <div>
                                        <h6 class="my-0">{{ $details['name'] }}</h6><br>
                                        <h6 class="">السعر : ${{ $details['price'] }}</h6>
                                    </div>
                                    <div class="row">
                                        <span class="delete">
                                            @csrf
                                            <button class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $id }}">
                                                 <i class="far fa-trash-alt"></i>
                                            </button>
                                        
                                    </span>  
                                    </div>
                                </li>
                           @endforeach
                        @endif
                        <li class="list-group-item d-flex justify-content-between">
                            <span>{{__('home.total price')}} (دولار)</span>
                            <p id="total"> ${{ $total }} </p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </main>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        // $(".update-cart").click(function (e) {

        //    e.preventDefault();
        //    var ele = $(this);
        //     alert(ele.parents("tr").find(".quantity").val());
        //     $.ajax({
        //        url: '{{ url('update-cart') }}',
        //        method: "patch",
        //        data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: ele.parents("tr").find(".quantity").val()},
        //        success: function (response) {
        //            window.location.reload();
        //        }
        //     });
        // });
        $(".remove-from-cart").click(function (e) {
           
            e.preventDefault();
            var ele = $(this);
            // alert(ele);
            if(confirm("Are you sure")) {
                $.ajax({
                    url: '{{ url('remove-from-cart') }}',
                    method: "DELETE",
                    data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id")},
                    success: function (response) {
                        window.location.reload();
                    }
                });
            }
        });
    </script>

    
@endsection