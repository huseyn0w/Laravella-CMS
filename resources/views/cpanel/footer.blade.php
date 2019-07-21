<?php
/**
 * Laravella CMS
 * File: footer.blade.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 21.07.2019
 */
?>
<footer class="footer">
    <div class="container-fluid">
        <nav>
            <ul class="footer-menu">
                <li>
                    <a href="#">
                        Home
                    </a>
                </li>
                <li>
                    <a href="#">
                        Company
                    </a>
                </li>
                <li>
                    <a href="#">
                        Portfolio
                    </a>
                </li>
                <li>
                    <a href="#">
                        Blog
                    </a>
                </li>
            </ul>
            <p class="copyright text-center">
                &copy; {{ now()->year }}
                Made with love by <a href="https://www.linkedin.com/in/huseyn0w/">Huseyn0w</a>
            </p>
        </nav>
    </div>
</footer>
</div>
</div>
<!-- <div class="fixed-plugin">
<div class="dropdown show-dropdown">
<a href="#" data-toggle="dropdown">
<i class="fa fa-cog fa-2x"> </i>
</a>

<ul class="dropdown-menu">
<li class="header-title"> Sidebar Style</li>
<li class="adjustments-line">
<a href="javascript:void(0)" class="switch-trigger">
<p>Background Image</p>
<label class="switch">
<input type="checkbox" data-toggle="switch" checked="" data-on-color="primary" data-off-color="primary"><span class="toggle"></span>
</label>
<div class="clearfix"></div>
</a>
</li>
<li class="adjustments-line">
<a href="javascript:void(0)" class="switch-trigger background-color">
<p>Filters</p>
<div class="pull-right">
<span class="badge filter badge-black" data-color="black"></span>
<span class="badge filter badge-azure" data-color="azure"></span>
<span class="badge filter badge-green" data-color="green"></span>
<span class="badge filter badge-orange" data-color="orange"></span>
<span class="badge filter badge-red" data-color="red"></span>
<span class="badge filter badge-purple active" data-color="purple"></span>
</div>
<div class="clearfix"></div>
</a>
</li>
<li class="header-title">Sidebar Images</li>

<li class="active">
<a class="img-holder switch-trigger" href="javascript:void(0)">
<img src="{{asset('admin')}}/img/sidebar-1.jpg" alt="" />
</a>
</li>
<li>
<a class="img-holder switch-trigger" href="javascript:void(0)">
<img src="{{asset('admin')}}/img/sidebar-3.jpg" alt="" />
</a>
</li>
<li>
<a class="img-holder switch-trigger" href="javascript:void(0)">
<img src="..//assets/img/sidebar-4.jpg" alt="" />
</a>
</li>
<li>
<a class="img-holder switch-trigger" href="javascript:void(0)">
<img src="{{asset('admin')}}/img/sidebar-5.jpg" alt="" />
</a>
</li>

<li class="button-container">
<div class="">
<a href="http://www.creative-tim.com/product/light-bootstrap-dashboard" target="_blank" class="btn btn-info btn-block btn-fill">Download, it's free!</a>
</div>
</li>

<li class="header-title pro-title text-center">Want more components?</li>

<li class="button-container">
<div class="">
<a href="http://www.creative-tim.com/product/light-bootstrap-dashboard-pro" target="_blank" class="btn btn-warning btn-block btn-fill">Get The PRO Version!</a>
</div>
</li>

<li class="header-title" id="sharrreTitle">Thank you for sharing!</li>

<li class="button-container">
<button id="twitter" class="btn btn-social btn-outline btn-twitter btn-round sharrre"><i class="fa fa-twitter"></i> · 256</button>
<button id="facebook" class="btn btn-social btn-outline btn-facebook btn-round sharrre"><i class="fa fa-facebook-square"></i> · 426</button>
</li>
</ul>
</div>
</div> -->

</body>
<!--   Core JS Files   -->
<script src="{{asset('admin')}}/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="{{asset('admin')}}/js/core/popper.min.js" type="text/javascript"></script>
<script src="{{asset('admin')}}/js/core/bootstrap.min.js" type="text/javascript"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="{{asset('admin')}}/js/plugins/bootstrap-switch.js"></script>
<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!--  Chartist Plugin  -->
<script src="{{asset('admin')}}/js/plugins/chartist.min.js"></script>
<!--  Notifications Plugin    -->
<script src="{{asset('admin')}}/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
<script src="{{asset('admin')}}/js/light-bootstrap-dashboard.js?v=2.0.0 " type="text/javascript"></script>
<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
<script src="{{asset('admin')}}/js/demo.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        // Javascript method's body can be found in assets/js/demos.js
        demo.initDashboardPageCharts();

        demo.showNotification();

    });
</script>

</html>

