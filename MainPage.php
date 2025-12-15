<?php
session_start();
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Головна сторінка</title>
    <?php include "./links.php"; ?>
</head>
<body>
    <?php include "./Header.php"; ?>

    <!-- Main page -->
    <section class="main-home" id="Main">  
        <div class="main-text">
            <h1>Магазин, де кожен гравець знаходить свій шлях до пригод.</h1>
            <p>Ласкаво просимо до нашого універсуму ігор! Тут кожен гравець знаходить свій власний шлях до неймовірних пригод. Від захоплюючих інді-ігор до найочікуваніших блокбастерів, ми пропонуємо найширший вибір гарячих новинок та класичних шедеврів. Зануртесь у світ ігор разом з нами!</p>
        </div>
        <div class="down-arrow">
            <a href="#catalog" class="down"><i class="bx bx-down-arrow-alt"></i></a>
        </div>
    </section>  

    <section class="catalog-product" id="catalog">
        <div class="center-text">
            <h2>Search Games</h2>
            <input type="text" id="searchInput" placeholder="Пошук...">
        </div>
        <div class="products">
        <?php
            include "./ConnectingDb.php";
            $sql = "SELECT * FROM products";
            $result = mysqli_query($conn, $sql);
            if ($result) {  
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<div class='row'>";
                        echo "<a href='ProductDetails.php?id=" . $row["id"] . "'><img src='" . $row["Image"] . "' alt=' '></a>";
                        echo "<div class='product-text'>";
                        echo "<h5>Sale " . $row["Sale"] . "</h5>";
                        echo "</div>";
                        echo "<div class='cart-icon'>";
                        echo "<button id='addToCartBtn' class='add-to-cart-btn'>Додати в кошик</button>";
                        echo "</div>";
                        echo "<div class='price'>";
                        echo "<h4>" . $row["ProductName"] . "</h4>";
                        echo "<p>" . $row["Price"] . " ₴</p>";
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "No results found.";
                }
            } else {
                echo "Error executing the query: " . mysqli_error($conn);
            }
        ?>
        </div>
    </section>

    <?php 
    include "footer.php";
    mysqli_query($conn, $sql);
    mysqli_close($conn);
    ?>

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

    <script> 
    document.addEventListener('DOMContentLoaded', function () {
        // Функція для фільтрації елементів за введеними користувачем даними
        function filterItems(searchTerm) {
            var items = document.querySelectorAll('.row'); // Замініть '.row' на селектор вашого товару
            items.forEach(function (item) {
                var itemName = item.querySelector('.price h4').innerText.toLowerCase(); // Замініть '.price h4' на селектор вашої назви товару
                if (itemName.includes(searchTerm.toLowerCase())) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        }

        // Додавання події для обробки введення користувачем у поле пошуку
        document.getElementById('searchInput').addEventListener('input', function () {
            var searchTerm = this.value.trim(); // Отримання введених даних та видалення пробілів
            filterItems(searchTerm); // Виклик функції фільтрації
        });

        // Додаткові функції та ініціалізація корзини тут...
    });
    </script>
</body>
</html>
