<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_form2'])) {
    $base64_input = $_POST['base64_input'];
    try {
        // Giải mã Base64
        $decoded = base64_decode($base64_input, true);

        if ($decoded === false) {
            throw new Exception("Lỗi: Chuỗi Base64 không hợp lệ.");
        }

        // Giải mã JSON thay vì unserialize
        $user_info = json_decode($decoded, false); // Trả về object stdClass

        if ($user_info === null) {
            throw new Exception("Lỗi: Không thể giải mã JSON từ dữ liệu.");
        }

        // Xác minh các thuộc tính cần thiết có tồn tại
        $required_fields = ['username', 'email', 'birth_year', 'gender'];
        foreach ($required_fields as $field) {
            if (!property_exists($user_info, $field)) {
                throw new Exception("Thiếu trường dữ liệu: $field");
            }
        }
    } catch (Exception $e) {
        $error_message = $e->getMessage();
    }
}
?>