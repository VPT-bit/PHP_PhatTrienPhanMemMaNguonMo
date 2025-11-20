// Truy vấn dữ liệu
$sql = "SELECT san_pham, so_luong FROM ban_hang";
$result = mysqli_query($conn, $sql);

$labels = array();
$data = array();

while ($row = mysqli_fetch_assoc($result)) {
$labels[] = $row['san_pham'];
$data[] = (int)$row['so_luong'];
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Biểu đồ bán hàng</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <h2>Số lượng khách hàng theo sản phẩm</h2>
    <canvas id="myChart" width="400" height="200"></canvas>

    <script>
        const labels = <?php echo json_encode($labels); ?>;
        const data = <?php echo json_encode($data); ?>;

        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Số lượng khách hàng',
                    data: data,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>

</html>