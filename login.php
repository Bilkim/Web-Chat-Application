<?php include_once "header.php"; ?>
    <body>
        <div class="wrapper">
            <section class="form login ">
                <header>Chat Application</header>
                <form action="#" autocomplete="off">
                    <div class="error-txt"></div>

                        <div class="field input">
                            <label>Email Address</label>
                            <input type="text" name="email" placeholder="Enter your email">

                        </div>
                        <div class="field input">
                            <label>Password</label>
                            <input type="password" name="password" placeholder="Enter new password">
                            <i class="fas fa-eye"></i>
                        </div>
                        

                        <div class="field button">
                            <input type="submit" value="Continue">

                        </div>
                </form>
                <div class="link">Do not have an account? <a href="index.php">Sign up</a> </div>

            </section>
        </div>

        <script src="javascript/passShowHide.js"></script>
        <script src="javascript/login.js"></script>
    </body>

</html>