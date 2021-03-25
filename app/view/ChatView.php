<main>
    
    <div class="chatapp">
        <div class="chatapp--center">

            <div class="chatapp--user">
                <a href="/users"><i class="fas fa-arrow-left"></i></a>
                <?= $this->getUser() ?>
            </div>

            <div class="chatapp--box">
                <span class="chatapp--box--wrapper outgoing">
                    <p class="chatapp--box--details">
                        Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum 
                        Lorem ipsum Lorem ipsum Lorem ipsum 
                    </p>
                </span>

                <span class="chatapp--box--wrapper incoming">
                    <span><img src="/assets/imgs/user-img.jpeg"/></span>
                    <p class="chatapp--box--details">
                        Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum 
                        Lorem ipsum Lorem ipsum Lorem ipsum 
                    </p>
                </span>
            </div>

            <form id="form-chat" action="#" class="chatapp--box--type">
                <input type="hidden" name="user-sender" value="<?= $_SESSION['user-id'] ?>"/>
                <input type="hidden" name="user-receiver" value="<?= $_GET['id'] ?>"/>
                <input type="text" name="message" placeholder="Type a message here..." />
                <button type="submit"><i class="fab fa-telegram-plane"></i></button> 
            </form>

        </div>
    </div>

</main>
