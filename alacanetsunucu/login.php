<?php

include("vt.php");

  ob_start();
  session_start();
  
  $username=htmlspecialchars(strip_tags(addslashes(stripslashes($_POST["ad"]))));
  $password=htmlspecialchars(strip_tags(addslashes(stripslashes($_POST["sifre"]))));
  
	  if($username!="" and $password!=""){
		  
		  $password=md5('56.o*' . $password . '?2,3!');
			$sorgu = $db->prepare("select * from kullanici where username = :username and password =:password");
			$sorgu->bindparam(":username",$username,PDO::PARAM_STR);
			$sorgu->bindparam(":password",$password,PDO::PARAM_STR);
			$sorgu->execute();
			$sayi = $sorgu->rowcount();
			if($sayi==0){
				
				echo "Kullancı Adı veya Şifre Yanlış.<br>";
  echo "Giriş sayfasına yönlendiriliyorsunuz.";
  header("Refresh: 10; url=index.php");
  
			}else{
	  
  $_SESSION["login"] = "true";
  $_SESSION["username"] = $username;
  $_SESSION["password"] = $password;
  
  $_SESSION["id"] = $id;
  $_SESSION["ip"] = $_SERVER["REMOTE_ADDR"];

  
  header("Location:icerik.php");
  
  }
}else{
	
			echo 'Lütfen Tüm Alanları Doldur';
		}
  ?>