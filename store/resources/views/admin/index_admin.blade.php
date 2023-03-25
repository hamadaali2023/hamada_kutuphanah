
@extends('layout.admin_main')
@section('content') 		
<div id="crypto-stats-3" class="row">
          <div class="col-xl-4 col-12">
            <div class="card crypto-card-3 pull-up">
              <div class="card-content">
                <div class="card-body pb-0">
                  <div class="row">

                    <div class="col-2"><a href="">
                      <h1 style="color: white; border-radius: 30px;padding: 6px 14px 6px 31px;background-color: #FF9149 !important;
                        }">B</h1></a>
                    </div>
                    <div class="col-5 pl-2">
                        <a href="">
                            <h4>الكورسات</h4>
                            <h6 class="text-muted">عدد الكورسات</h6>
                        </a>
                    </div>
                    <div class="col-5 text-right">
                        <a href="">
                            <h4> </h4>
                        </a>
                      <!--<h6 class="success darken-4">31% <i class="la la-arrow-up"></i></h6>-->
                    </div>
                    
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <canvas id="btc-chartjs" class="height-75"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
        </div>
@endsection
	  