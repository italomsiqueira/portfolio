<?php 

//CONEXÃO COM SERVIDOR
$conn = mysqli_connect('sql100.infinityfree.com', 'if0_40566558', 'Raquel0608');

if($conn){    
    mysqli_select_db($conn, 'sigo');
}else{
    die('ERRO AO CONECTAR AO BD');  
}
