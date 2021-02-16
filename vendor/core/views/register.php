    <main id="main">
        <section id="popup-container">
            <div class="form-container">
                <form method="POST" id="registration_form">
                    <h3>Sign in</h3>
                    <label for="login">
                        <input type="text" class="login" name="userlogin" id="reg-login" required>
                        <span class="icon"><i class="fa fa-user"></i></span>
                        <span class="label">Login</span>
                    </label>
                    <label for="email">
                        <input type="text" class="email" name="email" id="reg-email" required>
                        <span class="icon"><i class="fal fa-envelope"></i></span>
                        <span class="label">Email</span>
                    </label>
                    <label for="email">
                        <input type="text" class="phone" name="phone" id="reg-phone" required>
                        <span class="icon"><i class="fas fa-phone"></i></span>
                        <span class="label">Phone</span>
                    </label>
                    <label for="password">
                        <input type="password" id="reg-password" class="password" name="password" required>
                        <span class="icon"><i class="fa fa-lock"></i></span>    
                        <span class="label">Password</span>
                    </label>
                    <label for="confirm-password">
                        <input type="password" id="confirm-password" class="confirm-password" name="confirm-password" required>
                        <span class="icon"><i class="fa fa-lock"></i></span>    
                        <span class="label">Confirm password</span>
                    </label>
                    <button type="submit" class="sign-in" name="signin" disabled="true">Sign in</button>
                    <a href="login" title="Login" id="enter">Login</a>
                </form>
            </div>
        </section>
    </main>