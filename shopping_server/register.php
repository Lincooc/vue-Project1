<?php
header('Access-Control-Allow-Origin: http://localhost:5173'); // 允许指定来源的跨域请求
header('Access-Control-Allow-Methods: POST, GET, OPTIONS'); // 允许的请求方法
header('Access-Control-Allow-Headers: Content-Type, Authorization'); // 允许的请求头
header('Access-Control-Allow-Credentials: true'); // 如果需要允许跨域发送 cookie
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}
header('Content-Type: application/json');
$link = require_once "connect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputData = json_decode(file_get_contents('php://input'), true);
    if(empty($inputData)){
        echo json_encode(['success' => false, 'message' => '为空']);
        exit;
    }
    $userName = $inputData['userName'];
    $email = $inputData['email'];
    $password = $inputData['password'];
    if (empty($userName) || empty($email) || empty($password)) {
        echo json_encode(['success' => false, 'message' => '所有字段均为必填项']);
        exit;
    }

    $stmt = $link->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    //num_rows是查询结果result的行数
    if ($result->num_rows > 0) {
        echo json_encode(['success' => false, 'message' => '邮箱已被注册']);
        $stmt->close();
        $link->close();
        exit;
    }
    $stmt->close();
    // 检查用户名是否已存在
    $stmt = $link->prepare("SELECT * FROM users WHERE userName = ?");
    $stmt->bind_param('s', $userName);
    $stmt->execute();
    $result = $stmt->get_result();
    //num_rows是查询结果result的行数
    if ($result->num_rows > 0) {
        echo json_encode(['success' => false, 'message' => '用户名已被注册']);
        $stmt->close();
        $link->close();
        exit;
    }
    $stmt->close();

    // 使用 password_hash 对密码加密
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // 插入新用户数据
    $stmt = $link->prepare("INSERT INTO users (userName, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param('sss', $userName, $email, $hashedPassword);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => '注册成功']);
    } else {
        echo json_encode(['success' => false, 'message' => '注册失败']);
    }

    $stmt->close();
}
$link->close();
?>
