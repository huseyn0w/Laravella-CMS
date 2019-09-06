<?php
/**
 * Laravella CMS
 * File: header-styles.blade.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 09.08.2019
 */
?>
<meta charset="utf-8" />
<link rel="apple-touch-icon" sizes="76x76" href="{{asset('admin')}}/img/apple-icon.png">
<link rel="icon" type="image/png" href="{{asset('admin')}}/img/favicon.ico">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<title>Laravella CMS Control Panel Area</title>
<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
<!--     Fonts and icons     -->
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
<!-- CSS Files -->
<link href="{{asset('admin')}}/css/bootstrap.min.css" rel="stylesheet" />
<link href="{{asset('admin')}}/css/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" />
<!-- CSS Just for demo purpose, don't include it in your project -->
<link href="{{asset('admin')}}/css/demo.css" rel="stylesheet" />
@stack('extrastyles')
<link href="{{asset('admin')}}/css/laravella.css" rel="stylesheet" />