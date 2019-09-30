<?php 
#Condiciones
$num1 = 9;
$num2 = 10;

if($num1 > $num2){
	echo "numero 1 es mayor al numero 2";
}else if($num1 == $num2){
	echo "numeros iguales";
}else{
	echo "numero 1 es menor que numero 2";
}
echo"<br><br>";	
#switch
$dia="lunes";
switch($dia){
		case 'sabado': echo "estudio php";
		break;
		case 'viernes': echo "voy a la fiesta";
		break;
		case 'domingo': echo "toco en la iglesia";
		break;
	default: echo"voy a la universidad";
}

#while
echo "<br><br>";
$n =1;

while($n <5){
	echo $n;
	$n++;
}

#do while
echo "<br><br>";
$p =1;
do{
	echo $p;
	$p++;
} while($p <= 5);

#for
echo "<br><br>";

for($i=0; $i<=5;$i++){
	echo $i;
}
?>