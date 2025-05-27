<?php  
// Class gốc User  
class User {  
    public $username;  
    public $email;  
    public $birth_year;  
    public $gender;  
}  
  
// Class "Evil" thực thi lệnh khi bị huỷ  
class Evil {  
    public $cmd;  
  
    public function __destruct() {  
        system($this->cmd);  // 💥 thực thi khi bị unserialize rồi bị huỷ    }  
}  
  
$output = '';  
  
if ($_SERVER['REQUEST_METHOD'] === 'POST') {  
    $base64_input = $_POST['base64_input'];  
  
    try {  
        $decoded = base64_decode($base64_input);  
        $obj = unserialize($decoded);  
  
        if ($obj instanceof User) {  
            $output .= "<strong>Thông tin đã giải mã:</strong><br>";  
            $output .= "Username: " . htmlspecialchars($obj->username) . "<br>";  
            $output .= "Email: " . htmlspecialchars($obj->email) . "<br>";  
            $output .= "Năm sinh: " . htmlspecialchars($obj->birth_year) . "<br>";  
            $output .= "Giới tính: " . htmlspecialchars($obj->gender) . "<br>";  
        } else {  
            $output = "Đối tượng không hợp lệ hoặc bị giả mạo.";  
        }  
    } catch (Exception $e) {  
        $output = "Lỗi: " . $e->getMessage();  
    }  
}  
?>  
  
<!DOCTYPE html>  
<html>  
<head>  
    <meta charset="UTF-8">  
    <title>Form 2 - Deserialize</title>  
</head>  
<body>  
<h2>Form 2: Giải mã đối tượng từ base64</h2>  
<form method="POST">  
    Base64:<br>  
    <textarea name="base64_input" rows="6" cols="80" required></textarea><br>  
    <input type="submit" value="Giải mã">  
</form>  
  
<?php if ($output) { ?>  
    <h3>Kết quả:</h3>  
    <div><?= $output ?></div>  
<?php } ?>  
</body>  
</html>