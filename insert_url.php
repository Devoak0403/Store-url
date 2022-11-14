
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
require_once "config/db.php";
session_start();

if(isset($_POST['submit'])){

    $l_title = $_POST['l_title'];
    $l_description = $_POST['l_description'];
    $u_id = $_POST['u_id'];

    $url = $_POST['l_url']; 
    $url = urlencode($url); 
    $url = str_replace("%3A%2F%2F", "://", $url);
    $url = str_replace("%2F", "/", $url);
    $url = str_replace("%3F", "?", $url);
    $url = str_replace("%3D", "=", $url);
    $url = str_replace("%26", "&", $url);
    $url = str_replace("%3A", ":", $url);
    $url = str_replace("%2C", ",", $url);
    $url = str_replace("%23", "#", $url);
    $url = str_replace("%25", "%", $url);
    $url = str_replace("%2B", "+", $url);
    $url = str_replace("%40", "@", $url);
    $url = str_replace("%3B", ";", $url);
    $url = str_replace("%3E", ">", $url);
    $url = str_replace("%3C", "<", $url);
    $url = str_replace("%5B", "[", $url);
    $url = str_replace("%5D", "]", $url);
    $url = str_replace("%5C", "\\", $url);
    $url = str_replace("%22", "\"", $url);
    $l_url = $url;
    
    $stmt = $conn->prepare("INSERT INTO link_db (l_title, l_url, l_description,u_id) VALUES (?, ?, ? ,?)");
    $stmt->bindparam(1 , $l_title);
    $stmt->bindparam(2 , $l_url);
    $stmt->bindparam(3 , $l_description);
    $stmt->bindparam(4 , $u_id);
    $result = $stmt->execute();

        if($result){
            echo "<script>
                $(document).ready(function() {
                    Swal.fire({
                        title: 'สำเร็จ',
                        text: 'ข้อมูลถูกบันทึกเรียบร้อย!',
                        icon: 'success',
                        timer: 5000,
                        showConfirmButton: false
                    });
                })
            </script>";
            header("refresh:2; url=manage_url.php");
        }else {
            echo "<script>
                $(document).ready(function() {
                    Swal.fire({
                        title: 'ไม่สำเร็จ',
                        text: 'ข้อมูลไม่ถูกบันทึก!',
                        icon: 'error',
                        timer: 5000,
                        showConfirmButton: false
                    });
                })
            </script>";
            header("refresh:2; url=manage_url.php");
        }

    }

?>