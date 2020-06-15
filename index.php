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

        <main>
            <!--Code referred from https://mdbootstrap.com/snippets/jquery/ascensus/135508 -->
            <div class="container my-4">
            <!--Carousel Wrapper-->
            <div id="popular-item-carousel" class="carousel slide carousel-multi-item" data-ride="carousel">
            <!--Slides-->
            <div class="carousel-inner" role="listbox">

                <!--First slide-->
                <div class="carousel-item active">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card mb-2">
                                <div class="card-img-container">
                                    <img class="card-img-top carousel-img-top" src="images/chicken.jpg" alt="Card image cap">
                                </div>
                                <div class="card-body">
                                    <h4 class="card-title">Most Liked Chicken Recipe</h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 clearfix d-none d-md-block">
                            <div class="card mb-2">
                                <div class="card-img-container">
                                    <img class="card-img-top" src="images/pulao.jpg" alt="Card image cap">
                                </div>
                                <div class="card-body">
                                    <h4 class="card-title">Best South Indian Pulao</h4> 
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 clearfix d-none d-md-block">
                            <div class="card mb-2">
                                <div class="card-img-container">
                                    <img class="card-img-top" src="images/matarPaneer.jpg" alt="Card image cap">
                                </div>
                                <div class="card-body">
                                    <h4 class="card-title">Recipe Of the Week</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/.First slide-->
                <!--Second slide-->
                <div class="carousel-item">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card mb-2">
                                <div class="card-img-container">
                                    <img class="card-img-top" src="images/gulabJamun.jpg" alt="Card image cap">
                                </div>
                                <div class="card-body">
                                    <h4 class="card-title">Most Searched Dessert Recipe</h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 clearfix d-none d-md-block">
                            <div class="card mb-2">
                                <div class="card-img-container">
                                    <img class="card-img-top" src="images/sheerKhurma.jpg" alt="Card image cap">
                                </div>
                                <div class="card-body">
                                    <h4 class="card-title">Festive Dessert Special</h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 clearfix d-none d-md-block">
                            <div class="card mb-2">
                                <div class="card-img-container">
                                    <img class="card-img-top" src="images/besanBarfi.jpg" alt="Card image cap">
                                </div>
                                <div class="card-body">
                                    <h4 class="card-title">Our Favourite</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/.Second slide-->

            </div>
            <!--/.Slides-->
            </div>
            <!--/.Carousel Wrapper-->


            </div>  
        </main>
		<div>
			<?php 
				require_once 'subscription.php';
			?>
		</div>
        <footer class="page-footer font-small ">
            <?php include 'footer.php'?>
        </footer>
    </body>
</html>