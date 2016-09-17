<?php
include "../template/header.php";
include "../conn/connection.php";
if (isset($_SESSION['email'])):
    $currentPage = isset($_GET['page'])?$_GET['page']: 1;
    $offset = 20 * ($currentPage-1);
    $catStmt = $conn->prepare('SELECT * from categories LIMIT 20 OFFSET ' . $offset);
    $catStmt->execute();
    $categories = $catStmt->fetchAll();
    $queryRes = $conn->query('SELECT count(*) from categories');
    $count = $queryRes->fetchColumn();
    ?>
    <article>
        <div class="container">
            <div class="row">
                <?php include "../dbmenu.php"; ?>
                <div class="col-sm-8">
                    <?php if (isset($_GET['ok']) && $_GET['ok'] === "true"): ?>
                        <div class="row">
                            <div class="col-sm-12" id="notifications">
                                <div class="alert alert-success">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Sucesso:</strong> Categoria cadastrada com sucesso!
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
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
                                                        <td><a href="/categories/editCat.php?id=<?php echo $category['id']?>"><span class="glyphicon glyphicon-edit"></span></a><button class="fakeLink" onclick="deleteRowCategory(this,<?php echo $category['id'] ?>)"><span class="glyphicon glyphicon-remove-sign"></span></button></td>
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
                                        if($currentPage>1){
                                            echo '<li><a href="listCat.php?page='.($currentPage-1).'">&#60&#60</a></li>';
                                        }else{
                                            echo '<li class="disabled"><a href="">&#60&#60</a></li>';
                                        }
                                        for($i = $minPage; $i <= $maxPage; $i++):?>
                                        <li class="<?php echo $i==$currentPage? 'active':''?>"><a href="listCat.php?page=<?php echo $i?>"><?php echo $i ?></a></li>
                                        <?php endfor; 
                                        if($currentPage<$maxPage){
                                            echo '<li><a href="listCat.php?page='.($currentPage+1).'">&#62&#62</a></li>';
                                        }else{
                                            echo '<li class="disabled"><a href="">&#62&#62</a></li>';
                                        }?>
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