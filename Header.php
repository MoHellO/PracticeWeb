<?php
session_start();
?>

<header>
    <a href="#" class="logo"><img src="/PracticeWeb/PicturesForWeb/Logotype12.png" alt="UAKA"></a>
    <ul class="navmenu">
        <li><a href="/PracticeWeb/MainPage.php">Головна сторінка</a></li>
        <li><a href="#catalog">Каталог</a></li>
        <li><a href="/PracticeWeb/AboutUS.php">Про нас</a></li>
       
    </ul>
    <div class="nav-icon">
        <div class="bx bxs-cart" id="icon-cart-navbar"></div>
    </div>

            <div class="bx bxs-user" id="icon-user-navbar" onclick="toggleLoginForm()"></div>
       
    </div>
</header>

<!-- Форма для входу та реєстрації -->
<div id="login-container">
    <div id="close-login-btn">✖</div>
    <h2>Вхід в акаунт</h2>
    <input type="email" id="login-email" placeholder="Введіть ел. пошту">
    <input type="password" id="login-password" placeholder="Введіть пароль">
    <button id="login-btn">Вхід</button>
    <p>Немає акаунта? <span id="show-register-form">Реєстрація</span></p>
</div>

<div id="register-container" style="display: none;">
    <div id="close-register-btn">✖</div>
    <h2>Реєстрація</h2>
    <input type="email" id="register-email" placeholder="Введіть ел. пошту">
    <input type="password" id="register-password" placeholder="Введіть пароль">
    <button id="register-btn">Реєстрація</button>
    <p>Вже є акаунт? <span id="show-login-form">Вхід</span></p>
</div>
<!-- Кошик -->
<div id="cart-container">
    <div id="close-cart-btn">✖</div>
    <h2>Кошик</h2>
    <div id="cart-items-container"></div>
    <div>
        <p>Всього товарів: <span id="total-items">0</span></p>
        <p>Загальна сума: <span id="total-amount">0.00</span> ₴</p>
        <p>Вартість доставки: <span id="delivery-cost">0</span> ₴</p>
        <input type="email" id="email" placeholder="Введіть ел. пошту">
        <button id="checkout-btn">Оформити замовлення</button>
    </div>
</div>
