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
        <link href="/css/carbon.css" rel="stylesheet">
        <link href="/css/custom.css" rel="stylesheet">                
        <link href="/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">        

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
                <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
            <![endif]-->
    </head>
    <body id="loginPage" class="index">     
        <nav class="navbar navbar-default navbar-fixed-top">
            <div>                 
                <div class="navbar-header page-scroll ">
                    <div class="container">
                        <a class=" navbar-brand page-scroll" href="#page-top"><img src="/img/carbonLOGO.png" alt="Carbon Credit"></a>
                    </div>
                </div>               
            </div>            
        </nav>               
        @yield('content')       
        <script type="text/javascript" src="/js/vendor/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="/js/vendor/bootstrap.js"></script>                
        <script type="text/javascript" src="/js/agency.js"></script>
    </body>
</html>
