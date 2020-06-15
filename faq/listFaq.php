<?php
    require_once 'faqCrud.php';
    $faqObj = new faqCrud();
    $faqs = $faqObj->custom('select *,FaqCatName from faqs inner join faqcategories on faqs.FaqCatID = faqcategories.FaqCatID');
    
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Add Faq</title>
        <link href='https://fonts.googleapis.com/css?family=Alegreya Sans SC' rel='stylesheet'>
        <link rel="stylesheet" type="text/css" href="css/faq.css">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    </head>
    <body>
    <header class="bg-dark">
	<?php include 'header.php'?>
    </header>
        <main class="main-container">
            <div class="container" id="listfaq-header">
                <h1 class="h1 page-header" id="listfaq-heading">Faqs</h1>
                <a href="addFaq.php" ><button type="button" class="btn btn-outline-primary add-faq-btn">&#10133 Add new Faq</button></a>
            </div>
            <div class="container">
                <table class="table table-dark table-hover">
                    <thead>
                        <tr>
                        <th>Question</th>
                        <th>Answer</th>
                        <th>Category</th>
                        <th>Update</th>
                        <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($faqs as $faq){
                                echo("
                                <tr>
                                    <td>".$faq['FaqQtn']."</td>
                                    <td>".$faq['FaqAns']."</td>
                                    <td>".$faq['FaqCatName']."</td>
                                    <td><a href='updateFaq.php?id=".$faq['FaqID']."'><button type='button' class='btn btn-primary'>Update</button></a></td>
                                    <td><button type='button' class='btn btn-danger' data-toggle='modal' data-target='#delete".$faq['FaqID']."'>Delete</button>
                                    </td>
                                </tr>
                                <div class='modal fade' id='delete".$faq['FaqID']."' tabindex='-1' role='dialog' aria-labelledby='deleteFaq-Title' aria-hidden='true'>
                                    <div class='modal-dialog modal-dialog-centered' role='document'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                        <h5 class='modal-title' id='deleteFaqTitle'>Delete Faq</h5>
                                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                            <span aria-hidden='true'>&times;</span>
                                        </button>
                                        </div>
                                        <div class='modal-body'>
                                        <p class='lead'>Are you sure you want to delete this FAQ?</p>
                                        </div>
                                        <div class='modal-footer'>
                                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                                        <button type='button' class='btn btn-danger' onclick='deleteFaq(".$faq['FaqID'].")'>Delete</button>
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

        <?php include 'footer.php'?>
        <script>
            function deleteFaq(id){
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function(){
				if (this.readyState == 4 && this.status == 200) {
					location.reload();  	
				}
			}
			xmlhttp.open("GET", "deleteFaq.php?id="+id, true);
			xmlhttp.send();
		}
        </script>
    </body>
</html>