<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/materialize/css/materialize.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/sweet_alert/dist/sweetalert2.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/login.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="icon" type="image/ico" href="<?= base_url(); ?>images/favicon.ico"/>
    <title>Inicio de sesion</title>
</head>

<body url="<?php echo base_url(); ?>">



    <!-- Modal Structure -->
    <div id="modal1" class="modal " style="border-radius: 5px;">
        <div class="modal-content">
            <h4>Registrarse en Notas</h4>
            <div class="row">
                <form id="fmregistro">
                <div class="row">
        <div class="input-field col s12 m6">
          <i class="material-icons prefix">account_circle</i>
          <input id="nombre" type="text" class="validate">
          <label for="nombre">Nombre completo</label>
        </div>
        <div class="input-field col s12 m6">
          <i class="material-icons prefix">phone</i>
          <input id="telefono" type="tel" class="validate">
          <label for="telefono">Telefono</label>
        </div>
      </div>
        <div class="row">
        <div class="input-field col s12 m6">
            <i class="material-icons prefix">email</i>
            <input id="correo" type="text" class="validate">
            <label for="correo">Email</label>
            </div>
            <div class="input-field col s12 m6">
            <i class="material-icons prefix">lock</i>
            <input id="pass1" type="tel" class="validate">
            <label for="pass1">Contraseña</label>
            </div>
        </div>
        <div class="row">
        <div class="input-field col s12 m6 offset-m6">
            <i class="material-icons prefix">lock</i>
            <input id="pass2" type="text" class="validate">
            <label for="pass2">Confirmar Contraseña</label>
            </div>
        </div>
        
       


                </form>

            </div>
        </div>
        <div class="modal-footer">
            
            <div id="cerrar" class="modal-close waves-effect waves-green btn  deep-orange darken-1">Cancelar</div>
            <div id="registro" class="modal- waves-effect waves-blue btn blue darken-1">Continuar<i class="material-icons right">forward</i></div>
        </div>
    </div>




    <div id="cubito"></div>
    <div class="containter">
        <div class="row" style="margin-top:2%;">
            <div class="col m4 offset-m4 offset-s4 center" style="color:#fff">
                <h1 id="titulon" >Notas</h1>
            </div>
        </div>

 

        <div class="row" style="margin-top:5%;" </div>

            <div class="col l4 m6 s8 offset-s2 offset-m3 offset-l4 center"">
                <form class=" z-depth-5" style="background:#fff; padding:10px; border-radius:10px;" action="">
                <div class="row">
                    <div class="input-field col s12">
                        <input id="email" type="email" class="validate">
                        <label for="email">Email</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="password" type="password" class="validate">
                        <label for="password">Password</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m6">
                        <button id="log" class="btn waves-effect waves-light" type="button" name="action">Entrar
                            <i class="material-icons right">send</i>
                        </button>
                    </div>
                    <div class="input-field col s12 m6">
                        <button id="reg" class="btn waves-effect waves-light yellow darken-4 modal-trigger" data-target="modal1">Registrarse

                        </button>
                    </div>
                </div>
                </form>

            </div>
        </div>

        <div class="container" id="contenedor_imagen" style="margin-top:5%">
            <div class="row">
                <div class="col m4 offset-m4 offset-s4 center">
                    <img src="<?= base_url(); ?>images/nota.png" alt="notita" width="100px" id="imagen_nota">



                </div>
            </div>
        </div>


    </div>






    <script type="text/javascript" src="<?= base_url(); ?>assets/materialize/js/materialize.min.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>assets/sweet_alert/dist/sweetalert2.all.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>assets/js/login.js"></script>
</body>

</html>