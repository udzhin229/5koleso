<?php
session_start();
require_once ($_SERVER['DOCUMENT_ROOT'] . '/assets/bd/connect.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/assets/lang/lang.php');
$lang = 'uk';
if(isset($_COOKIE['lang'])) {
    // Проверьте, является ли значение куки 'lang' допустимым
    if($_COOKIE['lang'] == 'ru' || $_COOKIE['lang'] == 'uk') {
        $_SESSION['lang'] = $_COOKIE['lang'];
    }
}
$lng = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'uk';
$translation = $translate[$lng];

if (isset($_SESSION['user_mail'])) {
    $email = $_SESSION['user_mail'];
    $query = 'SELECT * FROM users WHERE email = :email';
    $statement = $pdo->prepare($query);
    $statement->execute(['email' => $email]);
    $user = $statement->fetch();
}
else {
    header('Location: /');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@500&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/root.css">
    <link rel="stylesheet" href="/assets/css/profile.css">
    <title>Каталог</title>
</head>
<body style="background: #ffffff">
    <div class="page">
        <?php include($_SERVER['DOCUMENT_ROOT'] . '/modal.php');?>
        <?php include($_SERVER['DOCUMENT_ROOT'] . '/cart-modal.php');?>
        <?php include($_SERVER['DOCUMENT_ROOT'] . '/header.php')?>
        <section>
            <div class="container">
                <div class="section__inner">
                    <div class="block1">
                        <div class="title"><?php echo $translation['prof1']?></div>
                        <form>
                            <label for="name"><?php echo $translation['cart2']?>: <?php if(!empty($user['name'])) {echo $user['name'];}?></label>
                            <label for="surname"><?php echo $translation['cart3']?>: <?php if(!empty($user['surname'])) {echo $user['surname'];}?></label>
                            <label for="phone"><?php echo $translation['cart4']?>: <?php if(!empty($user['phone'])) {echo $user['phone'];}?></label>
                        </form>
                        <button onclick="logout(event)"><?php echo $translation['prof8']?></button>
                    </div>
                    <div class="block2">
                        <div class="title"><?php echo $translation['prof3']?></div>
                        <div class="history__values">
                            <div class="g"><?php echo $translation['prof4']?></div>
                            <div class="s"><?php echo $translation['prof5']?></div>
                            <div class="d"><?php echo $translation['prof6']?></div>
                        </div>
                        <div class="history__blocks">
                            <?php
                            if (isset($_SESSION['user_mail'])) {
                                $mail = $_SESSION['user_mail'];
                                $q1 = 'SELECT * FROM orders WHERE email = :email';
                                $st = $pdo->prepare($q1);
                                $st->execute(['email' => $mail]);
                                $ord = $st->fetchAll();
                                if(count($ord) > 0) {
                                    foreach ($ord as $row) {
                                        echo 
                                        '
                                        <div class="history__block">
                                            <div class="history__block_g">
                                                <div class="img_block"><img src="data:image/jpeg;base64,'.base64_encode($row['img1']).'"/></div>
                                                <div class="block_info">
                                                    <div class="info_title">'.$row['name'].' '.(!empty($row['marka']) ? $row['marka'].' ' : '').(!empty($row['model']) ? $row['model'].' ' : '').(!empty($row['gen']) ? $row['gen'].' ' : '').(!empty($row['year']) ? $row['year'].'' : '').(!empty($row['radius']) ? '-'.$row['radius'].'' : '').'</div>
                                                    <div class="info_quantity">'.$row['quantity'].' шт.</div>
                                                </div>
                                            </div>
                                            <div class="history__block_s">'.$row['price'].' грн</div>
                                            <div class="history__block_d">'.$row['date'].'</div>
                                        </div>
                                        ';
                                    }
                                }
                                else {
                                    echo '<div class="block_none_ord">'.$translation['prof7'].'</div>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="section__inner1">
                    <div class="title"><?php echo $translation['c28']?></div>
                    <?php
                    if (isset($_SESSION['viewed_products'])) {
                        // подготовить запрос для выборки товаров с заданными id
                        $ids = implode(',', $_SESSION['viewed_products']);
                        $q_v = "SELECT * FROM models WHERE id IN ($ids)";
                        $s_v = $pdo->prepare($q_v);
                        
                        // выполнить запрос
                        $s_v->execute();
                        $result = $s_v->fetchAll(PDO::FETCH_ASSOC);
                        if(count($result) > 0) {
                            echo '<div class="blocks" id="blocks-container">';
                            foreach ($result as $product) {
                                echo 
                                "<div class='block' data-price='".$product['price']."' data-modell='".$product['model']."' data-marka='".$product['marka']."'>
                                    <div id='show-good' onclick=location.href='/catalog/good.php?&id=".$product['id']."' class='img'><img src='data:image/jpeg;base64,".base64_encode( $product['img1'] )."'/></div>
                                    <div onclick=location.href='/catalog/good.php?&id=".$product['id']."' class='title'>".$product['name']." ".(!empty($product['marka']) ? $product['marka'].' ' : '').(!empty($product['model']) ? $product['model'].' ' : '').(!empty($product['gen']) ? $product['gen'].' ' : '').(!empty($product['year']) ? $product['year'].'' : '').(!empty($product['radius']) ? '-'.$product['radius'].'' : '')."</div>
                                    <div class='price'>".$product['price']." грн</div>
                                    <button onclick=location.href='/catalog/good.php?&id=".$product['id']."'>".$translation['c27']."</button>
                                </div>";
                            }
                            echo '</div>';
                        }
                    }
                    else {
                        echo "<div class='not-view'>
                            <button onclick=location.href='/catalog/catalog.php'>".$translation['c29']."</button>
                        </div>";
                    }
                    ?>
                </div>
            </div>
        </section>
        
        <?php include($_SERVER['DOCUMENT_ROOT'] . '/footer-bl.php');?>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="/assets/js/script.js"></script>
    <script>
    function logout(event) {
        event.preventDefault();
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "/assets/bd/logout.php", true);
        xhr.send();
        location.replace('/');
    }
    </script>
</body>
</html>