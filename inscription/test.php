<?php

$header = "MIME-Version: 1.0\r\n";
$header .= 'From: "studychoice.alwaysdata.net"<pingstudychoice@gmail.com>'."\n";
$header .= 'Content-Type:text/html; charset="utf-8"'."\n";
$header .= 'Content-Transefer-Encoding: 8bits';

$message = '
<html>
	<body>
		<div align="center">mail PHP</div>
	</body>
</html>
';
try{
	mail("maxime.martinez@hotmail.fr","test php", $message, $header);
	echo "envoyé";
}catch(Exception $e){
	echo "fail";
}

?>