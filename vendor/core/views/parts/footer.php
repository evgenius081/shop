<footer>
        <section id="footer-wrapper"> 
            <div class="footer-list" id="list1">
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="http://blog.p444828q.beget.tech">Blog</a></li>
                    <li><a href="/about">About</a></li>
                    <li><a href="/contacts">Contacts</a></li>
                </ul>
            </div>
            <div class="footer-list" id="list2">
                <ul>
                    <li>ul. Grunwaldska, 81, Gdańsk, Polska</li>
                    <li>+48730858675</li>
                    <li>guleichzhenya@gmail.com</li>
                    <li>Pn - Pt 10.00 - 18.00</li>
                </ul>
            </div>
            <div class="footer-list" id="soc-net">
                <div id="list-socials">
                    <a href="https://www.facebook.com/profile.php?id=100016544251212" rel="nofollow" target="_blank"><i style="background: #3c5a9a;" class="fab fa-facebook-f"></i></a>
                    <a href="https://twitter.com/gulevichzhenya" rel="nofollow" target="_blank"><i style="background: #58ccff;" class="fab fa-twitter"></i></a>
                    <a href="https://vk.com/id393642414" rel="nofollow" target="_blank"><i style="color: #4A76A8" class="fab fa-vk fa-2x"></i></a>
                </div>
            </div>
        </section>
        <div id="socials">
            <a href="https://www.facebook.com/profile.php?id=100016544251212" rel="nofollow" target="_blank"><i style="background: #3c5a9a;" class="fab fa-facebook-f"></i></a>
            <a href="https://twitter.com/gulevichzhenya" rel="nofollow" target="_blank"><i style="background: #58ccff;" class="fab fa-twitter"></i></a>
            <a href="https://vk.com/id393642414" rel="nofollow" target="_blank"><i style="color: #4A76A8" class="fab fa-vk fa-2x"></i></a>
        </div>
        <section id="copyright">
            &copy;<?php if(date("Y") == 2020){
                echo '2020';
            }else{
                echo '2020 - '.date("Y");
            }?> Evgenius081 | All rights reserved(nope)
        </section>
    </footer>
    <script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
<?php if($this->var['view_name'] == 'shop'):?>
    <script src="/js/jquery-ui-1.12.1/jquery-ui.min.js"></script>
    <script src="/js/slick.js"></script>
    <script src="/js/slider.js"></script>
<?php endif;?>
    <script src="/js/script.js"></script>
<?php if($this->var['view_name'] != '404' && $this->var['view_name'] != 'about' && $this->var['view_name'] != 'login' && $this->var['view_name'] != 'register'){
    echo '<script src="/js/'.$this->var['view_name'].'.js"></script>';
}?>
</body>
</html>