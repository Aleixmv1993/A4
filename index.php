<?php

    require 'sys/DB.php';
    
    use App\sys\DB;
    
    
    define('CONF',__DIR__.'/Config.json');
    
    $gdb = DB::getInstance();
      

    $sql="SELECT * FROM users WHERE username = :username";

    $gdb->query($sql); 
    $gdb->bind(':username', "AleixAdmin");
    $res = $gdb->execute();

    
    if($res == 1){
        $result = $gdb->single();
        echo $result[username];
    }
    
    $sql2 ="SELECT username FROM users WHERE rol = :rol";
    
    $gdb->query($sql); 
    $gdb->bind(':rol', 1);
    $res = $gdb->execute();

