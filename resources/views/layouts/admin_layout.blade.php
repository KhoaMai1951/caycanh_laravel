<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="referrer" content="strict-origin"/>

    <title>Web ADMIN - @yield('title')</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">


    <style>
        #page-container {
            position: relative;
            min-height: 100vh;
            display: block;
            overflow: auto;
        }

        .container {
            position: relative;
            min-height: 100vh;
            display: block;
            overflow: auto;
        }

        .footer {

            /*clear: both;*/
            /*position: relative;*/
            /*height: 200px;*/
            /*margin-top: -200px;*/
            /*margin-top: -200px;*/

            position: fixed;
            bottom: 0;
        }

        #main-container {
            min-height: 800px;
        }

        .required:after {
            content: " *";
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div id="page-container">
    <!-- Navbar -->
    @section('navbar')
        @component('components.system_admin.navbar')

        @endcomponent
    @show

    <div id="main-container" class="container-fluid ml-2 pl-0">
        <div class="row">
            <!-- Main content -->
            <div class="col-lg-12 px-0">
                <div class="mt-2 container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    @section('footer')
        @component('components.system_admin.footer')

        @endcomponent
    @show

</div>

</body>
</html>
