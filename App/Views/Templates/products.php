<h1>All Products</h1>
<ul>
    <?php
        foreach($allProducts as $product) {
            ?>
                <li>
                    <div>
                        product: <?= $product['product'] ?>
                        price: <?= $product['price'] ?>
                    </div>
                </li>
            <?php
        }
    ?>
</ul>

<a href="/products/create">
    <button>Add Product</button>
</a>