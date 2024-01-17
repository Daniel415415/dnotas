<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
  <table class="table">
 <tr>
    <th>Nombre</th>
 	<th>Apellido</th>
 	<th>Correo</th>
 	<th>Contraseña</th>
 	<th>Acciones</th> 
 </tr>
  <tbody id="cont_table" data-search="true">
    
  </tbody>
</table>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
    <script>
      let tabla=document.querySelector('#cont_table');
      

    let agregar_row=(arr)=>{
      let row="";
     for (const item of arr) {
      for (const key in item) {
        if (item.hasOwnProperty(key)) {
         row+=`<td>${item[key]}</td>`;
        }
      }
      tabla.insertAdjacentHTML('beforeend',`<tr>${row}</tr>`);
      row="";
     }

    }
     
    let ar=[
      {
        nombre:"Juan",
        apellido:"Perez",
        correo:""
    },
    {
        nombre:"Miguel",
        apellido:"Bose"
    },
    {
        nombre:"Raul",
        apellido:"Ramirez"
    
    }

    ]

    let obetener_todas_notas=async ()=>{
    const respuesta = await fetch("http://www.notas.com/inicio/obtener_todas", {
			method: "GET", // or 'PUT'
			body: null, // data can be `string` or {object}!
			mode: "no-cors",
			headers: {
				"Content-Type": "application/json",
			},
		});
		if (respuesta.status === 200) {
		let {rows,total}= await respuesta.json();
    
    agregar_row(rows);
		}
  }
    </script>
  </body>
</html>