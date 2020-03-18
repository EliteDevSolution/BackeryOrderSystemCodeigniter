<!DOCTYPE html>
<html>
  <head>
    <title><?=$title?></title>
    <meta charset="utf8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<link href="/css/bootstrap.min.css" rel="stylesheet">
	<link href="/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600"
	        rel="stylesheet">
	<link href="/css/font-awesome.css" rel="stylesheet">
	<link href="/css/style.css" rel="stylesheet">
	<link href="/css/pages/dashboard.css" rel="stylesheet">
	<link href="/css/pages/signin.css" rel="stylesheet" type="text/css">
  <link href="/js/guidely/guidely.css" rel="stylesheet"> 
  <link href="/js/toastr/toastr.min.css" rel="stylesheet">
  <link href="/css/jquery-ui.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.10.19/css/dataTables.jqueryui.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css" rel="stylesheet">
  <link href="/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.4.6/bootstrap-editable/css/bootstrap-editable.css" rel="stylesheet"/>
  <link rel="stylesheet" type="text/css" href="/css/daterangepicker.css" />  
  
  </head>
  <body style="margin-bottom: 50px;">
  <div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container"> <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><span
                    class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span> </a><a class="brand" href="/"><i class="icon-home"></i> Bakery Order System</a>
      <?php
        if(UID){?>
          <div class="nav-collapse">
            <ul class="nav pull-right">
                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><h4><i
                                  class="icon-user"></i> <?=USERNAME?><?php if(USERROLE==1) echo "(Admin)"; ?> <b class="caret"></b></h3></a>
                  <ul class="dropdown-menu">
                    <li><a href="/login/logout">Logout</a></li>
                  </ul>
                </li>
              </ul>              
          </div>
          <!--/.nav-collapse --> 
      <?php } ?>
    </div>
    <!-- /container --> 
  </div>
  <!-- /navbar-inner --> 
</div>
<!-- /navbar -->
<?php
  if(UID)
{?>
      <div class="subnavbar">
        <div class="subnavbar-inner">
          <div class="container">
            <ul class="mainnav">
              <!-- <li <? if($page == "dashboard"){ echo 'class="active"'; } ?>><a href="/"><i class="icon-dashboard"></i><span>Dashboard</span> </a> </li> -->
              <li <?php if($page == "standing_order"){ echo 'class="active"'; } ?>><a href="/standing_order"><i class="icon-calendar"></i><span>S.Order</span> </a> </li>
              <li <?php if($page == "order"){ echo 'class="active"'; } ?>><a href="/order"><i class="icon-list-alt"></i><span>Cart</span> </a> </li>
              <li <?php if($page == "orderlist"){ echo 'class="active"'; } ?>><a href="/orderlist"><i class="icon-fire"></i><span>Order History</span> </a> </li>
              <?php if(USERROLE == 1) { ?>
              <li class="dropdown <?php if($page == "product" || $page == "product_group"){ echo 'active'; } ?>"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-sitemap"></i><span>Products</span> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="/product_group">Group</a></li>
                  <li><a href="/product">Product</a></li>
                  <li><a href="/sumery">Order Analysis</a></li>
                </ul>
              </li>
              <li <? if($page == "holiday"){ echo 'class="active"'; } ?>><a href="/holiday"><i class="icon-coffee"></i><span>Dates Closed</span> </a> </li>
              <li <?php if($page == "printsumery"){ echo 'class="active"'; } ?>><a href="/printsumery"><i class="icon-print"></i><span>Sumery</span> </a></li>
              <li <?php if($page == "employee"){ echo 'class="active"'; } ?>><a href="/employee"><i class="icon-user"></i><span>Users</span> </a></li>
              <?php } ?>
            </ul>
          </div>
          <!-- /container --> 
        </div>
        <!-- /subnavbar-inner --> 
      </div>
<?php } ?>
<!-- /subnavbar -->