
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>CGPA TRACKER</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="css/bootstrap_4.1.0.min.css">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="css/malihu-custom-scrollbar-plugin-jquery-3.1.5.min.css">

    <!-- Font Awesome JS -->
    <script defer src="js/fontawesome-solid-5.0.13.js"></script>
    <script defer src="js/fontawesome-5.0.13.min.js"></script>

</head>

<body>

    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div id="dismiss">
                <i class="fas fa-arrow-left"></i>
            </div>

            <div class="sidebar-header">
                <h3>CGPA TRACKER</h3>
            </div>

            <ul class="list-unstyled components text-center">
                <h3>Manu</h3>
                <div class="line"></div>
                <li> 
                    <a href="" id="home"><strong>Home</strong></a>
                </li>
                <li>
                    <a href="" id="result">Result</a>

                    <!-- <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">Pages</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="">Page 1</a>
                        </li>
                        <li>
                            <a href="">Page 2</a>
                        </li>
                        <li>
                            <a href="">Page 3</a>
                        </li>
                    </ul> -->
                </li>
                <li>
                    <a href="" id="result_spring">Result of spring</a>
                </li>
                <li>
                    <a href="">Contact</a>
                </li>
            </ul>

        </nav>

        <!-- Full page  -->
        <div id="content">
            <!-- navbar  -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>
                        <span>Toggle Manu</span>
                    </button>
                    <!-- <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button> -->
                    <h2>
                        <div id="page_name">
                        Home
                        </div>
                    </h2>
                    
                    <!-- <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="">Page</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="">Page</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="">Page</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="">Page</a>
                            </li>
                        </ul>
                    </div> -->
                </div>
            </nav>
            <!-- page content -->
            <div id="container">

            </div>

            <div id="errors"></div>

            
        </div>
    </div>
    <div class="overlay"></div>

    <!--------------------     scripts    ----------------------->
    <!-- jQuery-->
    <!-- <script src="js/jquery-3.3.1.min.js" ></script> -->
    <script src="js/jquery-3.3.1.js" ></script>
    <!-- Popper.JS -->
    <script src="js/popper-1.14.0.min.js" ></script>
    <!-- Bootstrap JS -->
    <script src="js/bootstrap-4.1.0.min.js" ></script>
    <!-- jQuery Custom Scroller CDN -->
    <script src="js/malihu-custom-scrollbar-plugin-jquery-3.1.5.min.js"></script>
    <!-- style script -->
    <script src="js/styleScript.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            
            $('#container').load('../views/home.php');
            
            $('#home').click(function(e){
                e.preventDefault();
                $('#container').load('../views/home.php',function(){
                    $("#sidebarCollapse").click();
                });
            });

            $('#result').click(function(e){
                e.preventDefault();
                $("#sidebarCollapse").click();
                $('#container').load('../views/result.php');
            });

            $('#result_spring').click(function(e){
                e.preventDefault();
                $("#sidebarCollapse").click();
                $('#container').load('../views/result_spring.php');
            });

        });
    </script>

    

</body>

</html>