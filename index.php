<?php
	//BAZA
	require_once('core.php');
	$p = new mysqli ("localhost","root","","sitedb");
	
	//SESJE
	session_start();
	if(isset($_SESSION['user'])){
		if($_SESSION['user'] == "admin") $s = new SiteInEdition($p);
	}
	else
	$s = new SiteDB($p);
	if($s->id == 'logout') $s->logout();

	//DODAWANIE ARTYKUŁU
	if(isset($_POST['menu']))$s->addArticle();

	//USUWANIE ARTYKUŁU
	if(isset($_GET['delete']))$s->deleteArticle();
	
?>

<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="style.css"/>
		<script src="script.js"></script>
		<?= $s->showTitle().$s->showKeywords();?>
	</head>
	<body>
		<header>
			<div  id="logo"><img src="<?=$s->showLogo()?>" alt="logo"/></div><br/>
			<div id="baner">MARIAN BLOG</div>
			<div id="log">
			<?php 
			if(!isset($_SESSION['user'])):
				require_once('login.html');
			else:
			?>
				
				Zalogowany: <?= $_SESSION['user']?>
				<a href='index.php?id=logout'>Wyloguj</a>
			<?php endif; ?>
			</div>
			</header>
			<div id="menu">
			<?php
			$a=$s->showMenu();
			foreach($a as $wiersz):
			?>
			<a href="index.php?id=<?= $wiersz["menu"] ?>"><li><?= $wiersz["menu"] ?></li></a>
			<?php
			endforeach;
			if(isset($_SESSION['user'])):
				if($_SESSION['user']=="admin"):
			?>
			<li id="add">Dodaj</li>
			<div id="formAddArticle">

				<form action = "index.php" method="POST">
					<label>Tytuł</label><br/>
					<input type="text" name="menu"/><br/>
					<label>Treść</label><br/>
					<textarea name="article">
					</textarea><br/>
					<input type="submit" value="Dodaj Artykuł"/>
				</form>
				
			</div>
				<?php endif; endif; ?>
			</div>
		<article>
		<?php
		
		if(isset($_SESSION['user'])):
			if($_SESSION['user']=="admin"):
			if(isset($_POST['edit']))$s->editArticle();
				if(isset($_GET['edit'])):
		?>			<!--##--HTML--##-->
					<form action='index.php?id=<?=$_GET['edit']?>' method='POST'>
					<textarea name='edit'><?=$s->showArticle();?></textarea>
					<input type='submit'>
					</form>
		<?php
				else:
		?>			<!--##--HTML--##-->
					<div id="title">
					<span><?=$s->id?></span>
					<a href='index.php?edit=<?=$s->id?>'>edytuj</a>
					<a href='index.php?delete=<?=$s->id?>'>usuń</a>
					</div>
					<div id="content">
					<?=$s->showArticle();?>
					
		<?php
				endif;
			endif;
		 else: ?>
		<div id="title">
		<span><?=$s->id?></span>
		</div>
		<div id="content">	
		<?=$s->showArticle()?>
		<?php
			endif;
		?>
			</div>
		</article>
	</body>
</html>