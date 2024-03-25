<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách nhân viên</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        img {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
        .pagination {
            display: inline-block;
        }
        .pagination a {
            color: black;
            float: left;
            padding: 8px 16px;
            text-decoration: none;
            transition: background-color .3s;
            border: 1px solid #ddd;
            margin: 0 4px;
        }
        .pagination a.active {
            background-color: #4CAF50;
            color: white;
            border: 1px solid #4CAF50;
        }
        .pagination a:hover:not(.active) {background-color: #ddd;}
    </style>
</head>
<body>

<h2>THÔNG TIN NHÂN VIÊN</h2>

<table>
    <tr>
        <th>Mã Nhân Viên</th>
        <th>Tên Nhân Viên</th>
        <th>Giới Tính</th>
        <th>Nơi Sinh</th>
        <th>Tên Phòng</th>
        <th>Lương</th>
    </tr>

    <?php
// Chèn mã PHP vào đây
// Kết nối đến cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ql_nhansu";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Thiết lập số nhân viên trên mỗi trang và trang hiện tại
$results_per_page = 5;

// Tính toán số trang
$sql = "SELECT * FROM NHANVIEN";
$result = $conn->query($sql);
$number_of_results = $result->num_rows;
$number_of_pages = ceil($number_of_results / $results_per_page);

// Xác định trang hiện tại
if (!isset($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}

// Xác định vị trí bắt đầu của kết quả trên mỗi trang
$this_page_first_result = ($page - 1) * $results_per_page;

// Lấy dữ liệu từ bảng NHANVIEN cho trang hiện tại
$sql = "SELECT * FROM NHANVIEN LIMIT $this_page_first_result, $results_per_page";
$result = $conn->query($sql);

// Hiển thị dữ liệu
if ($result->num_rows > 0) {
    // Hiển thị danh sách nhân viên
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row["Ma_NV"]."</td><td>".$row["Ten_NV"]."</td><td>";
        // Kiểm tra giới tính và hiển thị hình ảnh tương ứng
        if($row["Phai"] == "NU") {
            echo "<img src='woman.jpg' alt='Woman' style='width:20px;height:20px;'>";
        } else {
            echo "<img src='man.jpg' alt='Man' style='width:20px;height:20px;'>";
        }
echo "</td><td>".$row["Noi_Sinh"]."</td><td>".$row["Ma_Phong"]."</td><td>".$row["Luong"]."</td>";
        echo "</tr>";
    }

    // Hiển thị các nút phân trang
    echo "<div class='pagination'>";
    for ($page = 1; $page <= $number_of_pages; $page++) {
        echo '<a href="?page=' . $page . '">' . $page . '</a> ';
    }
    echo "</div>";
} else {
    echo "Không có nhân viên nào.";
}

// Hiển thị danh sách nhân viên
while($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>".$row["Ma_NV"]."</td><td>".$row["Ten_NV"]."</td><td>";
    // Kiểm tra giới tính và chèn hình ảnh tương ứng
    if($row["Phai"] == "NU") {
        echo "<img src='woman.jpg' alt='Woman' style='width:20px;height:20px;'>";
    } else {
        echo "<img src='man.jpg' alt='Man' style='width:20px;height:20px;'>";
    }
    echo "</td><td>".$row["Noi_Sinh"]."</td><td>".$row["Ma_Phong"]."</td><td>".$row["Luong"]."</td>";
    echo "</tr>";
}




// Đóng kết nối
$conn->close();
?>

</table>

</body>
</html>