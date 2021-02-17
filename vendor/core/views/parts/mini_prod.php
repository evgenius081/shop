<?php if(isset($this->var['0'])){
    $product = $this->var['0'];
}else if(isset($this->var['product'])){
    $product = $this->var['product'];
}?>
<article class="mini-good">
    <a href="/product/<?= str_replace(' ', '_', $product['name'])?>">
        <img src="/img/<?= $product['image']?>" alt="<?= $product['name']?>">
        <p class="mini-name"><?= $product['name']?></p>
        <p class="mini-price"><?= $product['price']?> USD</p>
    </a>
    <hr noshade size="0">
</article>
