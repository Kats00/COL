document.addEventListener('DOMContentLoaded', function () {

    const userIdContainer = document.getElementById('user-id-container');
    const user_id = userIdContainer.dataset.userId;

    console.log('User ID:', user_id);

    fetch(`DB/getListener.php?action=getOrders&user_id=${user_id}`)
        .then(response => response.json())
        .then(ordersResponse => {
            const orders = ordersResponse.orders;
            console.log('Orders:', orders);

            orders.forEach(order => {
                fetch(`DB/getListener.php?action=getOrderItems&order_id=${order.order_id}`)
                    .then(response => response.json())
                    .then(orderItemsResponse => {
                        const orderItems = orderItemsResponse.orderItems;
                        console.log(`Order Items for Order ID ${order.order_id}:`, orderItems);

                        renderOrderDetails(order, orderItems);
                    })
                    .catch(error => console.error('Fetch error (Order Items):', error));
            });
        })
        .catch(error => console.error('Fetch error (Orders):', error));
});

async function getProductById(product_id) {
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

async function getCustomerById(user_id) {
    return fetch(`DB/getListener.php?action=findUserById&user_id=${user_id}`)
        .then(response => response.json())
        .then(response => {
            if (response.hasOwnProperty('user')) {
                return response.user;
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

function renderOrderDetails(order, orderItems) {
    const tableBody = document.querySelector('.table tbody');
    var user;

    getCustomerById(order.user_id)
        .then(userData => {
            user = userData;

            return Promise.all(orderItems.map(orderItem => getProductById(orderItem.product_id)));
        })
        .then(products => {
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <th scope="row">${order.order_id}</th>
                <td>${order.date_ordered}</td>
                <td>${order.status}</td>
                <td>${user ? user.email : ''}</td>
                <td>${renderOrderedProducts(products, orderItems)}</td>
                <td>$${calculateTotalPrice(orderItems).toFixed(2)}</td>
                <td>
                    <button type="button" class="status-btn btn bg-blue-ui">
                        ${order.status === 'open' ? 'Close' : 'Open'}
                    </button>
                </td>
            `;
        
            tableBody.appendChild(newRow);
        
            const statusBtn = newRow.querySelector('.status-btn');
        
            if (statusBtn) {
                statusBtn.addEventListener('click', () => {
                    const newStatus = order.status === 'open' ? 'closed' : 'open';
        
                    changeOrderStatus(order.order_id, newStatus);
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
        
}


function renderOrderedProducts(products, orderItems) {
    let productsString = '';

    orderItems.forEach((orderItem, index) => {
        const product = products.find(product => product.product_id === orderItem.product_id);

        if (product) {
            productsString += `${product.product_name} (${orderItem.quantity})`;
        } else {
            productsString += `Product (${orderItem.quantity})`;
        }

        // Add a comma for all items except the last one
        if (index < orderItems.length - 1) {
            productsString += ', ';
        }
    });

    return productsString;
}


function calculateTotalPrice(orderItems) {
    return orderItems.reduce((total, orderItem) => total + orderItem.price, 0);
}

function changeOrderStatus(order_id, newStatus) {
    const formData = new URLSearchParams();
    formData.append('form_action', 'changeStatus');
    formData.append('order_id', order_id);
    formData.append('newStatus', newStatus);
   

    const xhr = new XMLHttpRequest();
    console.log(formData);
    xhr.open('POST', 'DB/postListener.php');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        console.log('Response received:');
        console.log(xhr.responseText);
    };

    xhr.send(formData);
}
