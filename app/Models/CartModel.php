<?php

class CartModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function addToCart($user_id, $product_name, $product_price, $product_image, $product_quantity)
    {
        $id = create_unique_number_id();
        $user_id = $_COOKIE['user_id'];
        $check_cart_numbers = mysqli_query($this->conn, "SELECT * FROM `cart` WHERE product_name = '$product_name' AND user_id = '$user_id'") or die('query failed');
        if (mysqli_num_rows($check_cart_numbers) > 0) {
            return 'Sản phẩm đã có trong giỏ hàng!';
        } else {
            mysqli_query($this->conn, "INSERT INTO `cart`(id, user_id, product_name, price, quantity, image) VALUES('$id', '$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
            return 'Sản phẩm đã được thêm vào giỏ hàng!';
        }
    }

    public function updateCart($cart_id, $cart_quantity, $current_version)
    {
        $current_data = mysqli_query($this->conn, "SELECT * FROM `cart` WHERE id = '$cart_id'") or die('query failed');
        $row = mysqli_fetch_assoc($current_data);
        $current_version_db = $row['version'];
        if ($current_version != $current_version_db) {
            return 'Có xung đột, vui lòng cập nhật lại dữ liệu.';
        } else {
            // Cập nhật dữ liệu và tăng phiên bản lên 1
            mysqli_query($this->conn, "UPDATE `cart` SET quantity = '$cart_quantity', version = version + 1 WHERE id = '$cart_id'") or die('query failed');
            return 'Cập nhật giỏ hàng thành công!';
        }
    }
    public function deleteCart($delete_cart_id)
    {
        mysqli_query($this->conn, "DELETE FROM `cart` WHERE id = '$delete_cart_id'") or die('query failed');
        return 'Xóa giỏ hàng thành công!';
    }
    public function deleteAllCart($user_id)
    {
        mysqli_query($this->conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
        return 'Xóa tất cả giỏ hàng thành công!';
    }
}
