<?php
/**
 * Created by IntelliJ IDEA.
 * User: Enes-PC
 * Date: 15.05.2018
 * Time: 13:55
 */

include "connection.php";
echo '<h2> Veriler Hesaplanıyor Lütfen bekleyiniz... </h2>';

$ogrno= $_POST["ogrno"];

$arkadaslist=$db->query("select * from ogrencinetwork where ogrencino='$ogrno';",PDO::FETCH_ASSOC);
//Numarası girilen öğrencinin arkaşlarına ait prifil bilgilerini ogrenci profil dosyasından çekmek için gereken sql sorgusunu oluşturuyoruz.

$strqueryark="select * from ogrenciprofil where ";
if($arkadaslist->rowCount()){
    foreach ($arkadaslist as $row){

        $strqueryark=$strqueryark."ogrencino=".$row["arkno1"]." or ";
        $strqueryark=$strqueryark."ogrencino=".$row["arkno2"]." or ";
        $strqueryark=$strqueryark."ogrencino=".$row["arkno3"]." or ";
        $strqueryark=$strqueryark."ogrencino=".$row["arkno4"]." or ";
        $strqueryark=$strqueryark."ogrencino=".$row["arkno5"]." or ";
        $strqueryark=$strqueryark."ogrencino=".$row["arkno6"]." or ";
        $strqueryark=$strqueryark."ogrencino=".$row["arkno7"]." or ";
        $strqueryark=$strqueryark."ogrencino=".$row["arkno8"]." or ";
        $strqueryark=$strqueryark."ogrencino=".$row["arkno9"]." or ";
        $strqueryark=$strqueryark."ogrencino=".$row["arkno10"];
    }
}
$arkadaslist=$db->query("select * from ogrencinetwork where ogrencino='$ogrno';",PDO::FETCH_ASSOC);
//Numarası girilen öğrenci ile arkadaş olmayan öğrencilerin yarısına ait profil bilgilerini çekmek için gerekli sql sorgusunu oluşturuyoruz.
$qrynotfriend="select * from ogrenciprofil where ";
$str="";
if($arkadaslist->rowCount()){
    foreach ($arkadaslist as $row){
        $str=$str."ogrencino!=".$ogrno." and ";
        $str=$str."ogrencino!=".$row["arkno1"]." and ";
        $str=$str."ogrencino!=".$row["arkno2"]." and ";
        $str=$str."ogrencino!=".$row["arkno3"]." and ";
        $str=$str."ogrencino!=".$row["arkno4"]." and ";
        $str=$str."ogrencino!=".$row["arkno5"]." and ";
        $str=$str."ogrencino!=".$row["arkno6"]." and ";
        $str=$str."ogrencino!=".$row["arkno7"]." and ";
        $str=$str."ogrencino!=".$row["arkno8"]." and ";
        $str=$str."ogrencino!=".$row["arkno9"]." and ";
        $str=$str."ogrencino!=".$row["arkno10"];
    }
}
$qrynotfriend.=$str;
$counter= $db->query("select count(id) as cnt from ogrencinetwork where ".$str,PDO::FETCH_ASSOC);//toplam arkadaş olmayan öğrenci sayısını hesaplıyoruz.
$number_of_rows = $counter->fetchColumn();
$qrynotfriend.=" limit ".floor($number_of_rows/2);//yarısı ile sınırlandırıyoruz

$arkprofil=$db->query($strqueryark,PDO::FETCH_ASSOC);//arkadaşların profilini veren sorguyu çalıştırıyoruz
$diziark=array();//arkadaşları bir matrise atmak için matrisi oluşturuyoruz
$label=array();//labelları eklemek için bir dizi oluşturduk 1 veya 0
$ogrnumarasi=array();//öğrenci numarasını eklemek için bir dizi oluşturduk
if($arkprofil->rowCount()){//sql sorgusundan dönen sonuçları diziark matrisine ekliyoruz. label dizisine burdaki öğrenci sayısı kadar 1 ekliyoruz
    foreach ($arkprofil as $row){//ogrnumarasi dizisine öğrencilerin numarası ekliyoruz.
        $diziark=array_merge($diziark,array( array(
        0=>$row["soru1"],
        1=> $row["soru2"],
        2=> $row["soru3"],
        3=> $row["soru4"],
        4=> $row["soru5"],
        5=> $row["soru6"],
        6=> $row["soru7"],
        7=> $row["soru8"],
        8=> $row["soru9"],
        9=> $row["soru10"],
        10=> $row["soru11"],
        11=> $row["soru12"],
        12=> $row["soru13"],
        13=> $row["soru14"],
        14=> $row["soru15"],
        )));
        array_push($label,1.);
        array_push($ogrnumarasi,$row["ogrencino"]);
    }
}
$notarkprofil=$db->query($qrynotfriend,PDO::FETCH_ASSOC);//arkadaş olmayan kişilerin yarısı için sql sorgusu çalıştırılıyor
$dizinotark=array();//bunlar için de bir matris tanımlanıyor

