<?php 

    session_start();
    require_once 'config/db.php';

    if (isset($_POST['signup']) && !empty($_POST['idline']) && isset($_POST['idline'])) {
        
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $c_password = $_POST['c_password'];
        $u_code = $_POST['u_code'];
        $idline = $_POST['idline'];
        $phone = $_POST['phone'];
        $urole = 'user';

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'รูปแบบอีเมลไม่ถูกต้อง';
            header("location: registerpage.php");
        } else if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
            $_SESSION['error'] = 'รหัสผ่านต้องมีความยาวระหว่าง 5 ถึง 20 ตัวอักษร';
            header("location: registerpage.php");
        } else if ($password != $c_password) {
            $_SESSION['error'] = 'รหัสผ่านไม่ตรงกัน';
            header("location: registerpage.php");
        } else { 
            
            try {

                $check_email = $conn->prepare("SELECT email FROM users WHERE email = :email");
                $check_email->bindParam(":email", $email);
                $check_email->execute();
                $row = $check_email->fetch(PDO::FETCH_ASSOC);
                
                if ($row['email'] == $email) {
                    $_SESSION['error'] = 'อีเมลนี้มีผู้ใช้แล้ว';
                    header("location: registerpage.php");
                } else {
                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                    $stmt = $conn->prepare("INSERT INTO users(firstname, lastname, email, password, urole , u_code, idline , phone) VALUES(:firstname, :lastname, :email, :password, :urole, :u_code, :idline, :phone)");
                    
                    $stmt->bindParam(":firstname", $firstname);
                    $stmt->bindParam(":lastname", $lastname);
                    $stmt->bindParam(":email", $email);
                    $stmt->bindParam(":password", $passwordHash);
                    $stmt->bindParam(":urole", $urole);
                    $stmt->bindParam(":u_code", $u_code);
                    $stmt->bindParam(":idline", $idline);
                    $stmt->bindParam(":phone", $phone);
                    $result = $stmt->execute();

    
                    if ($result) {
                        $_SESSION['success'] = "สมัครสมาชิกเรียบร้อยแล้ว! ";
                        header("refresh:0; url= loginpage.php"); 
                    } else {
                        $_SESSION['error'] = "มีบางอย่างผิดพลาด";
                        header("refresh:2; url= registerpage.php");
                    }
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            } 
        } 
}
?>