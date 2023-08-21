$arr=array(5=>1,12=>2);
$arr[]=56;
$arr["x"]=42;
unset($arr);
echo var_dump($arr);

// Answer is Syntax Error