<?php
session_start();
require_once 'assets/bd/connect.php';
if (isset($_POST['filter1'])) {
    $filter1 = $_POST['filter1'];
    $_SESSION['filter1'] = $_POST['filter1'];
}
else {
    $filter1 = 1;
}
// Выборка уникальных названий брендов из таблицы `car_brands`
$model_query = "SELECT DISTINCT brand_name FROM `car_brands` ORDER BY brand_name ASC";
$model_stmt = $pdo->query($model_query);
$model = $model_stmt->fetchAll(PDO::FETCH_ASSOC);

// Выборка моделей, удовлетворяющих условию фильтра $filter1
$change_query = "SELECT * FROM `models` WHERE $filter1";
$change_stmt = $pdo->query($change_query);
$change = $change_stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="/">Home</a>
    <div style="display: flex; justify-content: space-between;">
        <form action="/assets/bd/admin_upload.php" method="post" enctype="multipart/form-data">
            <label for="brand_name">Brand Name:</label>
            <input type="text" name="brand_name" id="brand_name">
            <br>
            <label for="brand_image">Brand Image:</label>
            <input type="file" name="brand_image" id="brand_image">
            <br>
            <input type="submit" value="Submit">
        </form>
        <form action="/assets/bd/upload_feed.php" method="post">
            <label for="name">Имя (возраст):</label>
            <input type="text" name="name" id="name">
            <br>
            <label for="name_ru">Имя (возраст) (рус):</label>
            <input type="text" name="name_ru" id="name_ru">
            <br>
            <label for="text">Отзыв:</label>
            <input type="text" name="text" id="text">
            <br>
            <label for="text_ru">Отзыв (рус):</label>
            <input type="text" name="text_ru" id="text_ru">
            <br>
            <input type="submit" value="Submit">
        </form>
    </div>
    <hr>
    <div style="display: flex; justify-content: space-between; flex-wrap: wrap;">
        <form action="/assets/bd/admin_upload_goods.php" method="post" enctype="multipart/form-data">
            <div class="flex">
                <label>Картинка 1:</label>
                <img class="image" id="image1" src="" alt="">
                <input type="file" name="brand_image1" id="brand_image1" onchange="previewImage(event, 1)">
            </div>
            <br>
            <div class="flex">
                <label>Картинка 2:</label>
                <img class="image" id="image2" src="" alt="">
                <input type="file" name="brand_image2" id="brand_image2" onchange="previewImage(event, 2)">
            </div>
            <br>
            <div class="flex">
                <label>Картинка 3:</label>
                <img class="image" id="image3" src="" alt="">
                <input type="file" name="brand_image3" id="brand_image3" onchange="previewImage(event, 3)">
            </div>
            <br>
            <label>Наименование:</label>
            <input type="text" name="name" id="name" value="Докатка">
            <br>
            <label>Марка:</label>
            <select name="marka" id="mark">
                <?php
                foreach ($model as $row) {
                    echo '<option value="' .$row['brand_name']. '">' . $row['brand_name'] . '</option>';
                }
                ?>
            </select>
            <br>
            <label>Модель:</label>
            <input type="text" name="model" id="model">
            <br>
            <label>Поколение:</label>
            <input type="text" name="gen" id="gen">
            <br>
            <label>Год:</label>
            <input type="text" name="year" id="year" value="(-)">
            <br>
            <label>Радиус:</label>
            <input type="text" name="rad" id="rad"  value="R">
            <br>
            <label>Цена:</label>
            <input type="text" name="price" id="price">
            <br>
            <label>Описание:</label><br>
            <label>розболтування:</label>
            <input type="text" name="desc"><br>
            <label>центральний отвір:</label>
            <input type="text" name="desc"><br>
            <label>розмір покришки:</label>
            <input type="text" name="desc"><br>
            <label>max швидкість:</label>
            <input type="text" name="desc"><br>
            <label>max тиск:</label>
            <input type="text" name="desc"><br>
            <input type="submit" value="Submit">
        </form>
        <form action="/assets/bd/admin_upload_access.php" method="post" enctype="multipart/form-data">
            <div class="flex">
                <label>Картинка 1:</label>
                <img class="image" id="image4" src="" alt="">
                <input type="file" name="brand_image1" id="brand_image1" onchange="previewImage2(event, 4)">
            </div>
            <br>
            <div class="flex">
                <label>Картинка 2:</label>
                <img class="image" id="image5" src="" alt="">
                <input type="file" name="brand_image2" id="brand_image2" onchange="previewImage2(event, 5)">
            </div>
            <br>
            <div class="flex">
                <label>Картинка 3:</label>
                <img class="image" id="image6" src="" alt="">
                <input type="file" name="brand_image3" id="brand_image3" onchange="previewImage2(event, 6)">
            </div>
            <br>
            <label>Наименование:</label><br>
            <input type="text" name="name" id="name" placeholder="Пример (Болт кріплення)">
            <br><br>
            <label>Наименование (рус):</label><br>
            <input type="text" name="name_ru" id="name_ru" placeholder="Пример (Болт крепления)">
            <br><br>
            <label>Категория:</label>
            <select name="marka" id="mark"><br>
                <option value="Аксессуары">Аксессуары</option>
            </select>
            <br>
            <label>Полное описание: (если есть)</label><br>
            <textarea name="all_descr" id="all_descr" cols="30" rows="3"></textarea>
            <br>
            <label>Полное описание (рус): (если есть)</label><br>
            <textarea name="all_descr_ru" id="all_descr_ru" cols="30" rows="3"></textarea>
            <br>
            <label>Заголовок описания-1 (если есть):</label><br>
            <input type="text" name="ttl_descr1" id="ttl_descr1">
            <br>
            <label>Заголовок описания-1 (рус) (если есть):</label><br>
            <input type="text" name="ttl_descr1_ru" id="ttl_descr1_ru">
            <br>
            <label>Описание списком-1 (если есть):</label><br>
            <textarea type="text" name="descr1" id="descr1" placeholder="ВАЖНО писать через (;) без пробелов" cols="30" rows="3"></textarea>
            <br>
            <label>Описание списком-1 (рус) (если есть):</label><br>
            <textarea type="text" name="descr1_ru" id="descr1_ru" placeholder="ВАЖНО писать через (;) без пробелов" cols="30" rows="3"></textarea>
            <br>
            <label>Заголовок описания-2 (если есть):</label><br>
            <input type="text" name="ttl_descr2" id="ttl_descr2">
            <br>
            <label>Заголовок описания-2 (рус) (если есть):</label><br>
            <input type="text" name="ttl_descr2_ru" id="ttl_descr2_ru">
            <br>
            <label>Описание списком-2 (если есть):</label><br>
            <textarea type="text" name="descr2" id="descr2" placeholder="ВАЖНО писать через (;) без пробелов" cols="30" rows="3"></textarea>
            <br>
            <label>Описание списком-2 (рус) (если есть):</label><br>
            <textarea type="text" name="descr2_ru" id="descr2_ru" placeholder="ВАЖНО писать через (;) без пробелов" cols="30" rows="3"></textarea>
            <br>
            <label>Заголовок описания-3 (если есть):</label><br>
            <input type="text" name="ttl_descr3" id="ttl_descr3">
            <br>
            <label>Заголовок описания-3 (рус) (если есть):</label><br>
            <input type="text" name="ttl_descr3_ru" id="ttl_descr3_ru">
            <br>
            <label>Описание списком-3 (если есть):</label><br>
            <textarea type="text" name="descr3" id="descr3" placeholder="ВАЖНО писать через (;) без пробелов" cols="30" rows="3"></textarea>
            <br>
            <label>Описание списком-3 (рус) (если есть):</label><br>
            <textarea type="text" name="descr3_ru" id="descr3_ru" placeholder="ВАЖНО писать через (;) без пробелов" cols="30" rows="3"></textarea>
            <br>
            <label>Ширина чехла (если есть):</label><br>
            <textarea type="text" name="width" id="width" placeholder="ВАЖНО писать через (;) без пробелов" cols="30" rows="3"></textarea>
            <br>
            <label>Профиль чехла (если есть):</label><br>
            <textarea type="text" name="profile" id="profile" placeholder="ВАЖНО писать через (;) без пробелов" cols="30" rows="3"></textarea>
            <br>
            <label>Размер обода чехла (если есть):</label><br>
            <textarea type="text" name="rim_size" id="rim_size" placeholder="ВАЖНО писать через (;) без пробелов" cols="30" rows="3"></textarea>
            <br>
            <label>Грузоподъёмность домкрата (если есть):</label><br>
            <textarea type="text" name="load_capacity" id="load_capacity" placeholder="ВАЖНО писать через (;) без пробелов" cols="30" rows="3"></textarea>
            <br>
            <label>ВАЖНО писать без грн и прочего<br>Цена (основная): </label><br>
            <input type="text" name="price" id="price">
            <br>
            <label>Цена-2 (для домкрата 2 тонны):</label><br>
            <input type="text" name="price1" id="price1">
            <br>
            <input type="submit" value="Submit">
        </form>
    </div>
    <hr>
    <form action="" method="post" id="myForm">
        <select name="filter1" id="filter1" onchange="document.getElementById('myForm').submit();">
            <option value="1">All</option>
            <?php
            foreach ($model as $row) {
                $selected = '';
                if (isset($_SESSION['filter1']) && $_SESSION['filter1'] == "`marka` = '".$row['brand_name']."'") {
                $selected = 'selected';
                }
                echo '<option value="`marka` = '."'".''.$row['brand_name'].''."'".'" '.$selected.'>' . $row['brand_name'] . '</option>';
            }
            ?>
        </select>
    </form>
    <div class="flex2">
    <?php foreach ($change as $row) {
        if($row['type'] === 'wh') {
            $desc_str = $row['description'];
            $desc_arr = explode(",", $desc_str);
            echo '
            <form class="form" id="'.$row['id'].'" method="post" enctype="multipart/form-data">
                <div class="flex">
                    <label>Картинка 1:</label>
                    <img class="image" id="image1_'.$row['id'].'" src="data:image/jpeg;base64,'.base64_encode( $row['img1'] ).'" alt="">
                    <input type="file" name="brand_image1" id="brand_image1" onchange="previewImage1(event, 1, '.$row['id'].')">
                </div>
                <div class="flex">
                    <label>Картинка 2:</label>
                    <img class="image" id="image2_'.$row['id'].'" src="data:image/jpeg;base64,'.base64_encode( $row['img2'] ).'" alt="">
                    <input type="file" name="brand_image2" id="brand_image2" onchange="previewImage1(event, 2, '.$row['id'].')">
                </div>
                <div class="flex">
                    <label>Картинка 3:</label>
                    <img class="image" id="image3_'.$row['id'].'" src="data:image/jpeg;base64,'.base64_encode( $row['img3'] ).'" alt="">
                    <input type="file" name="brand_image3" id="brand_image3" onchange="previewImage1(event, 3, '.$row['id'].')">
                </div>
                <label>Наименование:</label>
                <input type="text" name="name" id="name" value="'.$row['name'].'">
                <br>
                <label>Марка:</label>
                <input type="text" name="marka" id="marka" value="'.$row['marka'].'">
                <br>
                <label>Модель:</label>
                <input type="text" name="model" id="model" value="'.$row['model'].'">
                <br>
                <label>Поколение:</label>
                <input type="text" name="gen" id="gen" value="'.$row['gen'].'">
                <br>
                <label>Год:</label>
                <input type="text" name="year" id="year" value="'.$row['year'].'">
                <br>
                <label>Радиус:</label>
                <input type="text" name="rad" id="rad" value="'.$row['radius'].'">
                <br>
                <label>Цена:</label>
                <input type="text" name="price" id="price" value="'.$row['price'].'">
                <br>
                <label>Описание:</label><br>
                <label>розболтування:</label>
                <input type="text" name="desc" value="'.$desc_arr[0].'"><br>
                <label>центральний отвір:</label>
                <input type="text" name="desc" value="'.$desc_arr[1].'"><br>
                <label>розмір покришки:</label>
                <input type="text" name="desc" value="'.$desc_arr[2].'"><br>
                <label>max швидкість:</label>
                <input type="text" name="desc" value="'.$desc_arr[3].'"><br>
                <label>max тиск:</label>
                <input type="text" name="desc" value="'.$desc_arr[4].'"><br>
                <div style="display: flex; align-items: center; justify-content: space-around;">
                    <input type="submit" value="Submit">
                    <button onclick="deleteGood('.$row['id'].', event)">Delete</button>
                </div>
            </form>
            ';
        }  
    }
    ?>
    </div>
    <hr style="margin: 20px 0;">
    <div class="flex2">
    <?php
    $change_ac = "SELECT * FROM `models` WHERE 1";
    $ac_stmt = $pdo->query($change_ac);
    $ac = $ac_stmt->fetchAll(PDO::FETCH_ASSOC);
     foreach ($ac as $row) {
         if($row['type'] === 'ac') {
            echo '
            <form class="form_ac" id="'.$row['id'].'" method="post" enctype="multipart/form-data">
                <div class="flex">
                    <label>Картинка 1:</label>
                    <img class="image" id="image1_'.$row['id'].'" src="data:image/jpeg;base64,'.base64_encode( $row['img1'] ).'" alt="">
                    <input type="file" name="brand_image1" id="brand_image1" onchange="previewImage1(event, 1, '.$row['id'].')">
                </div>
                <div class="flex">
                    <label>Картинка 2:</label>
                    <img class="image" id="image2_'.$row['id'].'" src="data:image/jpeg;base64,'.base64_encode( $row['img2'] ).'" alt="">
                    <input type="file" name="brand_image2" id="brand_image2" onchange="previewImage1(event, 2, '.$row['id'].')">
                </div>
                <div class="flex">
                    <label>Картинка 3:</label>
                    <img class="image" id="image3_'.$row['id'].'" src="data:image/jpeg;base64,'.base64_encode( $row['img3'] ).'" alt="">
                    <input type="file" name="brand_image3" id="brand_image3" onchange="previewImage1(event, 3, '.$row['id'].')">
                </div>
                <label>Наименование:</label><br>
                <input type="text" name="name" id="name" placeholder="Пример (Болт кріплення)" value="'.$row['name'].'">
                <br><br>
                <label>Наименование (рус):</label><br>
                <input type="text" name="name_ru" id="name_ru" placeholder="Пример (Болт кріплення)" value="'.$row['name_ru'].'">
                <br><br>
                <label>Категория:</label>
                <select name="marka" id="mark"><br>
                    <option value="Аксессуары">Аксессуары</option>
                </select>
                <br>
                <label>Полное описание: (если есть)</label><br>
                <textarea name="all_descr" id="all_descr" cols="30" rows="3">'.$row['all_descr'].'</textarea>
                <br>
                <label>Полное описание (рус):</label><br>
                <textarea name="all_descr_ru" id="all_descr_ru" cols="30" rows="3">'.$row['all_descr_ru'].'</textarea>
                <br>
                <label>Заголовок описания-1 (если есть):</label><br>
                <input type="text" name="ttl_descr1" id="ttl_descr1" value="'.$row['ttl_descr1'].'">
                <br>
                <label>Заголовок описания-1 (рус):</label><br>
                <input type="text" name="ttl_descr1_ru" id="ttl_descr1_ru" value="'.$row['ttl_descr1_ru'].'">
                <br>
                <label>Описание списком-1 (если есть):</label><br>
                <textarea type="text" name="descr1" id="descr1" placeholder="ВАЖНО писать через (;) без пробелов" cols="30" rows="3">'.$row['descr1'].'</textarea>
                <br>
                <label>Описание списком-1 (рус):</label><br>
                <textarea type="text" name="descr1_ru" id="descr1_ru" placeholder="ВАЖНО писать через (;) без пробелов" cols="30" rows="3">'.$row['descr1_ru'].'</textarea>
                <br>
                <label>Заголовок описания-2 (если есть):</label><br>
                <input type="text" name="ttl_descr2" id="ttl_descr2" value="'.$row['ttl_descr2'].'">
                <br>
                <label>Заголовок описания-2 (рус):</label><br>
                <input type="text" name="ttl_descr2_ru" id="ttl_descr2_ru" value="'.$row['ttl_descr2_ru'].'">
                <br>
                <label>Описание списком-2 (если есть):</label><br>
                <textarea type="text" name="descr2" id="descr2" placeholder="ВАЖНО писать через (;) без пробелов" cols="30" rows="3">'.$row['descr2'].'</textarea>
                <br>
                <label>Описание списком-2 (рус):</label><br>
                <textarea type="text" name="descr2_ru" id="descr2_ru" placeholder="ВАЖНО писать через (;) без пробелов" cols="30" rows="3">'.$row['descr2_ru'].'</textarea>
                <br>
                <label>Заголовок описания-3 (если есть):</label><br>
                <input type="text" name="ttl_descr3" id="ttl_descr3" value="'.$row['ttl_descr3'].'">
                <br>
                <label>Заголовок описания-3 (рус):</label><br>
                <input type="text" name="ttl_descr3_ru" id="ttl_descr3_ru" value="'.$row['ttl_descr3_ru'].'">
                <br>
                <label>Описание списком-3 (если есть):</label><br>
                <textarea type="text" name="descr3" id="descr3" placeholder="ВАЖНО писать через (;) без пробелов" cols="30" rows="3">'.$row['descr3'].'</textarea>
                <br>
                <label>Описание списком-3 (рус):</label><br>
                <textarea type="text" name="descr3_ru" id="descr3_ru" placeholder="ВАЖНО писать через (;) без пробелов" cols="30" rows="3">'.$row['descr3_ru'].'</textarea>
                <br>
                <label>Ширина чехла (если есть):</label><br>
                <textarea type="text" name="width" id="width" placeholder="ВАЖНО писать через (;) без пробелов" cols="30" rows="3">'.$row['width'].'</textarea>
                <br>
                <label>Профиль чехла (если есть):</label><br>
                <textarea type="text" name="profile" id="profile" placeholder="ВАЖНО писать через (;) без пробелов" cols="30" rows="3">'.$row['profile'].'</textarea>
                <br>
                <label>Размер обода чехла (если есть):</label><br>
                <textarea type="text" name="rim_size" id="rim_size" placeholder="ВАЖНО писать через (;) без пробелов" cols="30" rows="3">'.$row['rim_size'].'</textarea>
                <br>
                <label>Грузоподъёмность домкрата (если есть):</label><br>
                <textarea type="text" name="load_capacity" id="load_capacity" placeholder="ВАЖНО писать через (;) без пробелов" cols="30" rows="3">'.$row['load_capacity'].'</textarea>
                <br>
                <label>ВАЖНО писать без грн и прочего<br>Цена (основная): </label><br>
                <input type="text" name="price" id="price" value="'.$row['price'].'">
                <br>
                <label>Цена-2 (для домкрата 2 тонны):</label><br>
                <input type="text" name="price1" id="price1" value="'.$row['price1'].'">
                <br>
                <div style="display: flex; align-items: center; justify-content: space-around;">
                    <input type="submit" value="Submit">
                    <button onclick="deleteGood_ac('.$row['id'].', event)">Delete</button>
                </div>
            </form>
            ';
        }  
    }
    ?>
    </div>
    
    <style>
        form {
            width: fit-content;
        }
        .form {
            border: 1px solid #000000;
        }
        .flex {
            display: flex;
            align-items: center;
        }
        .flex2 {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }
        .image{
            max-width: 50px;
        }
        .form_ac {
            border: 1px solid #000000;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
        // Функция для отправки AJAX-запроса
        function updateModel(id, brand_image1, brand_image2, brand_image3, name, marka, model, gen, year, rad, price, desc) {
            var formData = new FormData();
            formData.append('id', id);
            formData.append('brand_image1', brand_image1);
            formData.append('brand_image2', brand_image2);
            formData.append('brand_image3', brand_image3);
            formData.append('name', name);
            formData.append('marka', marka);
            formData.append('model', model);
            formData.append('gen', gen);
            formData.append('year', year);
            formData.append('rad', rad);
            formData.append('price', price);
            formData.append('desc', desc);
        $.ajax({
            url: '/assets/bd/update_good.php', // путь к файлу, который будет обрабатывать запрос
            type: 'POST',
            data: formData, // данные, которые будут отправлены на сервер
            contentType: false, // не устанавливать тип содержимого, позволяет отправлять файлы
            processData: false,
            success: function(response) {
            // обработка успешного ответа от сервера
            console.log(response);
            },
            error: function(jqXHR, textStatus, errorThrown) {
            // обработка ошибок при отправке запроса
            console.error(textStatus, errorThrown);
            }
        });
        }

        function updateModelAc(id, brand_image1, brand_image2, brand_image3, name, name_ru, marka, all_descr, ttl_descr1, descr1, ttl_descr2, descr2, ttl_descr3, descr3, all_descr_ru, ttl_descr1_ru, descr1_ru, ttl_descr2_ru, descr2_ru, ttl_descr3_ru, descr3_ru, width, profile, rim_size, load_capacity, price, price1) {
            var formData = new FormData();
            formData.append('id', id);
            formData.append('brand_image1', brand_image1);
            formData.append('brand_image2', brand_image2);
            formData.append('brand_image3', brand_image3);
            formData.append('name', name);
            formData.append('name_ru', name_ru);
            formData.append('marka', marka);
            formData.append('all_descr', all_descr);
            formData.append('ttl_descr1', ttl_descr1);
            formData.append('descr1', descr1);
            formData.append('ttl_descr2', ttl_descr2);
            formData.append('descr2', descr2);
            formData.append('ttl_descr3', ttl_descr3);
            formData.append('descr3', descr3);
            formData.append('all_descr_ru', all_descr_ru);
            formData.append('ttl_descr1_ru', ttl_descr1_ru);
            formData.append('descr1_ru', descr1_ru);
            formData.append('ttl_descr2_ru', ttl_descr2_ru);
            formData.append('descr2_ru', descr2_ru);
            formData.append('ttl_descr3_ru', ttl_descr3_ru);
            formData.append('descr3_ru', descr3_ru);
            formData.append('width', width);
            formData.append('profile', profile);
            formData.append('rim_size', rim_size);
            formData.append('load_capacity', load_capacity);
            formData.append('price', price);
            formData.append('price1', price1);
        $.ajax({
            url: '/assets/bd/update_good_ac.php', // путь к файлу, который будет обрабатывать запрос
            type: 'POST',
            data: formData, // данные, которые будут отправлены на сервер
            contentType: false, // не устанавливать тип содержимого, позволяет отправлять файлы
            processData: false,
            success: function(response) {
            // обработка успешного ответа от сервера
            console.log(response);
            alert('Успешно обновилось');
            },
            error: function(jqXHR, textStatus, errorThrown) {
            // обработка ошибок при отправке запроса
            console.error(textStatus, errorThrown);
            }
        });
        }
        
        function deleteGood(id, event) {
            event.preventDefault();
            var formData = new FormData();
            formData.append('id', id);
            $.ajax({
                url: '/assets/bd/delete_good.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    alert("Удаление успешно");
                    $('.form#' + id).remove(); // удаление формы из DOM
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error(textStatus, errorThrown);
                }
            });
        }

        function deleteGood_ac(id, event) {
            event.preventDefault();
            var formData = new FormData();
            formData.append('id', id);
            $.ajax({
                url: '/assets/bd/delete_good.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    alert("Удаление успешно");
                    $('.form_ac#' + id).remove(); // удаление формы из DOM
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error(textStatus, errorThrown);
                }
            });
        }

        // Обработчик события отправки формы
        $('.form_ac').on('submit', function(event) {
        event.preventDefault(); // отмена стандартной отправки формы
        var id = $(this).attr('id'); // получение id формы
        var brand_image1 = $(this).find('#brand_image1').prop('files')[0];
        var brand_image2 = $(this).find('#brand_image2').prop('files')[0];
        var brand_image3 = $(this).find('#brand_image3').prop('files')[0];
        var name = $(this).find('#name').val();
        var name_ru = $(this).find('#name_ru').val();
        var marka = $(this).find('#mark').val();
        var all_descr = $(this).find('#all_descr').val();
        var ttl_descr1 = $(this).find('#ttl_descr1').val();
        var descr1 = $(this).find('#descr1').val();
        var ttl_descr2 = $(this).find('#ttl_descr2').val();
        var descr2 = $(this).find('#descr2').val();
        var ttl_descr3 = $(this).find('#ttl_descr3').val();
        var descr3 = $(this).find('#descr3').val();
        var all_descr_ru = $(this).find('#all_descr_ru').val();
        var ttl_descr1_ru = $(this).find('#ttl_descr1_ru').val();
        var descr1_ru = $(this).find('#descr1_ru').val();
        var ttl_descr2_ru = $(this).find('#ttl_descr2_ru').val();
        var descr2_ru = $(this).find('#descr2_ru').val();
        var ttl_descr3_ru = $(this).find('#ttl_descr3_ru').val();
        var descr3_ru = $(this).find('#descr3_ru').val();
        var width = $(this).find('#width').val();
        var profile = $(this).find('#profile').val();
        var rim_size = $(this).find('#rim_size').val();
        var load_capacity = $(this).find('#load_capacity').val();
        var price = $(this).find('#price').val();
        var price1 = $(this).find('#price1').val();
        updateModelAc(id, brand_image1, brand_image2, brand_image3, name, name_ru, marka, all_descr, ttl_descr1, descr1, ttl_descr2, descr2, ttl_descr3, descr3, all_descr_ru, ttl_descr1_ru, descr1_ru, ttl_descr2_ru, descr2_ru, ttl_descr3_ru, descr3_ru, width, profile, rim_size, load_capacity, price, price1); // отправка AJAX-запроса
        });

        $('.form').on('submit', function(event) {
        event.preventDefault(); // отмена стандартной отправки формы
        var id = $(this).attr('id'); // получение id формы
        var brand_image1 = $(this).find('#brand_image1').prop('files')[0];
        var brand_image2 = $(this).find('#brand_image2').prop('files')[0];
        var brand_image3 = $(this).find('#brand_image3').prop('files')[0];
        var name = $(this).find('#name').val();
        var marka = $(this).find('#mark').val(); // получение значения поля "Марка"
        var model = $(this).find('#model').val(); // получение значения поля "Модель"
        var gen = $(this).find('#gen').val();
        var year = $(this).find('#year').val();
        var rad = $(this).find('#rad').val();
        var price = $(this).find('#price').val();
        var desc = $(this).find('input[name="desc"]').map(function() {return $(this).val();}).get();
        updateModel(id, brand_image1, brand_image2, brand_image3, marka, model, gen, year, rad, price, desc); // отправка AJAX-запроса
        alert("Изменено успешно");
        });
    </script>
    <script>
    // Получаем поле выбора изображения и поле ввода названия марки
    const imageInput = document.getElementById("brand_image");
    const brandNameInput = document.getElementById("brand_name");

    // Добавляем обработчик события на выбор изображения
    imageInput.addEventListener("change", () => {
        // Получаем имя выбранного изображения без расширения
        const imageName = imageInput.files[0].name.replace(/\.[^/.]+$/, "");
        
        // Устанавливаем имя в поле ввода названия марки
        brandNameInput.value = imageName;
    });
    </script>
    <script>
        function previewImage(event, id) {
        var reader = new FileReader();
        reader.onload = function(){
            var image = document.getElementById(`image${id}`);
            image.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
        }
    </script>
    <script>
        function previewImage1(event, id, id1) {
        var reader = new FileReader();
        reader.onload = function(){
            var image = document.getElementById(`image${id}_${id1}`);
            image.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
        }
    </script>
    <script>
        function previewImage2(event, id) {
        var reader = new FileReader();
        reader.onload = function(){
            var image = document.getElementById(`image${id}`);
            image.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</body>
</html>