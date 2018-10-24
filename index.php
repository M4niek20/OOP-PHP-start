<?php
	require_once('core.php');
	$p=new mysqli ("localhost","root","","sitedb");
	$s=new SiteDB($p);
?>

<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<?= $s->showTitle().$s->showKeywords();?>
		halo to ja xD
		</head>
	<body>
		<?php
		$a=$s->showMenu();
		foreach($a as $wiersz):?>
        	<a href="index.php?id=<?= $wiersz["menu"] ?>"><li><?= $wiersz["menu"] ?></li></a>
		<?php
		endforeach;
			echo '<img src="'.$s->showLogo().'" alt="logo"/>';
		?>
		<?=$s->showArticle();?>
	</body>
</html>