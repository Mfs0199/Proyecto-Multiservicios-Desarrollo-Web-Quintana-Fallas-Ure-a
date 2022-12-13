<?php include("PHP/database.php"); ?>

<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<title>Multiservicios S.A</title>

<link rel='icon' href='IMG/LogoPagina2.png' type='image/png'/ >

<link rel="stylesheet" href="CSS/estilo.css">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v6.0.0-beta1/css/all.css">
<body>

<div class="ms-div-menubar">
<a href="#inicio" class="ms-menu-item ms-boton"><b>Multiservicios S.A</b></a>

<div style="float: right;">
<a href="#qnssomos" class="ms-menu-item ms-boton">Quiénes somos</a>
<a href="#servicios" class="ms-menu-item ms-boton">Servicios</a>
<a href="#galeria" class="ms-menu-item ms-boton">Galería</a>
<a href="#experiencia" class="ms-menu-item ms-boton">Experiencia</a>
<a href="#contacto" class="ms-menu-item ms-boton">Contáctenos</a>
</div>
</div>

<div id="inicio" class="ms-contenido" style="max-width:1564px">

<div class="ms-mostrar-contenido ms-contenido" style="max-width:1500px;">
<img src="" alt="MultiserviciosSA" style="min-height: 600px;min-width: 100%;">
<div class="ms-tituloimg">
<h1>
  <span><img src="IMG/LogoPagina1.png" style="width: 400px;"></span>
</h1>
</div>
</div>

<!-- Quiénes somos -->
<div id="qnssomos" class="ms-contenedor">
<h2>Quiénes somos</h2>
<p>Somos una compañía que cuenta con amplia experiencia en la ejecución de proyectos, calidad y con la capacidad de enfrentar nuevos retos los cuales nos impulsa a seguir creciendo como constructora para así mejorar las condiciones de vida de los costarricenses

trabajamos para atender las necesidades específicas, todo esto lo desarrollamos regidos por la responsabilidad social que tenemos con el país y una relación de respeto con nuestros clientes y empleados.

La Constructora Multiservicios S.A es una empresa dedicada a la construcción de toda clase de edificios, proyectos de construcción, edificaciones, obras de urbanismo, mantimientos y remodelaciones.
</p>

<div class="ms-fila-padding" style="text-align: center;">

<div class="ms-col-img"
style="text-align: left;
    width: 25%;
    float: none;
    display: inline-table;">
<img src="IMG/LogoPagina2.png" style="width: 200px;height: 200px;">
<h3>Visión</h3>
<p>Ser una empresa que ofrezca a nuestros clientes, confianza y tranquilidad juto a los procesos constructivos de cada proyecto</p>
</div>

<div class="ms-col-img"
style="text-align: left;
    width: 25%;
    float: none;
    display: inline-table;">
<img src="IMG/LogoPagina2.png" style="width: 200px;height: 200px;">
<h3>Misión</h3>
<p>Proporcionar servicios integrales de asesoría y construcción a fin de resolver sus necesidades</p>
</div>

</div>

</div>

<!-- Servicios -->
<div id="servicios" class="ms-contenedor">
<h2>Servicios</h2>
<p>Construimos casas, locales comerciales y ofrecemos a nuestros clientes toda la asesoría necesaria para la realización de su proyecto, junto con consultoría, Diseño y planos, Nos especializamos en proyectos de remodelación acumulando una experiencia lograda a través de más de 20 años de trabajo y el personal adecuado para ofrecer acabados de calidad.
</p>

<?php

$Servicios = mysqli_query($BDMSSA,"SELECT IDSERVICIO, NOMBRE, UUID() GUID FROM SERVICIOS ORDER BY 1");
$Cont = 0;
while ($RServicio = mysqli_fetch_array($Servicios)) {

if($Cont==0){
  ?>
<div class="ms-fila-padding">
  <?php
}

?>

<div class="ms-col-img">
<div class="ms-mostrar-contenido">
  <div class="ms-name-img"><?php echo $RServicio['NOMBRE'] ?></div>
  <img src="FILES/Servicios/<?php echo $RServicio['IDSERVICIO']; ?>.png?V=<?php echo $RServicio['GUID']; ?>" style="width: 450PX;height: 300px;">
</div>
</div>

<?php

$Cont++;

if($Cont==3){
  $Cont=0;
  ?>
</div>
  <?php
}

}

 ?>

<!--<div class="ms-fila-padding">

<div class="ms-col-img">
<div class="ms-mostrar-contenido">
  <div class="ms-name-img">Construcción</div>
  <img src="IMG/construccion.jpg" style="width:100%">
</div>
</div>

<div class="ms-col-img">
<div class="ms-mostrar-contenido">
  <div class="ms-name-img">Remodelación</div>
  <img src="IMG/remodelaciones.jpg" style="width:100%">
