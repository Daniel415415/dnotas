<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="<?= base_url(); ?>assets/bootstrap-5.0.2-dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/fontawesome/css/all.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/css/notas.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/sweet_alert/dist/sweetalert2.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/tata-master/src/tata.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fredoka&display=swap" rel="stylesheet">
<link rel="icon" type="image/ico" href="<?= base_url(); ?>images/favicon.ico"/>
  <title>Notas</title>
</head>

<body url="<?php echo base_url(); ?>">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="">Notas</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#" onclick="hacer_peticion()">Inicio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"  onclick="hacer_peticion_borradas()">Notas eliminadas <i class="fas fa-recycle"></i></a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Categorias
            </a>
            <ul id="lista_categorias" class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li id="cat_todas" onclick="ver_categoria()"><a class="dropdown-item" href="#">Todas las notas</a></li>
              <li id="eliminar_cat"><a class="dropdown-item" href="#">Eliminar Categorias</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><button class=" btn " style="width:100%; height:100%;" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa fa-plus"></i> </button></li>
            </ul>
          </li>
         
          
        </ul>
        <div class="d-flex">
         <h4 style="color: #fff;"><i class="fa fa-user-tie" style="color: #fff;"></i> Hola, <?php echo $nom_us ?></h4><a href="<?= base_url() ?>inicio/cerrarSesion" class="btn btn-outline-warning btn-sm mx-2" >Salir <i class="bi bi-box-arrow-right"></i></a>
        </div>
      </div>
    </div>
  </nav>


  <div class="container-fluid">
    <div class="row">
      <div id="contenedor_notas" class="col-md-4 overflow-auto">
        <div class="row">
          <div id="input_busqueda" class="col-md-12">
            <div class="d-flex justify-content-center">
            <input id="bus"  class="form-control my-2 " type="text" placeholder="Buscar nota">
            <div id="expandir_lista" class="btn"><i class="fas fa-2x fa-expand-arrows-alt my-1"></i></div>
            </div>
           
          </div>
         
        
      
        </div>
        <div class="row">
          <div class=" d-flex flex-column">
           <div id="btn_nueva_nota" class="btn btn-dark"><i class="fa fa-plus-circle"></i> Nueva nota</div>
          </div>
        </div>
        <div id="lista" class="list-group "></div>
      </div>

      <div id="contenedor_descripcion" class="col-md-8">
        <div class="row">
          <div id="fecha" class="col my-3">Fecha</div>
          <div id="fecha" class="col">
            <div class="d-flex justify-content-end">
             <div id="expandir_descripcion" class="btn"><i class="fas fa-2x fa-expand-arrows-alt my-1"></i></div>
            </div>

          </div>
        </div>
        <input id="titulo" type="text" placeholder="Titulo">
        <textarea id="descripcion" placeholder="¿Cómo te va el día de hoy?"></textarea>
        <div class="row ">
          <div class="d-flex justify-content-end">
            <div id="agregar_imagen"><i class="fa fa-1x fa-image" style="color:white;"></i></div>
            <div id="agregar"><i class="fa fa-2x fa-save" style="color:white;"></i></div>

          </div>

        </div>

      </div>

    </div>
  </div>
 

  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar nueva categoria</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <label for="titulo_categoria">Nombre de la categoria</label>
      <input id="nombre_cat" name="titulo_categoria" type="text" placeholder="Nombre" class="form-control">
      <hr>
     <label for="">Color de la categoria</label>
      <div id="contenedor_colores" class="d-flex p-2 bd-highlight justify-content-around">
        <div style="background-color:yellow; "></div>
        <div style="background-color:blue;"></div>
        <div style="background-color:red;"></div>
        <div style="background-color:green;"></div>
        <div style="background-color:orange;"></div>
        <div style="background-color:cyan; "></div>
        <div style="background-color:pink; "></div>
        <div style="background-color:purple; "></div>
        <div style="background-color:black; " class="color_seleccionado"></div>
      </div>
      </div>
      <div class="modal-footer">
        <button id="cancelar_cat" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button id="guardar_cat" type="button" class="btn btn-primary">Guardar categoria</button>
      </div>
    </div>
  </div>
</div>



<script src="<?= base_url(); ?>assets/anime-master/lib/anime.min.js"></script>
  <script type="text/javascript" src="<?= base_url(); ?>assets/bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="<?= base_url(); ?>assets/sweet_alert/dist/sweetalert2.all.js"></script>
  <script type="text/javascript" src="<?= base_url(); ?>assets/tata-master/dist/tata.js"></script>
  <script type="text/javascript" src="<?= base_url(); ?>assets/js/peticiones.js"></script>
  <script type="text/javascript" src="<?= base_url(); ?>assets/js/categorias.js"></script>
  
  
 


</body>

</html>