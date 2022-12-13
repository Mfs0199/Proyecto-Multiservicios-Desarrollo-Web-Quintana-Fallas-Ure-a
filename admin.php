<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<title>Multiservicios S.A</title>

<link rel='icon' href='IMG/LogoPagina2.png' type='image/png'/ >

<link rel="stylesheet" href="CSS/estilo.css">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v6.0.0-beta1/css/all.css">

<style media="screen">

table th{
  background: #000;
  color:#fff;
  padding: 10px;
}

</style>

<body>

<?php

session_start();

  include("PHP/database.php");

if(isset($_GET['OP'])){
  $OP = $_GET['OP'];
}else{
  $OP = null;
}

        include 'PHP/email.php';

        $Email = new Email();

if(isset($_SESSION['IDUSUARIO'])){

  ?>
        <div class="ms-div-menubar">
        <a href="admin.php" class="ms-menu-item ms-boton"><b>Multiservicios S.A - Administrador</b></a>

        <div style="float: right;">
        <!--<a class="ms-menu-item ms-boton"><?php echo $_SESSION["NOMCOMPLETO"]; ?></a>-->
        <a href="admin.php?OP=1" class="ms-menu-item ms-boton">Comentarios</a>
        <a href="admin.php?OP=2" class="ms-menu-item ms-boton">Servicios</a>
        <a href="admin.php?OP=4" class="ms-menu-item ms-boton">Usuarios</a>
        <a href="admin.php?OP=3" class="ms-menu-item ms-boton">Cambiar contraseña</a>
        <a href="PHP/logout.php" class="ms-menu-item ms-boton">Cerrar sesión</a>
        </div>
        </div>

        <div class="ms-contenido" style="max-width:1564px;min-height: 75px;">
        </div>

  <?php

  if($OP == 1 || $OP == null){

      if(isset($_GET['IdContacto']) || isset($_POST['IdContacto'])){

      if(isset($_GET['IdContacto'])){
        $IdContacto = $_GET['IdContacto'];
      }else if(isset($_POST['IdContacto'])){
        $IdContacto = $_POST['IdContacto'];
      }

      if(isset($_POST['Edit']) && isset($IdContacto)){

        $Respuesta = $_POST['Respuesta'];
        $IDUsuario = $_SESSION['IDUSUARIO'];

        $Res = mysqli_query($BDMSSA,"UPDATE CONTACTOS_USUARIO SET RESPUESTA='$Respuesta', IDUSUARIO_EDITA='$IDUsuario', FMODIFICACION = NOW() WHERE IDCONTACTO = $IdContacto");

        $SQLCTC = mysqli_query($BDMSSA,"SELECT CORREO, ASUNTO, COMENTARIO FROM CONTACTOS_USUARIO WHERE IDCONTACTO = '$IdContacto'");

        $RCTC = mysqli_fetch_array($SQLCTC);

        $Correo = $RCTC['CORREO'];
        $Asunto = $RCTC['ASUNTO'];
        $Comentario = $RCTC['COMENTARIO'];

        $Email->EnviarCorreo("Respuesta Multiservicios SA: $Asunto","$Respuesta <br> A continuación su comentario: <br> $Comentario",$Correo,'','',array());

        header('Location: admin.php?OP=1&Res='.$Res);

      }

    }


      ?>

    <div class="ms-contenido">
    <table width="100%" border="1" cellspacing="0">
      <thead>
        <tr>
          <th>ID</th>
          <th>Fecha de creación</th>
          <th>Usuario</th>
          <th>Correo</th>
          <th>Asunto</th>
          <th>Comentario</th>
          <th>Respuesta</th>
          <th>Usuario que modificó</th>
          <th>Fecha de modificación</th>
          <th>Opciones</th>
        </tr>
      </thead>
      <tbody>

        <?php

        $Contactos = mysqli_query($BDMSSA,"SELECT IDCONTACTO,NOMBRE,A.CORREO,ASUNTO,COMENTARIO,RESPUESTA,FCREACION,B.NOMCOMPLETO USUARIO_EDITA ,FMODIFICACION
    FROM CONTACTOS_USUARIO A
    LEFT JOIN USUARIOS B ON B.IDUSUARIO = A.IDUSUARIO_EDITA");

        while ($RContactos = mysqli_fetch_array($Contactos)) {
          ?>
    <tr>
      <td style="text-align:center"><?php echo $RContactos['IDCONTACTO']; ?></td>
      <td style="text-align:center"><?php echo $RContactos['FCREACION']; ?></td>
      <td style="text-align:center"><?php echo $RContactos['NOMBRE']; ?></td>
      <td style="text-align:center"><?php echo $RContactos['CORREO']; ?></td>
      <td style="text-align:center"><?php echo $RContactos['ASUNTO']; ?></td>
      <td style="text-align:center"><?php echo $RContactos['COMENTARIO']; ?></td>
      <td style="text-align:center"><?php echo $RContactos['RESPUESTA']; ?></td>
      <td style="text-align:center"><?php echo $RContactos['USUARIO_EDITA']; ?></td>
      <td style="text-align:center"><?php echo $RContactos['FMODIFICACION']; ?></td>
      <td style="text-align:center"> <?php
      if($RContactos['RESPUESTA'] == null){
        ?>
          <a href="admin.php?OP=1&IdContacto=<?php echo $RContactos['IDCONTACTO']; ?>#editar" class="ms-boton" style="color: #fff!important;background-color: #000!important;margin-bottom:10px;">Editar</a>
        <?php
      }
       ?> </td>
    </tr>

          <?php
        }

         ?>

      </tbody>
    </table>

      </div>


    <?php

    if(isset($IdContacto)){

    $Contacto = mysqli_query($BDMSSA,"SELECT NOMBRE,CORREO,ASUNTO,COMENTARIO,RESPUESTA FROM CONTACTOS_USUARIO WHERE IDCONTACTO = $IdContacto");
    $RContactos = mysqli_fetch_array($Contacto);

    ?>

    <div id="editar" class="ms-contenedor">

    <h2>Edición de registro</h2>

    <form action="admin.php?OP=1#editar" method="post">
    <input type="hidden" name="Edit" value="1">
    <input type="hidden" name="IdContacto" value="<?php echo $IdContacto; ?>">
    <input class="ms-inputs" type="text" placeholder="Nombre" disabled name="Nombre" maxlength="150" value="<?php echo $RContactos['NOMBRE']; ?>">
    <input class="ms-inputs" type="email" placeholder="Correo" disabled name="Correo" maxlength="100" value="<?php echo $RContactos['CORREO']; ?>">
    <input class="ms-inputs" type="text" placeholder="Asunto" disabled name="Asunto" maxlength="150" value="<?php echo $RContactos['ASUNTO']; ?>">
    <textarea name="Comentario" class="ms-inputs" rows="8" cols="80" maxlength="500" disabled><?php echo $RContactos['COMENTARIO']; ?></textarea>
    <textarea name="Respuesta" class="ms-inputs" rows="8" cols="80" maxlength="500" required><?php echo $RContactos['RESPUESTA']; ?></textarea>
    <button class="ms-boton" style="color: #fff!important;background-color: #000!important;margin-bottom:10px;" type="submit">
    <i class="fas fa-save"></i> Guardar
    </button>
    </form>

    </div>

    <?php

    }

  }else if($OP == 2){

    if(isset($_POST['Create'])){

      $Nombre = $_POST['Nombre'];

      $SQLID =  mysqli_query($BDMSSA,"SELECT IFNULL(MAX(IDSERVICIO)+1,1) IDSERVICIO FROM SERVICIOS");
      $RID = mysqli_fetch_array($SQLID);

      $IdServicio = $RID['IDSERVICIO'];

      $Res = mysqli_query($BDMSSA,"INSERT INTO SERVICIOS (IDSERVICIO,NOMBRE) VALUES ($IdServicio,'$Nombre')");

      if(isset($_FILES['ImgServicio']) && $Res){
        move_uploaded_file($_FILES['ImgServicio']['tmp_name'], "FILES/Servicios/$IdServicio.png");
        unlink($_FILES['ImgServicio']['tmp_name']);
      }

    header('Location: admin.php?OP=2&Res='.$Res);

    }

    if(isset($_GET['IdServicio']) || isset($_POST['IdServicio'])){

    if(isset($_GET['IdServicio'])){
      $IdServicio = $_GET['IdServicio'];
    }else if(isset($_POST['IdServicio'])){
      $IdServicio = $_POST['IdServicio'];
    }

    if(isset($_POST['Edit']) && isset($IdServicio)){

      $Nombre = $_POST['Nombre'];

      $Res = mysqli_query($BDMSSA,"UPDATE SERVICIOS SET NOMBRE='$Nombre' WHERE IDSERVICIO = $IdServicio");

    if(isset($_FILES['ImgServicio']) && $Res){
      move_uploaded_file($_FILES['ImgServicio']['tmp_name'], "FILES/Servicios/$IdServicio.png");
      unlink($_FILES['ImgServicio']['tmp_name']);
    }

      header('Location: admin.php?OP=2&Res='.$Res);

    }

    if(isset($_GET['Delete']) && isset($IdServicio)){

      $Res = mysqli_query($BDMSSA,"DELETE FROM SERVICIOS WHERE IDSERVICIO = $IdServicio");

       unlink("FILES/Servicios/$IdServicio.png");

      header('Location: admin.php?OP=2&Res='.$Res);

    }

  }

  ?>

    <a class="ms-boton" style="color: #fff!important;background-color: #000!important;margin-bottom:10px;" href="admin.php?OP=2&Create=1#crear">Crear Servicio</a>

      <div class="ms-contenido">
      <table width="100%" border="1" cellspacing="0">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Opciones</th>
          </tr>
        </thead>
        <tbody>

          <?php

            $Servicios = mysqli_query($BDMSSA,"SELECT A.IDSERVICIO, A.NOMBRE FROM SERVICIOS A");

          while ($RServicios = mysqli_fetch_array($Servicios)) {
            ?>
      <tr>
        <td style="text-align:center"><?php echo $RServicios['IDSERVICIO']; ?></td>
        <td style="text-align:center"><?php echo $RServicios['NOMBRE']; ?></td>
        <td style="text-align:center">
            <a href="admin.php?OP=2&IdServicio=<?php echo $RServicios['IDSERVICIO']; ?>&Edit=1#editar" class="ms-boton" style="color: #fff!important;background-color: #000!important;margin-bottom:10px;">Editar</a>
            <a href="admin.php?OP=2&IdServicio=<?php echo $RServicios['IDSERVICIO']; ?>&Delete=1#eliminar" class="ms-boton" style="color: #fff!important;background-color: #000!important;margin-bottom:10px;">Eliminar</a>
         </td>
      </tr>

            <?php
          }

           ?>

        </tbody>
      </table>

        </div>

      <?php

      if(isset($_GET['Create'])){
        ?>
        <div id="crear" class="ms-contenedor">

        <h2>Creación de registro</h2>

        <form action="admin.php?OP=2#crear" method="post" enctype="multipart/form-data">
        <input type="hidden" name="Create" value="1">
        <input class="ms-inputs" type="text" placeholder="Nombre" name="Nombre" maxlength="50" required>
        <input class="ms-inputs" type="file" name="ImgServicio" required>
        <button class="ms-boton" style="color: #fff!important;background-color: #000!important;margin-bottom:10px;" type="submit">
        <i class="fas fa-save"></i> Crear
        </button>
        </form>

        </div>

        <?php
      }

      if(isset($IdServicio) && isset($_GET['Edit'])){

      $Servicio = mysqli_query($BDMSSA,"SELECT IDSERVICIO, NOMBRE, UUID() GUID FROM SERVICIOS WHERE IDSERVICIO = $IdServicio");
      $RServicios = mysqli_fetch_array($Servicio);

      ?>

      <div id="editar" class="ms-contenedor">

      <h2>Edición de registro</h2>

      <form action="admin.php?OP=2#editar" method="post" enctype="multipart/form-data">
      <input type="hidden" name="Edit" value="1">
      <input type="hidden" name="IdServicio" value="<?php echo $IdServicio; ?>">
      <input class="ms-inputs" type="text" placeholder="Nombre" name="Nombre" maxlength="50" value="<?php echo $RServicios['NOMBRE']; ?>" required>
      <img src="FILES/Servicios/<?php echo $IdServicio; ?>.png?V=<?php echo $RServicios['GUID']; ?>" style="width: 350px;height: 250px;">
      <input class="ms-inputs" type="file" name="ImgServicio">
      <button class="ms-boton" style="color: #fff!important;background-color: #000!important;margin-bottom:10px;" type="submit">
      <i class="fas fa-save"></i> Guardar
      </button>
      </form>

      </div>

      <?php

      }

  }else if($OP == 3){

    ?>

    <center>
    <div class="ms-contenedor" style="max-width: 50%;">

    <h2> Cambiar contraseña </h2>

    <form action="admin.php?OP=3" method="post">
    <input type="hidden" name="Change" value="1">
    <input class="ms-inputs" type="password" placeholder="Nueva contraseña" name="Clave" maxlength="50" required>
    <input class="ms-inputs" type="password" placeholder="Confirmar contraseña" name="ConfClave" maxlength="50" required>
    <button class="ms-boton" style="color: #fff!important;background-color: #000!important;margin-bottom:10px;" type="submit">
    <i class="fas fa-sign-in-alt"></i> Cambiar contraseña
    </button>

    </form>


    </div>
        </center>

        <?php

        if(isset($_POST['Change'])){

          $Clave = $_POST['Clave'];
          $ConfClave = $_POST['ConfClave'];

          $Res = 1;

          if($Clave == $ConfClave){
            $IDUsuario = $_SESSION['IDUSUARIO'];
            $Res = mysqli_query($BDMSSA,"UPDATE USUARIOS SET CLAVE = '$Clave' WHERE IDUSUARIO = '$IDUsuario'");

            if(!$Res){
              $Res = 2;
            }else{
              $Res = 3;
            }

          }

          ?>

         <p style="background: #78cee8;padding: 15px;border-radius: 15px;">
         <?php

         if($Res == 1)
         {
             echo "ERROR: Las contraseñas no coinciden";

         }else if($Res == 2){
           echo "No se pudo cambiar su contraseña";

         }else if($Res == 3){
           echo "Su contraseña se ha cambiado correctamente";

         }

         ?>
          </p>

     <?php

        }

  }else if($OP == 4){

    if(isset($_POST['Create'])){

      $Nombre = $_POST['Nombre'];
      $Correo = $_POST['Correo'];
      $Clave = $_POST['Clave'];

      $SQLEX =  mysqli_query($BDMSSA,"SELECT COUNT(*) EX FROM USUARIOS WHERE CORREO = '$Correo'");
      $REX = mysqli_fetch_array($SQLEX);

      $EX = $REX['EX'];

      if($EX == 0){
        $Res = mysqli_query($BDMSSA,"INSERT INTO USUARIOS (NOMCOMPLETO,CORREO,CLAVE,TIPO_USUARIO) VALUES ('$Nombre','$Correo','$Clave',1)");
      }else{
        $Res = false;
      }

      header('Location: admin.php?OP=4&Res='.$Res);

    }

    if(isset($_GET['IdUsuario']) || isset($_POST['IdUsuario'])){

    if(isset($_GET['IdUsuario'])){
      $IdUsuario = $_GET['IdUsuario'];
    }else if(isset($_POST['IdUsuario'])){
      $IdUsuario = $_POST['IdUsuario'];
    }

    if(isset($_POST['Edit']) && isset($IdUsuario)){

      $Nombre = $_POST['Nombre'];
      $Correo = $_POST['Correo'];

      $SQLEX =  mysqli_query($BDMSSA,"SELECT COUNT(*) EX FROM USUARIOS WHERE CORREO = '$Correo' AND IDUSUARIO != $IdUsuario");
      $REX = mysqli_fetch_array($SQLEX);

      $EX = $REX['EX'];

      if($EX == 0){
        $Res = mysqli_query($BDMSSA,"UPDATE USUARIOS SET NOMCOMPLETO='$Nombre', CORREO='$Correo' WHERE IDUSUARIO = $IdUsuario");
      }else{
        $Res = false;
      }

      header('Location: admin.php?OP=4&Res='.$Res);

    }

    if(isset($_GET['Delete']) && isset($IdUsuario)){

      $Res = mysqli_query($BDMSSA,"DELETE FROM USUARIOS WHERE IDUSUARIO = $IdUsuario");

      header('Location: admin.php?OP=4&Res='.$Res);

    }

  }

  ?>

    <a class="ms-boton" style="color: #fff!important;background-color: #000!important;margin-bottom:10px;" href="admin.php?OP=4&Create=1#crear">Crear usuario</a>

      <div class="ms-contenido">
      <table width="100%" border="1" cellspacing="0">
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Opciones</th>
          </tr>
        </thead>
        <tbody>

          <?php

            $Usuarios = mysqli_query($BDMSSA,"SELECT A.IDUSUARIO, A.NOMCOMPLETO, A.CORREO FROM USUARIOS A");

          while ($RUsuarios = mysqli_fetch_array($Usuarios)) {
            ?>
      <tr>
        <td style="text-align:center"><?php echo $RUsuarios['NOMCOMPLETO']; ?></td>
        <td style="text-align:center"><?php echo $RUsuarios['CORREO']; ?></td>
        <td style="text-align:center">
            <a href="admin.php?OP=4&IdUsuario=<?php echo $RUsuarios['IDUSUARIO']; ?>&Edit=1#editar" class="ms-boton" style="color: #fff!important;background-color: #000!important;margin-bottom:10px;">Editar</a>
            <a href="admin.php?OP=4&IdUsuario=<?php echo $RUsuarios['IDUSUARIO']; ?>&Delete=1#eliminar" class="ms-boton" style="color: #fff!important;background-color: #000!important;margin-bottom:10px;">Eliminar</a>
         </td>
      </tr>

            <?php
          }

           ?>

        </tbody>
      </table>

        </div>

      <?php

      if(isset($_GET['Create'])){
        ?>
        <div id="crear" class="ms-contenedor">

        <h2>Creación de registro</h2>

        <form action="admin.php?OP=4#crear" method="post">
        <input type="hidden" name="Create" value="1">
        <input class="ms-inputs" type="text" placeholder="Nombre" name="Nombre" maxlength="150" required>
        <input class="ms-inputs" type="email" placeholder="Correo" name="Correo" maxlength="100" required>
        <input class="ms-inputs" type="password" placeholder="Clave" name="Clave" maxlength="50" required>
        <button class="ms-boton" style="color: #fff!important;background-color: #000!important;margin-bottom:10px;" type="submit">
        <i class="fas fa-save"></i> Crear
        </button>
        </form>

        </div>

        <?php
      }

      if(isset($IdUsuario) && isset($_GET['Edit'])){

      $Usuario = mysqli_query($BDMSSA,"SELECT NOMCOMPLETO, CORREO FROM USUARIOS WHERE IDUSUARIO = $IdUsuario");
      $RUsuario = mysqli_fetch_array($Usuario);

      ?>

      <div id="editar" class="ms-contenedor">

      <h2>Edición de registro</h2>

      <form action="admin.php?OP=4#editar" method="post">
      <input type="hidden" name="Edit" value="1">
      <input type="hidden" name="IdUsuario" value="<?php echo $IdUsuario; ?>">
      <input class="ms-inputs" type="text" placeholder="Nombre" name="Nombre" maxlength="150" value="<?php echo $RUsuario['NOMCOMPLETO'] ?>" required>
      <input class="ms-inputs" type="email" placeholder="Correo" name="Correo" maxlength="100" value="<?php echo $RUsuario['CORREO'] ?>" required>
      <button class="ms-boton" style="color: #fff!important;background-color: #000!important;margin-bottom:10px;" type="submit">
      <i class="fas fa-save"></i> Guardar
      </button>
      </form>

      </div>

      <?php

      }

  }

?>

<?php

if(isset($_GET['Res'])){

  $Res = $_GET['Res'];

  ?>
  <p style="background: #78cee8;padding: 15px;border-radius: 15px;">
  <?php

  if(!$Res)
  {
      echo "No se ha podido guardar el cambio";

  }else{
    echo "Se ha guardado correctamente";
  }

  ?>
   </p>
  <?php

}

 ?>

<footer>
<p>Usuario: <?php echo $_SESSION['NOMCOMPLETO']; ?></p>
</footer>

  <?php

}else{

?>

<div class="ms-contenido" style="max-width:1564px">

<div class="ms-mostrar-contenido ms-contenido" style="max-width:1500px;">
<img src="" alt="" style="min-height: 180px;min-width: 100%;width: 1px;">
<div class="ms-tituloimg">
<h1>
  <span><img src="IMG/LogoPagina1.png" style="width: 200px;"></span>
</h1>
</div>
</div>

</div>

<?php

if($OP == 1 || $OP == null){
?>
<!-- Inicio de sesión de admin -->
<center>
<div class="ms-contenedor" style="max-width: 50%;">

<h2> Inicio de sesión </h2>
<p>Ingrese sus datos de acceso</p>

<form action="PHP/login.php" method="post">
<input class="ms-inputs" type="email" placeholder="Correo" required name="Correo" maxlength="100">
<input class="ms-inputs" type="password" placeholder="Contraseña" required name="Clave" maxlength="50">
<button class="ms-boton" style="color: #fff!important;background-color: #000!important;margin-bottom:10px;" type="submit">
<i class="fas fa-sign-in-alt"></i> Iniciar sesión
</button>
<a href="admin.php?OP=2" class="ms-boton" style="color: #fff!important;background-color: #000!important;margin-bottom:10px;font-size: 11px!important;">
<i class="fa-solid fa-key"></i> Recuperar contraseña
</a>
</form>


</div>
    </center>
<?php
}else if($OP == 2){

?>

<center>
<div class="ms-contenedor" style="max-width: 50%;">

<h2> Recuperar contraseña </h2>

<form action="admin.php?OP=3" method="post">
<input class="ms-inputs" type="email" placeholder="Correo" name="Correo" maxlength="100" required>
<button class="ms-boton" style="color: #fff!important;background-color: #000!important;margin-bottom:10px;" type="submit">
<i class="fas fa-sign-in-alt"></i> Recuperar
</button>
<a href="admin.php" class="ms-boton" style="color: #fff!important;background-color: #000!important;margin-bottom:10px;font-size: 11px!important;">
<i class="fa-solid fa-rotate-left"></i> Regresar
</a>

</form>


</div>
    </center>

<?php

if(isset($_GET['Res'])){

  $Res = $_GET['Res'];

  ?>
  <p style="background: #78cee8;padding: 15px;border-radius: 15px;">
  <?php

  if(!$Res)
  {
      echo "No se ha podido enviar su contraseña al correo";

  }else{
    echo "Se ha enviado un correo con su contraseña";
  }

  ?>
   </p>
  <?php

}


}else if($OP == 3){

  if (isset($_POST['Correo'])) {

    $Correo = $_POST['Correo'];

    $SQLUSR = mysqli_query($BDMSSA,"SELECT CLAVE, NOMCOMPLETO FROM USUARIOS WHERE CORREO = '$Correo'");

    $RUSR = mysqli_fetch_array($SQLUSR);

    if($RUSR['CLAVE'] != ''){

      $Res = $Email->EnviarCorreo("Recuperar contraseña Multiservicios SA","Estimad@ ".$RUSR['NOMCOMPLETO'].", <br> Su contraseña es: ".$RUSR['CLAVE'],$Correo,'','',array());

    }

    header('Location: admin.php?OP=2&Res='.$Res[0]);

  }


}

 ?>

<footer style="bottom: 0;position: fixed;width: 100%;">
<p>Desarrollado por Desarrollo web Quintana Fallas Ureña</p>
</footer>

<?php

session_destroy();

}
 ?>


</body>
</html>
