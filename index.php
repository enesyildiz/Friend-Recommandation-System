
<!DOCTYPE html/>
<html>
<head>
    <title>Mühendislik Projesi 4. Ödev</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
</head>
<?php
if(isset($_GET['hesap'])){
$hesap=$_GET['hesap'];}
else
{
$hesap=0;
}
?>
<body style="background-color: aliceblue;">
<div class="row" style="margin:5%;">
<div class="col-md-4">
    <form action="readogrpro.php" method="post">
        <h3> Öğrenci Profil Dosyasını Seçip Veritabanına Aktarınız</h3>
        <input type="file" name="profil" id="profil" >
        <input type="submit" name="pro" value="Aktar">
    </form>
</div>
<div class="col-md-4">

    <form action="readogrnet.php" method="post">
        <h3>Öğrenci Network Dosyasını Seçip Veritabanına Aktarınız</h3>
        <input type="file" name="network">
        <input type="submit" name="net" value="Aktar">
    </form>
</div>
<div class="col-md-4">

    <form action="readogrbil.php" method="post">
        <h3>Öğrenci Bilgi Dosyasını Seçip Veritabanına Aktarınız</h3>
        <input type="file" name="adsoyad">
        <input type="submit" name="net" value="Aktar">
    </form>
</div>
</div>

<div class="row" style="margin: 5%; text-align: center;">
    <div class="col-md-12">
        <h1 style="margin-bottom: 60px;">Arkadaş Bul</h1>
        <form method="post" action="arkadasbul.php">
            <input type="text" name="ogrno" id="ogrno">
            <input type="submit" value="Arkadaş Bul">
        </form>
    </div>
</div>
<?php
/*
 * hesap=1 parametresi ile sayfaya girilirse sayfanın
 * bu kısmı görünür oluyor yoksa sayfanın bu kısmı görülemiyor.
 * */
include "connection.php";

if($hesap==1){
    /* arkadaş tavsiye tablosuna sadece numara ve arkadaşlık oranı eklendi
    *  inner join yardımmıyla öğrenci ad soyad ve numaralarının olduğu tablodan
     * numaraya göre isimleri de çekildi ve ekrana basıldı.
    */
    $arkadasoneri=$db->query("SELECT 
ogr.adsoyad as adsoyad,fr.ogrencino as ogrno, fr.rate as rate FROM ogrenci as ogr 
INNER JOIN friendadvice as fr on ogr.ogrencino=fr.ogrencino 
ORDER by rate DESC 
LIMIT 10", PDO::FETCH_ASSOC);
echo'<div style="margin-left: 40%; text-align: left">';
            echo '<div class="row">';
            echo'<div class="col-md-3">';
            echo "<h6>Ad Soyad</h6>";
            echo '</div>';
            echo'<div class="col-sm-3">';
            echo "<h6>Öğrenci Numarası</h6>";
            echo '</div>';
            echo '</div><br>';

    if($arkadasoneri->rowCount()){
        foreach ($arkadasoneri as $row)
        {
            echo '<div class="row">';
            echo'<div class="col-md-3">';
            echo $row['adsoyad'];
            echo '</div>';
            echo'<div class="col-sm-3" >';
            echo $row['ogrno'];
            echo '</div>';
            echo '</div><br>';
        }
    }
echo'</div>';
}
?>

<br>
<br>
<br>

</body>



</html>
<?php
/**
 * Created by IntelliJ IDEA.
 * User: Enes-PC
 * Date: 14.05.2018
 * Time: 10:40
 */
?>