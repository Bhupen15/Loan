<?= $this->extend('templates/template') ?>
<?= $this->section('content') ?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="http://localhost/bhupendra/assets/welcome.css">
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <title>Codeigniter Login with Email/Password </title>
</head>


<body>
  <div class="container mt-5">
    <div class="row justify-content-md-center" style="height:85vh">
      <div class="col-5">

        <h2>Login</h2>


        <form action="<?php echo base_url("dashboard"); ?>" method="post" id="form">
          <div class="form-group mb-3">
            <input type="email" name="email" placeholder="Email" class="form-control">
          </div>
          <div class="form-group mb-3">
            <input type="password" name="password" placeholder="Password" class="form-control">
          </div>
          <div class="g-recaptcha mb-2" data-sitekey="6Lfp_dIjAAAAAAobizDB9S0Xl3_XqtWvyy_QV7kF"></div>

          <div class="d-grid">
            <button type= "submit" class="btn btn-dark">Signin</button>
          </div>
        </form>
      </div>

    </div>
  </div>
</body>



<script>

document.getElementById("form").addEventListener("submit", function (evt) {
        var response = grecaptcha.getResponse();
        if (response.length == 0) {
            //reCaptcha not verified
            alert("please verify you are humann!");
            evt.preventDefault();
            return false;
        }
        //captcha verified
        //do the rest of your validations here

});
</script>

</html>
<?= $this->endSection() ?>