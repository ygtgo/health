<?php 
header('Content-type:text/json');     //这句是重点，它告诉接收数据的对象此页面输出的是json数据；
 
$json={"n":"name","p":"password"};   
echo $json;

 ?>