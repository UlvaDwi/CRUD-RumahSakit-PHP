<?php
    session_start();                        
        $koneksi = new mysqli('localhost', 'root', '','rumah_sakit');
    $username=$_POST['username'];           
    $password=$_POST['password'];           

    $query=mysqli_query($koneksi, "select * from users where uname='$username' and upass='$password'");    
    if($query==TRUE){                             
        $_SESSION['username']=$username;      
        header("location:index.php");         
    }else{                                   
        echo "gagal login";
    }

?>