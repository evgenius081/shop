    <main id='main'>
        <section>
            <form id="upload-form" method="POST" action="" enctype="multipart/form-data">
                <section id="upload-container">
                <i class="fas fa-file-upload fa-10x"></i>
                    <input id="userfile" type="file" name="userfile" multiple>
                    <label for="userfile">Choose file</label>
                    <span>or drag it here</span>
                </section>
                <section id="upload-controls">
                    <label for="watermark">
                        <input type="text" class="watermark" name="watermark" required>
                        <span class="icon"><i class="fas fa-stamp"></i></span>
                        <span class="label">Watermark</span>
                    </label>
                    <label for="name">
                        <input type="text" class="title" name="title" required>
                        <span class="icon"><i class="far fa-heading"></i></span>
                        <span class="label">Title</span>
                    </label>
                    <label for="author">
                        <input type="text" class="author" name="author" required <?php if(isset($_SESSION['token'])) echo "value='".$_SESSION['creator']."'";?>>
                        <span class="icon"><i class="fa fa-user"></i></span>
                        <span class="label">Author</span>
                    </label>
                    <?php if(isset($_SESSION['token'])){
                     echo '<div id="access">
                     <div class="radio">
                         <input class="custom-radio" type="radio" id="private" name="access" value="private">
                         <label for="private">Private</label>
                     </div>                
                     <div class="radio">
                         <input class="custom-radio" type="radio" id="public" name="access" value="public" checked>
                         <label for="public">Public</label>
                     </div>
                 </div>';   
                    }else{
                        
                    }?>
                    <input type="submit" name="submit" value="Submit">
                </section>
            </form>
        </section>
        <div id="modal-size" class="modal"><p>File is too heavy(</p><i class="fal fa-times fa-2x"></i></div>
        <div id="modal-type" class="modal"><p>Wrong type(</p><i class="fal fa-times fa-2x"></i></div>
    </main>