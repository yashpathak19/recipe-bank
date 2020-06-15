<?php
	require_once 'faqCrud.php';
	$faqObj = new faqCrud();
	$faqs = $faqObj->list('faqs');
	$faqCats = $faqObj->list('faqcategories');
	

?>

<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Faq</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
    <link href='https://fonts.googleapis.com/css?family=Alegreya Sans SC' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="css/faq.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
</head>
<body>
<header>
	<?php include 'header.php'?>
</header>
<main>
	<div class="Container">
		<div class="row faq-main-container">
			<div id="cat-container">
				<div class="card">
					<div class="card-header">
						Faq Categories
					</div>
					<ul class="list-group list-group-flush">
						<?php
							foreach($faqCats as $faqCat){
								echo("
									<li class='list-group-item' onclick='displayFaq(".$faqCat['FaqCatID'].")'>".$faqCat['FaqCatName']."</li>
								");
							}
						?>
					</ul>
				</div>
			</div>
			<div id="faq-container">
				<div id="faq-inner-container">
					<?php
						foreach($faqs as $faq){
							echo("
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
							");
						}
					?>
				</div>
			</div>
		</div>
	</div>
</main>
<footer class="page-footer font-small ">
	<?php include 'footer.php'?>
</footer>

<script>
		function displayFaq(id){
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function(){
				if (this.readyState == 4 && this.status == 200) {
						document.getElementById('faq-inner-container').innerHTML = this.responseText;
						console.log(this.responseText);
					}
			}
			xmlhttp.open("GET", "displayFaq.php?id="+id, true);
			xmlhttp.send();
		}
</script>
</body>
</html>