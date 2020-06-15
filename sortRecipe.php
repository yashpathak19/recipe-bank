<?php
    require_once 'feedCrud.php';
    require_once 'websiteCRUD.php';
    $feedObj = new FeedCrud();
    $websiteCRUD = new websiteCRUD();
    $meal = $_POST['meal'];
    $date = $_POST['date'];
    $defaultSql = "select * from recipes";
    $sql = "";
    $response = "";
    if($meal != '0' && $date != '0'){
        $sql = "SELECT * FROM `recipes` where category = '$meal' ORDER BY `recipes`.`posted_date` $date";
    }
     if($meal == '0' && $date != '0'){
        $sql = "SELECT * FROM `recipes` ORDER BY `recipes`.`posted_date` $date";
    }
     if($meal != '0' && $date == '0'){
        $sql = "SELECT * FROM `recipes` where category = '$meal'";
    }
     if($meal == '0' && $date == '0'){
        $sql = "SELECT * FROM `recipes`";
    }
    // if($meal == 0){
    //     if($date == 0 || $date == "asc"){
    //         $sql = "1SELECT * FROM `recipes`
    //         ORDER BY `recipes`.`posted_date` ASC";
    //     }
    //     else if($date != 0 && $date == "desc"){
    //         $sql = "2SELECT * FROM `recipes`
    //         ORDER BY `recipes`.`posted_date` DESC";
    //     }
    // }
    // else{
    //     if($date == 0 || $date == "asc"){
    //         $sql = "3SELECT * FROM `recipes` where category = '$meal'
    //         ORDER BY `recipes`.`posted_date` ASC";
    //     }
    //     else if($date != 0 && $date == "desc"){
    //         $sql = "4SELECT * FROM `recipes` where category = '$meal'
    //         ORDER BY `recipes`.`posted_date` DESC";
    //     }
    // }
    $recipes = $feedObj->custom($sql);
   
    foreach($recipes as $r){
       $response .=  "<div class='card feed-card' style='width: 18rem;'>
            <a href='showRecipe.php?id=".$r['id']."'>
                <img class='card-img-top' src='upload/".$r['recipe_img']."' alt='Card image cap'>
                <div class='card-body'>
                    <h5 class='card-title'>".$r['title']."</h5>
                    <p class='card-text'>Likes ".$websiteCRUD->getTotalLikes($r['id'])."</p>
                </div>
            </a>
        </div>
        ";
    }
    echo($response);
            
    
?>