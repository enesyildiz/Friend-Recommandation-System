<?php
include "connection.php";
$row = 1;
$db->query("
DROP table if EXISTS ogrenci;
CREATE TABLE `eng_project_4`.`ogrenci` (
 `id` INT NOT NULL AUTO_INCREMENT ,
  `ogrencino` TEXT NOT NULL ,
   `adsoyad` VARCHAR(50) NOT NULL ,
    PRIMARY KEY (`id`))
     ENGINE = MyISAM; ");
$file=$_POST["adsoyad"];
if (($handle = fopen("uploads/".$file, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        //echo "<p> $row satırındaki $num alan: <br /></p>\n";
        $row++;
        for($i=0; $i<=1; $i++){
            if($data[$i]== null){
                $data[$i]=0;
            }

        }
        //echo $data[0]."-".$data[1]."<br>";
        if(    $db->query("insert into ogrenci
(ogrencino,adsoyad) VALUES 
('$data[0]','$data[1]');")){
            //echo 'success';
        }
        else{
            echo 'hata<br>'.print_r($db->errorInfo());
        }

    }
    echo "Aktarım Tamamlandı. Ana sayfaya yönlendiriliyorsunuz";
    header("refresh:5; url=index.php");
    fclose($handle);
}

?>