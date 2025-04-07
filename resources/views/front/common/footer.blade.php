<footer class="cater text-light pt-5 mt-5">
  <div class="container px-5">
    <div class="row" style="
    color: #009ee3;
">
      <div class="col-md-4 col-lg-4 col-sm-12">
      <div class="logo">
          <a style="text-decoration: none;" href="{{ route('index') }}"><img class="bawe" style="width: 350px;" src="{{ asset('frontend/images/tripp.png') }}" alt=""></a>
            
          </div>
        <p class="mb-2">Colors Of India Hospitality</p>
        {{-- <p>1234567890</p> --}}
      </div>
      <div class="col-md-4 col-lg-4 col-sm-12">
        <ul class="pt-2" style="list-style: none">
          <h4 class="font-weight-bold" style="font-weight: bold">Contact Us</h4>
          <li class="py-1">
            <strong>Phone:</strong> 9782324798
          </li>
          <li class="py-1">
            <strong>Email:</strong> <a href="mailto:coih.praveensharma@gmail.com" style="
            color: #009ee3;
        " class="text-decoration-none ">coih.praveensharma@gmail.com</a>
          </li>
          <li class="py-1">
            <strong>Address:</strong><br>
            T7, 3rd Floor, Jagdamba Tower,<br>
            Amrapali Circle, Vaishali Nagar,<br>
            Jaipur, Rajasthan 302021
          </li>
        </ul>
      </div>
      
      <div class="col-md-2 col-lg-2 col-sm-12">
        <ul class="pt-2" style="
        list-style: none;">
        <h4 class="font-weight-bold" style="font-weight: bold">Policies</h4>
          <li class="py-1"><a style="
            color: #009ee3;
        " href="{{ route('shipping_policy') }}">Shipping Policy</a></li>
          <li class="py-1"><a style="
            color: #009ee3;
        " href="{{ route('terms_condition') }}">Terms and Conditions</a></li>
        </ul>
      </div>
      <div class="col-md-2 col-lg-2 col-sm-12">
        <ul class="pt-2" style="
        list-style: none;">
        <h4 class="font-weight-bold" style="font-weight: bold">Categories</h4>
          <li class="py-1">Login</li>
          <li class="py-1">Register</li>
          <li class="py-1">Property</li>
          <li class="py-1">Cab</li>
        </ul>
      </div>
      {{-- <div class="col-6 col-lg-3 text-lg-end">
        <h4>Social Media Links</h4>
        <div class="social-media pt-2">
          <a href="#" class="text-light fs-2 me-3"><i class="bi bi-facebook"></i></a>
          <a href="#" class="text-light fs-2 me-3"><i class="bi bi-pinterest"></i></a>
          <a href="#" class="text-light fs-2 me-3"><i class="bi bi-instagram"></i></a>
          <a href="#" class="text-light fs-2"><i class="bi bi-linkedin"></i></a>
        </div>
      </div> --}}
    </div>
    <hr>
    <div class="d-sm-flex justify-content-between py-1">
      <p style="
    color: #009ee3;
">2025 © Trip Dekho. All Rights Reserved. </p>
      <p>
        <a href="#" class=" text-decoration-none pe-4" style="
        color: #009ee3;
    ">Designed and Developed by</a>
        <a href="#" class=" text-decoration-none" style="
    color: #009ee3;
"> <b>Fineoutput Technologies</b></a>
      </p>
    </div>
  </div>
</footer>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tempus-dominus/6.2.10/js/tempus-dominus.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.3/dist/js/splide.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide/dist/js/splide.min.js"></script>
  <script src="{{ asset('frontend/script.js') }}"></script>
  <script src="{{ asset('frontend/hotel.js') }}"></script>
  <script src="{{ asset('frontend/slider.js') }}"></script>
  </body>

</html>
