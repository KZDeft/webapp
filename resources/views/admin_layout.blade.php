<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<head>
    <title>EShopper Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- bootstrap-css -->
    <link rel="stylesheet" href="{{asset('backend/css/bootstrap.min.css')}}" >
    <!-- //bootstrap-css -->
    <!-- Custom CSS -->
    <link href="{{asset('backend/css/style.css')}}" rel='stylesheet' type='text/css' />
    <link href="{{asset('backend/css/style-responsive.css')}}" rel="stylesheet"/>
    <!-- font CSS -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <!-- font-awesome icons -->
    <link rel="stylesheet" href="{{asset('backend/css/font.css')}}" type="text/css"/>
    <link href="{{asset('backend/css/font-awesome.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('backend/css/morris.css')}}" type="text/css"/>
    <!-- calendar -->
    <link rel="stylesheet" href="{{asset('backend/css/monthly.css')}}">
    <!-- //calendar -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <!-- //font-awesome icons -->
    <script src="{{asset('backend/js/jquery2.0.3.min.js')}}"></script>
    <script src="{{asset('backend/js/raphael-min.js')}}"></script>
    <script src="{{asset('backend/js/morris.js')}}"></script>
</head>
<body>
<section id="container">
    <!--header start-->
    <header class="header fixed-top clearfix">
        <!--logo start-->
        <div class="brand">
            <a href="{{URL::to('/dashboard')}}" class="logo">
                EShopper
            </a>
            <div class="sidebar-toggle-box">
                <div class="fa fa-bars"></div>
            </div>
        </div>
        <!--logo end-->

        <div class="top-nav clearfix">
            <!--search & user info start-->
            <ul class="nav pull-right top-menu">
                <li>
                    <input type="text" class="form-control search" placeholder=" Search">
                </li>
                <!-- user login dropdown start-->
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <img alt="" src="{{URL::to('backend/images/2.png')}}">
                        <span class="username">
                             <?php
                                $admin_name = Session::get('admin_name');
                                $admin_role = Session::get('admin_role');
                                $admin_id = Session::get('admin_id');
                                if($admin_name) {
                                    echo $admin_name;
                                }
                            ?>
                        </span>
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu extended logout">
                        <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                        <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                        <li><a href="{{URL::to('/logout')}}"><i class="fa fa-key"></i> Log Out</a></li>
                    </ul>
                </li>
                <!-- user login dropdown end -->

            </ul>
            <!--search & user info end-->
        </div>
    </header>
    <!--header end-->
    <!--sidebar start-->
    <aside>
        <div id="sidebar" class="nav-collapse">
            <!-- sidebar menu start-->
            <div class="leftside-navigation">
                <ul class="sidebar-menu" id="nav-accordion">
                    <li>
                        <a class="active" href="{{URL::to('/dashboard')}}">
                            <i class="fa fa-dashboard"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-book"></i>
                            <span>Category</span>
                        </a>
                        <ul class="sub">
                            <li><a href="{{URL::to('/add-category')}}">Add new category</a></li>
                            <li><a href="{{URL::to('/all-category')}}">All category</a></li>
                        </ul>

                    </li>
                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-shirtsinbulk"></i>
                            <span>Brand</span>
                        </a>
                        <ul class="sub">
                            <li><a href="{{URL::to('/add-brand')}}">Add new brand</a></li>
                            <li><a href="{{URL::to('/all-brand')}}">All brand</a></li>
                        </ul>

                    </li>
                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-product-hunt"></i>
                            <span>Product</span>
                        </a>
                        <ul class="sub">
                            <li><a href="{{URL::to('/add-product')}}">Add new product</a></li>
                            <li><a href="{{URL::to('/all-product')}}">All product</a></li>
                        </ul>

                    </li>

                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-tag"></i>
                            <span>Promotion</span>
                        </a>
                        <ul class="sub">
                            <li><a href="{{URL::to('/add-sale')}}">Add new promotion</a></li>
                            <li><a href="{{URL::to('/all-sale')}}">All promotion</a></li>
                        </ul>

                    </li>
                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-tag"></i>
                            <span>Order</span>
                        </a>
                        <ul class="sub">
                            @if($admin_role == 2)
                                <li><a href="{{URL::to('/my-order/'.$admin_id)}}">My order</a></li>
                            @else
                            <li><a href="{{URL::to('/all-order')}}">Manage order</a></li>
                            @endif
                        </ul>

                    </li>
                </ul>
            </div>
            <!-- sidebar menu end-->
        </div>
    </aside>
    <!--sidebar end-->
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
            @yield('admin_content')
        </section>
        <!-- footer -->
        <div class="footer">
            <div class="wthree-copyright">
                <p>© 2017 Visitors. All rights reserved | Design by <a href="http://w3layouts.com">W3layouts</a></p>
            </div>
        </div>
        <!-- / footer -->
    </section>
    <!--main content end-->
