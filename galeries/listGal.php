<?php
include "../template/header.php";
include "../conn/connection.php";
if (isset($_SESSION['email'])):
    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
    $offset = 20 * ($currentPage - 1);
    $galStmt = $conn->prepare('SELECT g.id, g.name as gname, c.name as cname from galeries g,categories c WHERE g.category_id = c.id LIMIT 20 OFFSET ' . $offset);
    $galStmt->execute();
    $galeries = $galStmt->fetchAll();
    $queryRes = $conn->query('SELECT count(*) from galeries');
    $count = $queryRes->fetchColumn();
    $ok = isset($_GET['ok']);
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
                    <?php if ($ok): ?>
                        <div class="row">
                            <div class="col-sm-12" id="notifications">
                                <div class="alert alert-success">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Sucesso:</strong> Operação realizada com sucesso!
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
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
                                                        <td><?php echo $galery['gname'] ?></td>
                                                        <td><?php echo $galery['cname'] ?></td>
                                                        <td><a href="/galeries/editGal.php?id=<?php echo $galery['id'] ?>"><span class="glyphicon glyphicon-edit"></span></a><button class="fakeLink" onclick="deleteRowGalery(this,<?php echo $galery['id'] ?>)"><span class="glyphicon glyphicon-remove-sign"></span></button></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div> 
                                </div>
                                <div class="panel-footer text-center"> 
                                    <ul class="pagination pagination-sm">
                                        <?php
                                        $numPages = ceil($count / 20);
                                        $minPage = $currentPage - 2 > 0 ? $currentPage - 2 : 1;
                                        $maxPage = $currentPage + 2 < $numPages ? $currentPage + 2 : $numPages;
                                        if ($currentPage > 1) {
                                            echo '<li><a href="listGal.php?page=' . ($currentPage - 1) . '">&#60&#60</a></li>';
                                        } else {
                                            echo '<li class="disabled"><a href="">&#60&#60</a></li>';
                                        }
                                        for ($i = $minPage; $i <= $maxPage; $i++):
                                            ?>
                                            <li class="<?php echo $i == $currentPage ? 'active' : '' ?>"><a href="listGal.php?page=<?php echo $i ?>"><?php echo $i ?></a></li>
                                        <?php
                                        endfor;
                                        if ($currentPage < $maxPage) {
                                            echo '<li><a href="listGal.php?page=' . ($currentPage + 1) . '">&#62&#62</a></li>';
                                        } else {
                                            echo '<li class="disabled"><a href="">&#62&#62</a></li>';
                                        }
                                        ?>
                                    </ul></div>
                            </div>
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
<?php
endif;
include "../template/footer.php";
?>