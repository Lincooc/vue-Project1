<?php
header('Access-Control-Allow-Origin: http://localhost:5173'); // 允许指定来源的跨域请求
header('Access-Control-Allow-Methods: POST, GET, OPTIONS'); // 允许的请求方法
header('Access-Control-Allow-Headers: Content-Type, Authorization'); // 允许的请求头
header('Access-Control-Allow-Credentials: true'); // 如果需要允许跨域发送 cookie

// 如果是 OPTIONS 请求，直接返回状态码 200
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}
header('Content-Type: application/json');
$link = require_once "connect.php";

// 获取请求体中的 JSON 数据
$inputData = json_decode(file_get_contents('php://input'), true);

if (isset($inputData['email']) && isset($inputData['password'])) {
    $email = $inputData['email'];
    $password = $inputData['password'];

    // 从数据库中查询用户信息
    $stmt = $link->prepare("SELECT  userId,userName, password FROM users WHERE email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // 验证密码
        if (password_verify($password, $user['password'])) {
            echo json_encode([
                'success' => true,
                'message' => '登录成功',
                'userInfo' => [
                    'userId'=>$user['userId'],
                    'userName' => $user['userName'],
                    'email' => $email
                ]
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => '密码错误']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => '用户不存在']);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => '缺少必需的字段']);
}

$link->close();
?>
