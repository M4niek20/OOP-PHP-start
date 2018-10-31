<?php
class SiteDb
{
	protected $polaczenie;
	protected $menu=array();
	public $id="home";
	protected $content;
	protected $info = array();

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
		return $this->content['article'];
	}
}

class SiteInEdition extends SiteDb{

	public function showArticle()
	{	
		if(!empty($_GET['id'])) $this->id=$_GET['id'];
		if(!empty($_GET['edit'])) $this->id=$_GET['edit'];
		$q = "select article from content where menu='".$this->id."'";
		$w = $this->polaczenie->query($q);
		$this->content = $w->fetch_array();
		return $this->content['article'];
	}

	public function edytuj(){
		$zawartosc = $_POST['edit'];
		$q = "update `content` set `article`='$zawartosc' where `menu`='$this->id'";
		$this->polaczenie->query($q);
	}
	//przedefiniuj funkcję showArticle() na taką jak w klasie nadrzędnej 
	// ale wzbogaconą o przycisk/link do trybu edycji po naciśnięciu którego 
	//artykuł będzie ładował sie do textarea
	
	
}

?>