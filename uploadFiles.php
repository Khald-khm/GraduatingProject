
<?php
    require_once 'connect.php';
 
    if(ISSET($_POST['upload'])){
        $file_name = $_FILES['file']['name'];
        $file_temp = $_FILES['file']['tmp_name'];
        $file_size = $_FILES['file']['size'];
        $exp = explode(".", $file_name);
        $ext = end($exp);
        $name = date("Y-m-d h-i-s").".".$ext;
        $storage_name = $file_name;
        $path = "D:/upload/".$name;
        $post_id = $_GET['post_id'];
        $date = date("Y-m-d H:i:s");
 
        if($file_size > 5242880){
            echo "<script>alert('File too large')</script>";
            echo "<script>window.location='welcome.php'</script>";
        }else{
            try{				

                // if there is a wrong check the date function
                if(move_uploaded_file($file_temp, $path)){
                    // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql = $pdo->prepare("INSERT INTO files (name, storage_name, post_id, file_path, upload_date) VALUES (?, ?, ?, ?, ?)");
                    $sql->execute([$name, $storage_name, $post_id, $path, $date]);
                }
 
            }catch(PDOException $e){
                echo $e->getMessage();
            }
 
            $pdo = null;
            
            // not sure if the file name should be send in the url
            // I don't think we should send file name in the url but we will see
            $heading = 'location:manageProjectsFree.php?';

            header($heading);
        }
    }
