<?php
  require_once 'faqCrud.php';
  $faqId = $_GET['id'];
  $faqObj = new faqCrud();
  $faqCats = $faqObj->list('faqcategories');
  $errors = [];
  $faq = $faqObj->showFaq($faqId);
  $validation = "";
  if(isset($_POST['faq-submit'])){
    $faqQtn = $_POST['faqQtn'];
    $faqAns = $_POST['faqAns'];
    $faqCat = $_POST['faqCatDD'];
    $faq = new faqCrud(); 
    if($faqQtn !== "" && $faqAns !== "" && $faqCat!==""){
      $count = $faq->updateFaq($faqId,$faqQtn,$faqAns,$faqCat);
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
        <title>Update Faq</title>
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
        <main>
          <div class="container">
            <div>
                <h1 class="h1 page-header">Update Faq</h1>
                <a href="listFaq.php" ><button type="button" class="btn btn-outline-primary add-faq-btn">List Faq</button></a>
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
            <form method="post">
                <div class="form-group">
                  <label for="faqQtn">Question:</label>
                  <input type="text" class="form-control" id="faqQtn" name="faqQtn" placeholder="Enter question here" value="<?=$faq[0]['FaqQtn']?>">
                </div>
                <div class="form-group">
                    <label for="faqAns">Answer:</label>
                    <textarea class="form-control" id="faqAns" name="faqAns" rows="3"><?=$faq[0]['FaqAns']?></textarea>
                </div>
                <div class="form-group">
                  <label for="faqCatDD">Example select</label>
                  <select class="form-control" id="faqCatDD" name="faqCatDD">
                  <option value="0">__Select one__</option>
                    <?php
                      foreach($faqCats as $faqCat){
                          if($faqCat['FaqCatID'] == $faq[0]['FaqCatID']){
                                $selected = "selected";
                          }
                          else{
                              $selected = "";
                          }
                        echo("
                          <option $selected value='".$faqCat['FaqCatID']."'>".$faqCat['FaqCatName']."</option>
                        ");
                      }
                    ?>
                  </select>
                </div>
                <button type="submit" class="btn btn-primary" name="faq-submit">Update</button>
              </form>
          </div>
          
        </main>
        <?php include 'footer.php'?>
    </body>
</html>