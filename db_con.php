<!-- DATABASE CONNECTION -->
<?php
$servername='localhost';
$username='root';
$password='';
$dbname='phptest_db';

mysqli_report(MYSQLI_REPORT_STRICT);

try{
    $connection = new mysqli($servername, $username, $password, $dbname);
    // date_default_timezone_set(Asia/Kolkata);
} catch (Exception $e) {
    echo "Connection Failed".$e->getMessage();
    exit;
}
?>