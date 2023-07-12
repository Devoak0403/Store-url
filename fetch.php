
<?php 
session_start();
require_once 'config/db.php';
 
$searchTerm = $_GET['term']; 
$query = $conn->query("SELECT *  FROM link_db WHERE l_title LIKE '%".$searchTerm."%'"); 
$query->execute();
$rows = $query->fetchAll();
 
$skillData = array(); 
if($query->rowCount() > 0){ 
    foreach($rows as $row){ 
        $data['id'] = $row['l_id']; 
        $data['value'] = $row['l_title']; 
        array_push($skillData, $data); 
    } 
} 
 
echo json_encode($skillData); 
?>