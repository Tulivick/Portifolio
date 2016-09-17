<?php session_start();
$path = $_SERVER['DOCUMENT_ROOT'];
include $path."/conn/connection.php";
$stmt = $conn->prepare('SELECT * from categories');
$stmt->execute();
$categories = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-BR">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Henrique Rozada - Portfolio</title>

		<link rel="shortcut icon" type="image/x-icon" href="/Imagens/favicon.ico">
		
		<!-- CSS files -->
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="/style.css"/>
		
		<!-- JavaScript files -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<script src="/script.js"></script>
	</head>
	<body>
		<header>
			<h1 class="text-center">Henrique Rozada</h1>
		</header>
		<nav class="navbar navbar-inverse">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand image-logo" href="/index.php"><img src="/Imagens/HR.png" alt="Logo HR" /></a>
				</div>
				<div class="collapse navbar-collapse" id="myNavbar">
					<ul class="nav navbar-nav">
						<li <?php if($_SERVER['PHP_SELF'] == "/index.php"){echo 'class="active"';}?>><a href="/index.php">Home</a></li>
                                                <?php foreach ($categories as $category):?>
                                                <li <?php if(isset($_GET['cid']) && htmlspecialchars($_GET['cid']) == $category['id']){echo 'class="active"';}?>><a href="<?php echo "/category.php?cid=".$category['id']?>"><?php echo $category['name']?></a></li>
                                                <?php endforeach;?>
						<li <?php if($_SERVER['PHP_SELF'] == "/about.php"){echo 'class="active"';}?>><a href="/about.php">Sobre</a></li>
						<li <?php if($_SERVER['PHP_SELF'] == "/contato.php"){echo 'class="active"';}?>><a href="/contato.php">Contato</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
					<?php if(!isset($_SESSION['email'])):?>
						<li><a href="/login.php"><span class="glyphicon glyphicon-log-in"></span> Entrar</a></li>
					<?php else:?>
						<li><a href="/dashboard.php"><span class="glyphicon glyphicon-home"></span> Minha Conta</a></li>
						<li><a href="/logout.php"><span class="glyphicon glyphicon-log-out"></span> Sair</a></li>
					<?php endif;?>
					</ul>
				</div>
			</div>
		</nav>