<?php
/** @var array $product */
?>
<h2>Edit Product</h2>
<form method="post" action="<?= base_url('products/edit/' . $product['id']) ?>">
    <input type="text" name="product_name" value="<?= $product['product_name'] ?>" required><br>
    <textarea name="description"><?= $product['description'] ?></textarea><br>
    <input type="number" step="0.01" name="price" value="<?= $product['price'] ?>" required><br>
    <input type="number" name="quantity" value="<?= $product['quantity'] ?>" required><br>
    <button type="submit">Update</button>
</form>
<a href="<?= base_url('products') ?>">Back</a>