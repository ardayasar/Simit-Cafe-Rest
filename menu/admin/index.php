<?php require '../db.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/admin.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Simit Cafe & Restaurant</title>
</head>
<body>

    <div class="panel">
        <div class="add">
            <form action="i_cat.php" method="post" enctype="multipart/form-data">
                <input type="text" name="cat_tr" placeholder="Kategori Adı [TR]">
                <input type="text" name="cat_en" placeholder="Kategori Adı [EN]">
                <input type="file" name="background" placeholder="Arkaplan Resmi">
                <input type="submit" value="Ekle">
            </form>
        </div>
        <div class="list">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Kategori [TR]</th>
                    <th>Kategori [EN]</th>
                    <th>Arkaplan</th>
                    <th></th>
                </tr>
                <?php

try{
    $stmt = $mysqli->prepare("SELECT * FROM categories ORDER BY id DESC");
    $stmt->execute();
    $stmt->store_result();
    if($stmt->num_rows === 0) exit();
    $rowC = $stmt->num_rows;
    $rr = 0;
    $stmt->bind_result($id, $category, $cat_tr, $cat_en, $bg); 
    while($stmt->fetch()) {
                echo "<tr>
                    <td>" . $id . "</td>
                    <td contenteditable='true' id=\"ctr\">" . $cat_tr . "</td>
                    <td contenteditable='true' id=\"cen\">" . $cat_en . "</td>
                    <td id=\"bg\">" . $bg . "</td>
                    <td><a href=\"d_cat.php?id=" . $id . "\" id=\"del\">X</a></td>
                </tr>";

    }

    $stmt->close();
    }
    catch(Exception $e){
        echo $e;
    }
                ?>
            </table>
        </div>
    </div>

    <!-- ---------------------------------- -->

    <div class="panel">
        <div class="add">
            <form action="i_food.php" method="post">
                <input type="text" name="menu_tr" placeholder="Yemek Adı [TR]" required>
                <textarea name="in_tr" placeholder="İçindekiler [TR]" required></textarea>
                <input type="text" name="menu_en" placeholder="Yemek Adı [EN]" required>
                <textarea name="in_en" placeholder="İçindekiler [EN]" required></textarea>
                <input type="number" name="price" placeholder="Fiyat">
                <select name="cat" required>
                <?php

try{
    $stmt = $mysqli->prepare("SELECT category_tr, category FROM categories ORDER BY category_tr");
    $stmt->execute();
    $stmt->store_result();
    if($stmt->num_rows === 0) exit();
    $rowC = $stmt->num_rows;
    $rr = 0;
    $stmt->bind_result($category_tr, $category); 
    while($stmt->fetch()) {
                echo '<option value="' . $category . '">' . $category_tr . '</option>';
    }

    $stmt->close();
    }
    catch(Exception $e){
        echo $e;
    }
                ?>
                </select>
                <input type="submit" value="Ekle">
            </form>
        </div>
        <div class="list">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Yemek [TR]</th>
                    <th>İçindekiler [TR]</th>
                    <th>Yemek [EN]</th>
                    <th>İçindekiler [EN]</th>
                    <th>Fiyat</th>
                    <th>Kategori</th>
                    <th></th>
                </tr>
                <?php

try{
    
    $stmt = $mysqli->prepare("SELECT * FROM foods ORDER BY category");
    $stmt->execute();
    $stmt->store_result();
    if($stmt->num_rows === 0) {
        echo 'Yemek bulunamadı';
    }
    else{
    $rowC = $stmt->num_rows;
    $rr = 0;
    $stmt->bind_result($id, $food_tr, $food_en, $food_alt_tr, $food_alt_en, $price, $category); 
    while($stmt->fetch()) {
                
                echo "<tr>
                    <td>" . $id . "</td>
                    <td contenteditable='true' id=\"ftr\">" . $food_tr . "</td>
                    <td contenteditable='true' id=\"fatr\">" . $food_alt_tr . "</td>
                    <td contenteditable='true' id=\"fen\">" . $food_en . "</td>
                    <td contenteditable='true' id=\"faen\">" . $food_alt_en . "</td>
                    <td contenteditable='true' id=\"fpr\">" . $price . "</td>
                    <td>" . $category . "</td>
                    <td><a href=\"d_food.php?id=" . $id . "\" id=\"del\">X</a></td>
                </tr>";

    }

    $stmt->close();
}   
    }
    catch(Exception $e){
        echo $e;
    }
                ?>
            </table>
        </div>
    </div>
    
</body>

<script>
    $(document).on("input", "#cen",function(event) {
        var id = $(this).parent().children(':first-child').text();
        var editedText = $(this).text();
        $.ajax({
            type : "POST",
            url  : "u_cat_cen.php",
            contentType: "application/json",
            data : {"id": id, "text": editedText},// passing the values
            success: function(res){  
                      console.log(res);
                    }
        });
    });

    $(document).on("input", "#ctr",function(event) {
        var id = $(this).parent().children(':first-child').text();
        var editedText = $(this).text();
        $.ajax({
            type : "POST",
            url  : "u_cat_ctr.php",
            contentType: "application/json",
            data : {"id": id, "text": editedText},// passing the values
            success: function(res){  
                      console.log(res);
                    }
        });
    });


// ----------------------------------
$(document).on("input", "#ftr",function(event) {
    var id = $(this).parent().children(':first-child').text();
    var editedText = $(this).text();
    $.ajax({
        type : "POST",
        url  : "u_menu_ftr.php",
        contentType: "application/json",
        data : {"id": id, "text": editedText},// passing the values
        success: function(res){  
                    console.log(res);
                }
    });
});

$(document).on("input", "#fen",function(event) {
    var id = $(this).parent().children(':first-child').text();
    var editedText = $(this).text();
    $.ajax({
        type : "POST",
        url  : "u_menu_fen.php",
        contentType: "application/json",
        data : {"id": id, "text": editedText},// passing the values
        success: function(res){  
                    console.log(res);
                }
    });
});

$(document).on("input", "#fatr",function(event) {
    var id = $(this).parent().children(':first-child').text();
    var editedText = $(this).text();
    $.ajax({
        type : "POST",
        url  : "u_menu_fatr.php",
        contentType: "application/json",
        data : {"id": id, "text": editedText},// passing the values
        success: function(res){  
                    console.log(res);
                }
    });
});

$(document).on("input", "#faen",function(event) {
    var id = $(this).parent().children(':first-child').text();
    var editedText = $(this).text();
    $.ajax({
        type : "POST",
        url  : "u_menu_faen.php",
        contentType: "application/json",
        data : {"id": id, "text": editedText},// passing the values
        success: function(res){  
                    console.log(res);
                }
    });
});

$(document).on("input", "#fpr",function(event) {
    var id = $(this).parent().children(':first-child').text();
    var editedText = $(this).text();
    $.ajax({
        type : "POST",
        url  : "u_menu_fpr.php",
        contentType: "application/json",
        data : {"id": id, "text": editedText},// passing the values
        success: function(res){  
                    console.log(res);
                }
    });
});

</script>


</html>