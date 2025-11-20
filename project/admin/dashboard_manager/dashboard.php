<?php
// Load cả 2 loại dữ liệu từ đầu

// TOP 5 tồn kho nhiều nhất
$sql_topNhieu_sanPham = "
    SELECT Ten_san_pham, So_luong
    FROM san_pham
    ORDER BY So_luong DESC
    LIMIT 5
";
$result_topNhieu_sanPham = mysqli_query($conn, $sql_topNhieu_sanPham);

$labels_topNhieu_sanPham = [];
$data_topNhieu_sanPham = [];

while ($row = mysqli_fetch_assoc($result_topNhieu_sanPham)) {
    $labels_topNhieu_sanPham[] = $row['Ten_san_pham'];
    $data_topNhieu_sanPham[] = (int)$row['So_luong'];
}

// TOP 5 tồn kho ít nhất
$sql_topIt_sanPham = "
    SELECT Ten_san_pham, So_luong
    FROM san_pham
    ORDER BY So_luong ASC
    LIMIT 5
";
$result_topIt_sanPham = mysqli_query($conn, $sql_topIt_sanPham);

$labels_topIt_sanPham = [];
$data_topIt_sanPham = [];

while ($row = mysqli_fetch_assoc($result_topIt_sanPham)) {
    $labels_topIt_sanPham[] = $row['Ten_san_pham'];
    $data_topIt_sanPham[] = (int)$row['So_luong'];
}
?>

<div class="row">
    <div class="col-xl-6 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary" id="chartTitle">
                    5 sản phẩm có trong kho nhiều nhất
                </h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Thay đổi sắp xếp:</div>
                        <a class="dropdown-item" href="#" onclick="toggleChart('nhieu'); return false;">
                            <i class="fas fa-sort-amount-down"></i> Nhiều nhất
                        </a>
                        <a class="dropdown-item" href="#" onclick="toggleChart('it'); return false;">
                            <i class="fas fa-sort-amount-up"></i> Ít nhất
                        </a>
                    </div>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <canvas id="myChart_sanPham" width="400" height="200"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
    // Dữ liệu từ PHP
    const dataSource_sanPham = {
        nhieu: {
            labels: <?php echo json_encode($labels_topNhieu_sanPham); ?>,
            data: <?php echo json_encode($data_topNhieu_sanPham); ?>,
            title: '5 sản phẩm có trong kho nhiều nhất'
        },
        it: {
            labels: <?php echo json_encode($labels_topIt_sanPham); ?>,
            data: <?php echo json_encode($data_topIt_sanPham); ?>,
            title: '5 sản phẩm có trong kho ít nhất'
        }
    };

    // Khởi tạo chart
    const ctx_sanPham = document.getElementById('myChart_sanPham').getContext('2d');
    const myChart_sanPham = new Chart(ctx_sanPham, {
        type: 'bar',
        data: {
            labels: dataSource_sanPham.nhieu.labels,
            datasets: [{
                label: 'Số lượng sản phẩm',
                data: dataSource_sanPham.nhieu.data,
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
            },
            animation: {
                duration: 750
            }
        }
    });

    // Hàm toggle chart
    function toggleChart(type) {
        const source = dataSource_sanPham[type];

        // Update dữ liệu chart
        myChart_sanPham.data.labels = source.labels;
        myChart_sanPham.data.datasets[0].data = source.data;
        myChart_sanPham.update();

        // Update tiêu đề
        document.getElementById('chartTitle').textContent = source.title;

        // Đổi màu theo loại
        if (type === 'it') {
            myChart_sanPham.data.datasets[0].backgroundColor = 'rgba(255, 99, 132, 0.2)';
            myChart_sanPham.data.datasets[0].borderColor = 'rgba(255, 99, 132, 1)';
        } else {
            myChart_sanPham.data.datasets[0].backgroundColor = 'rgba(75, 192, 192, 0.2)';
            myChart_sanPham.data.datasets[0].borderColor = 'rgba(75, 192, 192, 1)';
        }
        myChart_sanPham.update();
    }
</script>