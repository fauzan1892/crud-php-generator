<?php 
    // session
    session_start();

    include 'setting.php';
    // echo password_hash('123', PASSWORD_DEFAULT);
    if(!empty($_POST['user']) && !empty($_POST['pass'])) {
        // tangkap username dan password 
        $user = htmlentities($_POST['user']);
        $pass = htmlentities($_POST['pass']);

        $sql = "SELECT * FROM users WHERE user=?";
        $row = $connectdb->prepare($sql);
        $row->execute(array($user));
        $count = $row->rowCount();
        
        if($count > 0)
        {
            // jika benar
            $hsl = $row->fetch();
            if(password_verify($pass,$hsl['pass']))
            {
                $_SESSION['codekop_session'] = $hsl;
                echo "<script>alert('Login Sukses');window.location='index.php';</script>";
            }else{
                echo "<script>alert('Login Gagal');window.location='login.php';</script>";
            }
        }else{
            // jika salah
            echo "<script>alert('Login Gagal');window.location='login.php';</script>";
        }
    }
?>
<!doctype html>
<html lang="en">
    <head>
        <title>Login</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body style="background:#be03fc;">
        <div class="container mt-5">
            <div class="row">
                <div class="col-sm-4 mt-5 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="text-center pt-2">Silahkan masuk terlebih dahulu</h6>
                        </div>
                        <div class="card-body">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="">Username</label>
                                    <input type="text" name="user" required autocomplete="off" class="form-control" placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="password" name="pass" required autocomplete="off" class="form-control" placeholder="Password">
                                </div>
                                <button type="submit" class="btn btn-primary btn-md">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   </body>
</html>