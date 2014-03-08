<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Form Component</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="css/font-awesome.css" rel="stylesheet" />


    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />




    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->


  </head>

  <body>

  <section id="container" class="">
      <!--header start-->
      <header class="header white-bg">
          <div class="sidebar-toggle-box">
              <div data-original-title="Toggle Navigation" data-placement="right" class="fa fa-bars tooltips"></div>
          </div>
          <!--logo start-->
          <a href="index.html" class="logo" >Flat<span>lab</span></a>
          <!--logo end-->
          <div class="nav notify-row" id="top_menu">
            <!--  notification start -->
            <ul class="nav top-menu">
              <!-- settings start -->
              <li class="dropdown">
                  <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                      <i class="fa fa-tasks"></i>
                      <span class="badge bg-success">6</span>
                  </a>
                  <ul class="dropdown-menu extended tasks-bar">
                      <div class="notify-arrow notify-arrow-green"></div>
                      <li>
                          <p class="green">You have 6 pending tasks</p>
                      </li>
                      <li>
                          <a href="#">
                              <div class="task-info">
                                  <div class="desc">Dashboard v1.3</div>
                                  <div class="percent">40%</div>
                              </div>
                              <div class="progress progress-striped">
                                  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                      <span class="sr-only">40% Complete (success)</span>
                                  </div>
                              </div>
                          </a>
                      </li>
                      <li>
                          <a href="#">
                              <div class="task-info">
                                  <div class="desc">Database Update</div>
                                  <div class="percent">60%</div>
                              </div>
                              <div class="progress progress-striped">
                                  <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                      <span class="sr-only">60% Complete (warning)</span>
                                  </div>
                              </div>
                          </a>
                      </li>
                      <li>
                          <a href="#">
                              <div class="task-info">
                                  <div class="desc">Iphone Development</div>
                                  <div class="percent">87%</div>
                              </div>
                              <div class="progress progress-striped">
                                  <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 87%">
                                      <span class="sr-only">87% Complete</span>
                                  </div>
                              </div>
                          </a>
                      </li>
                      <li>
                          <a href="#">
                              <div class="task-info">
                                  <div class="desc">Mobile App</div>
                                  <div class="percent">33%</div>
                              </div>
                              <div class="progress progress-striped">
                                  <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 33%">
                                      <span class="sr-only">33% Complete (danger)</span>
                                  </div>
                              </div>
                          </a>
                      </li>
                      <li>
                          <a href="#">
                              <div class="task-info">
                                  <div class="desc">Dashboard v1.3</div>
                                  <div class="percent">45%</div>
                              </div>
                              <div class="progress progress-striped active">
                                  <div class="progress-bar"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
                                      <span class="sr-only">45% Complete</span>
                                  </div>
                              </div>

                          </a>
                      </li>
                      <li class="external">
                          <a href="#">See All Tasks</a>
                      </li>
                  </ul>
              </li>
              <!-- settings end -->
              <!-- inbox dropdown start-->
              <li id="header_inbox_bar" class="dropdown">
                  <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                      <i class="fa fa-envelope-o"></i>
                      <span class="badge bg-important">5</span>
                  </a>
                  <ul class="dropdown-menu extended inbox">
                      <div class="notify-arrow notify-arrow-red"></div>
                      <li>
                          <p class="red">You have 5 new messages</p>
                      </li>
                      <li>
                          <a href="#">
                              <span class="photo"><img alt="avatar" src="./img/avatar-mini.jpg"></span>
                                    <span class="subject">
                                    <span class="from">Jonathan Smith</span>
                                    <span class="time">Just now</span>
                                    </span>
                                    <span class="message">
                                        Hello, this is an example msg.
                                    </span>
                          </a>
                      </li>
                      <li>
                          <a href="#">
                              <span class="photo"><img alt="avatar" src="./img/avatar-mini2.jpg"></span>
                                    <span class="subject">
                                    <span class="from">Jhon Doe</span>
                                    <span class="time">10 mins</span>
                                    </span>
                                    <span class="message">
                                     Hi, Jhon Doe Bhai how are you ?
                                    </span>
                          </a>
                      </li>
                      <li>
                          <a href="#">
                              <span class="photo"><img alt="avatar" src="./img/avatar-mini3.jpg"></span>
                                    <span class="subject">
                                    <span class="from">Jason Stathum</span>
                                    <span class="time">3 hrs</span>
                                    </span>
                                    <span class="message">
                                        This is awesome dashboard.
                                    </span>
                          </a>
                      </li>
                      <li>
                          <a href="#">
                              <span class="photo"><img alt="avatar" src="./img/avatar-mini4.jpg"></span>
                                    <span class="subject">
                                    <span class="from">Jondi Rose</span>
                                    <span class="time">Just now</span>
                                    </span>
                                    <span class="message">
                                        Hello, this is metrolab
                                    </span>
                          </a>
                      </li>
                      <li>
                          <a href="#">See all messages</a>
                      </li>
                  </ul>
              </li>
              <!-- inbox dropdown end -->
              <!-- notification dropdown start-->
              <li id="header_notification_bar" class="dropdown">
                  <a data-toggle="dropdown" class="dropdown-toggle" href="#">

                      <i class="fa fa-bell-o"></i>
                      <span class="badge bg-warning">7</span>
                  </a>
                  <ul class="dropdown-menu extended notification">
                      <div class="notify-arrow notify-arrow-yellow"></div>
                      <li>
                          <p class="yellow">You have 7 new notifications</p>
                      </li>
                      <li>
                          <a href="#">
                              <span class="label label-danger"><i class="fa fa-bolt"></i></span>
                              Server #3 overloaded.
                              <span class="small italic">34 mins</span>
                          </a>
                      </li>
                      <li>
                          <a href="#">
                              <span class="label label-warning"><i class="fa fa-bell"></i></span>
                              Server #10 not respoding.
                              <span class="small italic">1 Hours</span>
                          </a>
                      </li>
                      <li>
                          <a href="#">
                              <span class="label label-danger"><i class="fa fa-bolt"></i></span>
                              Database overloaded 24%.
                              <span class="small italic">4 hrs</span>
                          </a>
                      </li>
                      <li>
                          <a href="#">
                              <span class="label label-success"><i class="fa fa-plus"></i></span>
                              New user registered.
                              <span class="small italic">Just now</span>
                          </a>
                      </li>
                      <li>
                          <a href="#">
                              <span class="label label-info"><i class="fa fa-bullhorn"></i></span>
                              Application error.
                              <span class="small italic">10 mins</span>
                          </a>
                      </li>
                      <li>
                          <a href="#">See all notifications</a>
                      </li>
                  </ul>
              </li>
              <!-- notification dropdown end -->
          </ul>
          </div>
          <div class="top-nav ">
              <ul class="nav pull-right top-menu">
                  <li>
                      <input type="text" class="form-control search" placeholder="Search">
                  </li>
                  <!-- user login dropdown start-->
                  <li class="dropdown">
                      <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                          <img alt="" src="img/avatar1_small.jpg">
                          <span class="username">Jhon Doue</span>
                          <b class="caret"></b>
                      </a>
                      <ul class="dropdown-menu extended logout">
                          <div class="log-arrow-up"></div>
                          <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                          <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                          <li><a href="#"><i class="fa fa-bell-o"></i> Notification</a></li>
                          <li><a href="login.html"><i class="fa fa-key"></i> Log Out</a></li>
                      </ul>
                  </li>
                  <!-- user login dropdown end -->
              </ul>
          </div>
      </header>
      <!--header end-->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
                  <li>
                      <a href="index.html">
                          <i class="fa fa-dashboard"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="javascript:;">
                          <i class="fa fa-laptop"></i>
                          <span>Layouts</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="boxed_page.html">Boxed Page</a></li>
                          <li><a  href="horizontal_menu.html">Horizontal Menu</a></li>
                          <li><a  href="language_switch_bar.html">Language Switch Bar</a></li>
                          <li><a  href="email_template.html" target="_blank">Email Template</a></li>
                      </ul>
                  </li>

                  <li class="sub-menu">
                      <a href="javascript:;">
                          <i class="fa fa-book"></i>
                          <span>UI Elements</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="general.html">General</a></li>
                          <li><a  href="buttons.html">Buttons</a></li>
                          <li><a  href="widget.html">Widget</a></li>
                          <li><a  href="slider.html">Slider</a></li>
                          <li><a  href="nestable.html">Nestable</a></li>
                          <li><a  href="tree.html">Tree View</a></li>
                          <li><a  href="font_awesome.html">Font Awesome</a></li>
                      </ul>
                  </li>

                  <li class="sub-menu">
                      <a href="javascript:;">
                          <i class="fa fa-cogs"></i>
                          <span>Components</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="grids.html">Grids</a></li>
                          <li><a  href="calendar.html">Calendar</a></li>
                          <li><a  href="gallery.html">Gallery</a></li>
                          <li><a  href="todo_list.html">Todo List</a></li>
                          <li><a  href="draggable_portlet.html">Draggable Portlet</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" class="active" >
                          <i class="fa fa-tasks"></i>
                          <span>Form Stuff</span>
                      </a>
                      <ul class="sub">
                          <li class="active"><a  href="form_component.html">Form Components</a></li>
                          <li><a  href="advanced_form_components.html">Advanced Components</a></li>
                          <li><a  href="form_wizard.html">Form Wizard</a></li>
                          <li><a  href="form_validation.html">Form Validation</a></li>
                          <li><a  href="dropzone.html">Dropzone File Upload</a></li>
                          <li><a  href="inline_editor.html">Inline Editor</a></li>
                          <li><a  href="image_cropping.html">Image Cropping</a></li>
                          <li><a  href="file_upload.html">Multiple File Upload</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-th"></i>
                          <span>Data Tables</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="basic_table.html">Basic Table</a></li>
                          <li><a  href="responsive_table.html">Responsive Table</a></li>
                          <li><a  href="dynamic_table.html">Dynamic Table</a></li>
                          <li><a  href="advanced_table.html">Advanced Table</a></li>
                          <li><a  href="editable_table.html">Editable Table</a></li>
                      </ul>
                  </li>
                  <li>
                      <a  href="inbox.html">
                          <i class="fa fa-envelope"></i>
                          <span>Mail </span>
                          <span class="label label-danger pull-right mail-info">2</span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class=" fa fa-bar-chart-o"></i>
                          <span>Charts</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="morris.html">Morris</a></li>
                          <li><a  href="chartjs.html">Chartjs</a></li>
                          <li><a  href="flot_chart.html">Flot Charts</a></li>
                          <li><a  href="xchart.html">xChart</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-shopping-cart"></i>
                          <span>Shop</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="product_list.html">List View</a></li>
                          <li><a  href="product_details.html">Details View</a></li>
                      </ul>
                  </li>
                  <li>
                      <a href="google_maps.html" >
                          <i class="fa fa-map-marker"></i>
                          <span>Google Maps </span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;">
                          <i class="fa fa-comments-o"></i>
                          <span>Chat Room</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="lobby.html">Lobby</a></li>
                          <li><a  href="chat_room.html"> Chat Room</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-glass"></i>
                          <span>Extra</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="blank.html">Blank Page</a></li>
                          <li><a  href="lock_screen.html">Lock Screen</a></li>
                          <li><a  href="profile.html">Profile</a></li>
                          <li><a  href="invoice.html">Invoice</a></li>
                          <li><a  href="search_result.html">Search Result</a></li>
                          <li><a  href="pricing_table.html">Pricing Table</a></li>
                          <li><a  href="faq.html">FAQ</a></li>
                          <li><a  href="fb_wall.html">FB Wall</a></li>
                          <li><a  href="404.html">404 Error</a></li>
                          <li><a  href="500.html">500 Error</a></li>
                      </ul>
                  </li>
                  <li>
                      <a  href="login.html">
                          <i class="fa fa-user"></i>
                          <span>Login Page</span>
                      </a>
                  </li>

                  <!--multi level menu start-->
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-sitemap"></i>
                          <span>Multi level Menu</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="javascript:;">Menu Item 1</a></li>
                          <li class="sub-menu">
                              <a  href="boxed_page.html">Menu Item 2</a>
                              <ul class="sub">
                                  <li><a  href="javascript:;">Menu Item 2.1</a></li>
                                  <li class="sub-menu">
                                      <a  href="javascript:;">Menu Item 3</a>
                                      <ul class="sub">
                                          <li><a  href="javascript:;">Menu Item 3.1</a></li>
                                          <li><a  href="javascript:;">Menu Item 3.2</a></li>
                                      </ul>
                                  </li>
                              </ul>
                          </li>
                      </ul>
                  </li>
                  <!--multi level menu end-->

              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                              Inline form
                          </header>
                          <div class="panel-body">
                              <form class="form-inline" role="form">
                                  <div class="form-group">
                                      <label class="sr-only" for="exampleInputEmail2">Email address</label>
                                      <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Enter email">
                                  </div>
                                  <div class="form-group">
                                      <label class="sr-only" for="exampleInputPassword2">Password</label>
                                      <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password">
                                  </div>
                                  <div class="checkbox">
                                      <label>
                                          <input type="checkbox"> Remember me
                                      </label>
                                  </div>
                                  <button type="submit" class="btn btn-success">Sign in</button>
                              </form>

                          </div>
                      </section>

                  </div>
              </div>
             
              <div class="row">
                  <div class="col-lg-12">
                      
                     
                      <section class="panel">
                          <div class="panel-body">
                              <form class="form-horizontal tasi-form" method="get">                               
                                  
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label col-lg-2" for="inputSuccess">Selects</label>
                                      <div class="col-lg-10">
                                          <select class="form-control m-bot15">
                                              <option>1</option>
                                              <option>2</option>
                                              <option>3</option>
                                              <option>4</option>
                                              <option>5</option>
                                          </select>                                         
                                      </div>
                                  </div>

                                  <div class="form-group">
                                      <label class="col-sm-2 control-label col-lg-2" for="inputSuccess">Column sizing</label>
                                      <div class="col-lg-10">
                                          <div class="row">
                                              <div class="col-lg-2">
                                                  <input type="text" class="form-control" placeholder=".col-lg-2">
                                              </div>
                                              <div class="col-lg-3">
                                                  <input type="text" class="form-control" placeholder=".col-lg-3">
                                              </div>
                                              <div class="col-lg-4">
                                                  <input type="text" class="form-control" placeholder=".col-lg-4">
                                              </div>
                                          </div>

                                      </div>
                                  </div>

                              </form>
                          </div>
                      </section>

                      <section class="panel">
                          <header class="panel-heading">
                              Input groups
                          </header>
                          <div class="panel-body">
                              <form class="form-horizontal tasi-form" method="get">
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label col-lg-2" >Basic examples</label>
                                      <div class="col-lg-10">
                                          <div class="input-group m-bot15">
                                              <span class="input-group-addon">@</span>
                                              <input type="text" class="form-control" placeholder="Username">
                                          </div>

                                          <div class="input-group m-bot15">
                                              <input type="text" class="form-control">
                                              <span class="input-group-addon">.00</span>
                                          </div>

                                          <div class="input-group m-bot15">
                                              <span class="input-group-addon">$</span>
                                              <input type="text" class="form-control">
                                              <span class="input-group-addon">.00</span>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label col-lg-2" >Sizing</label>
                                      <div class="col-lg-10">
                                          <div class="input-group input-group-lg m-bot15">
                                              <span class="input-group-addon">@</span>
                                              <input type="text" class="form-control input-lg" placeholder="Username">
                                          </div>

                                          <div class="input-group m-bot15">
                                              <span class="input-group-addon">@</span>
                                              <input type="text" class="form-control" placeholder="Username">
                                          </div>

                                          <div class="input-group input-group-sm m-bot15">
                                              <span class="input-group-addon">@</span>
                                              <input type="text" class="form-control" placeholder="Username">
                                          </div>

                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label col-lg-2" >Checkboxe and radio</label>
                                      <div class="col-lg-10">
                                          <div class="input-group m-bot15">
                                              <span class="input-group-addon">
                                                <input type="checkbox">
                                              </span>
                                              <input type="text" class="form-control">
                                          </div>

                                          <div class="input-group m-bot15">
                                              <span class="input-group-addon">
                                                <input type="radio">
                                              </span>
                                              <input type="text" class="form-control">
                                          </div>

                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label col-lg-2" >Button addons</label>
                                      <div class="col-lg-10">
                                          <div class="input-group m-bot15">
                                              <span class="input-group-btn">
                                                <button class="btn btn-white" type="button">Go!</button>
                                              </span>
                                              <input type="text" class="form-control">
                                          </div>

                                          <div class="input-group m-bot15">
                                              <input type="text" class="form-control">
                                              <span class="input-group-btn">
                                                <button class="btn btn-white" type="button">Go!</button>
                                              </span>
                                          </div>

                                          <div class="input-group m-bot15">
                                              <div class="input-group-btn">
                                                  <button type="button" class="btn btn-white dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></button>
                                                  <ul class="dropdown-menu">
                                                      <li><a href="#">Action</a></li>
                                                      <li><a href="#">Another action</a></li>
                                                      <li><a href="#">Something else here</a></li>
                                                      <li class="divider"></li>
                                                      <li><a href="#">Separated link</a></li>
                                                  </ul>
                                              </div>
                                              <input type="text" class="form-control">
                                          </div>
                                          <div class="input-group m-bot15">
                                              <input type="text" class="form-control">
                                              <div class="input-group-btn">
                                                  <button type="button" class="btn btn-white dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></button>
                                                  <ul class="dropdown-menu pull-right">
                                                      <li><a href="#">Action</a></li>
                                                      <li><a href="#">Another action</a></li>
                                                      <li><a href="#">Something else here</a></li>
                                                      <li class="divider"></li>
                                                      <li><a href="#">Separated link</a></li>
                                                  </ul>
                                              </div>
                                          </div>

                                      </div>
                                  </div>

                                  <div class="form-group">
                                      <label class="col-sm-2 control-label col-lg-2" >Segmented buttons</label>
                                      <div class="col-lg-10">
                                          <div class="input-group m-bot15">
                                              <div class="input-group-btn">
                                                  <button tabindex="-1" class="btn btn-white" type="button">Action</button>
                                                  <button tabindex="-1" data-toggle="dropdown" class="btn btn-white dropdown-toggle" type="button">
                                                      <span class="caret"></span>
                                                  </button>
                                                  <ul role="menu" class="dropdown-menu">
                                                      <li><a href="#">Action</a></li>
                                                      <li><a href="#">Another action</a></li>
                                                      <li><a href="#">Something else here</a></li>
                                                      <li class="divider"></li>
                                                      <li><a href="#">Separated link</a></li>
                                                  </ul>
                                              </div>
                                              <input type="text" class="form-control">
                                          </div>

                                          <div class="input-group m-bot15">
                                              <input type="text" class="form-control">
                                              <div class="input-group-btn">
                                                  <button tabindex="-1" class="btn btn-white" type="button">Action</button>
                                                  <button tabindex="-1" data-toggle="dropdown" class="btn btn-white dropdown-toggle" type="button">
                                                      <span class="caret"></span>
                                                  </button>
                                                  <ul role="menu" class="dropdown-menu pull-right">
                                                      <li><a href="#">Action</a></li>
                                                      <li><a href="#">Another action</a></li>
                                                      <li><a href="#">Something else here</a></li>
                                                      <li class="divider"></li>
                                                      <li><a href="#">Separated link</a></li>
                                                  </ul>
                                              </div>
                                          </div>
                                      </div>
                                  </div>

                              </form>
                          </div>
                      </section>

                      <div class="row">
                          <div class="col-lg-6">
                              <section class="panel">
                                  <header class="panel-heading">
                                      Switch
                                  </header>
                                  <div class="panel-body">
                                      <div class="row m-bot15">
                                          <div class="col-sm-6 text-center">
                                              <input type="checkbox" checked="" data-toggle="switch" />
                                          </div>
                                          <div class="col-sm-6 text-center">
                                              <input type="checkbox" data-toggle="switch" />
                                          </div>
                                      </div>
                                      <div class="row m-bot15">
                                          <div class="col-sm-6 text-center">
                                              <div class="switch switch-square"
                                                   data-on-label="<i class=' fa fa-check'></i>"
                                                   data-off-label="<i class='fa fa-times'></i>">
                                                  <input type="checkbox" />
                                              </div>
                                          </div>
                                          <div class="col-sm-6 text-center">
                                              <div class="switch switch-square"
                                                   data-on-label="<i class=' fa fa-check'></i>"
                                                   data-off-label="<i class='fa fa-times'></i>">
                                                  <input type="checkbox" checked="" />
                                              </div>
                                          </div>
                                      </div>
                                      <div class="row">
                                          <div class="col-sm-6 text-center">
                                              <input type="checkbox" disabled data-toggle="switch" />
                                          </div>
                                          <div class="col-sm-6 text-center">
                                              <input type="checkbox" checked disabled data-toggle="switch" />
                                          </div>
                                      </div>
                                  </div>
                              </section>
                              <section class="panel">
                                  <header class="panel-heading">
                                      Tags Input
                                  </header>
                                  <div class="panel-body">
                                      <input name="tagsinput" id="tagsinput" class="tagsinput" value="Flat,Design,Lab,Clean" />
                                  </div>
                              </section>
                          </div>
                          <div class="col-lg-6">
                              <section class="panel">
                                  <header class="panel-heading">
                                      Custom Checkbox & Radio
                                  </header>
                                  <div class="panel-body">
                                      <form action="#" method="get" accept-charset="utf-8">
                                          <div class="checkboxes">
                                              <label class="label_check" for="checkbox-01">
                                                  <input name="sample-checkbox-01" id="checkbox-01" value="1" type="checkbox" checked /> I agree to the terms &#38; conditions.
                                              </label>
                                              <label class="label_check" for="checkbox-02">
                                              <input name="sample-checkbox-02" id="checkbox-02" value="1" type="checkbox" /> Please send me regular updates. </label>
                                              <label class="label_check" for="checkbox-03">
                                              <input name="sample-checkbox-02" id="checkbox-03" value="1" type="checkbox" /> This is nice checkbox.</label>

                                          </div>
                                          <div class="radios">
                                              <label class="label_radio" for="radio-01">
                                                  <input name="sample-radio" id="radio-01" value="1" type="radio" checked /> This is option A...
                                              </label>
                                              <label class="label_radio" for="radio-02">
                                                  <input name="sample-radio" id="radio-02" value="1" type="radio" /> and this is option B...
                                              </label>
                                              <label class="label_radio" for="radio-03">
                                                  <input name="sample-radio" id="radio-03" value="1" type="radio" /> or simply choose option C
                                              </label>
                                          </div>
                                      </form>
                                  </div>

                              </section>

                          </div>
                      </div>

                      

                     

                  </div>
              </div>
              <!-- page end-->
          </section>
      </section>
      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              2013 &copy; FlatLab by VectorLab.
              <a href="#" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script>

    <script src="js/jquery-ui-1.9.2.custom.min.js"></script>
    <script class="include" type="text/javascript" src="js/jquery.dcjqaccordion.2.7.js"></script>

  <!--custom switch-->
  <script src="js/bootstrap-switch.js"></script>
  <!--custom tagsinput-->
  <script src="js/jquery.tagsinput.js"></script>
  <!--custom checkbox & radio--> 


<script type="text/javascript" src="js/bootstrap-inputmask.min.js"></script>
<script src="js/respond.min.js" ></script>
<!--common script for all pages-->
<script src="js/common-scripts.js"></script>
<!--script for this page-->
<script src="js/form-component.js"></script>
</body>
</html>