@extends('layouts.master_layout.master_layout')
@section('title', 'Order')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Order</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ Auth::user()->role == 'admin' ? route('home.admin') : route('home')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Order</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title titleclass">Order History</h3>
                            </div>
                                <div>
                                    @if($orders->count() > 0)
                                    <div class="card-body">
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Customer Name</th>
                                                    <th>Contact</th>
                                                    <th>Address</th>
                                                    <th>Date</th>
                                                    <th>View</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($orders as $order)
                                                    <tr>
                                                        <td>{{$order->id}}</td>
                                                        <td>{{$order->customer_name}}</td>
                                                        <td>{{$order->contact}}</td>
                                                        <td>{{$order->address}}</td>
                                                        <td>{{$order->created_at->format('Y-m-d')}}</td>
                                                        <td><a title="Download PDF" href="{{route('orders.pdf',$order->id)}}" target="__blank"><i class="fas fa-download"></i></a></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @else
                                    <div class="card-body">
                                      <div class="alert alert-info">
                                        No records found.
                                      </div>
                                    </div>
                                    @endif
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection
