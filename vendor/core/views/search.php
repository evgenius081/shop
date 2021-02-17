<main id="main">
    <section id="goods-filters">
        <form method="get">
            <article>
                <div>
                    <i class="fal fa-sort-amount-up"></i><p>Sort by:</p>
                </div>
                <div class="dropdown-container">
                    <p id="dropdown-container-sorting">No sorting</p>
                    <ul class="dropdown">
                        <li>No sorting</li>
                        <li>A - Z</li>
                        <li>Z - A</li>
                        <li>Expensive</li>
                        <li>Cheap</li>
                    </ul>
                </div>
            </article>
            <article>
                <div>
                    <p>Per page: </p>
                </div>
                <div class="dropdown-container" id="goods-number">
                    <p id="dropdown-container-amount">12</p>
                    <ul class="dropdown">
                        <li>6</li>
                        <li>12</li>
                        <li>24</li>
                        <li>36</li>
                    </ul>
                </div>
            </article>
        </form>
    </section>
    <section id="goods" data-search="<?= $this->var['search']?>">
        <?= $this->var['products']?>
    </section>
</main>