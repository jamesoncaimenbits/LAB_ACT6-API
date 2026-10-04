<?php
/** @var array $product */
?>
<h2>Add Product</h2>
<form method="post" action="<?= base_url('products/create') ?>">
    <input type="text" name="product_name" placeholder="Product Name" required><br>
    <textarea name="description" placeholder="Description"></textarea><br>
    <input type="number" step="0.01" name="price" placeholder="Price" required><br>
    <input type="number" name="quantity" placeholder="Quantity" required><br>
    <button type="submit">Save</button>
</form>
<a href="<?= base_url('products') ?>">Back</a>