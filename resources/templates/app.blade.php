<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="csrf-token" content={{csrf_token()}}>
        <!-- Application Title -->
        <title>
            @section('title')
            Adaptive Carbon Systems
            @show
        </title>

        <link href="/css/bootstrap.min.css" rel="stylesheet">        
        <link href="/css/vendor/bootstrap-datetimepicker.min.css" rel="stylesheet">
        <link href="/css/table.css" rel="stylesheet">        
        <link href="/css/carbon.css" rel="stylesheet">
        <link href="/css/custom.css" rel="stylesheet">                
        <link href="/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">        
        <link href="/css/vendor/typeahead.css" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
                <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
            <![endif]-->
    </head>

    <body id="page-top" class="index">      
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="">               
                <div class="navbar-header page-scroll ">
                    @if (Auth::check())
                    <div class="container">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> 
                            <span class="sr-only">Toggle navigation</span> 
                            <span class="icon-bar"></span> 
                            <span class="icon-bar"></span> 
                            <span class="icon-bar"></span> 
                        </button>
                        <a class=" navbar-brand page-scroll" href="#page-top"><img src="/img/carbonLOGO.png" alt="Carbon Credit"></a>
                        <div class="userarea">Welcome <span class="username">{{ Auth::user()->name }}</span><br>
                            <a href="/user/logout"> Logout</a> 
                        </div>
                    </div>                    
                    @endif
                </div> 

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <div class="container">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="hidden"> <a href="#page-top"></a> </li>
                            <li>
                                <button class="btn btn-primary clsClear" data-toggle="modal" href="/dashboard/buy" data-target="#acsModal">Buy</button>
                            </li>
                            <li>
                                <button class="btn btn-primary clsClear" data-toggle="modal" href="/dashboard/sell" data-target="#acsModal">Sell</button>
                            </li>
                            <li>
                                <button class="btn btn-primary clsClear" data-toggle="modal" href="/dashboard/transfer" data-target="#acsModal">Transfer</button>
                            </li>
                            <li>
                                <button class="btn btn-primary clsClear" data-toggle="modal" href="/dashboard/grant" data-target="#acsModal">Grant</button>
                            </li>
                            <li>
                                <button class="btn btn-primary clsClear" data-toggle="modal" href="/dashboard/park" data-target="#acsModal">Park</button>
                            </li>
                        </ul>
                    </div>
                </div>                
            </div>            
        </nav>
        <section id="services">
            <div class="container">
                <div class="row" >
                    <div class="col-lg-12">
                        <h2 class="section-heading">My Available Carbon Credits: <span id="availableCarbonCredit">0</span></h2>
                    </div>
                </div>
                @yield('content')
        </section>
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-md-6"> <span class="copyright">Copyright &copy; Carbon Credit 2015</span> </div>
                    <div class="col-md-6">
                        <ul class="list-inline quicklinks">
                            <li><a href="#">Privacy Policy</a> </li>
                            <li><a href="#">Terms of Use</a> </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>         

        <div class="modal fade" id="acsModal" tabindex="-1" role="dialog" aria-labelledby="AcsCarbon" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content"></div>
            </div>   
        </div>

        <script type="text/javascript" src="/js/vendor/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="/js/vendor/bootstrap.js"></script>        
        <script type="text/javascript" src="/js/vendor/moment.min.js"></script>
        <script type="text/javascript" src="/js/vendor/bootstrap-datetimepicker.js"></script>        
        <script type="text/javascript" src="/js/vendor/bootstrap3-typeahead.js"></script>
        <script type="text/javascript" src="/js/vendor/jquery.validate.js"></script>       
        <script type="text/javascript" src="/js/vendor/jquery.easing.min.js"></script> 
        <script type="text/javascript" src="/js/acs.js"></script>
        <script type="text/javascript" src="/js/agency.js"></script>
    </body>
</html>
