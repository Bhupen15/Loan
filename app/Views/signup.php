<?= $this->extend('templates/template') ?>
<?= $this->section('content') ?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Codeigniter Auth User Registration </title>
  <link rel="stylesheet" href="http://localhost/bhupendra/assets/welcome.css">
  <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM="
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"
    integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- <script src="https://www.google.com/recaptcha/api.js" async defer></script> -->
    <style>
      .form-control{
        display: inline !important;
    width: 90% !important;
    margin: 5px !important;
      }
      .btn-dark{
        width: 90% !important;
    margin: 5px !important;
      }
      </style>
</head>

<body>


  <div class="container mt-5">
    <div class="row justify-content-md-center" style="height:85vh">
      <div class="col-5">
        <h2>Register</h2>
        <?php if (isset($validation)): ?>
          <div class="alert alert-warning">
            <?= $validation->listErrors() ?>
          </div>
        <?php endif; ?>

        <form action="<?php echo base_url("signup"); ?>" method="post" id="form">
          <div class="form-group mb-3">
            <input type="text" name="fname" placeholder="First name" class="form-control">
            <span>*</span>
          </div>
          <div class="form-group mb-3">
            <input type="text" name="lname" placeholder="Last name" class="form-control">
            <span>*</span>
          </div>
          <div class="form-group mb-3">
            <input type="number" name="mobile" placeholder="Mobile" class="form-control">
            <span>*</span>
          </div>
          <div class="form-group mb-3">
            <input type="email" name="email" placeholder="Email" class="form-control">
            <span>*</span>
          </div>
          <div class="form-group mb-3">
            <input id="password" type="password" name="password" placeholder="Password" class="form-control">
            <span>*</span>
          </div> 
          <div class="form-group mb-3">
            <input type="password" name="confirmpassword" placeholder="Confirm Password" class="form-control">


          </div>
          <!-- <div class="g-recaptcha" data-sitekey="6Lfp_dIjAAAAAAobizDB9S0Xl3_XqtWvyy_QV7kF"></div> -->
          <div class="d-grid">
            <button type="submit" class="btn btn-dark">Signup</button>
          </div>


        </form>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function () {

      $('#form').validate({
        rules: {
          fname: {
            required: true,
            maxlength: 50,
            minlength: 2,
          },
          lname: {
            required: true,
            maxlength: 50,
            minlength: 2,
          },
          email: {
            required: true,
            maxlength: 100,
            minlength: 6,
          },
          mobile: {
            required: true,
            maxlength: 10,
            minlength: 10,
          },
          password: {
            required: true,
            maxlength: 100,
            minlength: 6,
          },
          confirmpassword: {
            required: true,
            equalTo: "#password",
          }
        },
        messages: {
          fname: {
            maxlength: "First name is too large",
            minlength: "First name must be larger",
          },
          lname: {
            maxlength: "Last name is too large",
            minlength: "Last name must be larger",
          },

          email: {
            maxlength: "Email is too large",
            minlength: "Email must be larger",
          },
          mobile: {
            maxlength: "Mobile number must be of 10 digit",
            minlength: "Mobile number must be of 10 digit",

          },
          password: {
            maxlength: "Password is too large",
            minlength: "Password must be of 6 digit",
          },
          confirmpassword: {
            equalTo: "Password not same",
          }
        },
      });
    });
  </script>
</body>
<!-- <script>

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
</script> -->


</html>
<?= $this->endSection() ?>