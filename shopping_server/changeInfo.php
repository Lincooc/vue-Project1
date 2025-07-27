<?php
header('Access-Control-Allow-Origin: http://localhost:5173'); // 允许指定来源的跨域请求
//原项目为5173
header('Access-Control-Allow-Methods: POST'); // 允许的请求方法
header('Access-Control-Allow-Headers: Content-Type'); // 允许的请求头
header('Access-Control-Allow-Credentials: true'); // 如果需要允许跨域发送 cookie
$link=require_once "connect.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(empty($_POST)){
        echo json_encode(['success'=>false,'message'=>'未提交']);
        exit;
    }
    if(isset($_POST["userId"])&&isset($_POST["email"])&&isset($_POST["userName"])){
        $userId=$_POST["userId"];
        $email=$_POST["email"];
        $userName=$_POST["userName"];
        $res1=mysqli_query($link,"SELECT userName FROM users WHERE userName = '$userName'");
        $res2=mysqli_query($link,"SELECT userName FROM users WHERE userId = $userId");
        $result1=mysqli_fetch_assoc($res1);
        $result2=mysqli_fetch_assoc($res2);
        if(!empty($result1)){
            if($result2["userName"]!=$userName){
                echo json_encode(['success' => false, 'message' => '用户名已被注册']);
                exit;
            }
        }
        else{
            mysqli_query($link,"UPDATE users SET userName = '$userName' WHERE userId = $userId");
        }
        if(isset($_POST["password"])&&isset($_POST["Newpassword"])&&isset($_POST["confirmPassword"])){
            $password=$_POST["password"];
            $Newpassword=$_POST["Newpassword"];
            $confirmPassword=$_POST["confirmPassword"];
            if($password!=''&&$Newpassword!=''&&$confirmPassword!=''){
                $stmt = $link->prepare("SELECT password FROM users WHERE userId = ?");
                $stmt->bind_param('i', $userId);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    $user = $result->fetch_assoc();
                    $stmt->close();
                    if (password_verify($password, $user['password'])) {
                        $sql="update users set userName=?,email=?,password=? where userId=?";
                        $stmt = $link->prepare($sql);
                        $hashedPassword = password_hash($Newpassword, PASSWORD_DEFAULT);
                        $stmt->bind_param('sssi', $userName, $email,$hashedPassword,$userId);


                    } else {
                        echo json_encode(['success' => false, 'message' => '密码错误']);
                        exit;
                    }
                } else {
                    echo json_encode(['success' => false, 'message' => '用户不存在']);
                    exit;
                }

            }
            else{
                $sql="update users set userName=?,email=? where userId=?";
                $stmt = $link->prepare($sql);
                $stmt->bind_param('ssi', $userName, $email,$userId);
            }
        }
        else{
            echo json_encode(['success' => false,'message' => '数据传递错误']);
            exit;
        }



        if($stmt->execute()){
            echo json_encode(['success' => true,'message' => '执行成功','ispassword'=>$Newpassword]);
        }
        else{
            echo json_encode(['success' => false,'message' => '修改执行错误']);
            exit;
        }
    }
    else{
        echo json_encode(['success' => false,'message' => '数据传递错误']);
        exit;
    }
}

?>