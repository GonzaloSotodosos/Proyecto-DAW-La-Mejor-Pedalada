<?php
//validadores.php

/**
* Comprueba que una cadena contenga exclusivamente caracteres.
*
* @param string $cadena Cadena que se va a comprobar.
*
* @return bool Retorna verdadero si es texto.
*/
function es_texto($cadena) {
    //definimos el patrón   
     $patron = '/^[a-zA-Z0-9\s,ºñáéíóúÁÉÍÓÚ]+$/';
    return (preg_match($patron, $cadena));
}

/**
* Comprueba que una cadena tenga formato de email.
*
* @param string $email Cadena que se va a comprobar.
*
* @return bool Retorna verdadero si tiene forma de email.
*/

function es_email($email) {
    //convertimos el texto a minúsculas
    $email = strtolower($email);
    //definimos el patrón
    $patron = '/^[a-zA-Z0-9.!#$%&\'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/i';
 
    return (preg_match($patron, $email));
}
?>