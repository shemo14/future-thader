<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Orders;

class OrdersController extends Controller
{
    public function index(Request $request){
        $orders = Orders::take(20)->get();

        dd($orders);
    }
}
