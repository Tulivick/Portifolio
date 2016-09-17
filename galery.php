<?php
include "template/header.php";
include "conn/connection.php";
$stmt = $conn->prepare("SELECT * from images WHERE galery=:id");
$stmt->bindValue(':id', $_GET['id']);
$stmt->execute();
$results = $stmt->fetchAll();
$logged = isset($_SESSION['email']);
$ok = isset($_GET['ok']);
?>
<script>
    $(document).ready(function () {
        $('.alert.alert-info').on('close.bs.alert', function (event) {
            return deleteImage($(event.currentTarget).find('img'));
        });
    });
</script>
<article>
    <div class="container">
        <?php if ($logged): ?>
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
                        <div class="panel-heading text-center">Salvar alterações?</div>
                        <div class="panel-body">
                            <form class="form-inline text-center">
                                <button type="button" class="btn btn-success ena-dis" disabled onclick="saveChanges(<?php echo $_GET['id'] ?>)">Sim</button>
                                <button type="button" class="btn btn-danger ena-dis" disabled onclick="location.reload()">Não</button>
                            </form></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading text-center">Adicionar Imagem</div>
                        <div class="panel-body">
                            <form class="form-inline text-center">
                                <div class="form-group">
                                    <input type="file" id="imagem"/>
                                </div>
                                <button type="button" onclick="addImage();" class="btn btn-success">Adicionar</button>
                            </form></div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php
        foreach ($results as $img):
            if ($logged):
                ?>
                <div class="alert alert-info">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <img class="img-responsive center-block galery-img" src="<?php echo $img['path'] ?>" alt="<?php echo $img['path'] ?>">
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <img class="img-responsive center-block galery-img" src="<?php echo $img['path'] ?>" alt="<?php echo $img['path'] ?>">
                    </div>
                </div>
            <?php
            endif;
        endforeach;
        ?>
    </div>
</article>
<?php require "template/footer.php" ?>