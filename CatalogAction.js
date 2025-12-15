document.addEventListener('DOMContentLoaded', function () {
    // Cart object to encapsulate cart-related functions
    var cart = {
        icon: document.getElementById('icon-cart-navbar'),
        container: document.getElementById('cart-container'),
        closeBtn: document.getElementById('close-cart-btn'),
        itemsContainer: document.getElementById('cart-items-container'),
        checkoutBtn: document.getElementById('checkout-btn'),

        init: function () {
            this.checkoutBtn.addEventListener('click', this.checkout.bind(this));
            this.icon.addEventListener('click', this.toggleCart.bind(this));
            this.closeBtn.addEventListener('click', this.closeCart.bind(this));
            this.updateCartUI();
        },
        addToCart: function (itemName, itemPrice) {
            if (this.itemsContainer) {
                var cartItem = document.createElement('div');
                cartItem.classList.add('cart-item');
                cartItem.innerHTML = '<p>' + itemName + '</p><span>' + itemPrice + '</span><button class="remove-item">Видалити</button>';
                this.itemsContainer.appendChild(cartItem);
                this.updateCartUI();
                this.updateDeliveryCost();
                // Add event listener for removing the item
                var removeButton = cartItem.querySelector('.remove-item');
                removeButton.addEventListener('click', function () {
                    cart.removeFromCart(cartItem);
                });
            }
        },

        removeFromCart: function (cartItem) {
            cartItem.remove();
            this.updateCartUI();
            this.updateDeliveryCost();
        },
        updateDeliveryCost: function () {
            if (this.itemsContainer) {
                var cartItems = this.itemsContainer.querySelectorAll('.cart-item');
                var totalItems = cartItems.length;
                var deliveryCost = totalItems > 5 ? 0 : totalItems * 300;
                var deliveryCostElement = document.getElementById('delivery-cost');
                if (deliveryCostElement) {
                    deliveryCostElement.innerText = deliveryCost;
                }
            }
        },
        updateCartUI: function () {
            if (this.itemsContainer) {
                var cartItems = this.itemsContainer.querySelectorAll('.cart-item');

                // Update total items
                var totalItems = cartItems.length;
                var totalItemsElement = document.getElementById('total-items');
                if (totalItemsElement) {
                    totalItemsElement.innerText = totalItems;
                }

                // Update total amount
                var totalAmount = 0;
                var cartItemsHTML = '';
                cartItems.forEach(function (item) {
                    var itemName = item.querySelector('p').innerText;
                    var itemPrice = parseFloat(item.querySelector('span').innerText);
                    totalAmount += itemPrice;
                    cartItemsHTML += '<p>' + itemName + ' <span class="price">$' + itemPrice.toFixed(2) + '</span></p>';
                });
                if (this.itemsDisplay) {
                    this.itemsDisplay.innerHTML = cartItemsHTML;
                }
                var totalAmountElement = document.getElementById('total-amount');
                if (totalAmountElement) {
                    totalAmountElement.innerText = totalAmount.toFixed(2);
                }
            }
        },

        checkout: function () {
            if (this.itemsContainer) {
                // Отримати дані з корзини
                var cartItems = cart.itemsContainer.querySelectorAll('.cart-item');
                var cartItemDetails = [];
                cartItems.forEach(function (item) {
                    var itemName = item.querySelector('p').innerText;
                    var itemPrice = parseFloat(item.querySelector('span').innerText);
                    var itemQuantity = 1; // Вам потрібно реалізувати логіку отримання кількості товарів
                    cartItemDetails.push({
                        name: itemName,
                        price: itemPrice,
                        quantity: itemQuantity
                    });
                });
                // Отримання даних з форми купівлі
                
                var email = document.getElementById('email').value;
                

                // Валідація даних
                if ( email === '' ) {
                    alert('Будь ласка, заповніть обовязкове поле.');
                    return;
                }

                // Створення об'єкту з даними для передачі на сторінку оформлення замовлення
                var orderData = {
                    email: email,
                    
                    cart: cartItemDetails
                };

                // Передача даних на сторінку "DeliveryForm.php"
                localStorage.setItem('orderData', JSON.stringify(orderData));
                window.location.href = "./DeliveryForm.php";
            }
        },

        clearCart: function () {
            if (this.itemsContainer) {
                // Очистіть вміст корзини
                this.itemsContainer.innerHTML = '';
                // Оновіть інтерфейс корзини
                this.updateCartUI();
            }
        },

        toggleCart: function () {
            if (this.container) {
                this.container.classList.toggle('open');
                document.body.classList.toggle('open-cart');
                document.body.style.overflow = this.container.classList.contains('open') ? 'hidden' : 'auto';
            }
        },

        closeCart: function () {
            if (this.container) {
                this.container.classList.remove('open');
                document.body.classList.remove('open-cart');
                document.body.style.overflow = 'auto';
            }
        }
    };

    // Initialize the cart
    cart.init();

    // Optional: Add event listeners for adding items to the cart
    document.querySelectorAll('.cart-icon').forEach(function (cartIcon) {
        cartIcon.addEventListener('click', function () {
            // Отримання назві та ціни товару
            var itemName = this.closest('.row').querySelector('.price h4').innerText;
            var itemPrice = this.closest('.row').querySelector('.price p').innerText;
            // Додавання товару до корзини
            cart.addToCart(itemName, itemPrice);
        });
    });

    // Add event listener for adding item to the cart from the product page
    if (document.getElementById('addToCartBtn')) {
        document.getElementById('addToCartBtn').addEventListener('click', function () {
            // Отримання назві та ціни товару
            var itemName = document.getElementById('productName').innerText;
            var itemPrice = document.getElementById('productPrice').innerText;
            // Додавання товару до корзини
            cart.addToCart(itemName, itemPrice);
        });
    }
    
});