<?php
/**
 * Laravella CMS
 * File: footer-scripts.blade.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 09.08.2019
 */
?>

<!--   Core JS Files   -->
<script src="{{asset('admin')}}/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="{{asset('admin')}}/js/core/popper.min.js" type="text/javascript"></script>
<script src="{{asset('admin')}}/js/core/bootstrap.min.js" type="text/javascript"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="{{asset('admin')}}/js/plugins/bootstrap-switch.js"></script>
<!--  Google Maps Plugin    -->
{{--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>--}}
<!--  Chartist Plugin  -->
<script src="{{asset('admin')}}/js/plugins/chartist.min.js"></script>
<!--  Notifications Plugin    -->
<script src="{{asset('admin')}}/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
<script src="{{asset('admin')}}/js/light-bootstrap-dashboard.js?v=2.0.0 " type="text/javascript"></script>
<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
<script src="{{asset('admin')}}/js/demo.js"></script>
<script src="{{asset('admin')}}/js/laravella.js"></script>
@stack('extrascripts')
<script type="text/javascript">
    // $(document).ready(function() {
    //     // Javascript method's body can be found in assets/js/demos.js
    //     demo.initDashboardPageCharts();
    //
    //     // demo.showNotification();
    //
    // });
</script>
