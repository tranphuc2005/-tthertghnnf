<?php  
class User {  
    public $username;  
    public $email;  
    public $birth_year;  
    public $gender;  
  
    public function __construct($username, $email, $birth_year, $gender) {  
        $this->username = $username;  
        $this->email = $email;  
        $this->birth_year = $birth_year;  
        $this->gender = $gender;  
    }  
}  
  
$base64 = '';  
  
if ($_SERVER['REQUEST_METHOD'] === 'POST') {  
    $username = $_POST['username'];  
    $email = $_POST['email'];  
    $birth_year = $_POST['birth_year'];  
    $gender = $_POST['gender'];  
  
    $user = new User($username, $email, $birth_year, $gender);  
    $serialized = serialize($user);  
    $base64 = base64_encode($serialized);  
}  
?>  
  
<!DOCTYPE html>  
<html>  
<head>  
    <meta charset="UTF-8">  
    <title>Form 1 - Serialize User</title>  
</head>  
<body>  
<h2>Form 1: Nhập thông tin người dùng</h2>  
<form method="POST">  
    Username: <input type="text" name="username" required><br>  
    Email: <input type="email" name="email" required><br>  
    Năm sinh: <input type="number" name="birth_year" required><br>  
    Giới tính:  
    <select name="gender">  
        <option value="Nam">Nam</option>  
        <option value="Nữ">Nữ</option>  
    </select><br>    <input type="submit" value="Gửi">  
</form>  
  
<?php if ($base64) { ?>  
    <h3>Chuỗi base64:</h3>  
    <textarea rows="5" cols="80"><?= htmlspecialchars($base64) ?></textarea>  
<?php } ?>  
</body>  
</html>