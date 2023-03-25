<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Setting;
use Illuminate\Http\Request;
use App\Instructor;
use App\Wallet;
use App\Transaction;
class ReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function reports()
    {
        $users = Instructor::get();
        foreach($users as $_item)
        {
            $total_balance=Wallet::where('instructorId',$_item->id)->first();
            $_item->total_balance=$total_balance->total;

            $total_received=Transaction::where('walletId',$total_balance->id)->where('type','received')->sum('value');
            if($total_received){
                $_item->total_received=$total_received;
            }else{
                $_item->total_received=0;
            }
            $total_sales=Transaction::where('walletId',$total_balance->id)->where('type','payed')->sum('value');
            if($total_sales){
                $_item->total_sales=$total_sales;
            }else{
                $_item->total_sales=0;
            }
            

        }

        return view('admin.reports.all',compact('users'));
    }
    
    public function create()
    {
        //
    }
    
    public function store(Request $request)
    {
        //
    }

    
    public function show(Setting $setting)
    {
        //
    }

    
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
