<header id="header">
        <noscript style="text-align: center; display: block;"><img src="img/kianu.jpg" alt="filler" style="width: calc(83.6vw - 22px); height: calc((83.6vw - 22px) * 0.4286); border-radius: 8px;"></noscript>
    </header>
    <aside>
        <h2>Filters</h2>
        <section id="filter-container">
            <form action="#" id="filters">
                <? foreach($this->var['filters'] as $filter){
                    if($filter['name'] != 'price' && $filter['name'] != 'old_price' && $filter['name'] != 'manufacturer' && $filter['name'] != 'manufacturer_countries'){
                    ?>
                    <article id="<?=str_replace('_', '-', $filter['name'])?>">
                        <div class="filter-header-wrapper"><p><?=ucfirst(str_replace('_', ' ', $filter['name']))?></p></div>

                        <div class="filter-var-container">
                            <?php $arr = explode('%', $filter['possible_variants']);
                                foreach ($arr as $name){?>
                                    <div>
                                        <input type="checkbox" id="<?= str_replace(' ', '-', strtolower($name))?>" name="<?= str_replace(' ', '-', strtolower($name))?>">
                                        <label for="<?=str_replace(' ', '-', strtolower($name))?>"><?= ucfirst($name)?></label>
                                    </div>
                                <?php }
                            ?>
                        </div>
                    </article>
                <?php       }else if($filter['name'] == 'price'){
                            $arr = explode('%', $filter['possible_variants']);
                        ?>
                        <article id="price">
                            <div class="filter-header-wrapper"><p>Price</p></div>

                            <div class="filter-var-container">
                                <p>
                                    <label>Range:</label>
                                    <input type="text" id="min-amount" min="<?= $arr[0]?>" value="<?= $arr[0]?>">
                                    <label for="min-amount"> USD - </label>
                                    <input type="text" id="max-amount" max="<?= $arr[1]?>" value="<?= $arr[1]?>">
                                    <label for="max-amount"> USD</label>
                                </p>
                                <div id="slider-range"></div>
                                <div>
                                    <input type="checkbox" id="discount" name="discount">
                                    <label for="discount">Discount</label>
                                </div>
                            </div>
                        </article>
                    <?php }else  if($filter['name'] == 'manufacturer' ){
                        ?>
                        <article id="<?=str_replace('_', '-', $filter['name'])?>">
                            <div class="filter-header-wrapper"><p><?=ucfirst(str_replace('_', ' ', $filter['name']))?></p></div>

                            <div class="filter-var-container">
                                <?php $arr = explode('%', $filter['possible_variants']);
                                $arr2 = [];
                                foreach($this->var['filters'] as $f){
                                    if($f['name'] == 'manufacturer_countries'){
                                        $arr2 = explode('%', $f['possible_variants']);
                                    }
                                }
                                foreach ($arr as $i=>$name){?>
                                    <div>
                                        <input type="checkbox" id="<?= str_replace(' ', '-', strtolower($name))?>" name="<?= str_replace(' ', '-', strtolower($name))?>">
                                        <label for="<?= str_replace(' ', '-', strtolower($name))?>"><?= ucfirst($arr2[$i])?></label>
                                    </div>
                                <?php }
                                ?>
                            </div>
                        </article>
                    <?php       }
                }?>
                <article id="aside-buttons">
                    <button type="reset">Reset filters</button>
                    <button type="submit" id="filters-submit">Apply</button>
                </article>
            </form>
        </section>
    </aside>
    <main id="main" class="ie-main">
        <section id="goods">
            <?= (isset($this->var['products']) && $this->var['products'] != '')  ? $this->var['products'] : ' <h2>Sorry, something gone wrong</h2>'?>
        </section>
    </main>