<?php

date_default_timezone_set('Asia/Kuwait');

try
{
    $dsn = 'mysql:host=localhost;dbname=get_job';
    $pdo = new PDO($dsn, 'root', '');

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}

catch(Exception $e)
{
    echo $e->getMessage();
}

?>