<?php
  require_once 'faqCrud.php';
  $faqObj = new faqCrud();
  $faqCats = $faqObj->list('faqcategories');
  $errors = [];
  $faqQtn=$faqAns=$faqCat="";
  if(isset($_POST['faq-submit'])){
    $faqQtn = $_POST['faqQtn'];
    $faqAns = $_POST['faqAns'];
    $faqCat = $_POST['faqCatDD'];
    $faq = new faqCrud(); 
    if($faqQtn !== "" && $faqAns !== "" && $faqCat!==""){
      $count = $faq->addFaq($faqQtn,$faqAns,$faqCat);
      if($count){
         header("Location: listFaq.php");
      }
      else {
          echo "problem adding a student";
      }
    }  
    else{
      if($faqQtn == ""){
        $errors[] = "Question field is empty";
      }
      if($faqAns == ""){
        
        $errors[] = "Answer field is empty";
      }
      if($faqCat == ""){
        $errors[] = "Select a category";
      }
      
    }  
  }
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
        <?php include 'header.php'?>
        <main class="main-container">
          <div class="container">
            <div>
              <h1 class="h1 page-header">Add new faq</h1>
              <a href="listFaq.php" ><button type="button" class="btn btn-outline-primary add-faq-btn" >List Faq</button></a>
            </div>
            <div class="error">
                <ul>
                    <?php
                        foreach($errors as $err){
                        echo("<li class='lead error'>$err</li>");
                        }
                    ?>
                </ul>
              </div>
            <form method="post" class="crud-form">
              <div class="form-group">
                <label for="faqCatDD">FAQ Category</label>
                <div class="row">
                  <div>
                    <select class="form-control" id="faqCatDD" name="faqCatDD">
                      <option value="">__Select one__</option>
                      <?php
                        foreach($faqCats as $Cat){
                          if($faqCat == $Cat['FaqCatID'] ){
                            $selected = 'selected';
                          }
                          else{
                            $selected = "";
                          }
                          echo("
                            <option value='".$Cat['FaqCatID']."' $selected>".$Cat['FaqCatName']."</option>
                          ");
                        }
                      ?>
                    </select>
                  </div>
                  <button type="button" class="btn btn-md btn-outline-primary add-faq-btn" data-toggle='modal' data-target='#addFaqCat' style="margin-top:0; margin-left:0.5em">&#10133 Add new Category</button> 
                </div>
              </div>              
              <div class="form-group">
                <label for="faqQtn">Question:</label>
                <input type="text" class="form-control" id="faqQtn" name="faqQtn" placeholder="Enter question here" value="<?=$faqQtn?>">
              </div>
              <div class="form-group">
                  <label for="faqAns">Answer:</label>
                  <textarea class="form-control" id="faqAns" name="faqAns" rows="3"><?=$faqAns?></textarea>
              </div>
              <button type="submit" class="btn btn-primary" name="faq-submit">Submit</button>
            </form>
          </div>

          <div class="modal fade" id="addFaqCat" tabindex="-1" role="dialog" aria-labelledby="addFaqCatModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="addFaqCatModalLabel">Add Category</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form method="post">
                    <div class="form-group">
                      <label for="recipient-name" class="col-form-label">Category Name:</label>
                      <input type="text" class="form-control" id="newFaqCatName" name="newFaqCatName">
                    </div>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary" onclick='addFaqCat()'>Add</button>
                </div>
              </div>
            </div>
          </div>               
        </main>
        <?php include 'footer.php'?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script>
          function addFaqCat(){
            newFaqCatName = $("#newFaqCatName").val();
            if(newFaqCatName !== ""){
              response = $.ajax({
                type: "POST",
                url: 'addFaqCat.php',
                data: {faqCatName: newFaqCatName},
                success: function(data){
                  location.reload();
                }
              });
            }
          }
        </script>
    </body>
</html>