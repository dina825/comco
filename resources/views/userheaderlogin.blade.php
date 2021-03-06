<html xmlns="http://www.w3.org/1999/xhtml">
<title><?php echo $title?></title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<link href="<?php echo URL::to('assets/')?>/css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo URL::to('assets/')?>/js/jquery.min-1-9-1.js"></script>

<link href="<?php echo URL::to('assets/')?>/css/user_style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo URL::to('assets/')?>/css/user_style-responsive.css" rel="stylesheet" type="text/css" />



<link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

<script type="text/javascript" src="<?php echo URL::to('assets/')?>/js/popper.min.js"></script>


<link rel="stylesheet" type="text/css" href="<?php echo URL::to('assets/')?>/datatables/media/css/dataTables.bootstrap4.min.css">
<script src="<?php echo URL::to('assets/')?>/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="<?php echo URL::to('assets/')?>/datatables/media/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo URL::to('assets/')?>/datatables-responsive/js/dataTables.responsive.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo URL::to('assets/')?>/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo URL::to('assets/')?>/css/fixedHeader.dataTables.min.css">

<script src="<?php echo URL::to('assets/')?>/js/jquery.dataTables.min.js"></script>
<script src="<?php echo URL::to('assets/')?>/js/dataTables.fixedHeader.min.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo URL::to('assets/')?>/css/pretty-checkbox.css">
 
<script type="text/javascript" src="<?php echo URL::to('assets/')?>/js/jquery.validate.js"></script>




<link rel="stylesheet" href="<?php echo URL::to('assets/')?>/css/res-menu/menu_user.css">

<head>

</head>
<body class="wrap push">


<div class="modal fade" id="change_password_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <form action="<?php echo URL::to('shop/password_update')?>" method="post" id="login-form">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Change Password</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Enter Old Password</label>
            <input type="password" placeholder="Enter Old Password" class="form-control" required name="opassword">
          </div>
          <div class="form-group">
            <label>Enter New Password</label>
            <input type="password" placeholder="Enter New Password" class="form-control" required name="password" id="password">
          </div>
          <div class="form-group">
            <label>Enter Confirm Password</label>
            <input type="password" placeholder="Enter Confirm Password" class="form-control" required name="cpassword">
          </div>
        </div>
        
        <div class="modal-footer">          
            <div class="col-lg-12 col-md-12 col-sm-12 col-12 text-right" style="padding-right: 0px;">
              <button type="submit" class="btn btn-primary submit_button">Update</button>
            </div>
           
        </div>
      </form>

    </div>
  </div>
</div>


