<?php
include "template/header.php";
include "conn/connection.php";
$currentPage = 1;
if (isset($_GET['page'])) {
    $currentPage = $_GET['page'];
}
$offset = ($currentPage - 1) * 12;
$stmt = $conn->prepare("SELECT * from galeries WHERE category_id=".$_GET['cid']." LIMIT 15 OFFSET ".$offset);
$stmt->execute();
$results = $stmt->fetchAll();
$queryRes = $conn->query('SELECT count(*) from galeries WHERE category_id='.$_GET['cid']);
$count = $queryRes->fetchColumn();
?>
<article>
    <div class="container">
        <div class="row">
            <?php for ($i = 0; $i < count($results); $i++): ?>
                <div class="col-sm-4">
                    <a href="galery.php?id=<?php echo $results[$i]['id'] ?>">
                        <div class="panel panel-default category">
                            <div class="panel-body clear-padding"><img class="img-responsive" src="<?php echo $results[$i]['image'] ?>" alt="<?php echo $results[$i]['name'] ?>"></div>
                            <div class="panel-footer text-center"><?php echo $results[$i]['name'] ?></div>
                        </div>
                    </a>
                </div>
                <?php if ($i % 3 == 2): ?>
                </div><div class="row">
                <?php endif; ?>
            <?php endfor; ?>
        </div>
        <div class="row">
            <div class="col-sm-12 text-center">
                <ul class="pagination pagination-sm">
                                        <?php
                                        $numPages = ceil($count / 15);
                                        $minPage = $currentPage - 2 > 0 ? $currentPage - 2 : 1;
                                        $maxPage = $currentPage + 2 < $numPages ? $currentPage + 2 : $numPages;
                                        if($currentPage>1){
                                            echo '<li><a href="index.php?page='.($currentPage-1).'">&#60&#60</a></li>';
                                        }else{
                                            echo '<li class="disabled"><a href="">&#60&#60</a></li>';
                                        }
                                        for($i = $minPage; $i <= $maxPage; $i++):?>
                                        <li class="<?php echo $i==$currentPage? 'active':''?>"><a href="index.php?page=<?php echo $i?>"><?php echo $i ?></a></li>
                                        <?php endfor; 
                                        if($currentPage<$maxPage){
                                            echo '<li><a href="index.php?page='.($currentPage+1).'">&#62&#62</a></li>';
                                        }else{
                                            echo '<li class="disabled"><a href="">&#62&#62</a></li>';
                                        }?>
                                    </ul>
            </div>
        </div>
    </div>
</article>
<?php require "template/footer.php" ?>