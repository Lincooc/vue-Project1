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
    if(!isset($_POST["className"])){
        echo json_encode(['success'=>false,'message'=>'未获取分类']);
        exit;
    }
    $class=$_POST["className"];
    if($class=='all'){
        $sql="select proId,name,price,imgName from items";
        $res=mysqli_query($link,$sql);
        if (!$res) {
            echo json_encode(['success' => false, 'message' => '查询失败：' . mysqli_error($link)]);
            exit;
        }
        $result=mysqli_fetch_all($res,MYSQLI_ASSOC);
        if($result){
            echo json_encode(['success'=>true,'message'=>'查询成功','products'=>$result]);
            exit;
        }
        else{
            echo json_encode(['success'=>false,'message'=>'该分类商品为空']);
            exit;
        }
    }

    else{
        $sql="select proId,name,price,imgName from items where class=?";
        $stmt=$link->prepare($sql);
        $stmt->bind_param("s",$class);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $products = $result->fetch_all(MYSQLI_ASSOC);
                echo json_encode(['success'=>true,'message'=>'查询成功','products'=>$products]);
            }
            else{
                echo json_encode(['success'=>false,'message'=>'该分类商品为空']);
                exit;
            }
        } else {
            echo json_encode(['success' => false, 'message' => '查询错误']);
            exit;
        }
    }



}
else{
    echo json_encode(['success'=>false,'message'=>'提交失败']);
    exit;
}


?>