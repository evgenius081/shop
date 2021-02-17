<?php if(isset($this->var['product'])){
    $product = $this->var['product'];
}else if(isset($this->var['0'])){
    $product = $this->var['0'];
}
?>
<article class="good">
    <div class="good-descr">
        <a class="good-a" href="/product/<?= str_replace(' ', '_', $product['name'])?>"><img data-id="<?= $product['id']?>" src="/img/<?= $product['image'] ?>" alt="<?= $product['name']?> photo"></a>
        <p data-id="<?= $product['id']?>"><?= $product['name']?></p>
    </div>
    <?php if($product['old_price'] == NULL): ?>
        <p class="good-price" data-id="<?= $product['id']?>"><?= $product['price']?> USD</p>
    <?php else:?>
        <div class="changed-price">
            <p class="old-price"><?= $product['old_price']?> USD</p>
            <p data-id="<?= $product['id']?>" class="good-price"><?= $product['price']?> USD</p>
        </div>
    <?php endif;?>
    <div class="good-buttons">
        <a href="/product/<?= str_replace(' ', '_', $product['name'])?>" class="buy good-a">More</a>
        <a data-id="<?= $product['id']?>" class="add-to-chosen-button"><i class="<?= in_array($product['id'], $this->var['chosen_IDs']) ? 'fas' : 'far'?> fa-heart fa-2x"></i></a>
        <a data-id="<?= $product['id']?>" class="add-to-cart-button"><i class="<?= in_array($product['id'], $this->var['cart_IDs']) ? 'fas' : 'fal'?>  fa-shopping-cart fa-2x"></i></a>
    </div>
</article>