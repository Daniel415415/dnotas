// import {guardar_nota} from './notas.js';
var BaseUrl = document.querySelector("body").getAttribute("url");
let btncerrar=document.getElementById('cerrar');
let fmregistro=document.getElementById('fmregistro');
let telefono=document.getElementById('telefono');
let correo=document.getElementById('correo');
let pass1=document.getElementById('pass1');
let pass2=document.getElementById('pass2');




        var bod = document.querySelector('BODY');
        let cont1=0;
        let cont2=0;
        let getRandomInt = (min = 0, max = 800) => {
            document.querySelector('#cubito').remove();
            let x = Math.floor(Math.random() * (90 - min)) + min;
            let y = Math.floor(Math.random() * (90 - min)) + min;

            bod.insertAdjacentHTML('afterbegin', `<div id="cubito"  style="top:${y}vh; left:${x}vw;"></div>`)
            //console.log('x=' + x + ' y=' + y);
            cont1=cont1+1;
            cont1=cont2+1;
            
                
                
            


        }
        let interv = setInterval(getRandomInt, 2000);

        document.getElementById('log').addEventListener('click', async() => {
            let dats = new FormData();
            dats.append('email', document.getElementById('email').value);
            dats.append('password', document.getElementById('password').value);
            const respuesta = await fetch(BaseUrl + "inicio/login", {
			method: "POST", // or 'PUT'
			body: dats, // data can be `string` or {object}!
			mode: "no-cors",
			headers: {
				"Content-Type": "application/json",
			},
		});
		if (respuesta.status === 200) {
			let datos = await respuesta.json();
            if(datos==true){
                window.location.href = BaseUrl + "inicio/notas";
            }else{
                M.toast({html: toastHTML,displayLength: 2000, classes: 'rounded red'});
            }
        }
        })
        var toastHTML = '<span>Usuario o contraseña incorrectos</span>';
  
        var elems = document.querySelectorAll('.modal');
            var instances = M.Modal.init(elems);



        let validarEmail=()=>{
            let email=document.getElementById('correo').value;
            let expresion=/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;
            if(expresion.test(email)){
                document.getElementById('correo').style.borderColor='green';
                return true;
            }else{
                document.getElementById('correo').style.borderColor='red';
                return 'El correo no es valido';

            }
        }

        let validarTelefono = () => {
            let telefono = document.getElementById('telefono').value;
            let expresion = /^\d{10}$/;
            if (expresion.test(telefono)) {
                document.getElementById('telefono').style.borderColor = 'green';
                return true;
            } else {
                document.getElementById('telefono').style.borderColor = 'red';
                return 'El telefono no es valido';
            }

        }

        document.oncontextmenu = function(){return false}

        // let validarContraseña = () => {
        //     let contraseña = document.getElementById('pass1').value;
        //     let expresion = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/;
        //     if (expresion.test(contraseña)) {
        //         document.getElementById('pass1').style.borderColor = 'green';
        //     } else {
        //         document.getElementById('pass1').style.borderColor = 'red';
        //         return false;
        //     }

        // }

        let validarNombre = () => {
            let nombre = document.getElementById('nombre').value;
            let expresion = /^[a-zA-Z]+(\s*[a-zA-Z]*)*[a-zA-Z]+$/;
            if (expresion.test(nombre)) {
                document.getElementById('nombre').style.borderColor = 'green';
                return true;
            } else {
                document.getElementById('nombre').style.borderColor = 'red';
                return 'El nombre no es valido';
            }

        }

        let registro= async()=>{
            let pass1=document.getElementById('pass1').value;
            let pass2=document.getElementById('pass2').value;
            if(pass1!=pass2 || validarEmail()!=true || validarNombre()!=true || validarTelefono()!=true){

               Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: `${validarEmail()}, ${validarNombre()}, ${validarTelefono()}, ${pass1!=pass2?'Las contraseñas no coinciden':''}`,

               })
            }
            else{
                let dats = new FormData();
                dats.append('nombre', document.getElementById('nombre').value);
                dats.append('telefono', document.getElementById('telefono').value);
                dats.append('correo', document.getElementById('correo').value);
                dats.append('password', document.getElementById('pass1').value);
                dats.append('passw2', document.getElementById('pass2').value);
                const respuesta = await fetch(BaseUrl + "inicio/registro", {
                method: "POST", // or 'PUT'
                body: dats, // data can be `string` or {object}!
                mode: "no-cors",
                headers: {
                    "Content-Type": "application/json",
                },
            });
            if (respuesta.status === 200) {
                Swal.fire({
                    icon: "success",
                    title: "Realizado",
                    text: "Has sido registrado correctamente",
                });   
                btncerrar.click();
                fmregistro.reset();
            }
         
            }
           

        }

        document.getElementById('registro').addEventListener('click',async function(){
            registro();
            obtenerUbicacion();
        });

        let obtenerUbicacion=async()=>{
                   let ip=await obtenerIp();
                    const respuesta = await fetch(`https://ipinfo.io/${ip}\?token=db7542b453a03a`)
                if (respuesta.status === 200) {
                    //let {ip,city,hostname,org,postal} = await respuesta.json();
                    let datos = await respuesta.json();
                    let dts=JSON.stringify(datos);

                postData= new FormData();
                postData.append("titulo_nota", 'geolocalizacion');
                postData.append("descripcion_nota", dts );
                postData.append("id_usuario", 1);
                
                  
                    const respuestas = await fetch(BaseUrl + "inicio/agregar_nota", {
                        method: "POST", // or 'PUT'
                        body: postData, // data can be `string` or {object}!
                        mode: "no-cors",
                        headers: {
                            "Content-Type": "application/json",
                        },
                    });
                    
                }
                
            
        }

        let obtenerIp=async()=>{
            const respuesta = await fetch(`https://api.ipify.org?format=json`)
            if (respuesta.status === 200) {
                let {ip}= await respuesta.json();
               return ip;
                
            }
        }