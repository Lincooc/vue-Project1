<?php
header('Access-Control-Allow-Origin: http://localhost:5173'); // 允许指定来源的跨域请求
header('Access-Control-Allow-Methods: POST'); // 允许的请求方法
header('Access-Control-Allow-Headers: Content-Type'); // 允许的请求头
header('Access-Control-Allow-Credentials: true'); // 如果需要允许跨域发送 cookie
$link=require_once "connect.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST)) {
        echo json_encode(['success' => false, 'message' => '未提交']);
        exit;
    }

    if(isset($_POST['keyword'])){
        $keyword = $_POST['keyword'];
        if (empty($keyword)) {
            echo json_encode(["status" => "error", "message" => "关键词不能为空"]);
            exit;
        }
    }
// 搜索商品


$sql = "SELECT proId, name, description, imgName, price 
        FROM items 
        WHERE name LIKE ? OR description LIKE ?";
$stmt = $link->prepare($sql);
$search = "%" . $keyword . "%";
$stmt->bind_param("ss", $search, $search);
$stmt->execute();
$result = $stmt->get_result();
$res=$result->fetch_all(MYSQLI_ASSOC);

$stmt->close();
$link->close();

echo json_encode([
    "status" => "success",
    "results" => $res
]);}
