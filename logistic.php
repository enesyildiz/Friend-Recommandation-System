<?php
//arkadaşlık oranını bulan fonksiyon
function sigmoid($data,$beta){
    $count=$beta[0];
    for ($m=1; $m<16; $m++){
        $count+=$data[$m-1]*$beta[$m];
    }

    return 1.0/(1.0+exp(-$count/100));
}
//b[0] katsayısını hesaplayan fonksiyon

function calcb0($data,$beta,$label){
    $N=count($data);
    $count=0.0;

    for($l=0; $l<$N; $l++){
        $count+=sigmoid($data[$l],$beta)-$label[$l];
    }
    return(1.0/$N)*$count;
}
//b[1]-b[15] katsayılarını hesaplayan fonksiyon
function calcBeta($data,$beta,$label,$j){
    $N=count($data);
    $count=0.0;
    for($l=0; $l<$N; $l++){
        $temp=sigmoid($data[$l],$beta)-$label[$l];
            $count+=$temp*$data[$l][$j-1];

    }
    return (1.0/$N)*$count."<br><br>";
}
//Lojistik regresoun ile katsayılar vektörünü hesaplayan fonksiyon
function logisticRegression($maxiter, $stepsize, $data, $label){
    $b1=array();
    for($i=0; $i<16; $i++){
        $beta[$i]=1.0;
    }

    for($i=0; $i<$maxiter; $i++){
        $b1[0]=$beta[0]-$stepsize*calcb0($data,$beta,$label);
        for($j=1; $j<16; $j++){
            $b1[$j]=$beta[$j]-$stepsize*calcBeta($data,$beta,$label,$j);
        }
        for($e=0; $e<16; $e++){
        $beta[$e]=$b1[$e];
        }
    }
    return $beta;
}


?>