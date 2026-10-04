<?php
/** @var array $products */
?>
<h2>Product List</h2>
<a href="<?= base_url('products/create') ?>">Add Product</a> |
<a href="<?= base_url('auth/logout') ?>">Logout</a>
<table border="1" cellpadding="5">
    <tr>
        <th>ID</th><th>Name</th><th>Description</th><th>Price</th><th>Qty</th><th>Actions</th>
    </tr>
    <?php foreach ($products as $p): ?>
    <tr>
        <td><?= $p['id'] ?></td>
        <td><?= $p['product_name'] ?></td>
        <td><?= $p['description'] ?></td>
        <td><?= $p['price'] ?></td>
        <td><?= $p['quantity'] ?></td>
        <td>
            <a href="<?= base_url('products/edit/' . $p['id']) ?>">Edit</a>
            <a href="<?= base_url('products/delete/' . $p['id']) ?>" onclick="return confirm('Delete this product?')">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>