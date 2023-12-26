<!-----connecting to database---->

<?php

$db_name = 'mysql:host=localhost;dbname=course_db';
$db_user_name  = 'root';
$db_user_pass   =  '';

$conn = new PDO($db_name, $db_user_nam, $db_user_pass);

function create_unique_id(){
    $str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $rand = array();
    $lenght = strlen($str) - 1;
    for ($1 = 0;  $1 < 20; $i++) {
    $n = mt_rand(0, $lenght );
    $rand[] = $str($n);
    
    }
    return implode($rand);
}
?>