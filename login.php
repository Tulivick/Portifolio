<?php
include "conn/connection.php";
include "template/header.php";
$stmt = $conn->prepare("SELECT * from users WHERE email = :email");
$email = "";
$error = false;
$stmt->bindParam(':email', $email);
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $email = $_POST['email'];
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result && password_verify($_POST['password'], $result['password']) && $result['active']) {
        $_SESSION['name'] = $result['name'];
        $_SESSION['email'] = $result['email'];
        header("location: dashboard.php");
    } else {
        $error = true;
    }
}
?>
<article>
    <div class="container">
        <?php if ($error): ?>
            <div class="row">
                <div class="col-sm-12">
                    <div class="alert alert-danger">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>ERROR:</strong> Usuário ou senha invalidos.
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-sm-12">
                    <form role="form" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                        <div class="form-group">
                            <label for="username">Email:</label>
                            <input type="email" id="username" class="form-control" name="email" placeholder="user@email.com" required/>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" id="password" class="form-control" name="password" placeholder="Digite o password" required/>
                        </div>
                        <button type="submit" class="btn btn-default">Log in</button>
                    </form>
            </div>
        </div>
    </div>
</article>
<?php require "template/footer.php" ?>