</section>


<script src="{{asset('backend/js/bootstrap.js')}}"></script>
<script src="{{asset('backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('backend/js/scripts.js')}}"></script>
<script src="{{asset('backend/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('backend/js/jquery.nicescroll.js')}}"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="{{asset('backend/js/jquery.scrollTo.js')}}"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- morris JavaScript -->
<script>

</script>
<!-- calendar -->

<script type="text/javascript" src="{{asset('backend/js/monthly.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            chart30daysorder();
            var chart = new Morris.Bar({
                element: 'chart',
                // Chart data records -- each entry in this array corresponds to a point on
                // the chart.
                // lineColors: ['#e31a0b', '#e3e30b'],
                gridTextColor: [  '#333333'],
                parseTime: false,
                hideHover: 'auto',
                xkey: 'period',

                ykeys: ['sales'],
                labels: ['Sales']
            });

            function chart30daysorder() {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{url('/days-order')}}",
                    method: "POST",
                    dataType: "JSON",
                    data: {
                        _token: _token
                    },

                    success: function(data) {
                        chart.setData(data);
                    }
                });
            }

                $('#btn-dashboard-filter').click(function() {
                    var _token = $('input[name="_token"]').val();
                    var from_date = $('#datepicker').val();
                    var to_date = $('#datepicker2').val();

                    $.ajax({
                        url: "{{url('/filter-by-date')}}",
                        method: "POST",
                        dataType: "JSON",
                        data: {
                            _token: _token,
                            from_date: from_date,
                            to_date: to_date

                        },
                        // dataType:"JSON",
                        success: function(data) {

                            chart.setData(data)
                        }
                    });
                });


            $('.dashboard-filter').change(function() {
                var dashboard_value = $(this).val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{url('/dashboard-filter')}}",
                    method: "POST",
                    dataType: "JSON",
                    data: {
                        dashboard_value: dashboard_value,
                        _token: _token
                    },

                    success: function(data) {
                        chart.setData(data);
                    }
                });

            });

            });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        Morris.Donut({
            element: 'donut-example',
            resize: true,
            colors: ['#F11142', '#4211F1', '#11DBF1', '#11F137', '#F1E611'],


                data: [
                    {label: "Unapproved Order", value: <?php echo $order_0 ?>},
                    {label: "Shipping Order", value:  <?php echo $order_1 ?>},
                    {label: "Completed Order", value:  <?php echo $order_2 ?>},
                    {label: "Canceled Order", value:  <?php echo $order_3 ?>}
                ]

        });

    });
</script>

<script type="text/javascript">
    $(window).load( function() {

        $('#mycalendar').monthly({
            mode: 'event',

        });

        $('#mycalendar2').monthly({
            mode: 'picker',
            target: '#mytarget',
            setWidth: '250px',
            startHidden: true,
            showTrigger: '#mytarget',
            stylePast: true,
            disablePast: true
        });

        switch(window.location.protocol) {
            case 'http:':
            case 'https:':
                // running on a server, should be good.
                break;
            case 'file:':
                alert('Just a heads-up, events will not work when run locally.');
        }

    });
</script>
<!-- //calendar -->
</body>
</html>

