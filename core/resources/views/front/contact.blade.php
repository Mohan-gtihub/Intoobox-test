@extends('master.front')
@section('meta')
<meta name="keywords" content="{{$setting->meta_keywords}}">
<meta name="description" content="{{$setting->meta_description}}">
@endsection
@section('title')
    {{__('Contact')}}
@endsection
@section('styleplugins')
<link rel="stylesheet" href="{{asset('assets/frontend/css/plugins/leaflet.css')}}" />
@endsection

@section('content')
    <!-- Page Title-->
  <div class="container">
    <!-- contact us header/breadcrumb -->
    <div class="pt-12 pt-lg-8 pb-12 pb-lg-80">
      <h2 class="mb-0 text-center fw-bold text-dark heading-h2">Contact Us </h2>
      <div class="d-flex align-items-center justify-content-center mt-4">
        <div>
          <a href="#" class="fs-16 fw text-dark">Home </a>
        </div>
        <div class="text-gray-700 ms-2">-</div>
        <p class="text-gray-700 ms-2 mb-0">Contact Us</p>
      </div>
    </div>
    <!-- contact us header/breadcrumb -->

    <!-- contact us container -->
    <div class="row align-items-start">
      <div class="col-md-6 col-lg-3 d-flex align-items-center justify-content-center flex-column">
        <div>
          <img src="{{asset('assets/frontend/images/phone.png')}}" alt="" class="img-fluid" />
        </div>
        <h4 class="heading-h4 fw-bold mb-0 mt-4">Phone</h4>
        <div class="mb-0 mt-4">
          <a href="tel:0891 2507678" class="text-muted"> {{$setting->footer_phone}} </a>
        </div>
      </div>
      <div
        class="col-md-6 col-lg-3 mt-10 mt-md-0 d-flex align-items-center justify-content-center flex-column"
      >
        <div>
          <img src="{{asset('assets/frontend/images/marker-contact.png')}}" alt="" class="img-fluid">
        </div>
        <h4 class="heading-h4 fw-bold mb-0 mt-4">Address</h4>
        <div class="mb-0 mt-4">
          <p class="text-muted mb-0 text-center">{{$setting->footer_address}}</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3 mt-10 mt-lg-0 d-flex align-items-center justify-content-center flex-column">
        <div>
          <img src="{{asset('assets/frontend/images/clock-contact.png')}}" alt="" class="img-fluid" />
        </div>
        <h4 class="heading-h4 fw-bold mb-0 mt-4">Open time</h4>
        <div class="mb-0 mt-4">
          <p class="text-muted mb-0">10:00 am to 09:00 pm</p>
        </div>
      </div>
      <div
        class="col-md-6 col-lg-3 mt-10 mt-lg-0 d-flex align-items-center justify-content-center flex-column"
      >
        <div>
          <img src="{{asset('assets/frontend/images/email-contact.png')}}" alt="" class="img-fluid"/>
        </div>
        <h4 class="heading-h4 fw-bold mb-0 mt-4">Email</h4>
        <div class="mb-0 mt-4">
          <a href="mailto:info@intoobox.com" class="text-muted">
            info@intoobox.com
          </a>
        </div>
      </div>
    </div>
    <!-- contact us container -->
  </div>

  <!-- adress popup section -->
  <section class="bg-gray-100 py-12 mt-60 mt-lg-80 py-lg-60">
    <div class="container">
      <div id="contactMap" style="height: 400px"></div>
    </div>
  </section>
  <!-- adress popup section -->

  <!-- contact us from -->
  <section class="contact-us-section my-60 my-lg-80">
    <div class="container">
      <h2 class="heading-h2 mb-0 text-center">Leave Message</h2>

      <form  method="Post" action="{{route('front.contact.submit')}}" class="mt-8 mt-lg-12">
        @csrf
        <div class="row justify-content-md-center">
          <div class="col-md-6 mb-6">
            <input class="form-control border rounded-0 border-1" type="text" id="f_name" name="first_name" placeholder="First name">
            @error('first_name')
            <p class="text-danger">{{$message}}</p>
          @enderror
          </div>
          <div class="col-md-6 mb-6">
            <input class="form-control border rounded-0 border-1" type="text" id="last_name" name="last_name" placeholder="Last name">
            @error('last_name')
            <p class="text-danger">{{$message}}</p>
          @enderror
          </div>
          <div class="col-md-6 mb-6">
            <input class="form-control border rounded-0 border-1" type="email" id="email" name="email" placeholder="Your Email">
            @error('email')
            <p class="text-danger">{{$message}}</p>
          @enderror
          </div>
          <div class="col-md-6 mb-6">
            <input class="form-control border rounded-0 border-1" type="phone" id="phone" name="phone" placeholder="Your Phone">
            @error('phone')
              <p class="text-danger">{{$message}}</p>
            @enderror
          </div>
          <div class="col-md-12 mb-6">
            <textarea class="form-control contact-message-area" name="message" id="message" placeholder="Your message"></textarea>
            @error('message')
              <p class="text-danger">{{$message}}</p>
            @enderror
          </div>
          @if ($setting->recaptcha == 1)
                <div class="col-lg-12 mb-4">
                    {!! NoCaptcha::renderJs() !!}
                    {!! NoCaptcha::display() !!}
                    @if ($errors->has('g-recaptcha-response'))
                    @php
                        $errmsg = $errors->first('g-recaptcha-response');
                    @endphp
                    <p class="text-danger mb-0">{{__("$errmsg")}}</p>
                    @endif
                </div>
          @endif
          <div class="mt-6 mt-lg-9 col-12 col-md-4 col-lg-3 d-md-flex justify-content-lg-center">
            <button class="btn btn-danger text-white btn-block w-100 py-4 shadow-0 outline-0 rounded-0 text-uppercase">Send Message</button>
          </div>
        </div>
      </form>
    </div>
  </section>
  <!-- our team section -->

  <!-- delivery process section starts here -->
  <section class="delivery-section bg-gray-100 py-10 py-lg-13">
    <div class="container">
        <div class="w-100 w-lg-90 w-5xl-100 mx-auto">
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="d-flex justify-content-lg-center align-items-center">
                        <div>
                            <img src="{{ asset('assets/images/cart-icon.svg') }}" alt="hand icons" class="img-fluid no-download" width="35" />
                        </div>
                        <div class="ms-5">
                            <h5 class="text-dark heading-h6 fw-bold mb-1">
                                Low Minimums
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="d-flex justify-content-lg-center align-items-center">
                        <div>
                            <img src="{{ asset('assets/images/liquidity-icon.svg') }}" alt="hand icons" class="img-fluid no-download"  width="35" />
                        </div>
                        <div class="ms-5">
                            <h5 class="text-dark heading-h6 fw-bold mb-1">
                                Sustainable Solutions
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 ">
                    <div class="d-flex justify-content-lg-center align-items-center">
                        <div>
                            <img src="{{ asset('assets/frontend/images/payment.png') }}" alt="hand icons" class="img-fluid no-download" />
                        </div>
                        <div class="ms-5">
                            <h5 class="text-dark heading-h6 fw-bold mb-1">
                                Secure Payment
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="d-flex justify-content-lg-center align-items-center">
                        <div>
                            <img src="{{ asset('assets/frontend/images/support.png') }}" alt="hand icons" class="img-fluid no-download" />
                        </div>
                        <div class="ms-5">
                            <h5 class="text-dark heading-h6 fw-bold mb-1">
                                24/7 Support
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
  <!--  delivery process section ends here -->
