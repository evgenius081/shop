<section id="cart-wrapper">
    <article id="cart-container">
        <h2>Cart</h2>
        <article id="content">
            <?php if(!$this->var['added']){
                echo '<h3>Your cart is empty(</h3>';
            }else{
                ?>
                <article>
                    <div id="headers">
                        <p>Phohto</p>
                        <p>Name</p>
                        <p>Amount</p>
                        <p>Price</p>
                        <p></p>
                    </div>
            <?php
                foreach ($this->var['products'] as $id => $product){
                    ?>

                    <div class="container-good" data-id="<?= $product->id?>">
                        <div class="container-good-image">
                            <img src="<?= $product->img?>" alt="<?= $product->name?> photo" />
                        </div>
                        <div>
                            <p><?= $product->name?></p>
                        </div>
                        <div>
                            <p><?= $product->amount?></p>
                        </div>
                        <div>
                            <p><?= $product->price?></p>
                        </div>
                        <div>
                            <i data-id="<?= $product->id?>" style="color: #c62828; cursor: pointer" class="fas fa-trash fa-2x"></i>
                        </div>
                    </div>
            <?php
                }
                ?>
                    <div id="total-quantity" class="container-good">
                        <p>Total goods<p>
                        <p><?= $this->var['totalQuantity']?></p>
                    </div>
                    <div id="total-sum" class="container-good">
                        <p>Total sum<p>
                        <p><?= $this->var['totalSum']?> USD</p>
                    </div>
                </article>
                    <?php
            }
            ?>
        </article>
        <article id="cart-buttons">
            <?= $this->var['added'] ? '<a id="reset-cart">Clear cart</a>': ''?>
            <a id="continue-shopping<?= $this->var['added'] ? '' : '-empty'?>">Continue shopping</a>
            <?= $this->var['added'] ?  '<a id="submit-order">Submit order</a>' : ''?>
        </article>
    </article>
</section>

