/*Funcion validar
*Se crean las variables okUsuario y okContrasenia que obtienen
*el resultado de ejecutar las funciones validarUsuario y validarContrasenia
*Si ambas son true, devuelve true, con lo cual el formulario será valido
*Si no devolverá false, con lo que el formulario no se enviará.
*/
function validar(){
	var okUsuario = validarUsuario();	
	var okContrasenia = validarContrasenia();
	if(okUsuario && okContrasenia)
		return true;
	return false;	
}

/*Funcion validarUsuario
*Comprueba el tamañao del usuario introducido en el input usuario,
*Si está vacio muestra un error, sino si cumple las condiciones que 
*se indican en la expresión regular el resultado será true, con lo cual
*se validará el formulario. Si no se valida marcará el div con un estilo
*diferente y mostrará un mensaje de error.
*/
function validarUsuario(){
	var ok = true;
	var msgError = "";
	var usuario = document.getElementById("usuario").value;
	var divUsuario = document.getElementById("divUsuario");
	var error = document.getElementsByClassName("error")[0];
	
	divUsuario.style.border = "";
	error.innerHTML = "";
	
	if(usuario.length == 0){//Comprobamos que el campo no esta vacio
		ok = false;
		msgError = "El campo usuario no puede estar vacio";
	}
	else
		//Si contiene entre 3 y 12 letras 
		if(/^[a-zA-Z\sñáéíóúÁÉÍÓÚ]{3,12}$/.test(usuario)){
			ok = true;
		}
		else{
			ok = false;
			msgError = "Debe tener una longitud de 3 a 12 caracteres";
		}
	if(!ok){
		divUsuario.style.border = "2px solid red";
		error.innerHTML = msgError;
		return false;
	}
	return true;
}

/*Funcion validarContrasenia
*Comprueba el tamañao de la contraseña introducida en el input contrasenia,
*Si está vacio muestra un error, sino si no se cumple las condiciones que 
*se indican en la expresión regular el resultado será false, con lo cual
*no se validará el formulario. Si el resultado es el de la expresion regular
el resultado será true con lo que se validará el formulario. En caso de no validar
*marcará el div con un estilo diferente y mostrará un mensaje de error.
*/
function validarContrasenia(){
	var ok = true;
	var msgError = "";
	var contrasenia = document.getElementById("contrasenia").value;
	var divContrasenia = document.getElementById("divContrasenia");
	var error = document.getElementsByClassName("error")[1];
	
	divContrasenia.style.border = "";
	error.innerHTML = "";
	
	if(contrasenia.length == 0){//Comprobamos que el campo no esta vacio
		ok = false;
		msgError = "El campo contraseña no puede estar vacio";
	}
	else
		/*una letra mayúscula, seguida de uno de estos tres caracteres 
		especiales punto(.), coma(,) o guion medio(-), a continuación
		seis letras en minúscula, o seis números o combinación de ambos
		(letras y números)*/
		if(!(/^[A-Z](\.|\,|\-)[a-z0-9]{6}$/.test(contrasenia))){
			ok = false;
			msgError = "La contraseña debe comenzar por una letra mayúscula,"+
						" seguida de un punto(.), coma(,) o guion(-) y 6"+
						" letras minúsculas o 6 números o combinación de ambos";
		}			
	if(!ok){
		divContrasenia.style.border = "2px solid red";
		error.innerHTML = msgError;
		return false;
	}
	return true;
}