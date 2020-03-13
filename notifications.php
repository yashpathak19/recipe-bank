<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Home Page</title>
        <link href='https://fonts.googleapis.com/css?family=Alegreya Sans SC' rel='stylesheet'>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    </head>

    <body>
        <header>
            <?php include 'header.php'?>
        </header>
        <h1>Notifications</h1>
        <div class="card bg-primary text-white">
            <div class="card-body">
                <span>Yash liked your "Pasta recipe"</span>
                <button type="button" class="btn btn-danger">Remove</button>
            </div> 
        </div>
        <div class="card bg-success text-white">
            <div class="card-body">
                <span>Yash commented "This really helped me making Pasta"</span>
                <button type="button" class="btn btn-danger">Remove</button>
            </div>
        </div>
        <div class="card bg-success text-white">
            <div class="card-body">
                <span>Admin commented "This is the best recipe!!"</span>
                <button type="button" class="btn btn-danger">Remove</button>
            </div>
        </div>

        <footer class="page-footer font-small ">
            <?php include 'footer.php'?>
        </footer>
    </body>
</html>
