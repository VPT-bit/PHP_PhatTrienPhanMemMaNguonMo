<?php


$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM san_pham WHERE Ma_san_pham=?");
$stmt->bind_param("s", $id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();
$stmt->close();

// Xử lý submit form
if (isset($_POST['submit'])) {
    $ten = $_POST['Ten_san_pham'];
    $loai = $_POST['Ma_loai'];
    $sl = $_POST['So_luong'];
    $gia = $_POST['Don_gia'];
    $ncc = $_POST['Ma_nha_cung_cap'];
    $mo_ta = $_POST['Mo_ta'];

    $stmt = $conn->prepare("UPDATE san_pham SET Ten_san_pham=?, Ma_loai=?, So_luong=?, Don_gia=?, Ma_nha_cung_cap=?, Mo_ta=? WHERE Ma_san_pham=?");
    $stmt->bind_param("ssidsis", $ten, $loai, $sl, $gia, $ncc, $mo_ta, $id);
    $stmt->execute();
    $stmt->close();
    header("Location: list_product.php");
    exit;
}
?>

<form method="post">
    <label>Tên sản phẩm:</label>
    <input type="text" name="Ten_san_pham" value="<?php echo $product['Ten_san_pham']; ?>" required>
    <label>Mã loại:</label>
    <input type="text" name="Ma_loai" value="<?php echo $product['Ma_loai']; ?>">
    <label>Số lượng:</label>
    <input type="number" name="So_luong" value="<?php echo $product['So_luong']; ?>">
    <label>Đơn giá:</label>
    <input type="text" name="Don_gia" value="<?php echo $product['Don_gia']; ?>" required>
    <label>Mã NCC:</label>
    <input type="text" name="Ma_nha_cung_cap" value="<?php echo $product['Ma_nha_cung_cap']; ?>">
    <label>Mô tả:</label>
    <textarea name="Mo_ta"><?php echo $product['Mo_ta']; ?></textarea>
    <button type="submit" name="submit">Cập nhật</button>
</form>