<?php 

//CONEXÃO COM SERVIDOR
$conn = mysqli_connect(hostname: 'sql100.infinityfree.com', username: 'if0_40566558', password: 'Raquel0608');
mysqli_set_charset($conn, "utf8");

if($conn){    
    mysqli_select_db($conn, 'if0_40566558_sigo');
}else{
    die('ERRO AO CONECTAR AO BD');  
}
