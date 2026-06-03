<?php
require_once("../helper/header.php"); 
require_once("../../db/connection.php");
require_once("./source/categoryList.php");

$query = "select * from product where id=?";
$res = $pdo->prepare($query);
$res->execute([$_GET['id']]);

$products = $res->fetch(PDO::FETCH_ASSOC);

// echo "<pre>";

// print_r($products);
?>
<h3>Update Page</h3>
<div class="container">
    <div class="row">
        <div class="col-6 offset-3">

        <div class="d-flex justify-content-end">
            <a href="list.php" class="btn btn-dark text-white btn-sm rounded">Product List</a>
        </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="my-2 d-flex justify-content-center">
                    <img src="../../images/<?php echo $products['image']?>" id="output" class="w-50">
                </div>
                <input type="file" name="image" id="" class="form-control w-100 my-2"  onchange="loadFile(event)">
                <!-- <?php
                // if(isset($_POST['btn-create'])){
                //     $imageStatus = $_FILES['image']['name'] == "" ? false:true;
                //         echo $imageStatus ? "" : "<small class='text-danger'>Image is required..</small>";
                // }
                ?> -->
                <input type="text" name="name" value="<?php echo $_POST['name'] ?? $products['name']; ?>" class="form-control w-100 my-2" placeholder="Enter Product name...">
                <?php
                if(isset($_POST['btn-create'])){
                    $nameStatus = $_POST['name'] == "" ? false:true;
                    echo $nameStatus ? "" : "<small class='text-danger'>Name is required..</small>";
                }
                ?>
                <input type="text" name="price" value="<?php echo $_POST['price'] ?? $products['price']; ?>" class="form-control w-100 my-2" placeholder="Enter Price...">
                <?php
                if(isset($_POST['btn-create'])){
                    $priceStatus = $_POST['price'] == "" ? false:true;
                    echo $priceStatus ? "" : "<small class='text-danger'>Price is required..</small>";
                }
                ?>
                <textarea name="description" value="" class="form-control w-100 my-2" placeholder="Enter Description..." rows="10" cols="30"><?php echo $_POST['description'] ?? $products['description']; ?></textarea>
                <?php
                if(isset($_POST['btn-create'])){
                    $descriptionStatus = $_POST['description'] == "" ? false:true;
                    echo $descriptionStatus ? "" : "<small class='text-danger'>Description is required..</small>";
                }
                ?>
                <select name="option" class="form-select" value="">
                <option value="">Choose Category Name...</option>
                <?php
                foreach($categories as $item){
                    // $categoryName = $item['name'];
                    // $categoryId = $item['id'];
                    echo "<option value='".$item['id']."' ".($item['id'] == $products['category_id']? 'selected' : '').">".$item['name']."</option>";
                }
                ?>
            </select>
            <?php
            if(isset($_POST['btn-create'])){
                $optionStatus = $_POST['option'] == "" ? false:true;
                echo $optionStatus ? "" : "<small class='text-danger'>Select option is required..</small>";
            }
            ?>
                <input type="submit" name="btn-create" class="btn btn-sm btn-danger rounded w-100 my-2" value="Update">
            </form>
            <?php
            if(isset($_POST['btn-create'])){
                echo "<pre>";


                if($nameStatus && $priceStatus && $descriptionStatus && $optionStatus){

                if($_FILES['image']['name'] != "" ){
                    //delete old pic and then store new pic

                    $oldPic = $products['image'];
                    unlink("../../images/$oldPic"); //delete old pic

                    $imageName = uniqid() .$_FILES['image']['name'];
                    $tmpName = $_FILES['image']['tmp_name'];

                    $targetFile = "../../images/" .$imageName;

                    move_uploaded_file($tmpName, $targetFile); //store new pic in project

                    $updateQuery = "update product set name=?, price=?,image=?,description=?,category_id=? where id=?";
                    $updateRes = $pdo->prepare($updateQuery);
                    $updateRes->execute([$_POST['name'],$_POST['price'],$imageName,$_POST['description'],$_POST['option'],$_GET['id']]);

                }else{
                    $updateQuery = "update product set name=?, price=?,description=?,category_id=? where id=?";
                    $updateRes = $pdo->prepare($updateQuery);
                    $updateRes->execute([$_POST['name'],$_POST['price'],$_POST['description'],$_POST['option'],$_GET['id']]);
                }

                header("Location:list.php");


                }
            }
            ?>        
        </div>
    </div>
</div>

<?php
require_once("../helper/footer.php");
?>