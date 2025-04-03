<h1>{{ mainTitle }}</h1>
<ul>
    <?php
        foreach($viewData['allProducts'] as $product) {
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