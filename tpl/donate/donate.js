document.addEventListener('DOMContentLoaded', function () {

    const userIdContainer = document.getElementById('user-id-container');
    const user_id = userIdContainer.dataset.userId;

    const userTypeContainer = document.getElementById('user-type-container');
    const userType = userTypeContainer.dataset.userRole;

    console.log('User ID:', user_id);
    console.log('userType:', userType);

    fetch('DB/getListener.php?action=getProducts')
        .then(response => {
            console.log('Response:', response);
            return response.json();
        })
        .then(response => {
            if (response.hasOwnProperty('products')) {
            const productsData = response.products;
            console.log(productsData);
            const carouselInner1 = document.querySelector('#productCarousel1 .carousel-inner');
            const carouselInner2 = document.querySelector('#productCarousel2 .carousel-inner');

            const productsForKid = productsData.filter(product => product.product_for === 'kid');
            const productsForCom = productsData.filter(product => product.product_for === 'com');

            populateCarousel(productsForKid, carouselInner1, user_id);

            populateCarousel(productsForCom, carouselInner2, user_id);
            showHide(userType);
            updateCartVisibility(user_id);
          
            } else {
            console.log("Error: Invalid JSON format");
    }
  })
  .catch(error => console.error('Fetch error:', error));
    
});

function populateCarousel(products, carouselInner, user_id) {
    for (let i = 0; i < products.length; i += 4) {
      const slideDiv = document.createElement('div');
      slideDiv.classList.add('carousel-item');
      if (i === 0) {
        slideDiv.classList.add('active');
      }
  
      const rowDiv = document.createElement('div');
      rowDiv.classList.add('row');
  
      const productsSlice = products.slice(i, i + 4);
  
      productsSlice.forEach(product => {
        console.log(product);
        const productDiv = document.createElement('div');
        productDiv.classList.add('col-md-3', 'mb-4');
  
        productDiv.innerHTML = `
            <div class="item-box-blog">
                <div class="item-box-blog-image">
                    <figure>
                        <img alt="No Product" src="assets/Uploads/${product.product_picture}">
                    </figure>
                </div>
                <div class="item-box-blog-body">
                    <div class="item-box-blog-heading">
                        <a href="#" tabindex="0">
                            <h5>${product.product_name}</h5>
                        </a>
                    </div>
                    <div class="productId item-box-blog-data" style="padding: 0 15px;">
                        <p>${product.product_id}</p>
                    </div>
                    <div class="item-box-blog-text">
                        <p>Price: ${product.product_price}</p>
                    </div>
        
                    <!-- Quantity Section -->
                    <div class="quantity-section">
                        <button class="quantity-btn decrement-btn" data-product-id="${product.product_id}">-</button>
                        <span class="quantity" data-product-id="${product.product_id}">1</span>
                        <button class="quantity-btn increment-btn" data-product-id="${product.product_id}">+</button>
                    </div>
        
                    <button type="button" class="editButton btn bg-blue-ui" data-toggle="modal" data-target="#exampleModalCenter" data-bs-whatever="editProduct">Edit</button>
                    <button type="button" class="deleteButton btn bg-blue-ui" data-bs-whatever="deleteProduct">Delete</button>
                    <button type="button" class="addToCart btn btn-primary btn-lg btn-block">Add to Cart</button>
                </div>
            </div>
        `;

        const deleteButton = productDiv.querySelector('.deleteButton');

        deleteButton.addEventListener('click', function (event) {
            event.preventDefault();
            const productId = productDiv.querySelector('.productId').textContent;
            deleteProduct(productId);
          });
        const editButton = productDiv.querySelector('.editButton');

        editButton.addEventListener('click', function (event) {
          event.preventDefault();
          const productId = productDiv.querySelector('.productId').textContent;
          populateEdit(productId);
        });
        
        const incrementButton = productDiv.querySelector('.increment-btn');
        const decrementButton = productDiv.querySelector('.decrement-btn');
        const quantitySpan = productDiv.querySelector('.quantity');
  
        incrementButton.addEventListener('click', function () {
          const currentQuantity = parseInt(quantitySpan.textContent);
          quantitySpan.textContent = currentQuantity + 1;
        });
  
        decrementButton.addEventListener('click', function () {
          const currentQuantity = parseInt(quantitySpan.textContent);
          if (currentQuantity > 1) {
            quantitySpan.textContent = currentQuantity - 1;
          }
        });

        const addToCartButton = productDiv.querySelector('.addToCart');
        addToCartButton.addEventListener('click', function () {
            const productId = product.product_id;
            const quantity = parseInt(productDiv.querySelector('.quantity').textContent);
            const userid = user_id;

            addToCart(productId, quantity, userid);
        });



        rowDiv.appendChild(productDiv);
      });
  
      slideDiv.appendChild(rowDiv);
      carouselInner.appendChild(slideDiv);
    }
  }
  

  function populateEdit(product_id) {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', `DB/getListener.php?action=findProductById&product_id=${product_id}`, true);
    xhr.setRequestHeader('Content-Type', 'application/json');

    xhr.onload = function () {
        if (xhr.status === 200) {
            try {
                const response = JSON.parse(xhr.responseText);

                if (response.hasOwnProperty('product')) {
                    const product = response.product;

                    const productIDInput = document.getElementById('edit_product_id');
                    const productNameInput = document.getElementById('edit_product_name');
                    const productPriceInput = document.getElementById('edit_product_price');
                    const productQtyInput = document.getElementById('edit_product_qty');
                    const productDescriptionInput = document.getElementById('edit_product_description');

                    productIDInput.value = product_id;
                    productNameInput.value = product.product_name;
                    productPriceInput.value = product.product_price;
                    productQtyInput.value = product.product_qty;
                    productDescriptionInput.value = product.product_description;

                    const editProductBtn = document.getElementById('editProductBtn');
                    editProductBtn.onclick = function () {
                        editProduct(product.product_id);
                    };


                    const modal = new bootstrap.Modal(document.getElementById('exampleModalCenter'));
                    modal.show();
                } else {
                    console.log("Error: Invalid JSON format");
                }

            } catch (e) {
                console.log("JSON Parsing Error: " + e);
            }
        } else {
            console.log("Error");
        }
    };

    xhr.send();
}

