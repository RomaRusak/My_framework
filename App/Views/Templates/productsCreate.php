<h1>Add product</h1>
    <div>
        <form action="/products" method="POST">
            <div>
                <label for="productName">Product name</label>
                <input 
                value="<?= isset($validatedData['productName']) ? $validatedData['productName']: '' ?>"
                type="text" 
                name="productName" 
                id="productName" 
                required
                >
                <?php
                    if (isset($validatedData['productName']) && count($validatedData['productNameErrors'])) {
                        ?>
                            <ul>
                                <?php
                                    foreach($validatedData['productNameErrors'] as $error) {
                                        ?>
                                        <li>
                                            <p><?= $error ?></p>
                                        </li>
                                        <?php
                                    }
                                ?>
                            </ul>
                        <?php
                    }
                ?>
            </div>
            <div>
                <label for="productPrice">Product price</label>
                <input 
                value="<?= isset($validatedData['productPrice']) ? $validatedData['productPrice']: '' ?>"
                type="number" 
                id="productPrice" 
                name="productPrice" 
                required
                >
                <?php
                    if (isset($validatedData['productPriceErrors']) && count($validatedData['productPriceErrors'])) {
                        ?>
                            <ul>
                                <?php
                                    foreach($validatedData['productPriceErrors'] as $error) {
                                        ?>
                                        <li>
                                            <p><?= $error ?></p>
                                        </li>
                                        <?php
                                    }
                                ?>
                            </ul>
                        <?php
                    }
                ?>
            </div>
    
            <button type="submit">Add product</button>
        </form>
    </div>