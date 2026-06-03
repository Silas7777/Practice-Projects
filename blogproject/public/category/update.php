<?php
require_once("../helper/header.php"); 
require_once("../../db/connection.php");
?>

<?php
$query = "select * from category where id=?";
$res = $pdo->prepare($query);
$res->execute([$_GET['id']]);

$data = $res->fetch(PDO::FETCH_ASSOC);
?>

<div class="container">
    <div class="row"> 
        <div class="col-6 offset-3">
            <form action="" method="post">
                <input type="text" name="categoryName" class="form-control" value='<?php echo $_POST["categoryName"] ?? $data["name"];?>'>
                    <?php 
                        if(isset($_POST['btn-update'])){
                        $categoryStatus = $_POST['categoryName'] == "" ? false:true;

                        echo $categoryStatus ? "": "<small class='text-danger'>Category field is required!</small>";
                        }
                    ?>
                <input type="submit" name="btn-update" value="Update" class="btn btn-sm btn-secondary rounded mt-3 w-100">
            </form>
           
        </div>
    </div>
</div>

<?php 
  if(isset($_POST['btn-update'])){
        $category_Name = $_POST['categoryName'];

    if($categoryStatus){
        $sql = "update category set name=? where id=?";
        $res = $pdo->prepare($sql);
        $res->execute([$category_Name,$_GET['id']]);
        
        header("Location:create.php");

        }
    
    }
require_once("../helper/footer.php");
?>