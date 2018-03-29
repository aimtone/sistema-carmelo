<html>

<head></head>

<body style="border: 1px solid #222d32; background: #222d32">
	<h1 style="background: #222d32;padding: 5px;color:white">ClienBot</h1>

	<div style="font-size: 15px;background: white; padding:10px;margin-top: -60px;">
		<h2>Hola <a style="text-decoration: none; color:gray" href="mailto:<?php echo e($mail_address); ?>"><?php echo e($mail_address); ?></a></h2>
		<p>Te he enviado esta solicitud por que quiero que te unas a mi Equipo en Clienbot</p>
		<p>Haz clic en el siguiente enlace para aceptar la solicitud</p>
		<a href="http://localhost/clienbot/panel/final/account.html?token=<?php echo e($token); ?>">http://localhost/clienbot/panel/final/account.html?token=<?php echo e($token); ?></a>
	</div>
	<hr>
	<span style="color: white; padding: 2px">Clienbot 2018 &copy; Todos los derechos reservados</span>
	
</body>

</html>