function editProduct() {
    const formData = new FormData();
    formData.append('form_action', 'editProduct');
    formData.append('edit_product_id', document.getElementById('edit_product_id').value);
    formData.append('edit_product_name', document.getElementById('edit_product_name').value);
    formData.append('edit_product_price', document.getElementById('edit_product_price').value);
    formData.append('edit_product_qty', document.getElementById('edit_product_qty').value);
    formData.append('edit_product_description', document.getElementById('edit_product_description').value);

    const pictureInput = document.getElementById('edit_product_picture');
    if (pictureInput.files.length > 0) {
        formData.append('edit_product_picture', pictureInput.files[0]);
    }

    const xhr = new XMLHttpRequest();
    console.log(formData);
    xhr.open('POST', 'DB/postListener.php');

    xhr.onload = function () {
        console.log('Response received:');
        console.log(xhr.responseText);
    };

    xhr.send(formData);
}

function deleteProduct(product_id) {
    if (confirm("Are you sure you want to delete this product?")) {
        const formData = new URLSearchParams();
        formData.append('form_action', 'deleteProduct');
        formData.append('delete_product_id', product_id);

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

function addToCart(productId, quantity, user_id) {
    const formData = new URLSearchParams();
    formData.append('form_action', 'addToCart');
    formData.append('product_id', productId);
    formData.append('quantity', quantity);
    formData.append('user_id', user_id);

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

function showHide(userType) {
    var editButtons = document.querySelectorAll('.editButton');
    var deleteButtons = document.querySelectorAll('.deleteButton');

    console.log('editButtons:', editButtons);
    console.log('deleteButtons:', deleteButtons);

    if (userType === 'admin') {
        editButtons.forEach(function (button) {
            button.style.display = 'block !important';
        });

        deleteButtons.forEach(function (button) {
            button.style.display = 'block !important';
        });
    } else {
        editButtons.forEach(function (button) {
            button.style.display = 'none';
        });

        deleteButtons.forEach(function (button) {
            button.style.display = 'none';
        });
    }
}

function updateCartVisibility(userID) {
    var addToCartButtons = document.querySelectorAll('.addToCart');

    console.log('addToCartButtons:', addToCartButtons);

    if (userID && userID.trim() !== '') {
        addToCartButtons.forEach(function (button) {
            button.style.display = 'block !important';
        });
    } else {
        addToCartButtons.forEach(function (button) {
            button.style.display = 'none';
        });
    }
}
