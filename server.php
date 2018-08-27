<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>INFORMACION DE VARIABLES DE SERVIDOR</title>
</head>

<body>
<?php 

foreach($_SERVER as $n => $v){

	echo $n." >>> ".$v."<br />";


}
?>
</body>
</html>