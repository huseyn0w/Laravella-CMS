<?php
/**
 * Laravella CMS
 * File: footer.blade.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 19.07.2019
 */

$site_options = get_site_options();

$copyright = $site_options->copyright;
$linkedin_url = $site_options->linkedin_url;
$github_url = $site_options->github_url;

?>
<!-- start footer Area -->
<footer class="footer-area section-gap">
    <div class="container">
        <div class="row footer-bottom d-flex justify-content-between">
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            <p class="col-lg-8 col-sm-12 footer-text">{!! $copyright !!}</p>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            <div class="col-lg-4 col-sm-12 footer-social">
                <a href="{{$linkedin_url}}"><i class="fa fa-linkedin"></i></a>
                <a href="{{$github_url}}"><i class="fa fa-github"></i></a>
            </div>
        </div>
    </div>
</footer>
<!-- End footer Area -->

<script src="{{asset('front/'.env('TEMPLATE_NAME').'/js/vendor/jquery-2.2.4.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="{{asset('front/'.env('TEMPLATE_NAME').'/js/vendor/bootstrap.min.js')}}"></script>
<script src="{{asset('front/'.env('TEMPLATE_NAME').'/js/parallax.min.js')}}"></script>
<script src="{{asset('front/'.env('TEMPLATE_NAME').'/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('front/'.env('TEMPLATE_NAME').'/js/jquery.sticky.js')}}"></script>
<script src="{{asset('front/'.env('TEMPLATE_NAME').'/js/jquery.magnific-popup.min.js')}}"></script>
@stack('extrascripts')
<script src="{{asset('front/'.env('TEMPLATE_NAME').'/js/main.js')}}"></script>
</body>
</html>