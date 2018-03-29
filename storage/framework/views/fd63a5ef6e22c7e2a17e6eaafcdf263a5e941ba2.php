<html>

<head></head>

<body style="border: 1px solid #222d32; background: #222d32">
	<h1 style="background: #222d32;padding: 5px;color:white">ClienBot</h1>

	<div style="font-size: 15px;background: white; padding:10px;margin-top: -60px;">
		<h2>Hola <?php echo e($user_name); ?></h2>
		<p>Hemos recibido una solicitud de recuperacion de contrasena en tu cuenta de Clienbot, si tu no has realizado esta accion, por favor, escribenos a <a href="support@clienbot.com">support@clienbot.com</a></p>
		<p>De lo contrario, para continuar con el proceso de cambiar tu contrasena, haz clic en el siguiente enlace o copialo en la barra de navegacion de tu explorador</p>
		<a href="http://<?php echo e($server); ?>/reset?token=<?php echo e($token); ?>&id=<?php echo e($user_id); ?>">http://<?php echo e($server); ?>/reset?token=<?php echo e($token); ?>&id=<?php echo e($user_id); ?></a>
	</div>
	<hr>
	<span style="color: white; padding: 2px">Clienbot 2018 &copy; Todos los derechos reservados</span>
	
</body>

</html>

