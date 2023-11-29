<?php require('./header.php') ?>
<?php require('./connection.php') ?>

    

 

    <section id="log">
        <div class="d-flex justify-content-center align-items-center vh-100">
            <form id="forma" class="w-50 rounded-3 p-5" method="POST" action="signup_procces.">
                <div class="container-fluid">
                    <h2 class="text-center text-light mb5">SIGN UP</h2>
                    <div class="mb-3">
                        <label for="name" class="form-label text-light">Enetr your name</label>
                        <input type="text" name="username" class="form-control" id="username" aria-describedby="name-lHelp">
                    </div>
                    <div class="mb-3">
                        <label for="Email" class="form-label text-light">Email address</label>
                        <input type="email" name="email" class="form-control" id="Email" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="Password" class="form-label text-light">Password</label>
                        <input type="password" name="password" class="form-control" id="Password">
                    </div>
                    <div class="text-center mt-5"> 
                        <button type="submit" class="btn btn-primary">SIGN UP</button>
                    </div>
                    <a class="nav-link text-info text-center mt-4" href="index.php">
                        LOGIN
                    </a> 
                </div>
            </form>
        </div>
    </section>

 
    
    <?php require('./footer.php') ?>