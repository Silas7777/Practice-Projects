<?php
require_once("../helper/header.php"); 
require_once("../../db/connection.php");

    $productQuery = "
                        select product.id, product.name as name, product.price, product.description, product.image, product.category_id, category.name as category_name
                        from product
                        left join category
                        on product.category_id = category.id
                        order by product.created_at desc
                    ";
    $res = $pdo->prepare($productQuery);
    $res->execute();

    $products = $res->fetchAll(PDO::FETCH_ASSOC);


?>

<div class="container">
    <div class="row">
        <div class="col-10 offset-1">
            <table class="table">
                <thead class="table-dark">
                    <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Description</th>
                    <th scope="col">Category Name</th>
                    <th></th>

                    </tr>
                </thead>
                <tbody>
                   <?php

                    foreach($products as $item){
                            echo "
                                <tr>
                                    <td><img class='w-50' src='../../images/".$item['image']."'></td>
                                    <td>".$item['name']."</td>
                                    <td>".$item['price']."</td>
                                    <td>".$item['description']."</td>
                                    <td>".$item['category_name']."</td>
                                    <td>
                                        <a href='update.php?id=".$item['id']."' class='btn btn-sm btn-secondary rounded'><i class='fa-solid fa-pen-to-square'></i></a>
                                        <a href='delete.php?id=".$item['id']."&oldImageName=".$item['image']."' class='btn btn-sm btn-danger rounded'><i class='fa-solid fa-trash'></i></a>
                                    </td>
                                </tr>
                                    ";
                    }
                    
                   ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
require_once("../helper/footer.php");?>