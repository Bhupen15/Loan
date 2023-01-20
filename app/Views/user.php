

<?= $this->extend('templates/template') ?>
<?= $this->section('content') ?>
<?php
$session = \Config\Services::session();

?>
<div><h2>Welcome <?= $session->get('users')['fname']; ?> </h2></div>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="http://localhost/bhupendra/assets/welcome.css">

</head>


<body>
<!-- <button><a href="/apply">Apply</a></button> -->
<!-- <button <a href="/apply" type="button" class="btn btn-outline-primary">Apply</a></button> -->
<a href="/apply" class="btn btn-primary" role="button" >Apply</a>

  <div class="container mt-5">
    <div class="row justify-content-md-center" style="height:80vh">
  

    </div>
  </div>


</body>


</html>
<?= $this->endSection() ?>