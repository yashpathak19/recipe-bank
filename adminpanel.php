<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin Panel</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/adminpanel.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body data-spy="scroll" data-target="#myScrollspy" data-offset="1">
<header>
  <?php include 'header.php'?>
</header>
<div class="container-fluid">
  <div class="row">
    <!-- Scrollspy example referenced from https://www.w3schools.com/bootstrap/bootstrap_scrollspy.asp-->
    <nav class="col-sm-3 col-4" id="myScrollspy">
      <ul class="nav nav-pills flex-column">
        <li class="nav-item">
          <a class="nav-link active" href="#section1">My Posts</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#section2">Notifications</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#section3">My Profile</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#section4">Delete My Account</a>
        </li>
      </ul>
    </nav>
    <div class="col-sm-9 col-8">
      <div id="section1">    
        <h1>My Posts</h1>
        <div class="container">
            <table class="table table-dark table-hover">
              <thead>
                <tr>
                  <th>Title</th>
                  <th>Date</th>
                  <th>Author</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>My First Post</td>
                  <td>2020-03-13</td>
                  <td>Admin</td>
                  <td><button type="button" class="btn btn-primary">Edit</button></td>
                  <td><button type="button" class="btn btn-danger">Delete</button></td>
                </tr>
                <tr>
                  <td>My Second Post</td>
                  <td>2020-03-13</td>
                  <td>Admin</td>
                  <td><button type="button" class="btn btn-primary">Edit</button></td>
                  <td><button type="button" class="btn btn-danger">Delete</button></td>
                </tr>
                <tr>
                    <td>My Third Post</td>
                    <td>2020-03-13</td>
                    <td>Admin</td>
                    <td><button type="button" class="btn btn-primary">Edit</button></td>
                    <td><button type="button" class="btn btn-danger">Delete</button></td>
                </tr>
                <tr>
                    <td>My Fourth Post</td>
                    <td>2020-03-13</td>
                    <td>Admin</td>
                    <td><button type="button" class="btn btn-primary">Edit</button></td>
                    <td><button type="button" class="btn btn-danger">Delete</button></td>
                </tr>
                <tr>
                    <td>My Fifth Post</td>
                    <td>2020-03-13</td>
                    <td>Admin</td>
                    <td><button type="button" class="btn btn-primary">Edit</button></td>
                    <td><button type="button" class="btn btn-danger">Delete</button></td>
                </tr>
              </tbody>
            </table>
          </div>
      </div>
      <div id="section2"> 
        <h1>Notifications</h1>
        <div class="container">
            <table class="table table-dark table-hover">
              <thead>
                <tr>
                  <th>Message</th>
                  <th>Date</th>
                  <th>Author</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Yash liked your "Pasta recipe"</td>
                  <td>2020-03-13</td>
                  <td>Yash</td>
                  <td><button type="button" class="btn btn-danger">Delete</button></td>
                </tr>
                <tr>
                    <td>Yash commented "This really helped me making Pasta"</td>
                    <td>2020-03-13</td>
                    <td>Yash</td>
                    <td><button type="button" class="btn btn-danger">Delete</button></td>
                </tr>
                <tr>
                    <td>Admin commented "This is the best recipe!!"</td>
                    <td>2020-03-13</td>
                    <td>Admin</td>
                    <td><button type="button" class="btn btn-danger">Delete</button></td>
                </tr>
              </tbody>
            </table>
          </div>
      </div>        
        <div id="section3"> 
            <h2>My Profile</h2>       
            <form action="/action_page.php">
                <div class="form-group">
                    <label for="fname">First Name:</label>
                    <input type="fname" class="form-control" id="fname">
                    <label for="lname">Last Name:</label>
                    <input type="lname" class="form-control" id="lname">
                </div>
                <div class="form-group">
                    <label for="email">Email address:</label>
                    <input type="email" class="form-control" id="email">
                </div>
                <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input type="password" class="form-control" placeholder="Enter password" id="pwd">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    <div id="section4">
        <h2>Delete Account</h2>         
        <p>This will delete everything including posts, likes and comments. You cannot revert this. Are you sure want to delete your profile?</p>
        <button type="button" class="btn btn-danger">Yes, Delete Everything!</button>
    </div>
  </div>
</div>
<footer class="page-footer font-small ">
  <?php include 'footer.php'?>
</footer>
</body>
</html>
