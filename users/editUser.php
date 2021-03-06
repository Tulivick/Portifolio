<?php
include "../template/header.php";
include "../conn/connection.php";
$name = $email = $pass = $id = "";
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
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
        } else {
            array_push($errors, "Id de usuario invalido!");
        }
        if (count($errors) == 0) {
            $stmt = $conn->prepare("UPDATE `users` SET `name` = :name, `email` = :email WHERE id = :id");
            $stmt->bindValue(":name", $name);
            $stmt->bindValue(":email", $email);
            $stmt->bindValue(":id", $id);
            if ($stmt->execute()) {
                header("location: listUsers.php?ok=true");
            }
        }
    }elseif($_SERVER['REQUEST_METHOD'] === "GET"){
        $stmt = $conn->prepare("SELECT * from users WHERE id = :id");
        $stmt->bindValue(':id',$_GET['id']);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $name = $result['name'];
        $email = $result['email'];
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
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($_GET['id'])?>"/>
                                <div class="form-group">
                                    <label for="name">Nome:</label><input type="text" class="form-control" id="name" name="name" value="<?php echo $name ?>" required/>
                                </div>
                                <div class="form-group">
                                    <label for="name">Email:</label><input type="email" class="form-control" id="email" name="email" value="<?php echo $email ?>" required/>
                                </div>
                                <button type="submit" class="btn btn-success">Salvar</button>
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