@endsection
@section('script')
<script src="{{asset('assets/frontend/js/plugins/leaflet.js')}}"></script>
<script>
    
// leaflet map settings
document.addEventListener("DOMContentLoaded", function () {
  // making cutom icon
  var greenIcon = L.icon({
    iconUrl: "assets/frontend/images/contact-marker.png",
    shadowUrl: "assets/frontend/images/maker-shadow",

    iconSize: [34, 50], // size of the icon
    shadowSize: [50, 16], // size of the shadow
    iconAnchor: [17.72775328710475, 83.30915399818795], // point of the icon which will correspond to marker's location
    shadowAnchor: [51.1, -0.1], // the same for the shadow
    popupAnchor: [17.72775328710475, 83.30915399818795], // point from which the popup should open relative to the iconAnchor
  });
  // Initialize the map
  var map = L.map("contactMap").setView([17.72775328710475, 83.30915399818795], 13);

  // Add a tile layer (you can replace this with your desired tile layer)
  L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    attribution: "© OpenStreetMap contributors",
  }).addTo(map);

  L.marker([17.72775328710475, 83.30915399818795], { icon: greenIcon }).addTo(map);

  // Add a marker with a popup
  var popup = L.popup([17.72775328710475, 83.30915399818795], {
    content:
      "<h5 class='heading-h5 fw-bold mb-0 text-center'>In Too Box</h5><p class='text-muted mb-0 mt-1 text-center'>Phone: 0891 - 2507678 <br/> D. No. 48-7-55/1, Srinagar, VIZAG - 530 016.</p>",
  }).openOn(map);
});
</script>
@endsection