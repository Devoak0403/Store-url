
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
require_once 'config/db.php';
if(isset($_POST['update'])){
    $l_id = $_POST['l_id'];
    $l_title = $_POST['l_title'];
    $l_url = $_POST['l_url'];
    $l_description = $_POST['l_description'];

    $stmtupdate = $conn->prepare("UPDATE link_db SET l_title = :l_title, l_url = :l_url, l_description = :l_description WHERE l_id = :l_id");
    $stmtupdate->bindParam(':l_title', $l_title);
    $stmtupdate->bindParam(':l_url', $l_url);
    $stmtupdate->bindParam(':l_description', $l_description);
    $stmtupdate->bindParam(':l_id', $l_id);
    $result = $stmtupdate->execute();

    if($result){
        echo "<script>
            $(document).ready(function() {
                Swal.fire({
                    title: 'สำเร็จ',
                    text: 'ข้อมูลถูกแก้ไขเรียบร้อย!',
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
                    text: 'ข้อมูลไม่ถูกแก้ไข!',
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