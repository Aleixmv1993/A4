<?php

    
    ini_set("display_errors", 1);
    ini_set("display_startup_errors", 1);
    error_reporting(E_ALL);

    require 'sys/DB.php';
    
    use App\sys\DB;
    
    
    define('CONF',__DIR__.'/Config.json');
    
    $gdb = DB::getInstance();
      

    $sql="SELECT * FROM users WHERE user = :username";
    
    
    $gdb->query($sql);
        $user = "a.malaret";
    $gdb->bind(':username', $user); 

    var_dump($gdb);
    $gdb->execute();

    echo "Consulta single";
    echo "<p>". $gdb->single() ."</p>";
   
    
    

    
    $sql2 ="INSERT INTO `user` (`id`, `user`, `email`, `password`) VALUES (NULL, 'test', 'test@gmail.com', 'linuxlinux');";
    
    $gdb->query($sql2); 
    $res = $gdb->execute();
    echo "lastInsertId";
    print $gdb->lastInsertId();
    print("\n");
   

    
    $sql3 = "SELECT * FROM user";
    
    $gdb->query($sql3);
    $gdb->execute();
    

    $count = $gdb->rowCount();
    echo "rowCount";
    echo $count;
    print("\n");
    
    
    $sql4="SELECT * FROM user";

    $gdb->query($sql4); 
    $res = $gdb->execute();
    $rows = [];
    $rows = $gdb->resultSet();
    echo  "<p>Result set()</p>";
    if($rows)
    {
        foreach($rows as $row)
        {
            echo "<p>".$row['user'] . " | " . $row['password'] . "</p>";       
        }
    }