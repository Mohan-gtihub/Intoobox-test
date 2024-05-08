@extends('master.front')
@section('title')
    {{__('Dashboard')}}
@endsection
@section('content')

     <!-- Page Title-->
     <section class="cart-section mt-8 mt-lg-12 mb-60 mb-md-80 mb-lg-140">
        <div class="container">
            <!-- Wish List header/breadcrumb -->
            <div class="container pb-60 pb-lg-100">
                <h2 class="mb-0 text-center fw-bold text-dark heading-h2">{{__('Tickets')}}</h2>
                <div class="d-flex align-items-center justify-content-center mt-4">
                    <div>
                        <a href="{{route('front.index')}}" class="fs-16 fw text-dark"> {{__('Home')}} </a>
                    </div>
                    <div class="text-gray-700 ms-2">-</div>
                    <p class="text-gray-700 ms-2 mb-0">{{__('Tickets')}}</p>
                </div>
            </div>
  
            <div class="row">
              <div class="col-lg-12">
                <div class="mb-3">
                    <div class="card">
                        <div class="card-body d-flex flex-row justify-content-between align-items-center">
                            <h5 class="mb-0">{{ __('All Tickets') }}</h5>
                            <a href="{{ route('user.ticket.create') }}" class="btn btn-danger btn-sm"><span class="text-white">{{__('Add New')}}</span></a>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="u-table-res">
                            <table class="table table-bordered mb-0">
                                <thead>
                                <tr>
                                    <th>{{__('Subject')}} #</th>
                                    <th>{{__('Status')}}</th>
                                    <th>{{__('Last Reply')}}</th>
                                    <th>{{__('Action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse ($tickets as $ticket)
                                <tr>
                                    <td>{{$ticket->subject}}</td>
                                    <td>
                                        <span class="badge badge-primary">{{$ticket->status}}</span>
                                    </td>
                                    @if ($ticket->lastMessage)
                                    <td>{{ \Carbon\Carbon::parse($ticket->lastMessage->created_at)->diffForHumans() }}</td>
                                    @else
                                    <td> {{__('No Reply')}}</td>
                                    @endif
                                    <td>
                                        <a class="btn btn-info btn-sm text-white" href="{{ route('user.ticket.view',$ticket->id) }}">
                                            <i class="fas fa-eye"> </i> {{__('View')}}
                                        </a>
                                        <a class="btn btn-sm btn-danger text-white" href="{{ route('user.ticket.delete',$ticket->id) }}">
                                            <i class="fas fa-trash"> </i> {{__('Delete')}}
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                    <tr class="text-center">
                                        <td colspan="4">{{__('Ticket Not Found')}}</td>
                                    </tr>
                                @endforelse

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
