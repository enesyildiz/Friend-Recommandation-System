<?php
include "connection.php";
$row = 1;
$file=$_POST["network"];
$db->query("DROP table if EXISTS ogrencinetwork;
CREATE TABLE
 `eng_project_4`.`ogrencinetwork` 
( `id` INT NOT NULL AUTO_INCREMENT ,
 `ogrencino` VARCHAR(10) NULL ,
 `arkno1` VARCHAR(10) NULL ,
 `arkno2` VARCHAR(10) NULL ,
 `arkno3` VARCHAR(10) NULL ,
 `arkno4` VARCHAR(10) NULL ,
 `arkno5` VARCHAR(10) NULL ,
 `arkno6` VARCHAR(10) NULL ,
 `arkno7` VARCHAR(10) NULL ,
 `arkno8` VARCHAR(10) NULL ,
 `arkno9` VARCHAR(10) NULL ,
 `arkno10` VARCHAR(10) NULL ,
 PRIMARY KEY (`id`)) 
ENGINE = InnoDB;");
if (($handle = fopen("uploads/".$file, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        //echo "<p> $row satırındaki $num alan: <br /></p>\n";
        $row++;
        for($i=0; $i<=10; $i++){
            if($data[$i]== null){
                $data[$i]=0;
            }
        }
        if(    $db->query("insert into ogrencinetwork 
(ogrencino,arkno1,arkno2,arkno3,arkno4,arkno5,arkno6,arkno7,arkno8,arkno9,arkno10) VALUES 
($data[0],$data[1],$data[2],$data[3],$data[4],$data[5],$data[6],$data[7],$data[8],$data[9],$data[10]);")){
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