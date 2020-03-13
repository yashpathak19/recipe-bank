<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Sign Up Form</title>
        <link href='https://fonts.googleapis.com/css?family=Alegreya Sans SC' rel='stylesheet'>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    </head>

    <body>
        <header>
            <?php include 'header.php'?>
        </header>
        <!--To do: validation-->
        <!-- bootstrap login card ref: https://codepen.io/amin20/details/ExxaVLa-->
        <div class="container py-5">
          <div class="row">
              <div class="col-md-12">
                  <h2 class="text-center text-white mb-4">Sign Up </h2>
                  <div class="row">
                      <div class="col-md-6 mx-auto">
                          <div class="card rounded-0">
                              <div class="card-header">
                                  <h3 class="mb-0">Sign Up</h3>
                              </div>
                              <div class="card-body">
                                  <form class="form" role="form" autocomplete="off" id="userSignup" novalidate="" method="POST">
                                      <div class="form-group">
                                          <label for="firstname">Firstname</label>
                                          <input type="text" class="form-control form-control-lg rounded-0" name="firstname" id="firstname" required>
                                          <div class="invalid-feedback">Please provide firstname</div>
                                      </div>
                                      <div class="form-group">
                                          <label for="lastname">Lastname</label>
                                          <input type="text" class="form-control form-control-lg rounded-0" name="lastname" id="lastname" required>
                                          <div class="invalid-feedback">Please provide lastname</div>
                                      </div>
                                      <div class="form-group">
                                          <label for="email">Email</label>
                                          <input type="text" class="form-control form-control-lg rounded-0" name="email" id="email" required>
                                          <div class="invalid-feedback">Please provide Email!</div>
                                      </div>
                                      <div class="form-group">
                                          <label for="password">Password</label>
                                          <input type="password" class="form-control form-control-lg rounded-0" id="password" required>
                                          <div class="invalid-feedback">Please provide password</div>
                                      </div>
                                      <button type="submit" class="btn btn-success btn-lg float-right" id="login">Sign Up</button>
                                  </form>
                              </div>
                          </div>
                      </div>
                  </div>      
              </div>
          </div>
      </div>
        <footer class="page-footer font-small ">
            <?php include 'footer.php'?>
        </footer>
    </body>
</html>
