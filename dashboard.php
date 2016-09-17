<?php
include "template/header.php";
include "conn/connection.php";
$stmt = $conn->prepare('SELECT * from users LIMIT 5');
$stmt->execute();
$users = $stmt->fetchAll();
$stmt = $conn->prepare('SELECT * from categories LIMIT 5');
$stmt->execute();
$categories = $stmt->fetchAll();
$stmt = $conn->prepare('SELECT * from galeries LIMIT 5');
$stmt->execute();
$galeries = $stmt->fetchAll();
?>
<article>
    <div class="container">
        <?php if (isset($_SESSION['email'])): ?>
            <div class="row">
                <?php include "dbmenu.php"; ?>
                <div class="col-sm-8">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">Usuários</div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table id="userTable" class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Nome</th>
                                                    <th>Email</th>
                                                    <th>Ações</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($users as $user): ?>
                                                    <tr class="<?php echo $user['active'] ? "success" : "danger" ?>">
                                                        <td><?php echo $user['id'] ?></td>
                                                        <td><?php echo $user['name'] ?></td>
                                                        <td><?php echo $user['email'] ?></td>
                                                        <td><button class="fakeLink" onclick="deactivateUser(this,<?php echo $user['id'] ?>)"><span class="glyphicon glyphicon-<?php echo $user['active'] ? "remove" : "ok" ?>"></span></button><a href="/users/editUser.php?id=<?php echo $user['id']?>"><span class="glyphicon glyphicon-edit"></span></a><button class="fakeLink" onclick="deleteRowUser(this,<?php echo $user['id'] ?>)"><span class="glyphicon glyphicon-remove-sign"></span></button></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div> 
                                </div>
                                <div class="panel-footer text-right"><a href="users/listUsers.php">Listar todos</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">Categorias</div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table id="categoryTable" class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Nome</th>
                                                    <th>Ações</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($categories as $category): ?>
                                                    <tr>
                                                        <td><?php echo $category['id'] ?></td>
                                                        <td><?php echo $category['name'] ?></td>
                                                        <td><a href="/categories/editCat.php?id=<?php echo $category['id']?>"><span class="glyphicon glyphicon-edit"></span></a><button class="fakeLink" onclick="deleteRowCategory(this,<?php echo $user['id'] ?>)"><span class="glyphicon glyphicon-remove-sign"></span></button></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div> 
                                </div>
                                <div class="panel-footer text-right"><a href="categories/listCat.php">Listar todas</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">Galerias</div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table id="galeryTable" class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Nome</th>
                                                    <th>Categoria</th>
                                                    <th>Ações</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($galeries as $galery): ?>
                                                    <tr>
                                                        <td><?php echo $galery['id'] ?></td>
                                                        <td><?php echo $galery['name'] ?></td>
                                                        <td><?php echo $galery['category_id'] ?></td>
                                                        <td><a href="/galeries/editGal.php?id=<?php echo $galery['id']?>"><span class="glyphicon glyphicon-edit"></span></a><button class="fakeLink" onclick="deleteRowGalery(this,<?php echo $user['id'] ?>)"><span class="glyphicon glyphicon-remove-sign"></span></button></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div> 
                                </div>
                                <div class="panel-footer text-right"><a href="galeries/listGal.php">Listar todos</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            Área restrita...
        <?php endif; ?>
    </div>
</article>
<?php require "template/footer.php" ?>