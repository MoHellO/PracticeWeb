<!DOCTYPE html>
<html lang="uk">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Форма Замовлення</title>
<script src="Delivery.js"></script>
<div id="product-details-container"></div>
<?php 
include "links.php";
?>
<script src="https://cdn.emailjs.com/dist/email.min.js"></script>
</head>
<body>
<?php
include "Header.php";
?>
<section class="main-home" id="Main">   
    <div class="main-text">
        <h1>Замовлення</h1>
        <div id="order-details"></div>
            <div class="col-75">
                    <form action="/action_page.php">
                            <div class="col-50">
                                <h3>Купівля</h3>
                            </div>
                            <div class="col-50">
                                </div>
                                <label for="cname">Імя на карті</label>
                                <input type="text" id="cname" name="cardname" placeholder="John More Doe">
                                <label for="ccnum">Номер карти</label>
                                <input type="text" id="ccnum" name="cardnumber" placeholder="1111 2222 3333 4444" maxlength="19">
                                <label for="expmonth">Термін дії</label>
                                <input type="text" id="expmonth" name="expmonth" placeholder="DD/MM/YYYY" maxlength="10">
                                <label for="cvv">CVV</label>
                                <input type="text" id="cvv" name="cvv" placeholder="352" maxlength="3" style="width: 50px;">
                            </div>
                        </div>
                        </div>
                        <button id="confirm-order-btn">Підтвердити замовлення</button>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>
</section>
<script>
    document.addEventListener('DOMContentLoaded', function () {
    var cvvInput = document.getElementById('cvv');

    cvvInput.addEventListener('input', function () {
        cvvInput.value = cvvInput.value.replace(/\D/g, '').substring(0, 3); // Remove non-digit characters and limit to 3 digits
    });
});
    document.addEventListener('DOMContentLoaded', function () {
    var ccNumInput = document.getElementById('ccnum');

    ccNumInput.addEventListener('input', function () {
        var input = ccNumInput.value;
        input = input.replace(/\D/g, ''); // Remove all non-digit characters

        var formattedInput = '';
        for (var i = 0; i < input.length; i++) {
            if (i > 0 && i % 4 === 0) {
                formattedInput += ' ';
            }
            formattedInput += input[i];
        }

        ccNumInput.value = formattedInput.substring(0, 19); // Limit input to 19 characters
    });
});
    document.addEventListener('DOMContentLoaded', function () {
    var expMonthInput = document.getElementById('expmonth');

    expMonthInput.addEventListener('input', function () {
        var input = expMonthInput.value;
        input = input.replace(/\D/g, ''); // Remove all non-digit characters

        if (input.length > 2) {
            input = input.substring(0, 2) + '/' + input.substring(2);
        }
        if (input.length > 5) {
            input = input.substring(0, 5) + '/' + input.substring(5);
        }
        if (input.length > 10) {
            input = input.substring(0, 10); // Limit input to 10 characters
        }

        expMonthInput.value = input;
    });
});
document.addEventListener('DOMContentLoaded', function () {
    var orderData = JSON.parse(localStorage.getItem('orderData'));
    if (orderData) {
        var orderHTML = `
            <h2>Деталі клієнта</h2>
            <p>Email: ${orderData.email}</p>
            <h2>Замовлення</h2>
            <ul>
        `;
        orderData.cart.forEach(function(item) {
            orderHTML += `<li>${item.name} - Ціна: ${item.price} ₴, Кількість: ${item.quantity}</li>`;
        });
        orderHTML += '</ul>';
        document.getElementById('order-details').innerHTML = orderHTML;
    } else {
        document.getElementById('order-details').innerHTML = '<p>Деталі замовлення не знайдені.</p>';
    }

    document.getElementById('confirm-order-btn').addEventListener('click', function() {
        var orderData = JSON.parse(localStorage.getItem('orderData'));
        if (orderData) {
            var deliveryCostElement = document.getElementById('delivery-cost');
            if (deliveryCostElement) {
                orderData.deliveryCost = deliveryCostElement.value;
            }
            var paymentTypeElement = document.getElementById('payment-type');
            if (paymentTypeElement) {
                orderData.paymentType = paymentTypeElement.value;
            }
            // Додайте код для отримання даних карти і додавання їх до об'єкту orderData
            // Наприклад:
         // orderData.cardNumber = document.getElementById('card-number').value;
            placeOrder(orderData);
        } else {
            alert('Деталі замовлення не знайдені.');
        }
    });


    var orderData = JSON.parse(localStorage.getItem('orderData'));
    if (orderData) {
        var deliveryCostElement = document.getElementById('delivery-cost');
        if (deliveryCostElement) {
            deliveryCostElement.value = orderData.deliveryCost || 0;
        }
        var paymentTypeElement = document.getElementById('payment-type');
        if (paymentTypeElement) {
            paymentTypeElement.value = orderData.paymentType || 'cash-on-delivery';
        }
    }
});
function placeOrder(orderData) {
    // Формування даних для шаблону
    const templateParams = {
        to_email: orderData.email,
        from_name: 'DEN',
        subject: 'Підтвердження покупку',
        name: orderData.name,
        items: orderData.cart, // Масив товарів з деталями та кількістю
        totalAmount: orderData.totalAmount // Загальна вартість замовлення
    };

    // Відправка електронної пошти через emailjs
    emailjs.send("service_26hqwko","template_2yvlj16", templateParams)
        .then(function(response) {
            console.log('Email успішно відправлено:', response);
            alert("Вам був відправлений email лист!");
        })
        .catch(function(error) {
            console.error('Помилка при відправленні email:', error);
            alert("Виникла помилка при відправленні замовлення.");
        });
}
emailjs.init('Jgh665_vo2GCRfz-2');
</script>
</body>
</html>
