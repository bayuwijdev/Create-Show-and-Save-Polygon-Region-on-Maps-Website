<?php 
    function koneksi_db() { 
        $host = "localhost"; 
        $database = "db_cobaregionmaps"; 
        $user = "root"; // isikan sesuai yang diisi sewaktu membuka PhpMyadmin
        $password = "";  // isikan sesuai yang diisi sewaktu membuka PhpMyadmin
        $link=mysql_connect($host,$user,$password); 
        mysql_select_db($database,$link);
        if(!$link) 
           echo "Error : ".mysql_error(); 
        return $link; 
    }
 ?>