var user_id = 0;
var cartItems = null;

document.addEventListener('DOMContentLoaded', function () {
    const userIdContainer = document.getElementById('user-id-container');
    user_id = userIdContainer.dataset.userId;

     const placeOrderButton = document.getElementById('placeOrderButton');

     placeOrderButton.addEventListener('click', placeOrderButtonClicked);

    fetch(`DB/getListener.php?action=getCartItems&user_id=${user_id}`)
        .then(response => response.json())
        .then(response => {
            if (response.hasOwnProperty('cartItems')) {
                cartItems = response.cartItems;
                console.log(cartItems);
                populateCart(cartItems);
            } else {
                console.log("Error: Invalid JSON format");
            }
        })
        .catch(error => console.error('Fetch error:', error));
});

function getProduct(product_id) {
    return fetch(`DB/getListener.php?action=findProductById&product_id=${product_id}`)
        .then(response => response.json())
        .then(response => {
            if (response.hasOwnProperty('product')) {
                return response.product;
            } else {
                console.log("Error: Invalid JSON format");
                return null;
            }
        })
        .catch(error => {
            console.error('Fetch error:', error);
            return null;
        });
}

function populateCart(cartItems) {
    const cartContainer = document.querySelector('.col-lg-7 .card-body');

    cartContainer.innerHTML = '';

    let totalPrice = 0;

    Promise.all(cartItems.map(cartItem => getProduct(cartItem.product_id)))
        .then(products => {
            products.forEach((product, index) => {
                const cartItem = cartItems[index];

                const card = document.createElement('div');
                card.classList.add('card', 'mb-3');

                const cardBody = document.createElement('div');
                cardBody.classList.add('card-body');

                const productDetails = document.createElement('div');
                productDetails.classList.add('d-flex', 'justify-content-between');

                const productInfo = document.createElement('div');
                productInfo.classList.add('ms-3');
                productInfo.innerHTML = `
                    <h5>${product.product_name}</h5>
                    <p class="small mb-0">${product.product_description}</p>
                `;

                const quantityPrice = document.createElement('div');
                const price = product.product_price * cartItem.quantity;
                totalPrice += price;
                quantityPrice.classList.add('d-flex', 'flex-row', 'align-items-center');
                quantityPrice.innerHTML = `
                    <div style="width: 50px;">
                        <h5 class="fw-normal mb-0">${cartItem.quantity}</h5>
                    </div>
                    <div style="width: 80px;">
                        <h5 class="mb-0">$${price.toFixed(2)}</h5>
                    </div>
                    <button type="button" class="removeButton btn bg-blue-ui" data-bs-whatever="deleteProduct">Delete</button>
                `;

                const removeButton = quantityPrice.querySelector('.removeButton');
                removeButton.addEventListener('click', function (event) {
                    event.preventDefault();
                    deleteCartItem(cartItem.cart_item_id);
                });

                productDetails.appendChild(productInfo);

                cardBody.appendChild(productDetails);
                cardBody.appendChild(quantityPrice);

                card.appendChild(cardBody);

                cartContainer.appendChild(card);
            });

            updatePrice(totalPrice);
        });
}


function deleteCartItem(cartItem_Id) {
    if (confirm("Are you sure you want to remove this product?")) {
        const formData = new URLSearchParams();
        formData.append('form_action', 'removeCartItem');
        formData.append('cart_item_id', cartItem_Id);

        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'DB/postListener.php');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function () {
            console.log('Response received:');
            console.log(xhr.responseText);
        };

        xhr.send(formData);
    }
}

function updatePrice(subtotal) {
    var delivery_fee = 0;
    const subtotalDiv = document.getElementById('subtotal');
    const deliveryFee = document.getElementById('delivery-fee');

    var totalPrice = delivery_fee + subtotal;

    subtotalDiv.textContent = `$${subtotal.toFixed(2)}`;
    deliveryFee.textContent = `$${delivery_fee.toFixed(2)}`;

    const totalDivs = document.querySelectorAll('.total');
    totalDivs.forEach(totalDiv => {
        totalDiv.textContent = `$${totalPrice.toFixed(2)}`;
    });
}

function placeOrder(user_id, cartItems) {
    const formData = new URLSearchParams();

    formData.append('form_action', 'addOrderItems');
    formData.append('user_id', user_id);

    formData.append('cartItems', JSON.stringify(cartItems));

    console.log('Data being sent:', formData.toString());

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'DB/postListener.php');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        console.log('Response received:');
        console.log(xhr.responseText);
    };

    xhr.send(formData);
}


function placeOrderButtonClicked() {
    if (confirm("Place Order?")) {
        console.log("user_id:" + user_id);
        console.log("cartItems:" + cartItems);
        placeOrder(user_id, cartItems);
    }
}