<div class="width_100 red_row">
  <div class="container">
    <div class="row">
      <div class="col-lg-2 col-md-2 col-sm-6 col-6">        
        <div class="width_100 top_social">
          <ul>
            <li><a href="javascript:"><i class="fab fa-facebook-square"></i></a></li>
            <li><a href="javascript:"><i class="fab fa-twitter-square"></i></a></li>
            <li><a href="javascript:"><i class="fab fa-linkedin"></i></a></li>
          </ul>
        </div>
      </div>
      <div class="col-lg-10 col-md-10 col-sm-6 col-6">
        <div class="desktop_menu">
          <ul>
            <?php
            $segment =  Request::segment(2);
            ?>
            <li><a href="<?php echo URL::to('/')?>/" class="home_button">Home</a></li>
            <li><a href="<?php echo URL::to('/about')?>" class="about_button">About Us</a></li>
            <li><a href="<?php echo URL::to('/service')?>" class="service_button">Services</a></li>
            <li><a href="<?php echo URL::to('/why_choose_us')?>" class="why_choose_button">Why choose us</a></li>
            <li><a href="javascript:" class="product_button">Products</a></li>
            <li><a href="<?php echo URL::to('/career')?>" class="career_button">Career</a></li>          
            <li><a href="<?php echo URL::to('/contact')?>" class="contact_button">Get in Touch</a></li>
            <li><a href="<?php echo URL::to('/shop/my_account/')?>" class="<?php if($segment == 'my_account' || $segment == 'shop_commission'){echo 'active'; } ?>" >My Account</a></li>
          </ul>
        </div>
        <div class="mobile_menu_ul">
          <nav id="menu" class="menu_panel" role="navigation">
                <ul>
                    <li><a href="<?php echo URL::to('/')?>/" class="home_button">Home</a></li>
                    <li><a href="<?php echo URL::to('/about')?>" class="about_button">About Us</a></li>
                    <li><a href="<?php echo URL::to('/service')?>" class="service_button">Services</a></li>
                    <li><a href="<?php echo URL::to('/why_choose_us')?>" class="why_choose_button">Why choose us</a></li>
                    <li><a href="javascript:" class="product_button">Products</a></li>
                    <li><a href="<?php echo URL::to('/career')?>" class="career_button">Career</a></li>          
                    <li><a href="<?php echo URL::to('/contact')?>" class="contact_button">Get in Touch</a></li>
                    <li><a href="<?php echo URL::to('/shop/my_account/')?>" >My Account</a></li>
                </ul>
            </nav>
          <a href="#menu" class="menu-link"><i class="fas fa-bars"></i></a>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="width_100">
  <div class="container">
    <div class="row">
      <div class="col-lg-2 col-md-2 col-sm-4 col-6">
        <a href="<?php echo URL::to('/')?>"><img src="<?php echo URL::to('assets/')?>/images/comco_logo_red.png" class="red_logo"></a>
      </div>
      <div class="col-lg-10 col-md-10 col-sm-8 col-6">

        <div class="top_cart">
          <a href="javascript:" class="top_view_cart"><i class="fas fa-shopping-cart"></i></a>
          <div class="view_cart_detail" style="display: none;">
            <div class="white_space"></div>
            <ul>
              <li>
                <div class="title">Core 3-in-1 Cable Type-C / Lightning / Micro USB 0.2M</div>
                <div class="product_img"><img src="<?php echo URL::to('assets/')?>/images/product1.png" /></div>
                <div class="qty_amount">
                  <div class="qty"><input type="number" value="1" ></div>
                  <div class="amount">
                    <div class="discount">&#163; 150</div>
                    <div class="final_price">&#163; 130</div>
                  </div>
                </div>
                <div class="remove">
                  <a href="javascript:"><i class="fas fa-trash-alt"></i></a>
                </div>
              </li>
              <li>
                <div class="title">Core 3-in-1 Cable Type-C / Lightning / Micro USB 0.2M</div>
                <div class="product_img"><img src="<?php echo URL::to('assets/')?>/images/product1.png" /></div>
                <div class="qty_amount">
                  <div class="qty"><input type="number" value="1" ></div>
                  <div class="amount">
                    <div class="discount">&#163; 150</div>
                    <div class="final_price">&#163; 130</div>
                  </div>
                </div>
                <div class="remove">
                  <a href="javascript:"><i class="fas fa-trash-alt"></i></a>
                </div>
              </li>
            </ul>

            <div class="width_100 big_price">
              <a href="view_cart.php" class="btn btn-primary submit_button">View Cart</a>
            </div>
          </div>          
        </div>

        <div class="top_contact">
          <i class="fas fa-phone-volume"></i> &nbsp;+44 (0) 20 3322 5259 &nbsp;&nbsp;<i class="fas fa-envelope"></i> &nbsp;<a href="mailto:sales@comco-retail.co.uk">sales@comco-retail.co.uk</a>&nbsp;&nbsp;
        </div>
        
      </div>
    </div>
  </div>
</div>
<div class="width_100 inner_title_row inner_title_red_black">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-12 col-12">
        <div class="main_title width_100"><?php echo $title?></div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-7 col-7 d-md-block d-lg-block d-xl-block d-sm-none d-none">
          <div class="inner_menu">
            <div class="btn-group">
              <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bars"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-right">                
                <a class="dropdown-item" href="<?php echo URL::to('/shop/my_account')?>">My Account</a>
                <a class="dropdown-item" href="javascript:">Order History</a>
                <a class="dropdown-item" href="<?php echo URL::to('/shop/shop_commission')?>">Commission</a>
                <a class="dropdown-item" href="<?php echo URL::to('/shop/logout')?>">Logout</a>
              </div>
            </div>
            </div>
          <div class="welcome_name">Welcome to <span><?php echo $shop_details->shop_name;?></span></div>
      </div>

    </div>
  </div>
