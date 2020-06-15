<?php
    require_once 'feedCRUD.php';
    $user_id = 1;
    $recipe = new FeedCrud();
    $recipes = $recipe->custom("Select * from recipes where user_id = $user_id");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>List Recipes</title>
        <link href='https://fonts.googleapis.com/css?family=Alegreya Sans SC' rel='stylesheet'>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    </head>

    <body>
        <header class="bg-dark">
            <?php include 'header.php'?>
        </header>
        <main>
            <div class="container">
            <div class="container">
                <h1 class="h1 page-header">Recipes</h1>
                <a href="createRecipe.php" ><button type="button" class="btn btn-outline-primary add-faq-btn">&#10133 Add new Recipe</button></a>
            </div>
                <table class="table table-dark table-hover">
                    <thead>
                        <tr>
                        <th>Recipe Title</th>
                        <th>Category</th>
                        <th>Posted Date</th>
                        <th>Update</th>
                        <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($recipes as $r){
                                echo("
                                    <tr>
                                        <td>".$r['title']."</td>
                                        <td>".$r['category']."</td>
                                        <td>".$r['posted_date']."</td>
                                        <td><a href='updateRecipe.php?id=".$r['id']."'><button type='button' class='btn btn-primary'>Update</button></a></td>
                                        <td><button type='button' class='btn btn-danger' data-toggle='modal' data-target='#delete".$r['id']."'>Delete</button>
                                        </td>
                                    </tr>
                                    <div class='modal fade' id='delete".$r['id']."' tabindex='-1' role='dialog' aria-labelledby='deleterecipe-Title' aria-hidden='true'>
                                        <div class='modal-dialog modal-dialog-centered' role='document'>
                                        <div class='modal-content'>
                                            <div class='modal-header'>
                                            <h5 class='modal-title' id='deleterecipeTitle'>Delete recipe</h5>
                                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                                <span aria-hidden='true'>&times;</span>
                                            </button>
                                            </div>
                                            <div class='modal-body'>
                                            <p class='lead'>Are you sure you want to delete this recipe?</p>
                                            </div>
                                            <div class='modal-footer'>
                                            <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                                            <button type='button' class='btn btn-danger' onclick='deleterecipe(".$r['id'].")'>Delete</button>
                                            </div>
                                        </div>
                                        </div>
                                    </div>      
                                ");
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </main>

        <footer class="page-footer font-small ">
            <?php include 'footer.php'?>
        </footer>
        <script>
            function deleterecipe(id){
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function(){
				if (this.readyState == 4 && this.status == 200) {
					location.reload();  	
				}
			}
			xmlhttp.open("GET", "deleteRecipe.php?id="+id, true);
			xmlhttp.send();
		}
        </script>
    </body>
</html>