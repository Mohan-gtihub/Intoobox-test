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
            <div class="padding-top-2x mt-2 hidden-lg-up"></div>
            <div class="mb-3">
                <div class="card">
                    <div class="card-body d-flex flex-row justify-content-between align-items-center">
                        <h5 class="mb-0">{{ __('New Ticket') }}</h5>
                        <a href="{{ route('user.ticket') }}" class="btn btn-danger btn-sm m-0"><span class="text-white">{{__('Back')}}</span></a>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="{{route('user.ticket.store')}}" method="post" enctype="multipart/form-data" class="contact-form">
                        @csrf
                        <div class="row">
                            <div class="form-group col-lg-12">
                                <label for="website">{{__('Subject')}} *</label>
                                <input type="text" class="form-control rounded-0" id="subject" name="subject" value="{{old('subject')}}" placeholder="{{__('Subject')}}">
                                @error('subject')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>

                            <div class="col-12 form-group">
                                <label for="inputMessage">{{__('Message')}} *</label>
                                <textarea name="message" class="form-control" rows="6"></textarea>
                                @error('message')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="row justify-content-between">
                            <div class="col-md-12">
                                <label for="inputAttachments" class="font-weight-bold">{{__('Attachment')}}</label>
                                <div class="form-group custom-file">
                                    <input type="file" name="file" id="customFile" class="custom-file-input">
                                   @error('file')
                                   <p class="text-danger">{{$message}}</p>
                                   @enderror

                                </div>
                                <div id="fileUploadsContainer"></div>
                                <p class="my-2 ticket-attachments-message text-muted">
                                    {{__('Allowed File Extension: .zip')}}</p>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-3">
                            <button class="btn btn-danger btn-sm text-white" type="submit"><span class="text-white">{{__('Submit')}}</span></button>
                        </div>
                    </form>
                </div>
            </div>

          </div>
        </div>
        </div>
     </section>
@endsection
