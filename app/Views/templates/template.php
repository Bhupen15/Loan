<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
   

<nav class="navbar navbar-expand-lg" style="background-color: black;">
    <div class="container-fluid">
        <a class="navbar-brand" style="color:azure;" href="#">Loan Website</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link" style="color:azure;" aria-current="page" href="<?= site_url("home"); ?>">Home</a>
                <a class="nav-link" style="color:azure;" href="<?= site_url("signin"); ?>">Login</a>
                <a class="nav-link" style="color:azure;" href="<?= site_url("signup"); ?>">Register</a>

            </div>
        </div>
    </div>
</nav>
<?php
// This is the main content partial


$this->renderSection('content');
?>


<footer style="text-align:center;">This is footer &copy Bhupendra</footer>