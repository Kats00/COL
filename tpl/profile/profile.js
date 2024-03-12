document.addEventListener('DOMContentLoaded', function () {
    const userIdContainer = document.getElementById('user-id-container');
    user_id = userIdContainer.dataset.userId;

    getUser(user_id);
    getOrders(user_id);
});

function getUser(user_id) {
    fetch(`DB/getListener.php?action=findUserById&user_id=${user_id}`)
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then(response => {
            if (response.hasOwnProperty('user')) {
                const user = response.user;
                console.log(user);

                updateUserInfo(user);
                updateUserCard(user);
                populateForm(user)
            } else {
                console.log("Error: Invalid JSON format");
            }
        })
        .catch(error => console.error('Fetch error:', error));
}

function getOrders(user_id){
    fetch(`DB/getListener.php?action=getOrdersByUserId&user_id=${user_id}`)
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then(response => {
            if (response.hasOwnProperty('orders')) {
                const orders = response.orders;
                console.log(orders);

                orders.forEach(order => {
                    fetch(`DB/getListener.php?action=getOrderItems&order_id=${order.order_id}`)
                        .then(response => response.json())
                        .then(orderItemsResponse => {
                            const orderItems = orderItemsResponse.orderItems;
                            console.log(`Order Items for Order ID ${order.order_id}:`, orderItems);
                           
                            renderOrderDetails(order, orderItems)
                        })
                        .catch(error => console.error('Fetch error (Order Items):', error));
                });
            } else {
                console.log("Error: Invalid JSON format");
            }
        })
        .catch(error => console.error('Fetch error:', error));
    
}

function updateUserInfo(user) {
    const userDetailsContainer = document.getElementById('user-details');

    const htmlContent = `

        <div class="row">
            <div class="col-sm-3">
                <h6 class="mb-0">Name</h6>
            </div>
            <div class="col-sm-9 text-secondary">
                ${user.first_name} ${user.last_name}
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-3">
                <h6 class="mb-0">Email</h6>
            </div>
            <div class="col-sm-9 text-secondary">
                ${user.email}
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-3">
                <h6 class="mb-0">Mobile</h6>
            </div>
            <div class="col-sm-9 text-secondary">
                ${user.contact_num}
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-3">
                <h6 class="mb-0">Address</h6>
            </div>
            <div class="col-sm-9 text-secondary">
                ${user.address}
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-12">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                    Edit
                </button>
            </div>
        </div>
    `;

    userDetailsContainer.innerHTML = htmlContent;
}

function updateUserCard(user){
    const profilePictureContainer = document.getElementById('user-card');

    const htmlContent = `
        <div class="d-flex flex-column align-items-center text-center">
            <img src="assets/Uploads/${user.profile_picture || 'noPic.png'}" alt="profile picture" class="rounded-circle" width="150">
            <div class="mt-3">
                <h4>${user.first_name} ${user.last_name}</h4>
            </div>
        </div>
    `;

    profilePictureContainer.innerHTML = htmlContent;
}

function renderOrderDetails(order, orderItems) {
    const tableBody = document.querySelector('.table tbody');
    var user;

    Promise.all(orderItems.map(orderItem => getProductById(orderItem.product_id)))
        .then(products => {
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <th scope="row">${order.order_id}</th>
                <td>${order.date_ordered}</td>
                <td>${order.status}</td>
                <td>${renderOrderedProducts(products, orderItems)}</td>
                <td>$${calculateTotalPrice(orderItems).toFixed(2)}</td>
                <td>
                    <button type="button" class="status-btn btn bg-blue-ui">
                        ${order.status === 'open' ? 'Cancelled' : ' '}
                    </button>
                </td>
            `;

            tableBody.appendChild(newRow);
        
            const statusBtn = newRow.querySelector('.status-btn');
        
            if (statusBtn) {
                statusBtn.addEventListener('click', () => {
                    const newStatus = "cancelled";
        
                    changeOrderStatus(order.order_id, newStatus);
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}


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

function renderOrderedProducts(products, orderItems) {
    let productsString = '';

    orderItems.forEach((orderItem, index) => {
        const product = products.find(product => product.product_id === orderItem.product_id);

        if (product) {
            productsString += `${product.product_name} (${orderItem.quantity})`;
        } else {
            productsString += `Product (${orderItem.quantity})`;
        }

        if (index < orderItems.length - 1) {
            productsString += ', ';
        }
    });

    return productsString;
}


function calculateTotalPrice(orderItems) {
    // Calculate the total price based on the order items
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

function populateForm(userData) {
    document.getElementById('first_name').value = userData.first_name;
    document.getElementById('last_name').value = userData.last_name;
    document.getElementById('email').value = userData.email;
    document.getElementById('contact_num').value = userData.contact_num;
    document.getElementById('address').value = userData.address;
    // Populate radio button based on user type
    document.getElementById(userData.user_type).checked = true;
}

