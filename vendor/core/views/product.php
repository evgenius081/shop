<main id='main'>
    <section id="good-photo">
        <img src="/img/mini_<?php echo $this->var['product']['image']?>" alt="T<?php echo $this->var['product']['name']?> photo">
    </section>
    <section id="good-characteristics">
        <h1><?php echo $this->var['product']['name']?></h1>
        <ul id="characteristics">
            <li><span>Qualification level: </span><?php echo $this->var['product']['qualification_level']?></li>
            <li><span>Telescope type: </span><?php echo $this->var['product']['telescope_type']?></li>
            <li><span>Mounting type: </span><?php echo $this->var['product']['mounting_type']?></li>
            <li><span>Manufacturer: </span><?php echo $this->var['product']['manufacturer']?></li>
            <li><span>Observation object: </span><?php echo $this->var['product']['observation_object']?></li>
            <li><span>Aiming type: </span><?php echo $this->var['product']['aiming_type']?></li>
        </ul>
        <?php if($this->var['product']['discount_price'] == NULL){
            echo '<p>Price: '.$this->var['product']['price'].' USD</p>';
        }else{
            echo '        <div id="price">
            <span>Price: </span>
            <div id="changed-price">
                <p id="old-price">'.$this->var['product']['price'].' USD</p>
                <p id="new-price">'.$this->var['product']['discount_price'].' USD</p>
            </div>
        </div>';
        }?>

        <form action="#" method="post" id='buy-form'>
            <div id="good-order">
                <div>
                    <button id="buy" type="submit">BUY</button>
                    <div id="good-amount">
                        <input type="number" name="amount" min="1" id="amount-field" value="1" max="<?php echo $this->var['product']['amount']?>">
                        <div id="amount-buttons">
                            <a id="amount-plus">+</a>
                            <a id="amount-minus">-</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
    <section id="good-description">
        <?= $this->var['product']['description']?>
    </section>
</main>