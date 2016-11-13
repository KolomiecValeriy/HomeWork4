<?php

$connector = new Controllers\Connector($config);

$sth = $connector->getConnection();
$sql = 'SELECT department.name, university.name FROM department RIGHT JOIN university ON (department.university_id=university.id)';
	
$query = $connector->getConnection()->query($sql);
$queryResult = $query->fetchAll(PDO::FETCH_BOTH);
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Кафедры</title>
	</head>
	<body>
	<a href="index.php">Назад</a>
		<h1>Университеты</h1>
		<table border=1>
			
			<?php
			$count = 1;
			echo "<tr><th>#</th><th>Кафедра</th><th>Университет</th></tr>";
			
			foreach ($queryResult as $row) {
				echo "<tr><td>{$count}</td><td>{$row[0]}</td><td>{$row[1]}</td></tr>";
				$count++;
			}
			
            ?>
		</table>
	</body>
</html>
