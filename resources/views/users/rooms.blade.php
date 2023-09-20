@include('../layouts/header')

   <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <h2>Halls</h2>
                        <div class="bt-option">

                            <span>room & workspace</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach($halls as $hall)
    <section class="rooms-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="room-item">
                        <div class="ri-text">
                            <h4>{{$hall->name}}</h4>
                            <table>
                                <tbody>
                                    <tr>
                                        <td class="r-o">Type:</td>
                                        <td>{{$hall->type}}</td>
                                    </tr>
                                    <tr>
                                        <td class="r-o">Number of seats:</td>
                                        <td>{{ $hall->number_of_seats}}</td>
                                    </tr>
                                    <tr>
                                        <td class="r-o">location:</td>
                                        <td>{{$hall->location}}</td>
                                    </tr>
                                    <tr>
                                        <td class="r-o">days:</td>
                                        <td>{{$hall->days_of_works}}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <form action="{{ route('appointment',$hall->id) }}" method="get">
                                <button type="submit" class="btn btn-info">
                                    <a class="primary-btn">Appointment</a>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>


                @endforeach
                <div class="col-lg-12">
                    {{ $halls->links()}}
                </div>
            </div>
        </div>
    </section>
    <!-- Rooms Section End -->

    <!-- Footer Section Begin -->
    <footer class="footer-section">
        <div class="container">
            <div class="footer-text">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="ft-about">
                            <div class="logo">
                                <a href="#">
                                    <img src="img/footer-logo.png" alt="">
                                </a>
                            </div>
                            <p>We inspire and reach millions of travelers<br /> across 90 local websites</p>
                            <div class="fa-social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-tripadvisor"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                                <a href="#"><i class="fa fa-youtube-play"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 offset-lg-1">
                        <div class="ft-contact">
                            <h6>Contact Us</h6>
                            <ul>
                                <li>(12) 345 67890</li>
                                <li>info.colorlib@gmail.com</li>
                                <li>856 Cordia Extension Apt. 356, Lake, United State</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 offset-lg-1">
                        <div class="ft-newslatter">
                            <h6>New latest</h6>
                            <p>Get the latest updates and offers.</p>
                            <form action="#" class="fn-form">
                                <input type="text" placeholder="Email">
                                <button type="submit"><i class="fa fa-send"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-option">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <ul>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">Terms of use</a></li>
                            <li><a href="#">Privacy</a></li>
                            <li><a href="#">Environmental Policy</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-5">
                        <div class="co-text">
                            <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                Copyright &copy;<script>
                                    document.write(new Date().getFullYear());
                                </script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Search model Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch"><i class="icon_close"></i></div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>
    <!-- Search model end -->

    <!-- Js Plugins -->
    <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('js/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset('js/jquery-ui.min.js')}}"></script>
    <script src="{{asset('js/jquery.slicknav.js')}}"></script>
    <script src="{{asset('js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
</body>

</html>