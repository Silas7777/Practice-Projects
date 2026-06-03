<?php
require_once("../helper/header.php"); 
require_once("../../db/connection.php");
require_once("./source/categoryList.php");
?>

<div class="container">
    <div class="row">
        <div class="col-6 offset-3">

        <div class="d-flex justify-content-end">
            <a href="list.php" class="btn btn-dark text-white btn-sm rounded">Product List</a>
        </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="my-2 d-flex justify-content-center">
                    <img src="" id="output" class="w-50">
                </div>
                <input type="file" name="image" id="" class="form-control w-100 my-2"  onchange="loadFile(event)">
                <?php
                if(isset($_POST['btn-create'])){
                    $imageStatus = $_FILES['image']['name'] == "" ? false:true;
                        echo $imageStatus ? "" : "<small class='text-danger'>Image is required..</small>";
                }
                ?>
                <input type="text" name="name" value="<?php echo $_POST['name'] ?? ""; ?>" class="form-control w-100 my-2" placeholder="Enter Product name...">
                <?php
                if(isset($_POST['btn-create'])){
                    $nameStatus = $_POST['name'] == "" ? false:true;
                    echo $nameStatus ? "" : "<small class='text-danger'>Name is required..</small>";
                }
                ?>
                <input type="text" name="price" value="<?php echo $_POST['price'] ?? ""; ?>" class="form-control w-100 my-2" placeholder="Enter Price...">
                <?php
                if(isset($_POST['btn-create'])){
                    $priceStatus = $_POST['price'] == "" ? false:true;
                    echo $priceStatus ? "" : "<small class='text-danger'>Price is required..</small>";
                }
                ?>
                <textarea name="description" value="" class="form-control w-100 my-2" placeholder="Enter Description..." rows="10" cols="30"><?php echo $_POST['description'] ?? ""; ?></textarea>
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
                    echo "<option value='".$item['id']."' ".(isset($_POST['option'])&&($_POST['option'] == $item['id'])? 'selected' : '').">".$item['name']."</option>";
                }
                ?>
            </select>
            <?php
            if(isset($_POST['btn-create'])){
                $optionStatus = $_POST['option'] == "" ? false:true;
                echo $optionStatus ? "" : "<small class='text-danger'>Select option is required..</small>";
            }
            ?>
            <input type="submit" name="btn-create" class="btn btn-sm btn-danger rounded w-100 my-2" value="Create">
            </form>
            <?php
            if(isset($_POST['btn-create'])){
                echo "<pre>";


                if($nameStatus && $priceStatus && $imageStatus && $descriptionStatus && $optionStatus){

                $imageName = uniqid(). $_FILES['image']['name'];
                $tmpName = $_FILES['image']['tmp_name'];

                $targetFile = "../../images/" . $imageName;

                move_uploaded_file($tmpName, $targetFile);

                $productQuery = "insert into product (name,price,image,description,category_id) values (?,?,?,?,?)";
                $productRes = $pdo->prepare($productQuery);
                $productRes->execute([$_REQUEST['name'],$_REQUEST['price'],$imageName,$_REQUEST['description'],$_REQUEST['option']]);

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