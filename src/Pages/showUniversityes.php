<?php

$connector = new Controllers\Connector($config);

$sth = $connector->getConnection();
$sql = 'SELECT * FROM university';
	
$query = $connector->getConnection()->query($sql);
$queryResult = $query->fetchAll(PDO::FETCH_BOTH);
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Университеты</title>
	</head>
	<body>
	<a href="index.php">Назад</a>
		<h1>Университеты</h1>
		<table border=1>
			
			<?php
			$count = 1;
			echo "<tr><th>#</th><th>Университет</th><th>Город</th><th>Сайт</th></tr>";
			
			foreach ($queryResult as $row) {
				echo "<tr><td>{$count}</td><td>{$row[1]}</td><td>{$row[2]}</td><td>{$row[3]}</td></tr>";
				$count++;
			}
			
            ?>
		</table>
	</body>
</html>
