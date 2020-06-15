<?php
    require_once 'faqCrud.php';
    $catId = $_GET['id'];
    $faqObj = new faqCrud();
    $faqs = $faqObj->showCatFaqs($catId);
    $responseText = "";
    foreach($faqs as $faq){
        $responseText .= "
        <div class='accordion' id='faq-inner-container'>
            <div class='card'>
                <div class='card-header' id='faqQtn-container'>
                    <h5 class='mb-0'>
                    <button class='btn btn-link' type='button' data-toggle='collapse' data-target='#faq".$faq['FaqID']."' aria-expanded='true' aria-controls='collapseOne'>
                        ".$faq['FaqQtn']."
                    </button>
                    </h5>
                </div>
        
                <div id='faq".$faq['FaqID']."' class='collapse' aria-labelledby='faqQtn-container' data-parent='#faq-inner-container'>
                    <div class='card-body'>
                        ".$faq['FaqAns']."
                    </div>
                </div>
            </div>
        </div>
        ";
    }
    echo($responseText);
?>