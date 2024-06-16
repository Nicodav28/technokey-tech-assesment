<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TECHNOKEY</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">

</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Technokey</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link active" aria-current="page" href="#">Flights</a>
                        <div class="d-flex ">
                            <a class="nav-link" href="#">Logout</a>
                        </div>

                    </div>
                </div>
            </div>
        </nav>
    </header>

    <div class="container mt-5">
        <?php include_once "../app/views/{$view}.php" ?>
    </div>


    <footer>
        <script src="js/bootstrap.min.js"></script>
    </footer>

</body>

</html>