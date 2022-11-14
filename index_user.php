<?php 

    session_start();
    require_once 'config/db.php';
    require_once 'class/date.php';
    if (!isset($_SESSION['user_login'])) {
      $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
      header('location: loginpage.php');
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include 'include_user/header.php'; ?>
</head>
<body class="hold-transition sidebar-fixed layout-navbar-fixed ">
<div class="wrapper ">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <?php include 'include_user/navbar.php'; ?>

  <?php include 'include_user/sidebar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper ">
    <!-- Content Header (Page header) -->
    <div class="content-header ">
      <div class="container-fluid ">
        <div class="row  ">
          <div class="col-lg-10 mt-4 text-center ">
              <h1 class=""> &nbsp; ----- ระบบเบิก-จ่ายวัสดุสิ้นเปลืองและครุภัณฑ์ ในสาขาวิชาเทคโนโลยีโลจิสติกส์ -----</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- <div class="row">
          <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                <?php

                  $stmt=$conn->query("SELECT *,COUNT(*)As c_1 FROM item_a WHERE a_type ='1'");
                  $stmt->execute();
                  $rows = $stmt->fetchAll();
                  foreach ($rows as $row){

                  
                ?>
                <p>จำนวนวัสดุสิ้นเปลือง</p>
                <h3><?=$row['c_1'];?></h3>
                 <?php } ?>
                
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="form_item.php" class="small-box-footer">เพิ่มเติม <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div> -->
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body" >
                <div class="row">
                  <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                      <?php
                      $stmt = $conn->query("SELECT * FROM users WHERE u_id = $user_id");
                      $stmt->execute();
                      $row = $stmt->fetch(PDO::FETCH_ASSOC);
                      ?>
                    <h3 class="text-dark"><i class="fas fa-user"></i> สวัสดี :: คุณ <?php echo $row['firstname'] . ' ' . $row['lastname'];?></h3>
                    <h5 class="mt-3 text-muted">ข้อมูลของฉัน</h5>
                    <ul class="list-unstyled">
                      <li>
                        <a href="" class="btn-link text-secondary"><i class="fas fa-key"></i> รหัสนักศึกษา : <?php echo $row['u_code'];?></a>
                      </li>
                      <li>
                        <a href="" class="btn-link text-secondary"><i class="fas fa-envelope"></i> อีเมล : <?php echo $row['email'];?></a>
                      </li>
                      <li>
                        <a href="" class="btn-link text-secondary"><i class="fas fa-comment"></i> ไอดีไลน์ : <?php echo $row['idline'];?></a>
                      </li>
                      <li>
                        <a href="" class="btn-link text-secondary"><i class="fas fa-phone "></i> เบอร์โทรศัพท์ : <?php echo $row['phone'];?></a>
                      </li>
                      <li>
                        <a href="" class="btn-link text-secondary"><i class="fas fa-clock"></i> เป็นสมาชิกเมื่อ : <?php echo DBThaiShortDate($row['creat_at']);?></a>
                      </li>
                    </ul>
                    <hr>
                    <div class="text-right mt-2 mb-4">
                      <a href="updateform_member_user.php?u_id=<?=$row['u_id'];?>" class="btn btn-mb btn-warning text-light">แก้ไขข้อมูล</a>
                    </div>
                  </div>
                  <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                    <div class="row">
                      <div class="col-12 col-sm-4">
                        <div class="info-box bg-lightblue">
                          <div class="info-box-content">
                              <?php

                              $stmt=$conn->query("SELECT *,COUNT(*)As c_1 FROM item_a WHERE a_type ='1'");
                              $stmt->execute();
                              $rows = $stmt->fetchAll();
                              foreach ($rows as $row){


                              ?>
                            <span class="info-box-text text-center text-light">จำนวนวัสดุสิ้นเปลือง</span>
                            <span class="info-box-number text-center text-light mb-0 text-lg" ><?php echo $row['c_1'];?> รายการ</span>
                            <?php } ?>
                          </div>
                        </div>
                      </div>
                      <div class="col-12 col-sm-4">
                        <div class="info-box bg-orange">
                          <div class="info-box-content">
                              <?php

                              $stmt=$conn->query("SELECT *,COUNT(*)As c_2 FROM item_a WHERE a_type ='2'");
                              $stmt->execute();
                              $rows = $stmt->fetchAll();
                              foreach ($rows as $row){


                              ?>
                              <span class="info-box-text text-center text-light">จำนวนครุภัณฑ์</span>
                              <span class="info-box-number text-center text-light mb-0 text-lg"><?php echo $row['c_2'];?> รายการ</span>
                              <?php } ?>
                          </div>
                        </div>
                      </div>
                      <div class="col-12 col-sm-4">
                        <div class="info-box bg-gray">
                          <div class="info-box-content">
                              <?php

                              $stmt=$conn->query("SELECT COUNT(*)As c_3 FROM history WHERE u_id = $user_id");
                              $stmt->execute();
                              $rows = $stmt->fetchAll();
                              foreach ($rows as $row){


                              ?>
                              <span class="info-box-text text-center text-light">จำนวนรายการเบิกของฉัน</span>
                              <span class="info-box-number text-center text-light mb-0 text-lg"><?php echo $row['c_3'];?> รายการ</span>
                              <?php } ?>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-12">
                        <div class="card">
                          <div class="card-header bg-maroon">
                            <h3 class="card-title">ข้อมูลการยืม</h3>
                          </div>
                          <!-- /.card-header -->
                          <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                              <thead>
                                <tr class="text-center">
                                  <th>รหัสครุภัณฑ์</th>
                                  <th>ชื่อครุภัณฑ์</th>
                                  <th>จำนวน</th>
                                  <th>วันที่ยืม</th>
                                  <th>กำหนดคืน</th>
                                  <th>สถานะ</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                $stmt=$conn->query("SELECT * FROM history INNER JOIN item_a ON history.item_id = item_a.a_key WHERE history.u_id = $user_id AND history.h_type = 2  ORDER BY history.lent_start DESC" );
                                $stmt->execute();
                                $rows = $stmt->fetchAll();
                                if (!$rows) {
                                  echo "<tr><td colspan='10' class='text-center'>ไม่มีรายการของคุณ</td></tr>";
                                } else {
                                  foreach ($rows as $row) {
                                ?>
                                <tr class="text-center">
                                  <td hidden><?=$row['h_id'];?></td>
                                  <td><?=$row['item_id'];?></td>
                                  <td><?=$row['a_name'];?></td>
                                  <td><?=$row['h_value'];?></td>
                                  <td><?=DBThaiShortDate($row['lent_start']);?></td>
                                  <td><?=DBThaiShortDate($row['lent_end']);?></td>
                                  <td><?php 
                                    if($row['status_id']=='1'){
                                      echo '<span class="badge badge-success text-md p-2">ยืม</span>';
                                    } else if($row['status_id']=='2'){
                                      echo '<span class="badge badge-info text-md p-2">คืน</span>';
                                    } else if($row['status_id']=='3'){
                                      echo '<span class="badge badge-danger text-md p-2">เกินกำหนด</span>';
                                    }
                                    ?>
                                    </td>
                                    <td >
                                      <a href="updateform_lent_user.php?h_id=<?=$row['h_id'];?>" ><i class="fas fa-edit"></i></a>
                                    </td>
                                </tr>
                              </tbody>
                              <?php } }  ?>
                            </table>
                          </div>
                          <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-12">
                        <div class="card">
                          <div class="card-header bg-olive">
                            <h3 class="card-title">ประวัติการเบิกวัสดุสิ้นเปลือง</h3>
                          </div>
                          <!-- /.card-header -->
                          <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                              <thead>
                                <tr class="text-center">
                                  <th>รหัสวัสดุ</th>
                                  <th>ชื่อวัสดุ</th>
                                  <th>จำนวน</th>
                                  <th>วันที่เบิก</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                $stmt=$conn->query("SELECT * FROM history INNER JOIN item_a ON history.item_id = item_a.a_key WHERE history.u_id = $user_id AND history.h_type = 1 ORDER BY history.lent_start DESC" );
                                $stmt->execute();
                                $rows = $stmt->fetchAll();
                                if (!$rows) {
                                  echo "<tr><td colspan='10' class='text-center'>ไม่มีรายการของคุณ</td></tr>";
                                } else {
                                  foreach ($rows as $row) {
                                ?>
                                <tr class="text-center">
                                  <td hidden><?=$row['h_id'];?></td>
                                  <td><?=$row['item_id'];?></td>
                                  <td><?=$row['a_name'];?></td>
                                  <td><?=$row['h_value'];?></td>
                                  <td><?=DBThaiShortDate($row['lent_start']);?></td>
                                  
                                </tr>
                              </tbody>
                              <?php } }  ?>
                            </table>
                          </div>
                          <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <?php include 'include_user/footer.php'; ?>
</div>
  <?php include 'include_user/footer_script.php'; ?>

</body>
</html>
