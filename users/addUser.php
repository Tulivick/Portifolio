<?php
include "../template/header.php";
include "../conn/connection.php";
$name = $email = $pass = "";
$errors = array();
if (isset($_SESSION['email'])):
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        if (isset($_POST['name'])) {
            $name = $_POST['name'];
        } else {
            array_push($errors, "É necessario informar o nome!");
        }
        if (isset($_POST['email'])) {
            $email = $_POST['email'];
        } else {
            array_push($errors, "É necessario informar o email!");
        }
        if (isset($_POST['password'])) {
            $pass = $_POST['password'];
            if (!isset($_POST['password2']) || !($_POST['password2'] === $pass)) {
                array_push($errors, "Senhas não conferem!");
            }
        } else {
            array_push($errors, "É necessario informar uma senha!");
        }
        if (count($errors) == 0) {
            $stmt = $conn->prepare("INSERT INTO `users`(`name`, `email`, `active`, `password`) VALUES (:name,:email,true,:password);");
            $stmt->bindValue(":name", $name);
            $stmt->bindValue(":email", $email);
            $stmt->bindValue(":password", password_hash($pass, PASSWORD_DEFAULT));
            if ($stmt->execute()) {
                header("location: listUsers.php?ok=true");
            }
        }
    }
    ?>
    <article>
        <div class="container">
            <div class="row">
                <?php include "../dbmenu.php"; ?>
                <div class="col-sm-8">
                    <?php if (count($errors) > 0): ?>
                        <div class="row">
                            <div class="col-sm-12" id="notifications">
                                <div class="alert alert-danger">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <ul>
                                        <?php foreach ($errors as $error): ?>
                                            <li><strong>Erro:</strong> <?php echo $error ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-sm-12">
                            <form role="form" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                                <div class="form-group">
                                    <label for="name">Nome:</label><input type="text" class="form-control" id="name" name="name" value="<?php echo $name ?>" required/>
                                </div>
                                <div class="form-group">
                                    <label for="name">Email:</label><input type="email" class="form-control" id="email" name="email" value="<?php echo $email ?>" required/>
                                </div>
                                <div class="form-group">
                                    <label for="name">Senha:</label><input type="password" class="form-control" id="password" name="password" required/>
                                </div>
                                <div class="form-group">
                                    <label for="name">Confirmar Senha:</label><input type="password" class="form-control" id="password2" name="password2" required/>
                                </div>
                                <button type="submit" class="btn btn-default">Salvar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
<?php else: ?>
    <article>
        <div class="container">
            <div class="row text-center">
                <div class="col-sm-12">Área restrita...</div>
            </div>
        </div>
    </article>
<?php endif; ?>
<?php include "../template/footer.php" ?>