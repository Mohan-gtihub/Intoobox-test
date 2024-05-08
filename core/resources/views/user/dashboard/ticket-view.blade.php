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
                <div class="mb-2">
                    <div class="card">
                        <div class="card-body d-flex flex-row justify-content-between align-items-center">
                            <p class="mb-0"><span class="badge badge-primary">{{$ticket->status}}</span> {{__('Subject :')}} {{$ticket->subject}}</p>
                            <div>
                            <a href="{{ route('user.ticket') }}" class="btn btn-danger btn-sm text-white">{{__('Back')}}</a>
                            @if($ticket->file)
                            <a href="{{asset('assets/files/'.$ticket->file)}}" title="Download" class="btn btn-danger btn-sm text-white"> {{__('Attachment')}}</a>
                            @endif
                        </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        @if($ticket->messages->count() > 0)
                        @foreach ($ticket->messages as $message)
                            @if ($message->user_id == 0)
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="width-100 mr-3" >
                                            {{__('Admin')}}
                                        </div>
                                        <div class="media-body">
                                            <small><span>{{__('Posted on')}} {{ \Carbon\Carbon::parse($message->created_at)->diffForHumans() }}</span></small>
                                          <p>{{$message->message}}</p>
                                        </div>
                                      </div>
                                </div>
                            </div>
                            @else
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="width-100 mr-3" >
                                            {{__('Me')}}
                                        </div>
                                        <div class="media-body">
                                            <small><span>{{__('Posted on')}} {{ \Carbon\Carbon::parse($message->created_at)->diffForHumans() }}</span></small>
                                          <p>{{$message->message}}</p>
                                        </div>
                                      </div>
                                </div>
                            </div>
                            @endif
                        @endforeach
                        @endif
                        @if($ticket->status != 'Closed')
                        <form action="{{route('user.ticket.reply')}}" method="post" enctype="multipart/form-data" class="contact-form">
                            @csrf
                            <input type="hidden" value="{{$ticket->id}}" name="ticket_id">
                            <div class="row">
                                <div class="col-12 form-group">
                                    <label for="inputMessage">{{__('Message')}} *</label>
                                    <textarea name="message" class="form-control" id="inputMessage" placeholder="{{__('Message')}}" rows="6"></textarea>
                                @error('message')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                                </div>
                            </div>
    
                            <div class="d-flex justify-content-between mt-3">
                                <button class="btn btn-danger btn-sm" type="submit"><span class="text-white">{{__('Reply')}}</span></button>
                            </div>
                        </form>
                        @endif
                    </div>
                </div>
              </div>
            </div>
        </div>
     </section>
@endsection
