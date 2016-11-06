<?php

$connector = new Controllers\Connector($config);

$sth = $connector->getConnection();
$sql = 'SELECT * FROM university';
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Университет</title>
	</head>
	<body>
	<a href="index.php">Назад</a>
		<h1>Университеты</h1>
		<table border=1>
			<tr>
				<th>Название</th><th>Город</th><th>Сайт</th>
			</tr>
			<?php
            foreach ($connector->getConnection()->query($sql) as $row) {
                echo "<tr><td>{$row['name']}</td><td>{$row['city']}</td><td>{$row['site']}</td></tr>";
            }
            ?>
		</table>
	</body>
</html>