</div>
</div>

<div class="ms-col-img">
<div class="ms-mostrar-contenido">
  <div class="ms-name-img">Mantenimientos preventivos y correctivos</div>
  <img src="IMG/mantenimiento.jpeg" style="width:100%">
</div>
</div>

</div>-->

</div>

<!-- Galería -->
<div id="galeria" class="ms-contenedor">
<h2>Galería Proyectos Realizados</h2>

<div class="ms-fila-padding">

<div class="ms-col-img">
<div class="ms-mostrar-contenido">
  <div class="ms-name-img">Construcción</div>
  <img src="IMG/trabajos1.jpg" style="width:100%">
</div>
</div>

<div class="ms-col-img">
<div class="ms-mostrar-contenido">
  <div class="ms-name-img">Remodelación</div>
  <img src="IMG/trabajos2.jpg" style="width:100%">
</div>
</div>

<div class="ms-col-img">
<div class="ms-mostrar-contenido">
  <div class="ms-name-img">Construcción</div>
  <img src="IMG/trabajos3.jpg" style="width:350px; height: 300px">
</div>
</div>

<div class="ms-col-img">
<div class="ms-mostrar-contenido">
  <div class="ms-name-img">Remodelación</div>
  <img src="IMG/trabajos4.jpg" style="width:100%">
</div>
</div>

<div class="ms-col-img">
<div class="ms-mostrar-contenido">
  <div class="ms-name-img">Mantenimiento</div>
  <img src="IMG/trabajos5.jpg" style="width:100%">
</div>
</div>

<div class="ms-col-img">
<div class="ms-mostrar-contenido">
  <div class="ms-name-img">Construcción</div>
  <img src="IMG/trabajos1.jpg" style="width:100%">
</div>
</div>

</div>

</div>


<!-- Experiencia -->
<div id="experiencia" class="ms-contenedor">
<h2>Experiencia</h2>

<div class="ms-col-img">
<div class="ms-mostrar-contenido">

   <img src="IMG/deloro.jpg" style="width: 200px;height: 200px;">
</div>
</div>

<div class="ms-col-img">
<div class="ms-mostrar-contenido">

   <img src="IMG/CATSA.jpg" style="width: 200px;height: 200px;">
</div>
</div>

<div class="ms-col-img">
<div class="ms-mostrar-contenido">

   <img src="IMG/novelteak.png" style="width: 200px;height: 200px;">
</div>
</div>



</div>


</div>

<!-- Contacto -->
<div id="contacto" class="ms-contenedor">

<h2> Contacto</h2>
<p>Solicitar más información</p>

<form action="index.php#contacto" method="post">
<input type="hidden" name="OP" value="1">
<input class="ms-inputs" type="text" placeholder="Nombre" required name="Nombre" maxlength="150">
<input class="ms-inputs" type="email" placeholder="Correo" required name="Correo" maxlength="100">
<input class="ms-inputs" type="text" placeholder="Asunto" required name="Asunto" maxlength="150">
<textarea name="Comentario" class="ms-inputs" rows="8" cols="80" maxlength="500" required></textarea>
<button class="ms-boton" style="color: #fff!important;background-color: #000!important;margin-bottom:10px;" type="submit">
<i class="fa fa-paper-plane"></i> Enviar Mensaje
</button>
</form>
<?php

include('PHP/database.php');

if(isset($_POST['OP'])){

?>
<p style="background: #78cee8;padding: 15px;border-radius: 15px;">
<?php

$Nombre = $_POST['Nombre'];
$Correo = $_POST['Correo'];
$Asunto = $_POST['Asunto'];
$Comentario = $_POST['Comentario'];

$Res = mysqli_query($BDMSSA,"INSERT INTO CONTACTOS_USUARIO (NOMBRE, CORREO, ASUNTO, COMENTARIO) VALUES ('$Nombre','$Correo','$Asunto','$Comentario')");

if(!$Res)
{
    echo "No se ha podido enviar el mensaje";

}else{

  include 'PHP/email.php';

  $Email = new Email();

  $Res = $Email->EnviarCorreo("Mensaje de comentario","Estimad@s, <br> Se ha recibido un mensaje por parte de $Nombre, con el correo $Correo, con el siguiente asunto: <br> $Asunto <br> Con el siguiente comentario: <br> $Comentario",'multiserviciossa123@hotmail.com','','',array());

  echo "Se ha enviado el mensaje correctamente";
}

mysqli_close($BDMSSA);

?>
 </p>
<?php

}

 ?>

</div>

<footer>
<p>Desarrollado por Desarrollo web Quintana Fallas Ureña </p>
</footer>

</body>
</html>
