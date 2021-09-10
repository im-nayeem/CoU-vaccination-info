<?php
$user_ip = getenv('REMOTE_ADDR');
$geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$user_ip"));

$city = $geo["geoplugin_city"];

$lat=$geo["geoplugin_latitude"];
$longt=$geo["geoplugin_longitude"];

$map="https://maps.google.com/?q=".$lat.",".$longt;
// echo $lat.$longt."<br>";
// echo $city."<br>";
// echo $map."<br>";

?>
<?php
    function getIPAddress() {  
    // whether ip is from the share internet  
     if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                $ip = $_SERVER['HTTP_CLIENT_IP'];  
        }  
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
     }  
//whether ip is from the remote address  
    else{  
             $ip = $_SERVER['REMOTE_ADDR'];  
     }  
     return $ip;  
}  
$ip = getIPAddress();  
 
$sql="select * from visitor where ip='{$ip}'";
$ar=get_element($conn,$sql);

$ip_count=1;
if(isset($ar[0]['ip_count']))
        $ip_count = $ar[0]['ip_count']+1;

if(empty($ar))
    {

        $sql="insert into visitor values(?,1)";
        
    }
else
    $sql="update visitor set ip_count=? where ip=?";



 $stmt=prepare_sql($conn,$sql); // call function to prepare sql
        if($stmt) //if $stmt is not false then procced
        {
            if(empty($ar))
                mysqli_stmt_bind_param($stmt,"s",$ip); //update student table
            else
            mysqli_stmt_bind_param($stmt,"ss",$ip_count,$ip);
            
                $count=is_success($stmt,$conn);
          

                
        }
      
 if(!empty($ar))
    $arr=$ar[0];
        
?>