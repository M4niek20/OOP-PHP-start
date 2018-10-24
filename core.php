<?php
class SiteDb
{
	private $polaczenie;
	private $menu=array();
	private $id="home";
	private $content;
	private $info = array();

	public function __construct($p)
	{
		$this->polaczenie=$p;    
		if ($this->polaczenie->connect_error) die("Błąd połączenia:".$polaczenie->connect_error);
		
		$q3 = "select * from info";
		$w3 = $this->polaczenie->query($q3);
		$this->info = $w3->fetch_array();
	}
	
	public function showMenu()
	{
		$q = "select menu from content";
		$w = $this->polaczenie->query($q);
		return $w;
	}

	public function showTitle() 
	{
		return "<title>".$this->info["title"]."</title>\n";
	}

	public function showKeywords() 
	{
		return "<meta name='keywords' content='".$this->info["keywords"]."'>\n";
	}

	public function showLogo() 
	{
		return $this->info["logo"];
	}
	
	public function showArticle()
	{	
		if(!empty($_GET['id'])) $this->id=$_GET['id'];
		$q = "select article from content where menu='".$this->id."'";
		$w = $this->polaczenie->query($q);
		$this->content = $w->fetch_array();
		return "<hr>".$this->content['article'];
	}
}
?>