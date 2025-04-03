<h1>{{ mainTitle }}</h1>
    <div>
        <form action="/products" method="POST">
            <div>
                <label for="productName">Product name</label>
                <input 
                value="<?= isset($viewData['validatedData']['productName']) ? $viewData['validatedData']['productName']: '' ?>"
                type="text" 
                name="productName" 
                id="productName" 
                required
                >
                <?php
                    if (isset($viewData['validatedData']['productName']) && count($viewData['validatedData']['productNameErrors'])) {
                        ?>
                            <ul>
                                <?php
                                    foreach($viewData['validatedData']['productNameErrors'] as $error) {
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
                value="<?= isset($viewData['validatedData']['productPrice']) ? $viewData['validatedData']['productPrice']: '' ?>"
                type="number" 
                id="productPrice" 
                name="productPrice" 
                required
                >
                <?php
                    if (isset($viewData['validatedData']['productPriceErrors']) && count($viewData['validatedData']['productPriceErrors'])) {
                        ?>
                            <ul>
                                <?php
                                    foreach($viewData['validatedData']['productPriceErrors'] as $error) {
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