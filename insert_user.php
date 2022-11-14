<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php 

session_start();
require_once 'config/db.php';

    if (isset($_POST['submit'])) {

        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $c_password = $_POST['c_password'];
        $urole = $_POST['urole'];

        if($password != $c_password){
            echo "<script>
                $(document).ready(function() {
                    Swal.fire({
                        title: 'ผิดพลาด',
                        text: 'รหัสผ่านไม่ตรงกัน',
                        icon: 'error',
                        timer: 5000,
                        showConfirmButton: false
                    });
                })
            </script>";
            header ("Refresh: 2; url=manage_user.php");
        }
        else {
            $cheak_email = $conn->query("SELECT * FROM users WHERE email = '$email'");
            $cheak_email->execute();
            $row = $cheak_email->fetch();

            if($row > 0){
                echo "<script>
                    $(document).ready(function() {
                        Swal.fire({
                            title: 'ผิดพลาด',
                            text: 'อีเมลนี้มีผู้ใช้งานแล้ว',
                            icon: 'error',
                            timer: 5000,
                            showConfirmButton: false
                        });
                    })
                </script>";
                header ("Refresh: 2; url=manage_user.php");
            }
            else {
        
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("INSERT INTO users(fullname, email, password, urole ) VALUES(:fullname, :email, :password, :urole)");
                $stmt->bindParam(':fullname', $fullname);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':password', $passwordHash);
                $stmt->bindParam(':urole', $urole);
                $result = $stmt->execute();

                if ($result) {
                echo "<script>
                $(document).ready(function() {
                    Swal.fire({
                        title: 'สำเร็จ',
                        text: 'เพิ่มสมาชิกเรียบร้อยแล้ว!',
                        icon: 'success',
                        timer: 5000,
                        showConfirmButton: false
                    });
                })
                </script>";
                header("refresh:2; url=manage_user.php");
            } else {
                echo "<script>
                $(document).ready(function() {
                    Swal.fire({
                        title: 'ผิดพลาด',
                        text: 'มีบางอย่างผิดพลาด!',
                        icon: 'error',
                        timer: 5000,
                        showConfirmButton: false
                    });
                })
                </script>";
                header("refresh:2; url=manage_user.php");
            }
        }
    }
} 


?>