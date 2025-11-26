<?php 

//CONEXÃO COM SERVIDOR
$conn = mysqli_connect('localhost', 'root', '');

if($conn){    
    mysqli_select_db($conn, 'infocurso');
}else{
    die('ERRO AO CONECTAR AO BD');  
}
