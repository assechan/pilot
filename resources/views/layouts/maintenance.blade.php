<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Pilot Cargo Chain</title>

    <!-- Styles -->
    <link rel="icon" href="/images/icon.ico">
    <link href="/css/app.css" rel="stylesheet">
    <link href= "/js/select2/select2.css" rel = "stylesheet">  
    <link rel="stylesheet" href="/js/jqueryDatatable/jquery.dataTables.min.css">
    <link rel="stylesheet" href="/toaster/toastr.css">
    <link rel="stylesheet" href="/js/jqueryUI/jquery-ui.css">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <link href="/sidebar/css/simple-sidebar.css" rel="stylesheet">

    @stack('styles')

    <!-- Scripts -->

    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
            ]) !!};
        </script>

    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-default navbar-fixed-top" id="navtop">
                <div class="navbar-header">
                    <!-- Branding Image -->
                    <a class="navbar-brand" id="menu-toggle" href="#menu-toggle">
                        <img src="/images/burger.png">
                    </a>
                    <!-- <a class="navbar-brand" style="color: #fff;"><img src="/images/pilotlogo.png" id="logo"></a> -->
                    <a class="navbar-brand" style="color: #fff;" id="vert">Hauling Services Management System</a>
                </div>
                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                        <li><a href="{{ url('/login') }}" id="useracc">Login</a></li>
                        <li><a href="{{ url('/register') }}" id="useracc">Register</a></li>
                        @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ url('/logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                    @endif
                </ul>
            </div>
        </nav>
    </div>
    <br>
    <br>
    <div id="wrapper" id="sidebar">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <!-- <li class="sidebar-brand" id="sidebrand">
                    <a href="#">
                        <img src="/images/pilotlogo.png" id="logo">
                    </a>
                </li> -->
                <li>
                    <br>
                    <a href="Dashboard.html"><i class="fa fa-dashboard"></i>&nbsp;&nbsp;Dashboard</a>
                </li>
                <li>
                    <a data-toggle="collapse" href="#collapse1"><i class="fa fa-exchange"></i>&nbsp;&nbsp;Transactions</a>
                </li>
                <div id="collapse1" class="pane;-collapse collapse">
                    <ul class="list-group" style="list-style-type: circle;">
                        <li>
                            <a href = "{{ route('consignee.index') }}"  class = "consignee"><i class="fa fa-user"></i>&nbsp;&nbsp;Consignee</a>
                        </li>
                        <li>
                            <a href = "{{ route('quotation.index') }}"  class = "quotation"><i class="fa fa-print"></i>&nbsp;&nbsp;Quotation</a>
                        </li>
                        <li>
                            <a href = "{{ route('contracts.index') }}" class = "contracts"><i class="fa fa-file-text-o"></i>&nbsp;&nbsp;Contract</a>
                        </li>
                        <li>
                            <a href = "{{ route('brokerage.index') }}"  class = "brokerage"><i class="fa fa-table"></i>&nbsp;&nbsp;Brokerage</a>
                        </li>
                        <li>
                            <a href = "{{ route('trucking.index') }}" class="delivery"><i class="fa fa-truck"></i>&nbsp;&nbsp;Delivery</a>
                        </li>
                        <li id="frstgrp">
                            <a href="{{ route('view.index') }}" class = "class-billing"><i class="fa fa-money"></i>&nbsp;&nbsp;Billing and Payment</a>
                        </li>
                    </ul>
                </div>
                <li>
                    <a data-toggle="collapse" href="#collapse2" class="maintenance"><i class="fa fa-wrench"></i>&nbsp;&nbsp;Maintenance</a>
                </li>
                <div id="collapse2" class="pane;-collapse collapse">
                    <ul class="list-group" style="list-style-type: circle;">
                        <li>
                            <a href = "{{ route('brokerage_fee.index') }}"  class = "class-brokerage-fee"><i class="fa fa-circle"></i>&nbsp;&nbsp;Brokerage Fee</a>
                        </li>
                        <li>
                            <a href = "{{ route('cds_fee.index') }}"  class = "class-cds-fee"><i class="fa fa-circle"></i>&nbsp;&nbsp;CDS Fee</a>
                        </li>
                        <li>
                            <a href = "{{ route('ipf_fee.index') }}"  class = "class-ipf-fee"><i class="fa fa-circle"></i>&nbsp;&nbsp;IPF</a>
                        </li>
                        <li>
                            <a href = "{{ route('vat_rate.index') }}"  class = "class-vat-rate"><i class="fa fa-circle"></i>&nbsp;&nbsp;VAT Rate</a>
                        </li>
                        <li>
                            <a href = "{{ route('exchange_rate.index') }}"  class = "class-exchange-rate"><i class="fa fa-circle"></i>&nbsp;&nbsp;Exchange Rate</a>
                        </li>
                        <li>
                            <a href = "{{ route('vehicletype.index') }}"  class = "class-vehicle-type"><i class="fa fa-circle"></i>&nbsp;&nbsp;Vehicle Type</a>
                        </li>
                        <li>
                            <a href = "{{ route('vehicle.index') }}"  class = "class-vehicle"><i class="fa fa-circle"></i>&nbsp;&nbsp;Vehicle</a>
                        </li>
                        <li>
                            <a href = "{{ route('location_province.index') }}"  class = "class-province"><i class="fa fa-circle"></i>&nbsp;&nbsp;Province</a>
                        </li>
                        <li>
                            <a href = "{{ route('location_city.index') }}"  class = "class-city"><i class="fa fa-circle"></i>&nbsp;&nbsp;City</a>
                        </li>
                        <li>
                            <a href = "{{ route('location.index') }}"  class = "location"><i class="fa fa-circle"></i>&nbsp;&nbsp;Location</a>
                        </li>
                        <li>
                            <a href = "{{ route('container_type.index') }}"  class = "class-container-type"><i class="fa fa-circle"></i>&nbsp;&nbsp;Container</a>
                        </li>
                        <li>
                            <a href = "{{ route('standard_arearates.index') }}"  class = "class-area-rates"><i class="fa fa-circle"></i>&nbsp;&nbsp;Area Rates </a>
                        </li>
                        <li>
                            <a href = "{{ route('charge.index') }}"  class = "class-charges"><i class="fa fa-circle"></i>&nbsp;&nbsp;Charges </a>
                        </li>
                        <li>
                            <a href = "{{ route('billing.index') }}"  class = "class-billing"><i class="fa fa-circle"></i>&nbsp;&nbsp;Bills</a>
                        </li>
                        <li>
                            <a href = "{{ route('contract_template.index') }}"  class = "class-contract-template"><i class="fa fa-circle"></i>&nbsp;&nbsp;Contract Template</a>
                        </li>
                        <li>
                            <a href = "{{ route('quotation_template.index') }}"  class = "class-quotation-template"><i class="fa fa-circle"></i>&nbsp;&nbsp;Quotation Template</a>
                        </li>
                    </ul>
                </div>
                <li>
                    <a href="{{ route('queries.index') }}"><i class="fa fa-list"></i>&nbsp;&nbsp;Queries</a>
                </li>
                <li>
                    <a data-toggle="collapse" href="#collapse3" class="class-reports"><i class="fa fa-bar-chart"></i>&nbsp;&nbsp;Reports</a>
                </li>
                <div id="collapse3" class="panel-collapse collapse">
                    <ul class="list-group" style="list-style-type: circle;">
                        <li>
                            <a href = "{{ route('shipment.index') }}"  class = "class-shipment"><i class="fa fa-circle"></i>&nbsp;&nbsp;Shipment Report</a>
                        </li>
                        <li>
                            <a href = "{{ route('delivery.index') }}"  class = "class-del_rep"><i class="fa fa-circle"></i>&nbsp;&nbsp;Delivery Report</a>
                        </li>
                    </ul>
                </div>
                <li>
                    <a href="{{ route('utilities.index') }}" class="utilities"><i class="fa fa-gear"></i>&nbsp;&nbsp;Utilities</a>
                </li>
            </ul>
        </div>

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    @yield('content')
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
    </div>



    <!-- Scripts -->
    <script src="/js/app.js"></script>
    <script type="text/javascript" src = "/js/jquery.validate.js"></script>
    <script type="text/javascript" charset="utf8" src="/js/jqueryDatatable/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8" src="/toaster/toastr.js"></script>
    <script type="text/javascript" charset="utf8" src="/js/jqueryUI/jquery-ui.js"></script>
    <script  type = "text/javascript" charset = "utf8" src="/js/jqueryValidate/additional-methods.js"></script>  
    <script  type = "text/javascript" charset = "utf8" src="/js/inputMask/jquery.inputmask.bundle.js"></script> 
    <script  type = "text/javascript" charset = "utf8" src="/js/select2/select2.full.js"></script> 
    


    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
        $(document).on('show.bs.modal', '.modal', function () {
            var zIndex = 1040 + (10 * $('.modal:visible').length);
            $(this).css('z-index', zIndex);
            setTimeout(function() {
                $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
            }, 0);
        });

        

        $('.money_er').inputmask("numeric", { 
            radixPoint: ".", 
            groupSeparator: ",", 
            digits: 7, 
            autoGroup: true, 
            rightAlign: true, 
            
            
        }); 

        
        $('.money').inputmask("numeric", { 
            radixPoint: ".", 
            groupSeparator: ",", 
            digits: 2, 
            autoGroup: true, 
            rightAlign: true, 
            removeMaskOnSubmit:true, 
        });


        function formatNumber(n) { 
            var currency = "Php "; 
            return currency +  n.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"); 
        }

        function formatNumber_s(n) { 
            var currency = "$ "; 
            return currency +  n.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"); 
        } 

        function format_container_maxweight(n) { 
            var unit = " kgs"; 
            return n.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + unit; 
        } 
        function format_container_size(n) { 
            var unit = "-footer"; 
            return n.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + unit; 
        } 

    </script>
    @stack('scripts')
</body>
</html>