</div>
<div class="width_100 inner_title_row inner_title_black d-md-none d-lg-none d-xl-none d-sm-block d-block">
  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
    <div class="inner_menu">
      <div class="btn-group">
        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-bars"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-right">        
          <a class="dropdown-item" href="<?php echo URL::to('/shop/my_account')?>">My Account</a>  
          <a class="dropdown-item" href="javascript:">Order History</a>
          <a class="dropdown-item" href="<?php echo URL::to('/shop/shop_commission')?>">Commission</a>
          <a class="dropdown-item" href="<?php echo URL::to('/shop/logout')?>">Logout</a>
        </div>
      </div>
      </div>
    <div class="welcome_name">Welcome to <span><?php echo $shop_details->shop_name;?></span></div>
  </div>
</div>




@yield('content')




<div class="width_100 footer_first margin_top_40">
  <a href="<?php echo URL::to('/')?>/">Home</a> | 
  <a href="<?php echo URL::to('/about')?>">About Us</a> | 
  <a href="<?php echo URL::to('/service')?>">Services</a> | 
  <a href="<?php echo URL::to('/why_choose_us')?>">Why choose us</a> | 
  <a href="javascript:">Products</a> | 
  <a href="<?php echo URL::to('/career')?>">Career</a> | 
  <a href="<?php echo URL::to('/contact')?>">Get in Touch</a> | 
  <a href="<?php echo URL::to('/terms_conditions')?>">Terms and Conditions</a> | 
  <a href="<?php echo URL::to('/delivery_return')?>">Delivery & Returns</a> | 
  <a href="<?php echo URL::to('/privacy_policy')?>">Privacy Policy</a>
</div>

<div class="width_100 footer_last">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-12 col-12 text-left">
        All Right Reserved &copy; 2020 Comco
      </div>
      <div class="col-lg-6 col-md-6 col-sm-12 col-12 text-right">
        <div class="width_100 top_social bottom_social">
          <ul>
            <li>Follow Us&nbsp;&nbsp;</li>
            <li><a href="javascript:"><i class="fab fa-facebook-square"></i></a></li>
            <li><a href="javascript:"><i class="fab fa-twitter-square"></i></a></li>
            <li><a href="javascript:"><i class="fab fa-linkedin"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
<script src="<?php echo URL::to('assets/')?>/js/res-menu/bigSlide_user.js"></script>
<script>
    $(document).ready(function() {
        $('.menu-link').bigSlide();
    });
</script>
<script>

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

/*$(".top_view_cart").click(function(){
  $(".view_cart_detail").toggle();
});
*/
</script>


<script type="text/javascript">
$.ajaxSetup({async:false});
$('#add-form').validate({
    rules: {
      userid: {required: true},
      password:{required: true},      
    },
    messages: {              
      userid : {required : "Enter Email ID"},
      password:{required:"Enter Password"},
    },
});
</script>

<script type="text/javascript">
$.ajaxSetup({async:false});
$('#login-form').validate({
    rules: {        
        opassword : {required: true, remote:"<?php echo URL::to('shop/password_check')?>"},
        password:{required: true},
        cpassword:{required: true, equalTo: password},        
    },
    messages: {        
        opassword : {
          required : "Enter Old Password",
          remote : "Old password incorrect",
        },
        password:{required:"Enter New Password"},      
        cpassword : {
            required: "Confirm Password Field is required",
            equalTo : "Should match to above field",
        },
    },
});

</script>
<script type="text/javascript" src="<?php echo URL::to('assets/')?>/js/bootstrap.min.js"></script> 
</body>
</html>


