<?php
header('Access-Control-Allow-Origin: http://localhost:5173'); // 允许指定来源的跨域请求
header('Access-Control-Allow-Methods: POST'); // 允许的请求方法
header('Access-Control-Allow-Headers: Content-Type'); // 允许的请求头
header('Access-Control-Allow-Credentials: true'); // 如果需要允许跨域发送 cookie
$link=require_once "connect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {//是否提交方式是post
    if(isset($_POST['pName']) && isset($_POST['pDescrip']) && isset($_POST['pPrice']) && isset($_POST['pClass'])
        && isset($_POST['userId'])&& isset($_FILES['pImage'])) {
        $userName = $_POST['pName'];
        $description = $_POST['pDescrip'];
        $price = $_POST['pPrice'];
        $class=$_POST['pClass'];
        $userId = $_POST['userId'];
        $stock=$_POST['pStock'];
        $imgName = $_FILES['pImage']['name'];
        $targetPath="";
        foreach ($_FILES['pImage']['error'] as $key => $error){
            if ($error === UPLOAD_ERR_OK) {// 检查是否成功上传了图片
                $target= 'uploads/' .$imgName[$key];//拼接字符串获取路径
                if (move_uploaded_file($_FILES["pImage"]["tmp_name"][$key], $target)) {
                    $targetPath .= $target.',';
                } else {
                    echo json_encode(['success' => false, 'message' => '文件上传失败']);
                    exit;
                }
            }
            else{
                echo json_encode(['success' => false, 'message' => $error]);
                exit;
            }
        }

        $targetPath = rtrim($targetPath, ',');

        //不用mysqli_query()是因为下面这种写法可以防止注入
        $stmt = $link->prepare("INSERT INTO items(name, description, imgName,class,price, stock,userId) VALUES (?,?, ?, ?,?, ?,?)");
        $stmt->bind_param('ssssiii', $userName, $description, $targetPath,$class,$price,$stock, $userId);//s表示字符串类型

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => '物品添加成功']);
        } else {
            echo json_encode(['success' => false, 'message' => '物品添加失败']);
        }
        $stmt->close();
    }


    else{
        echo json_encode(['success' => false, 'message' => '字段不允许为空']);
        exit;
    }

}

$link->close();
?>
