<?php
include "ConnectingDb.php";

// Перевірка, чи встановлений параметр 'id' у URL
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Підготовка SQL-запиту з використанням підготовленого оператора
    $sql = "SELECT p.ProductName, p.Price, p.Image, d.OS, d.GPU, d.CPU, d.Memory, d.Storage
            FROM products p
            INNER JOIN firearm_link fl ON p.id = fl.firearm_id
            INNER JOIN firearm_details d ON fl.details_id = d.id
            WHERE p.id = ?";

    // Підготовка оператора
    $stmt = mysqli_prepare($conn, $sql);

    // Прив'язка параметрів
    mysqli_stmt_bind_param($stmt, "i", $id);

    // Виконання оператора
    mysqli_stmt_execute($stmt);

    // Отримання результату
    $result = mysqli_stmt_get_result($stmt);

    $data = array();
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    echo json_encode(array("data" => $data));
} else {
    // Обробка випадку, коли параметр 'id' не вказаний
    echo "Параметр ID не вказано.";
}
?>