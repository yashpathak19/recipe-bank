<?php
    require_once 'feedCrud.php';
    $feedObj = new FeedCrud();
    $recipes = $feedObj->listRecipes('recipes');
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="utf-8"/>
    <title>Feed</title>
    <link href='https://fonts.googleapis.com/css?family=Alegreya Sans SC' rel='stylesheet'>
    <!---->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
   <!---->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src="js/feed.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
    <header class="bg-dark">
        <?php include 'header.php'?>
    </header>
    <main>
        <div class="container mt-3">
            <!-- The Modal -->
            <div class="modal fade" id="myModal">
                <div class="modal-dialog">
                <div class="modal-content">
                
                    <!-- Modal Header -->
                    <div class="modal-header">
                    <h4 class="modal-title">Notifications</h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    </div>
                    
                    <!-- Modal body -->
                    <div class="modal-body" id="modal-body">
                    Modal body..
                    </div>
                    
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <form action="notifications.php" method="post">
                            <input type="submit" class="btn btn-info" value="Open Notifications"/>
                        </form>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                    
                </div>
                </div>
        </div>
        <div class="container">
            <form id="sorting-form" method="get">
                <div class="row sorting-container">
                    <div class="sorting-dd">
                        <select id="sortmeal" onchange="this.form.submit()">
                            <option value="">Sort by meals</option>
                            <option value ="appetizers">Appetizers</option>
                            <option value="main">Main Course</option>
                            <option value="deserts">Deserts</option>
                            <option value="beverages">Bevarages</option>
                        </select>
                    </div>   
                    <div class="sorting-dd">
                        <select id="sortpopular" onchange="this.form.submit()">
                            <option value="">Sort by popularity</option>
                            <option value="mp">Most Popular</option>
                            <option value="lp">Least Popular</option>
                        </select>
                    </div>
                    <div class="sorting-dd">
                        <select id="sortdate" onchange = "this.form.submit()">
                            <option value="">Sort by date</option>
                            <option value="n">Newest</option>
                            <option value="o">Oldest</option>
                        </select>
                    </div>
                </div>
            </form>
        </div>
        <div class="container feed-main-container" id="feed-main-container" style="margin: 1em auto">
            <?php
                foreach($recipes as $r){
                    echo("
                        <div class='card feed-card' style='width: 18rem;'>
                            <a href='showRecipe.php?id=".$r['id']."'>
                                <img class='card-img-top' src='upload/".$r['recipe_img']."' alt='Card image cap'>
                                <div class='card-body'>
                                    <h5 class='card-title'>".$r['title']."</h5>
                                </div>
                            </a>
                        </div>
                    ");
                }
            ?>
        </div>
        
    </main>
    <footer class="page-footer font-small ">
        <?php include 'footer.php'?>
    </footer>
    <script>
            window.onload = main;
            function main(){
                document.getElementById('sorting-form').onsubmit = sortRecipes;
            }
            
            function sortRecipes(){
                console.log('form submitted');
                var feed = document.getElementById('feed-main-container');  
                var mealDD = document.getElementById('sortmeal');  
                var popularDD = document.getElementById('sortpopular');
                var dateDD = document.getElementById('sortdate');    
                // var xmlhttp = new XMLHttpRequest();
                // var feed = document.getElementById('feed-main-container');  
                // var chgDD = document.getElementById(sortParam); 
                // var chgDDValue = chgDD.options[chgDD.selectedIndex].value;

                // if(sortParam == 'sortmeal'){
                //     xmlhttp.open("GET", "sortRecipe.php?sortparam=sortmeal&value="+(chgDDValue), true);
                //     xmlhttp.send();
                // }
                // if(sortParam == 'sortpopular'){
                //     xmlhttp.open("GET", "sortRecipe.php?sortparam=sortpopular&value="+(chgDDValue), true);
                //     xmlhttp.send();
                // }
                // if(sortParam == 'sortdate'){
                //     xmlhttp.open("GET", "sortRecipe.php?sortparam=sortdate&value="+(chgDDValue), true);
                //     xmlhttp.send();
                // }
                // xmlhttp.onreadystatechange = function(){
                //     if (this.readyState == 4 && this.status == 200) {
                //         feed.innerHTML = this.responseText;
                //     }
                // }  
            }
    </script>
</body>
</html>
