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
		if(!empty($_GET['id'])) $this->id=$_GET['id'];
		if(!empty($_GET['edit'])) $this->id=$_GET['edit'];
		if(!empty($_GET['delete'])) $this->id=$_GET['delete'];

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
		$q = "select article from content where menu='".$this->id."'";
		$w = $this->polaczenie->query($q);
		$this->content = $w->fetch_array();
		return $this->content['article'];
	}

	public function showLogin()
	{
		if(!isset($_SESSION['user'])) require_once('login.html');
		else {
		echo "twój login: " . $_SESSION['user'] . "<a href='index.php?id=logout'>Wyloguj</a>";
		}
	}
}

class SiteInEdition extends SiteDb{

	public function editArticle()
	{
		$zawartosc = $_POST['edit'];
		$q = "update `content` set `article`='$zawartosc' where `menu`='".$this->id."'";
		$this->polaczenie->query($q);
	}

	public function logout(){
		session_destroy();
		header("Location: index.php");
	}

	public function addArticle(){
		
		$menu = $_POST['menu'];
		if($menu != ""){
		$article = $_POST['article'];
		$date = date ("Y-m-d");
		echo $date;
		$q = "insert into `content`(`menu`, `article`, `date`) VALUES ('$menu','$article','$date')";
		$this->polaczenie->query($q);
		header("Location: index.php");
		}
	}

	public function deleteArticle(){
		$q = "delete from `content` where `menu`='$this->id'";
		$this->polaczenie->query($q);
		header("Location: index.php");
	}
}	
?>