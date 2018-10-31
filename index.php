<?php
	require_once('core.php');
	$p=new mysqli ("localhost","root","","sitedb");
	session_start();
	if(isset($_SESSION['user'])){
		if($_SESSION['user']=="admin")
		$s = new SiteInEdition($p);
		echo "twój login: ".$_SESSION['user'];
	}
	else
	$s=new SiteDB($p);
?>

<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<?= $s->showTitle().$s->showKeywords();?>
	</head>
	<body>
		
		<?php
		if(!isset($_SESSION['user']))require_once('login.html');
		$a=$s->showMenu();
		foreach($a as $wiersz):?>
        	<a href="index.php?id=<?= $wiersz["menu"] ?>"><li><?= $wiersz["menu"] ?></li></a>
		<?php
		endforeach;
			echo '<img src="'.$s->showLogo().'" alt="logo"/>';
		?>
		<hr>

		<?php
		if(isset($_SESSION['user'])){
			if($_SESSION['user']=="admin"){
		if(isset($_POST['edit'])){
			$s->edytuj();
		}
		if(isset($_GET['edit'])){
			echo "<form action='index.php' method='POST'><textarea name='edit'>";
		}
		echo $s->showArticle();
		if(isset($_GET['edit'])){
			echo "</textarea><input type='submit'>";
		}
		else{
			echo "<a href='index.php?edit=".$s->id."'>edytuj</a>";
		}
	}
}else echo $s->showArticle();

		?>
	</body>
</html>