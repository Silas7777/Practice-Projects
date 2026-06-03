<?php
require_once("../helper/header.php"); 
require_once("../../db/connection.php");

    $categoryQuery = "select id,name from category order by created_at DESC";
    $categoryRes = $pdo->prepare($categoryQuery);
    $categoryRes->execute();

    $categoryData = $categoryRes->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
    <div class="row">
        <div class="col-4">
            <form action="" method="post">
                <input type="text" name="categoryName" placeholder="Enter Category Name" class="form-control w-100">
                <?php
                if(isset($_POST['btn-create'])){
                    $categoryStatus = $_POST['categoryName'] == "" ? false:true;

                    echo $categoryStatus ? "": "<small class='text-danger'>Category field is required!</small>";
                }

               
                ?>
                <input type="submit" name="btn-create" value="Create" class="mt-3 form-control btn btn-dark text-white rounded shadow-sm">
            </form>
            
        </div>
        <div class="col">
            <?php
              if(isset($_POST['btn-create'])){
                $category_Name = $_POST['categoryName'];

                if($categoryStatus){
                    $sql = "insert into category(name) values (?)";
                    $res = $pdo->prepare($sql);
                    $res->execute([$category_Name]);
        
                    header("Location:create.php");

                     }
    
                }
                
                foreach($categoryData as $item){
                    $category = $item['name'];
                    $id = $item['id'];
                    echo "
            <div class='card my-2'>
                <div class='card-body'>
                    <div class='row'>
                        <div class='col-10'>
                            <div class='p1'> 
                                $category
                            </div>
                        </div>
                        <div class='col'>
                            
                                <a href='update.php?id=$id' class='btn btn-sm btn-secondary rounded'><i class='fa-solid fa-pen-to-square'></i></a>
                                <a href='delete.php?id=$id' class='btn btn-sm btn-danger rounded'><i class='fa-solid fa-trash'></i></a>

                        
                        </div>
                    </div>
                </div>
            </div>
                    ";
                }
            ?>

        </div>
    </div>
</div>

<?php
  
require_once("../helper/footer.php");
?>