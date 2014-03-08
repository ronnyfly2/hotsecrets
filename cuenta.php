<?php require_once('Connections/HotSecrets.php');
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
?>
<!DOCTYPE html>
<html>
<head>
<?php include("extructura-hot/1-head-index.php"); ?>
</head>
<body class=" customer-account-index">
<div class="ma-wrapper">
<noscript>
<div class="global-site-notice noscript">
<div class="notice-inner">
<p>
<strong>JavaScript seems to be disabled in your browser.</strong><br />
You must have JavaScript enabled in your browser to utilize the functionality of this website.                </p>
</div>
</div>
</noscript>
<div class="ma-page">
<?php include("extructura-hot/1-header.php"); ?>
<div class="ma-main-container col2-left-layout">
<div class="container">
<div class="main">
<div class="main-inner">
<div class="row-fluid show-grid">
<div class="col-left sidebar span3">
<div class="block block-account">
<div class="block-title">
<strong><span>My Account</span></strong>
</div>
<div class="block-content">
<ul>
<li class="current"><strong>Account Dashboard</strong></li>
<li><a href="http://www.plazathemes.com/demo/ma_aries/index.php/customer/account/edit/">Account Information</a></li>
<li><a href="http://www.plazathemes.com/demo/ma_aries/index.php/customer/address/">Address Book</a></li>
<li><a href="http://www.plazathemes.com/demo/ma_aries/index.php/sales/order/history/">My Orders</a></li>
<li><a href="http://www.plazathemes.com/demo/ma_aries/index.php/sales/billing_agreement/">Billing Agreements</a></li>
<li><a href="http://www.plazathemes.com/demo/ma_aries/index.php/sales/recurring_profile/">Recurring Profiles</a></li>
<li><a href="http://www.plazathemes.com/demo/ma_aries/index.php/review/customer/">My Product Reviews</a></li>
<li><a href="http://www.plazathemes.com/demo/ma_aries/index.php/tag/customer/">My Tags</a></li>
<li><a href="http://www.plazathemes.com/demo/ma_aries/index.php/wishlist/">Wishlist</a></li>
<li><a href="http://www.plazathemes.com/demo/ma_aries/index.php/oauth/customer_token/">My Applications</a></li>
<li><a href="http://www.plazathemes.com/demo/ma_aries/index.php/newsletter/manage/">Newsletter Subscriptions</a></li>
<li class="last"><a href="http://www.plazathemes.com/demo/ma_aries/index.php/downloadable/customer/products/">My Downloadable Products</a></li>
</ul>
</div>
</div>

</div>

<div class="col-main span9">
<div class="my-account">
<div class="dashboard">
<div class="page-title">
<h1>My Dashboard</h1>
</div>

<div class="welcome-msg">
<p class="hello">
<strong>Hello, roro rara!</strong>
</p>
<p>From your My Account Dashboard you have the ability to view a snapshot of your recent account activity and update your account information. Select a link below to view or edit information.</p>
</div>

<div class="box-account box-recent">

<div class="box-head">
<h2>Pedidos recientes</h2>
<a href="">View All</a>
</div>

</div>

<div class="box-account box-info">
<div class="box-head">
<h2>Account Information</h2>
</div>

<div class="col2-set">
<div class="col-1">
<div class="box">

<div class="box-title">
<h3>Contact Information</h3>
<a href="http://www.plazathemes.com/demo/ma_aries/index.php/customer/account/edit/">Edit</a>
</div>

<div class="box-content">
<p>roro rara<br />
ronny_the_fly7@hotmail.com<br />
<a href="http://www.plazathemes.com/demo/ma_aries/index.php/customer/account/edit/changepass/1/">Change Password</a>
</p>
</div>

</div>
</div>

<div class="col-2">
<div class="box">
<div class="box-title">
<h3>Newsletters</h3>
<a href="http://www.plazathemes.com/demo/ma_aries/index.php/newsletter/manage/">Edit</a>
</div>
<div class="box-content">
<p>You are currently not subscribed to any newsletter.</p>
</div>
</div>
</div>

</div>

<div class="col2-set">
<div class="box">
<div class="box-title">
<h3>Address Book</h3>
<a href="http://www.plazathemes.com/demo/ma_aries/index.php/customer/address/">Manage Addresses</a>
</div>

<div class="box-content">

<div class="col-1">
<h4>Default Billing Address</h4>
<address>
roro rara<br/>asas asdf dsf<br />
sadasd ,  Alaska, 5120<br/>
United States<br/>
T: 1124578
<br />
<a href="">Edit Address</a>
</address>
</div>
<div class="col-2">
<h4>Default Shipping Address</h4>
<address>
roro rara<br/>
asas asdf dsf<br />
sadasd ,  Alaska, 5120<br/>
United States<br/>
T: 1124578
<br />
<a href="">Edit Address</a>
</address>
</div>

</div>
</div>
</div>

</div>
</div>
</div>
</div> 

                           
</div>
</div>
</div>
</div>
</div>
<?php include("extructura-hot/3-footer.php"); ?>
</div>
</div>
</body>
</html>
