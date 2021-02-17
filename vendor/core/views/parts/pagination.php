<section id='pagination'>
    <?php $current = $this->var['page'];
        if($current == 1){ ?>
    <a style="background-color: #757575;" class="prev page-numbers" data-page="<?= ($current - 1) ?>">
        <i class="far fa-arrow-left"></i>
    </a>
        <div>
            <span class="page-numbers current">1</span>

<?php }else if($current == 2){ ?>
    <a class="prev page-numbers" href="/" data-page="<?= ($current - 1) ?>">
        <i class="far fa-arrow-left"></i>
    </a>
            <div>
                <a class="page-numbers" data-page="1" href="/">1</a>

<?php }else{ ?>
    <a class="prev page-numbers" data-page="<?= ($current - 1) ?>" href="/page/<?= ($current - 1) ?>/">
        <i class="far fa-arrow-left"></i>
    </a>
                <div>
                    <a class="page-numbers" data-page="1" href="/">1</a>
<?php }
for($i = 2; $i<=intdiv($this->var['pages_number']['total'], $this->var['skip']); $i++ ){
    if($i != $current){
        echo '<a class="page-numbers" data-page="'.$i.'" href="/page/'. $i .'/">' . $i .'</a>';
    }else{
        echo "<span class='page-numbers current'>". $current ."</span>";
    }
}
if($current != intdiv($this->var['pages_number']['total'], $this->var['skip'])){
    echo '</div>
                                    <a class="next page-numbers" data-page="'.($current + 1).'" href="/page/' . ($current + 1) . '/"><i class="far fa-arrow-right"></i></a>';
}else{
    echo '</div>
                                <a style="background-color: #757575;" class="next page-numbers"><i class="far fa-arrow-right"></i></a>';
}
?>
               </section>