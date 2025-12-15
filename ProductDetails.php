<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Деталі товару</title>
    <link rel="stylesheet" type="text/css" href="./StyleForWeb.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Afacad:ital,wght@0,400;0,500;0,600;0,700;1,500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 
<link rel="stylesheet"  href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
 <?php include "./links.php"; ?>
</head>
<body>
    <?php include "./Header.php" ?>
    <!-- Main content -->
    <section class="product-page" id="Main">
        <section class="product-info">
            <div class="container">
                <h2>Деталі товару</h2>
                <script>
                    $(document).ready(function () {
                        // Отримання даних товару з PHP скрипту
                        $.ajax({
                            url: "./ProductConnect.php?id=<?php echo $_GET['id']; ?>",
                            method: "GET",
                            dataType: "json",
                            success: function (data) {
                                // Заповнення елементів HTML даними товару
                                $('#productName').text(data.data[0].ProductName);
                                $('#productPrice').text(data.data[0].Price);
                                $('#productImageContainer').html('<img src="' + data.data[0].Image + '" alt="' + data.data[0].ProductName + '">');
                                $('#productDescription').text(data.data[0].Description);
                            },
                            error: function (xhr, status, error) {
                                console.error(xhr.responseText);
                            }
                        });
                    });
                </script>
                <!-- Додано розділ для виводу Назви, Ціни, Зображення та Опис поза таблицею -->
                <div class="product-specs">
    <h3 id="productName"></h3>
    <div id="productImageContainer" class="product-images"></div>
    <h2>Ціна</h2>   
    <p id="productPrice"></p>
    <p id="productDescription"></p>
    <button id='addToCartBtn' class='add-to-cart-btn'>Додати в кошик</button>
    <h2>Технічні характеристики</h2>    
</div> 

                <!-- Табличка для виводу інших деталей -->
                <table id="productDetailsTable" class="product-specs">
                    <thead>
                        <tr>
                        <th>OS  </th>
                            <th>GPU</th>
                            <th>CPU</th>
                            <th>Memory</th>
                            <th>Storage</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </section>
    </section>
    <link href="https://cdn.datatables.net/v/dt/dt-2.0.3/datatables.min.css" rel="stylesheet">

    <script src="https://cdn.datatables.net/v/dt/dt-2.0.3/datatables.min.js"></script>

    <script>


        $(document).ready(function () {
            if ($.fn.DataTable) {
                $('#productDetailsTable').DataTable({
                    "processing": false,
                    "serverSide": true,
                    "bJQueryUI": false,
                    "searching": false, // Disable search bar
                    "paging": false, // Disable pagination
                    "info": false, // Disable table information display
                    "ordering": false, // Disable sorting
                    "ajax": {
                        "url": "./ProductConnect.php",
                        "data": function (data) {
                            data.id = <?php echo $_GET['id']; ?>;
                        }
                    },
                    "columns": [
                        { "data": "OS" },
                        { "data": "GPU" },
                        { "data": "CPU" },
                        { "data": "Memory" },
                        { "data": "Storage" }
                        
                    ]
                });
            } else {
                console.error("DataTables library is not loaded.");
            }
        });
    </script>



    <script>
        $(document).ready(function () {
            var initialWidth = 50; // Початкова ширина зображення (в пікселях)
            var initialHeight = 50; // Початкова висота зображення (в пікселях)
            var enlarged = false; // Початковий стан - не збільшений

            var enlarged = false;
            $('#productImage').on('click', '#productImage', function () {
                var $img = $(this);
                if (enlarged) {
                    $img.css({
                        width: '',
                        height: ''
                    });
                    enlarged = false;
                } else {
                    var newWidth = $img.width() * 2;
                    var newHeight = $img.height() * 2;
                    $img.css({
                        width: newWidth + 'px',
                        height: newHeight + 'px'
                    });
                    enlarged = true;
                }
            });
        });
    </script>

    <div id="cart-container">
        <span id="close-cart-btn">&times;</span>
        <div id="cart-items-container"></div>
        <div id="cart-summary">
            <p>Кількість предметів: <span id="total-items">0</span></p>
            <p>Вартість: ₴<span id="total-amount">0.00</span></p>
            <input type="email" id="email" placeholder="Введіть ел. пошту">
            <button id="checkout-btn">Сплатити замовлення</button>
        </div>
    </div>





    <?php include "./footer.php"; ?>



</body>

</html>