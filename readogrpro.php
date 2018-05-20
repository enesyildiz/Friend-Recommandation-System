<?php
include "connection.php";
$row = 1;
$db->query("
DROP table if EXISTS ogrenciprofil;
CREATE TABLE
 `eng_project_4`.`ogrenciprofil` 
( `id` INT NOT NULL AUTO_INCREMENT ,
 `ogrencino` VARCHAR(10) NULL ,
 `soru1` INT NULL ,
 `soru2` INT NULL ,
 `soru3` INT NULL ,
 `soru4` INT NULL ,
 `soru5` INT NULL ,
 `soru6` INT NULL ,
 `soru7` INT NULL ,
 `soru8` INT NULL ,
 `soru9` INT NULL ,
 `soru10` INT NULL ,
 `soru11` INT NULL ,
 `soru12` INT NULL ,
 `soru13` INT NULL ,
 `soru14` INT NULL ,
 `soru15` INT NULL ,
 PRIMARY KEY (`id`)) 
ENGINE = InnoDB;");
 $file=$_POST["profil"];
if (($handle = fopen("uploads/".$file, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        //echo "<p> $row satırındaki $num alan: <br /></p>\n";
        $row++;
        for($i=0; $i<=15; $i++){
            if($data[$i]== null){
                $data[$i]=0;
            }
        }
        if(    $db->query("insert into ogrenciprofil 
(ogrencino,soru1,soru2,soru3,soru4,soru5,soru6,soru7,soru8,soru9,soru10,soru11,soru12,soru13,soru14,soru15) VALUES 
($data[0],$data[1],$data[2],$data[3],$data[4],$data[5],$data[6],$data[7],$data[8],$data[9],$data[10],$data[11],$data[12],$data[13],$data[14],$data[15]);")){
            //echo 'success';
        }
        else{
            echo 'hata<br>';
        }

    }
    echo "Aktarım Tamamlandı. Ana sayfaya yönlendiriliyorsunuz";
    header("refresh:5; url=index.php");
    fclose($handle);
}

?>