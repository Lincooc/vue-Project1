<?php
header('Access-Control-Allow-Origin: http://localhost:5173'); // 允许指定来源的跨域请求
header('Access-Control-Allow-Methods: POST'); // 允许的请求方法
header('Access-Control-Allow-Headers: Content-Type'); // 允许的请求头
header('Access-Control-Allow-Credentials: true'); // 如果需要允许跨域发送 cookie
$link=require_once "connect.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(empty($_POST)){
        echo json_encode(['success'=>false,'message'=>'未提交']);
        exit;
    }
    if(isset($_POST["proId"])){
        $proId = $_POST["proId"];
        $sql = "SELECT * FROM items WHERE proId =?";
        $stmt = $link->prepare($sql);
        $stmt->bind_param("i", $proId);
        if($stmt->execute()){
            $result = $stmt->get_result();
            $product = $result->fetch_assoc();
            $id = $product["userId"];
            $sql = "SELECT userName FROM users WHERE userId =?";
            $stmt = $link->prepare($sql);
            $stmt->bind_param("i", $id);
            if($stmt->execute()){
                $resultId = $stmt->get_result();
                if(empty($resultId)) {
                    echo json_encode(['success' => false, 'message' => '获取商家失败']);
                    exit;
                }
                $shopId = $resultId->fetch_assoc();
                if(empty($shopId)){
                    echo json_encode(['success' => false, 'message' => '获取商家失败']);
                    exit;
                }

                echo json_encode(['success' => true, 'message' => '加载成功', 'product' => $product,'shopId'=>$shopId]);
            }
            else{
                echo json_encode(['success' => false, 'message' => '加载获取失败']);
                exit;
            }
        }
        else{
            echo json_encode(['success' => false, 'message' => '加载获取失败']);
            exit;
        }

    }
    else{
        echo json_encode(['success' => false, 'message' => '不存在该商品']);
        exit;
    }
}
else{
    echo json_encode(['success'=>false,'message'=>'加载提交失败']);
    exit;
}
?>