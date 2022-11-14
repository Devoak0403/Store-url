<?php 

    session_start();
    require_once 'config/db.php';
    require_once 'class/date.php';
    if (!isset($_SESSION['admin_login'])) {
        $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
        header('location: loginpage.php');
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include 'include/header.php'; ?>
</head>
<body class="hold-transition sidebar-fixed layout-navbar-fixed ">
<div class="wrapper">

  <!-- Preloader -->
  <!-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div> -->

  <?php include 'include/navbar.php'; ?>

  <?php include 'include/sidebar.php'; ?>

  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-2">หน้าหลัก</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            </ol>
          </div>
        </div>
      </div>
    </div>
    <section class="content">
      <div class="container">
        <div class="row justify-content-center">
			<div class="col-md-4 col-sm-6 col-12">
				<div class="info-box bg-gradient-light">
					<span class="info-box-icon"><i class="fas fa-link"></i></span>
					<?php
					
					$stmt = $conn->query("SELECT *,COUNT(l_id) AS c_row FROM link_db ORDER BY l_id DESC LIMIT 1");
					$stmt->execute();
					$row = $stmt->fetch();

					?>
					<div class="info-box-content">
						<span class="info-box-text text-lg">URL ทั้งหมด</span>
						<span class="info-box-number text-lg"><?=$row['c_row'] ?> รายการ</span>
						<div class="progress">
							<div class="progress-bar bg-primary" style="width: 70%"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-6 col-12">
				<div class="info-box bg-gradient-orange">
					<span class="info-box-icon"><i class="fas fa-users"></i></span>
					<?php
					
					$stmt = $conn->query("SELECT *,COUNT(u_id) AS c_rowuser FROM users ORDER BY u_id DESC LIMIT 1");
					$stmt->execute();
					$row = $stmt->fetch();

					?>
					<div class="info-box-content">
						<span class="info-box-text text-lg">User ทั้งหมด</span>
						<span class="info-box-number text-lg"><?=$row['c_rowuser'] ?> บัญชี</span>
						<div class="progress">
							<div class="progress-bar" style="width: 20%"></div>
						</div>
						<span class="progress-description">
						</span>
					</div>
				</div>
			</div>
        </div>
        <div class="row ">
          	<div class="col-md-12 mt-2">
            	<div class="">
              		<div class="card-body">
					<form action="index_admin.php" method="POST">
						<div class="input-group mb-4">
							<input type="text" class="form-control " placeholder="พิมพ์ title เพื่อค้นหา...." id="title_input" name="l_title">
							<button class="btn bg-indigo" type="submit" >ค้นหา</button>
						</div>
					</form>
					
					<?php  
					if(isset($_POST["l_title"]))
					{
					$output = '';
					$stmtQ = $conn->prepare("SELECT * FROM link_db WHERE l_title = '".$_POST["l_title"]."'");
					$stmtQ->execute();
					$rows = $stmtQ->fetchAll();

					if (!$rows) {
						echo "<div class='row justify-content-center'>
						<span class='badge badge-danger text-center text-md'>-- Data is not Found --</span> 
						</div>";
						
						} else {
							$output .= '
							<div class="card">
							<div class="card-body table-responsive p-0">';
							foreach ($rows as $row) {
							{
							$output .= '
							<div class="container">
								<div class="row">
									<div class="col-md-12">
										<div class="card-body">
										<div class="row">
											<div class="col-md-12">
											<div class="form-group">
												<label for="l_title">ชื่อลิ้งค์</label>
												<input type="text" class="form-control" id="l_title" name="l_title" value="'.$row["l_title"].'" disabled>
											</div>
											</div>
											<div class="col-md-12">
											<label for="l_url">ลิ้งค์</label>
											<div class="input-group mb-4">
												<button class="btn btn-sm btn-outline-danger btn-md" id="clickCopy">
												<i class="fas fa-copy"></i>
												</button>
												<textarea class="form-control" id="goodContent" name="l_url" rows="3" disabled>'.$row["l_url"].'</textarea>
												</div>
											</div>
											<div class="col-md-12">
											<div class="form-group">
												<label for="l_description">หมายเหตุ</label>
												<textarea class="form-control" id="l_description" name="l_description" rows="3" disabled>'.$row["l_description"].'</textarea>
											</div>
										</div>
										</div>
										<a href="index_admin.php" class="btn btn-danger">ย้อนกลับ</a>
									</div>
									</div>
								</div>
									';
							}
							$output .= '</table>
							</div>';
							echo $output;
							}
						}
					}
                    ?>
              	</div>
            </div>
        </div>

                  

          <!-- <div class="col-md-12">
            <div class="card">
              <div class="card-header bg-info">
                <h3 class="card-title">ข้อมูลการเบิกวัสดุ <span class="badge bg-danger "> NEW</span></h3>
              </div>
              <div class="card-body table-responsive p-0">
              <?php  
										if(isset($_POST["l_title"]))
										{
										$output = '';
										require_once "config/db.php";
										$stmtQ = $conn->prepare("SELECT * FROM link_db WHERE l_title = '".$_POST["l_title"]."'");
										$stmtQ->execute();
										$rows = $stmtQ->fetchAll();

										if (!$rows) {
											echo "<tr><td colspan='8' class='text-center'>-- Data is not Found --</td></tr>";
											} else {
												$output .= '  
												<div class="table-responsive ">  
												<table class="table table-bordered">';
												foreach ($rows as $row) {
												{
												$output .= '
												
													<tr>  
														<td width="15%"><label>Title</label></td>  
														<td width="70%">'.$row["l_title"].'</td>  
													</tr>
													<tr>  
														<td width="15%" >
															<label>Link</label>
															<button class="btn btn-sm btn-outline-primary ml-4" id="clickCopy">
																<i class="fas fa-copy"></i>
															</button>
														</td>  
														<td width="70%">
															<a id="goodContent" href="'.$row["l_url"].'" target="_blank">'.$row["l_url"].'
															</a>
														</td>  
													</tr>
													<tr>  
														<td width="15%"><label>Description</label></td>  
														<td width="70%">'.$row["l_description"].'</td>  
													</tr>
												';
												}
												$output .= '</table></div>';
												echo $output;
												}
											}
										}
										?>
									
              </div>
            </div>
          </div> -->
        </div>
      </div>
    </section>
  </div>
  <?php include 'include/footer.php'; ?>
</div>
  <?php include 'include/footer_script.php'; ?>

  <script>
		$(function() {
			$("#title_input").autocomplete({
				source: "fetch.php",
				select:function(event, ui){
					event.preventDefault();
					$("#title_input").val(ui.item.value);
				}
			});
		});
	</script>

	<script>
	copyToClipboard(document.getElementById("content"));

	document.getElementById("clickCopy").onclick = function() {
		copyToClipboard(document.getElementById("goodContent"));
	}
	function copyToClipboard(e) {
		var tempItem = document.createElement('input');

		tempItem.setAttribute('type','text');
		tempItem.setAttribute('display','none');
		
		let content = e;
		if (e instanceof HTMLElement) {
				content = e.innerHTML;
		}
		
		tempItem.setAttribute('value',content);
		document.body.appendChild(tempItem);
		
		tempItem.select();
		document.execCommand('Copy');

		tempItem.parentElement.removeChild(tempItem);
	}
	</script>

</body>
</html>