if($notarkprofil->rowCount()){
    foreach ($notarkprofil as $row){//bu kişiler de dizinotark matrisine ekleniyor label klasörüne burdaki satır sayısı kadar 0 ekleniyor
        $dizinotark=array_merge($dizinotark,array(//öğrenci numaraları da bu döngü içerisinde ogrnumarasi arrayine ekleniyor
            array(
           // "ogrno"=>$row["ogrencino"],
            0=>$row["soru1"],
            1=> $row["soru2"],
            2=> $row["soru3"],
            3=> $row["soru4"],
            4=> $row["soru5"],
            5=> $row["soru6"],
            6=> $row["soru7"],
            7=> $row["soru8"],
            8=> $row["soru9"],
            9=> $row["soru10"],
            10=> $row["soru11"],
            11=> $row["soru12"],
            12=> $row["soru13"],
            13=> $row["soru14"],
            14=> $row["soru15"],
            )));
            array_push($label,0.);
            array_push($ogrnumarasi,$row["ogrencino"]);

    }
}
$dizi=array_merge($diziark,$dizinotark);// son olarak bu iki matris birleştiriliyor ve eğitim verisi matrisi elde ediliyor

?>

<?php

$testqry=$qrynotfriend;//test verisi için gerekli sql sorgusu oluşturuluyor.
$limit=floor($number_of_rows/2)+1;
$testqry.=",".$number_of_rows;
$test=array();

echo $testqry;
$testdata=$db->query($testqry,PDO::FETCH_ASSOC);//test verisi için eğitim verisinden geriye kalan veriler çekiliyor
$testogrnumarasi=array();
if($testdata->rowCount()){
    foreach ($testdata as $row){
        $test=array_merge($test,array( array(
            0=>$row["soru1"],
            1=> $row["soru2"],
            2=> $row["soru3"],
            3=> $row["soru4"],
            4=> $row["soru5"],
            5=> $row["soru6"],
            6=> $row["soru7"],
            7=> $row["soru8"],
            8=> $row["soru9"],
            9=> $row["soru10"],
            10=> $row["soru11"],
            11=> $row["soru12"],
            12=> $row["soru13"],
            13=> $row["soru14"],
            14=> $row["soru15"],
        )));
        array_push($testogrnumarasi,$row["ogrencino"]);
    }
}
//test verisi matrisi oluşturuluyor
include "logistic.php";//lojisstic regresyon fotrmüllerinin bulunduğu dosya bu sayfaya ekleniyor
//arkadaşlık oranlarını tutacak tablo oluşturuluyor
$db->query("DROP table if EXISTS friendadvice; 
CREATE TABLE `eng_project_4`.`friendadvice` ( 
`id` INT NOT NULL AUTO_INCREMENT , 
`ogrencino` TEXT NULL ,
`rate` FLOAT NULL , 
PRIMARY KEY (`id`)) 
ENGINE = MyISAM; 
");

$beta=logisticRegression(100,0.001,$dizi,$label);//katsayıları hesaplayan fonksiyon çağırılıp $beta dizisine eğitim verisinden gelen oranlar ekleniyor

    echo "<pre><br><br><br>";
    for($i=0; $i<count($test); $i++) {
       $friendrate = sigmoid($test[$i], $beta);//arkadaşlık oranını bulan fonksiyon
       $db->query("insert into friendadvice (ogrencino,rate) values ('$testogrnumarasi[$i]',$friendrate)");//veritabanına ekleme

    }
    header("Location: index.php?hesap=1");//hesap=1 parametresi ile tekrar ana sayfaya yönlendiriyoruz


echo"</pre>";


?>

