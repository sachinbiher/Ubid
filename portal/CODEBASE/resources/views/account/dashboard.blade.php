@extends('layouts.app')

@section('content')

<div class="content-overlay"></div>
<div class="header-navbar-shadow"></div>
<div class="content-wrapper">
    <div class="content-body">
        <!-- Dashboard Ecommerce Starts -->
        <section  class="mt-1">
            <div class="container">
                <div class="row welcome-board">
                    <div class="col-xl-12 col-md-6 col-lg-6">
                        <div class="card ">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-lg-8">
                                        <div class="d-block card-header border-0 text-center p-a0">
                                            <h2 class="text-center my-2">Welcome Back <b>Admin!</b></h2>
                                        </div>
                                        <div class="row text-center">
                                            <div class="col-md-12">
                                                <h6 class="">Greetings from UBID!</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row match-height orders-statitcs">
                    <div class="col-xl-4 col-lg-6 payment-block">
                        <div class="card">
                            <div class="card-body">
                                <img src="app-assets/images/icons/orders_today.png" class="bg-light-danger orders-icon icon">
                                <p class="small-title">Total Bids Placed</p>
                                <h2 class="">{{$total_bids}}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 payment-block">
                        <div class="card">
                            <div class="card-body">
                                <img src="app-assets/images/icons/total_orders.png" class="bg-light-danger orders-icon icon">
                                <p class="small-title">Total Bids Accepted</p>
                                <h2 class="">{{$accepted_bids}}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 payment-block">
                        <div class="card">
                            <div class="card-body">
                                <img src="app-assets/images/icons/Todays_Sales.png" class="bg-light-danger orders-icon icon">
                                <p class="small-title">Total Bids Pending</p>
                                <h2 class="">{{$pending_bids}}</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row match-height orders-statitcs">
                    <div class="col-xl-6 col-lg-6 payment-block">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Total Bids</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Category</th>
                                                <th>Sub Category</th>
                                                <th>Bid Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($total_bids_value as $total_bid)
                                            <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            
                                                            <span>{{$total_bid->category_name}}</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            
                                                            @if(!$total_bid->child_category_name)
                                                            <span>-</span>
                                                            @else
                                                            <span>{{$total_bid->child_category_name}}</span>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td>{{$total_bid->total}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 payment-block">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Total Bids Accepted</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Category</th>
                                                <th>Sub Category</th>
                                                <th>Bid Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($accepted_bids_value as $accepted_bid)
                                            <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            
                                                            <span>{{$accepted_bid->category_name}}</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            @if(!$accepted_bid->child_category_name)
                                                            <span>-</span>
                                                            @else
                                                            <span>{{$accepted_bid->child_category_name}}</span>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td>{{$accepted_bid->total}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Dashboard Ecommerce ends -->
    </div>
</div>
@stop