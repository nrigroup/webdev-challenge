<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        {{-- title change for each new or by default it remains "Webdev" --}}
        <title>
            @yield('title', 'Webdev')
        </title>
        <style>
            .custom-or{
                padding: 1rem;
            }
            .custom-upload-file{
                text-align: center;
                background-color: #cbd2d0;
                width: 100%;
                padding: 1rem;
            }
            .custom-upload-file:hover{
                border: 4px dashed #343a40;
            }
            .custom-upload-file .custom-file-input{
                display: none;
            }
            .nav-pills .nav-link.active, .nav-pills .show>.nav-link{
                background-color: #343a40;
            }
        </style>
    </head>
    <body>

        {{-- Navbar Content --}}
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Inventory Manager</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse navbar-left" id="navbarText">
            </div>
        </nav>

        {{-- Page Content area --}}
        <div class="container-fluid p-2">
            @yield('content')
        </div>

    </body>

    {{-- Footer  --}}
    <footer>
        @yield('footer_content')
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </footer>
    {{-- Footer  --}}
</html>
