<header id="header">
        <noscript style="text-align: center; display: block;"><img src="img/kianu.jpg" alt="filler" style="width: calc(83.6vw - 22px); height: calc((83.6vw - 22px) * 0.4286); border-radius: 8px;"></noscript>
    </header>
    <aside>
        <h2>Filters</h2>
        <section id="filter-container">
            <form action="#" id="filters">
                <article id="price">
                    <div class="filter-header-wrapper"><p>Price</p></div>
                    
                    <div class="filter-var-container">
                        <p>
                            <label>Range:</label>
                            <input type="text" id="min-amount" min="0">
                            <label for="min-amount"> USD - </label>
                            <input type="text" id="max-amount" max="4000">
                            <label for="max-amount"> USD</label>
                        </p>
                        <div id="slider-range"></div>
                        <div>
                            <input type="checkbox" id="discount" name="discount">
                            <label for="discount">Discount</label>
                        </div>
                    </div>
                </article>
                <article id="qualification-level">
                    <div class="filter-header-wrapper"><p>Qualification level</p></div>
                    
                    <div class="filter-var-container">
                        <div>
                            <input type="checkbox" id="child" name="child">
                            <label for="child">Child</label>
                        </div>
                        <div>
                            <input type="checkbox" id="beginner" name="beginner">
                            <label for="beginner">Beginner</label>
                        </div>
                        <div>
                            <input type="checkbox" id="fan" name="fan">
                            <label for="fan">Fan</label>
                        </div>
                        <div>
                            <input type="checkbox" id="professional" name="professional">
                            <label for="professional">Professional</label>
                        </div>
                    </div>
                </article>
                <article id="telescope-type">
                    <div class="filter-header-wrapper"><p>Telescope type</p></div>
                    
                    <div class="filter-var-container">
                        <div>
                            <input type="checkbox" id="mirror" name="mirror">
                            <label for="mirror">Mirror</label>
                        </div>
                        <div>
                            <input type="checkbox" id="lens" name="lens">
                            <label for="lens">Lens</label>
                        </div>
                        <div>
                            <input type="checkbox" id="catadioptrical" name="catadioptrical">
                            <label for="catadioptrical">Catadioptrical</label>
                        </div>
                    </div>
                </article>
                <article id="mounting-type">
                    <div class="filter-header-wrapper"><p>Mounting type</p></div>
                    
                    <div class="filter-var-container">
                        <div>
                            <input type="checkbox" id="equatorial" name="equatorial">
                            <label for="equatorial">Equatorial</label>
                        </div>
                        <div>
                            <input type="checkbox" id="equatorial-eq1" name="equatorial-eq1">
                            <label for="equatorial-eq1">Equatorial EQ1</label>
                        </div>
                        <div>
                            <input type="checkbox" id="azimuthal" name="azimuthal">
                            <label for="azimuthal">Azimuthal</label>
                        </div>
                        <div>
                            <input type="checkbox" id="dobson" name="dobson">
                            <label for="dobson">Dobson</label>
                        </div>
                    </div>
                </article>
                <article id="manufacturer">
                    <div class="filter-header-wrapper"><p>Manufacturer</p></div>
                    
                    <div class="filter-var-container">
                        <div>
                            <input type="checkbox" id="bresser" name="bresser">
                            <label for="bresser">Bresser (Germany)</label>
                        </div>
                        <div>
                            <input type="checkbox" id="celestron" name="celestron">
                            <label for="celestron">Celestron (USA)</label>
                        </div>
                        <div>
                            <input type="checkbox" id="explore_scientific" name="explore_scientific">
                            <label for="explore_scientific">Explore Scientific(USA)</label>
                        </div>
                        <div>
                            <input type="checkbox" id="delta_optical" name="delta_optical">
                            <label for="delta_optical">Delta Optical (Poland)</label>
                        </div>
                        <div>
                            <input type="checkbox" id="levenhuk" name="levenhuk">
                            <label for="levenhuk">Levenhuk (USA)</label>
                        </div>
                        <div>
                            <input type="checkbox" id="meade" name="meade">
                            <label for="meade">Meade (USA)</label>
                        </div>
                        <div>
                            <input type="checkbox" id="sky-watcher" name="sky-watcher">
                            <label for="sky-watcher">Sky-Watcher (Сanada)</label>
                        </div>
                        <div>
                            <input type="checkbox" id="lunt" name="lunt">
                            <label for="lunt">LUNT (USA)</label>
                        </div>
                        <div>
                            <input type="checkbox" id="konus" name="konus">
                            <label for="konus">Konus (USA)</label>
                        </div>
                    </div>
                </article>
                <article id="observation-object">
                    <div class="filter-header-wrapper"><p>Observation object</p></div>
                    
                    <div class="filter-var-container">
                        <div>
                            <input type="checkbox" id="earth" name="earth">
                            <label for="earth">Earth</label>
                        </div>
                        <div>
                            <input type="checkbox" id="sun" name="sun">
                            <label for="sun">Sun</label>
                        </div>
                        <div>
                            <input type="checkbox" id="solar_system" name="solar_system">
                            <label for="solar_system">Solar system</label>
                        </div>
                        <div>
                            <input type="checkbox" id="deep_space" name="deep_space">
                            <label for="deep_space">Deep space</label>
                        </div>
                    </div>
                </article>
                <article id="aiming-type">
                    <div class="filter-header-wrapper"><p>Aiming type</p></div>
                    
                    <div class="filter-var-container">
                        <div>
                            <input type="checkbox" id="hand" name="hand">
                            <label for="hand">Hand</label>
                        </div>
                        <div>
                            <input type="checkbox" id="auto" name="auto">
                            <label for="auto">Auto</label>
                        </div>
                    </div>
                </article>
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