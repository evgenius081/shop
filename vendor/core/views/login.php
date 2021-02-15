    <main id="main">
        <?php if(isset($_SESSION['token'])){
            echo "<div class='modal'><p>You are already logged in!</p><i class='fal fa-times fa-2x'></i></div>"; 
        }else{
            echo '<section id="popup-container">
            <div class="form-container">
                <form method="POST">
                    <h3>Login</h3>
                    <label for="login">
                        <input type="text" class="login" name="userlogin" required>
                        <span class="icon"><i class="fa fa-user"></i>
                        </span><span class="label">Login</span>
                    </label>
                    <label for="password">
                        <input type="password" class="password" name="password" required>
                        <span class="icon"><i class="fa fa-lock"></i></span>    
                        <span class="label">Password</span>          
                    </label>
                    <button type="submit" class="sign-in" name="signup">Login</button>
                    <div id="form-links">
                        <a href="" title="Forgot password?">Forgot password?</a>
                        <a href="register" title="Sign in" id="registration">Sign in</a>
                    </div>
                </form>
            <section>
        </section> 
        ';
        }?>
    </main>