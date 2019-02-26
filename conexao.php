<?php 

try{
	$pdo = new PDO("mysql:dbname=financeiro;host=localhost","Financeiro_dev", "");
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
	echo "Erro na conexao".$e->getMessage();
	exit;
}

?>