<?php
include "../template/header.php";
include "../conn/connection.php";
$name = $id = $category = "";
$errors = array();
if (isset($_SESSION['email'])):
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        if (isset($_POST['name'])) {
            $name = $_POST['name'];
        } else {
            array_push($errors, "É necessario informar o nome!");
        }
        if (isset($_POST['category'])) {
            $category = $_POST['category'];
        } else {
            array_push($errors, "Necessário selecionar uma categoria!");
        }
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
        } else {
            array_push($errors, "Id de galeria necessário!");
        }
        if (count($errors) == 0) {
            $stmt = $conn->prepare("UPDATE `galeries` SET `name` = :name, `category_id` = :cat_id WHERE id = :id");
            $stmt->bindValue(":name", $name);
            $stmt->bindValue(":cat_id", $category);
            $stmt->bindValue(":id", $id);
            if ($stmt->execute()) {
                header("location: listGal.php?ok=true");
            }
        }
    } elseif ($_SERVER['REQUEST_METHOD'] === "GET") {
        $stmt = $conn->prepare("SELECT * from galeries WHERE id = :id");
        $stmt->bindValue(':id', $_GET['id']);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $name = $result['name'];
        $category = $result['category_id'];
    }
    $catStmt = $conn->prepare('SELECT id, name from categories');
    $catStmt->execute();
    $categories = $catStmt->fetchAll();
    ?>
    <script>
        $(document).ready(function () {
            $('.in').removeClass('in');
            $('#collapse3').addClass('in');
        })
    </script>
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
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($_GET['id']) ?>"/>
                                <div class="form-group">
                                    <label for="name">Nome:</label>
                                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $name ?>" required/>
                                </div>
                                <div class="form-group">
                                    <label for="category">Categoria:</label>
                                    <select class="form-control" name="category">
                                        <?php foreach ($categories as $cat): ?>
                                            <option value="<?php echo $cat['id'] ?>" <?php echo $cat['id'] === $category ? "selected" : "" ?>><?php echo $cat['name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
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