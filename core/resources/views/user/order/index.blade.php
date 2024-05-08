@extends('master.front')
@section('title')
    {{__('Orders')}}
@endsection

@section('content')

     <!-- Page Title-->
     <section class="cart-section mt-8 mt-lg-12 mb-60 mb-md-80 mb-lg-140">
      <div class="container">
          <!-- Wish List header/breadcrumb -->
          <div class="container pb-60 pb-lg-100">
              <h2 class="mb-0 text-center fw-bold text-dark heading-h2">{{__('Orders')}}</h2>
              <div class="d-flex align-items-center justify-content-center mt-4">
                  <div>
                      <a href="{{route('front.index')}}" class="fs-16 fw text-dark"> {{__('Home')}} </a>
                  </div>
                  <div class="text-gray-700 ms-2">-</div>
                  <p class="text-gray-700 ms-2 mb-0">{{__('Orders')}}</p>
              </div>
          </div>

          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
            <div class="u-table-res">
              <table class="table table-bordered mb-0">
                <thead>
                  <tr>
                    <th>{{__('Order')}} #</th>
                    <th>{{__('Total')}}</th>
                    <th>{{__('Order Status')}}</th>
                    <th>{{__('Payment Status')}}</th>
                    <th>{{__('Date Purchased')}}</th>
                    <th>{{__('Action')}}</th>
                  </tr>
                </thead>
                <tbody>
                 @foreach ($orders as $order)
                 <tr>
                  <td><a class="navi-link" href="#" data-toggle="modal" data-target="#orderDetails">{{$order->transaction_number}}</a></td>
                  <td>
                    @if ($setting->currency_direction == 1)
                    {{$order->currency_sign}}{{PriceHelper::OrderTotal($order)}}
                    @else
                    {{PriceHelper::OrderTotal($order)}}{{$order->currency_sign}}
                    @endif
    
                  </td>
                  <td>
                    @if($order->order_status == 'Pending')
                    <span class="text-info">{{$order->order_status}}</span>
                    @elseif($order->order_status == 'In Progress')
                    <span class="text-warning">{{$order->order_status}}</span>
                    @elseif($order->order_status == 'Delivered')
                    <span class="text-success">	{{$order->order_status}}</span>
                    @else
                    <span class="text-danger">{{__('Canceled')}}</span>
                    @endif
                  </td>
                  <td>
                    @if($order->payment_status == 'Paid')
                    <span class="text-success">{{$order->payment_status}}</span>
                    @else
                    <span class="text-danger">{{$order->payment_status}}</span>
                    @endif
                  </td>
    
                  <td>{{$order->created_at->format('D/M/Y')}}</td>
                  <td>
                      <a href="{{route('user.order.invoice',$order->id)}}" class="btn btn-info btn-sm">{{__('Details')}}</a>
                  </td>
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
@endsection

