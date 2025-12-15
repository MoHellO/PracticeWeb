document.addEventListener('DOMContentLoaded', function () {
    // Retrieve product details from the URL
    var urlParams = new URLSearchParams(window.location.search);
    var productId = urlParams.get('productId');
    var productName = urlParams.get('productName');
    var productPrice = urlParams.get('productPrice');
  
    document.addEventListener("DOMContentLoaded", function() {
        var deliveryStatus = document.getElementById('deliveryStatus');
        if (deliveryStatus) {
            deliveryStatus.innerHTML = "Updated content";
        } else {
            console.error("Element with ID 'deliveryStatus' not found.");
        }
    });
    // Display product details on the form
    var productDetailsContainer = document.getElementById('product-details-container');
    productDetailsContainer.innerHTML = `
        <h2>Замовлення товару:</h2>
        <p>Товар: ${productName}</p>
        <p>Ціна: ${productPrice}</p>
        <input type="hidden" name="productId" value="${productId}">
        <input type="hidden" name="productName" value="${productName}">
        <input type="hidden" name="productPrice" value="${productPrice}">
    `;
  
  
    function sendOrderEmail(orderDetails) {
        Email.send({
            Host: "smtp.your-email-provider.com",
            Username: "golomi1151@gmail.com",
            Password: "12345678900qw",
            To: 'dd805096@gmail.com',
            From: "golomi1151@gmail.com",
            Subject: 'UAKA',
            Body: orderDetails.join('\n'),
        }).then(
            message => alert('Order placed successfully!'),
            error => alert('Error placing order: ' + error)
        );
    }
  });
  
  