<?php

//Descomente si se usa fetch
//header("Content-type: application/json; charset=utf-8");
$_POST = json_decode(file_get_contents("php://input"), true);
//HAsta acá solo si es fetch

$headers = 'MIME-Version: 1.0'. "\r\n" ;
$headers .= 'Content-type: text/html; charset=utf-8'. "\r\n" ;
$headers .= "From: POSTMASTER <postmaster@corrego69.com>". "\r\n" ;
//$headers .= 'To: Carlos <carlos.orrego.diaz@gmail.com>'. "\r\n" ;
$headers .= "X-Mailer: PHP/".phpversion();
//$headers .= 'Cc: birthdayarchive@example.com';
//$headers .= 'Bcc: birthdaycheck@example.com';

$mensaje = "
<html>
<head>
  <title>Has sido contactado</title>
</head>
<body>
  <p>Antecedentes de contacto desde pagina personal NO ES SPAM</p>
  <table>
    <tr>
      <th>Nombre</th><td>{$_POST['first_name']} {$_POST['last_name']}</td>
    </tr>
    <tr>
      <th>Correo</th><td>{$_POST['email']}</td>
    </tr>
    <tr>
      <th>Fono</th><td>{$_POST['telephone']}</td>
    </tr>
	<tr>
      <th>Detalle</th><td>{$_POST['comments']}</td>
    </tr>
  </table>
</body>
</html>
"; 

$mail    = 'carlorregod@gmail.com';
$asunto  = "Formulario de contacto de {$_POST['first_name']} {$_POST['last_name']}";

try{
	if (!mail($mail, $asunto, $mensaje, $headers)) {
		echo json_encode(array('contactado'=>'error'));
	}else{
		echo json_encode(array('contactado'=>'ok'));
	}
}catch(\Exception $e){
	echo json_encode(array('contactado'=>$e->getMessage()));
}



