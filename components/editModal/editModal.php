<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="editProductForm" action="DB/postListener.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="edit_product_picture">Product Picture:</label>
            <input type="file" class="form-control-file" id="edit_product_picture" name="edit_product_picture" accept="image/*">
        </div>

        <div class="form-outline mb-4">
            <input type="text" id="edit_product_id" name="edit_product_id" class="form-control form-control-lg" placeholder="Product ID" disabled />
        </div>
        <div class="form-outline mb-4">
            <input type="text" id="edit_product_name" name="edit_product_name" class="form-control form-control-lg" placeholder="Product Name" required />
        </div>

        <div class="form-outline mb-4">
            <input type="number" id="edit_product_price" name="edit_product_price" class="form-control form-control-lg" placeholder="Product Price" required />
        </div>

        <div class="form-outline mb-4">
            <input type="number" id="edit_product_qty" name="edit_product_qty" class="form-control form-control-lg" placeholder="Quantity" required />
        </div>

        <div class="form-outline mb-4">
            <input type="text" id="edit_product_description" name="edit_product_description" class="form-control form-control-lg" placeholder="Product Description" required />
        </div>

        <div class="modal-footer">
            <div class="row">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="form_action" onclick="editProduct()">Save changes</button>
            </div>
        </div>
    </form>

      </div>
    </div>
  </div>
</div>