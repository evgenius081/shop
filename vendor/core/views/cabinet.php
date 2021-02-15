    <?php if(isset($_SESSION['token'])){
        echo  '    
        <header>
            <h1>Hello, '.$_SESSION['creator'].'</h1>
        </header>
        <main id="main">
        </main>';
    }else{
        echo "<main id='main'><div class='modal'><p>You aren`t logged in!</p><i class='fal fa-times fa-2x'></i></div></main>"; 
        }?>