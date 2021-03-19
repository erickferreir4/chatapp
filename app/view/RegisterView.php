<main>
    <div class="chatapp">
        <div class="chatapp--center">
            <h1>Realtime Chat App</h1>
            <span class="error-txt">This is an error message</span>
            <form id="form-register">
                <span class="wrapper">
                    <span class="field">
                        <label>First Name</label>
                        <input type="text" placeholder="First Name" name="first-name" required/>
                    </span>

                    <span class="field">
                        <label>Last Name</label>
                        <input type="text" placeholder="Last Name" name="last-name" required/>
                    </span>
                </span>

                <span class="field">
                    <label>Email Address</label>
                    <input type="email" placeholder="Enter you email" name="email" required/>
                </span>

                <span class="field">
                    <label>Password</label>
                    <input type="password" placeholder="Enter new password" name="passwd" required/>
                    <i class="fas fa-eye"></i>
                </span>

                <span class="field file">
                    <label>Select Image</label>
                    <input type="file" name="file" accept=".png,.jpg,.jpeg" required/>
                </span>

                <button type="submit">Continue to chat</button>
            </form>

            <p class="link">Already signed up? <a href="/register">Login now</a></p>
        </div>
    </div>
</main>
