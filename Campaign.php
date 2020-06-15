<?php
interface Campaign{
	public function emailContent();
}

class Content {
	public function subscribersEmail(Campaign $campaign){
		$campaign->emailContent();
	}
}

class PopularPosts implements Campaign{
	public function emailContent(){
		echo "PopularPosts conetnt";
	}
}

class PopularUser implements Campaign{
	public function emailContent(){
		echo "PopularUser content";
	}
}

class MostShared implements Campaign{
	public function emailContent(){
		echo "MostShared content";
	}
}
?>