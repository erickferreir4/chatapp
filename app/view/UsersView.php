<main>
    <div class="chatapp">
        <div class="chatapp--center">

            <div class="chatapp--user">
                <?= $this->getUser(); ?>
                <a href="/logout">Logout</a>
            </div>

            <div class="chatapp--search">
                <input type="text" placeholder="Enter name to search..." />
                <button><i class="fas fa-search"></i></button>
            </div>

            <div class="chatapp--userslist" id="userslist">
            </div>

        </div>
    </div>
</main>

