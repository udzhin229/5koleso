<?php
session_start();
require_once '../assets/bd/connect.php';
require_once ('../assets/lang/lang.php');

$lang = 'uk';
if(isset($_COOKIE['lang'])) {
    // Проверьте, является ли значение куки 'lang' допустимым
    if($_COOKIE['lang'] == 'ru' || $_COOKIE['lang'] == 'uk') {
        $_SESSION['lang'] = $_COOKIE['lang'];
    }
}
$lng = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'uk';
$translation = $translate[$lng];

if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM models WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    if ($stmt->rowCount() == 0) {
        header('Location: /catalog/catalog.php');
        exit();
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    // добавить id в массив в сессии, если его там еще нет
    if (!isset($_SESSION['viewed_products'])) {
        $_SESSION['viewed_products'] = array();
    }
    if (!in_array($id, $_SESSION['viewed_products'])) {
        array_unshift($_SESSION['viewed_products'], $id);
    }

    // ограничить количество просмотренных товаров до 4
    $_SESSION['viewed_products'] = array_slice($_SESSION['viewed_products'], 0, 4);
} else {
    header('Location: /catalog/catalog.php');
    exit();
}
    $desc_str = $row['description'];
    if (!empty($desc_str)) {
    $desc_arr = explode(";", $desc_str);
}
    $descr1 = $row['descr1'];
    if (!empty($descr1)) {
    $descr_1 = explode(";", $descr1);
}
    $descr2 = $row['descr2'];
    if (!empty($descr2)) {
    $descr_2 = explode(";", $descr2);
}
    $descr3 = $row['descr3'];
    if (!empty($descr3)) {
    $descr_3 = explode(";", $descr3);
}
$descr1_ru = $row['descr1_ru'];
if (!empty($descr1_ru)) {
$descr_1_ru = explode(";", $descr1_ru);
}
$descr2_ru = $row['descr2_ru'];
if (!empty($descr2_ru)) {
$descr_2_ru = explode(";", $descr2_ru);
}
$descr3_ru = $row['descr3_ru'];
if (!empty($descr3_ru)) {
$descr_3_ru = explode(";", $descr3_ru);
}
    $l_c = $row['load_capacity'];
    if (!empty($l_c)) {
        $load_capacity = explode(";", $l_c);
    }
    $r_s = $row['rim_size'];
    if (!empty($r_s)) {
        $rim_size = explode(";", $r_s);
    }
    $pr = $row['profile'];
    if (!empty($pr)) {
        $profile = explode(";", $pr);
    }
    $wd = $row['width'];
    if (!empty($wd)) {
        $width = explode(";", $wd);
    }
    
    $q = "SELECT * FROM models WHERE `type` = :type";
    $st = $pdo->prepare($q);
    $type = 'ac';
    $st->bindParam(':type', $type, PDO::PARAM_STR);
    $st->execute();
    $result = $st->fetchAll(PDO::FETCH_ASSOC);
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
    <link rel="stylesheet" href="/assets/css/good.css">
    <link rel="stylesheet" href="/assets/css/owl.carousel.min.css">
    <title>Каталог</title>
</head>
<body style="background: #ffffff">
    <div class="page">
        <?php include($_SERVER['DOCUMENT_ROOT'] . '/modal.php');?>
        <?php include($_SERVER['DOCUMENT_ROOT'] . '/cart-modal.php');?>
        <?php include($_SERVER['DOCUMENT_ROOT'] . '/header.php')?>
        <section class="good">
            <div class="container">
                <div class="good__inner">
                    <div class="info">
                        <div class="text"><?php if($row['type'] == 'ac') {if($lng == 'ru' && $row['name_ru']){echo $row['name_ru'];} else {echo $row['name'];};} else {echo "<div style='cursor: pointer;' onclick='history.back()'>Докатки на авто</div> <img src='/assets/images/catalog/vector.svg' alt='vector'>";}?> <?php if(!empty($row['marka'])){echo $row['marka'];}?> <?php if(!empty($row['model'])){echo $row['model'];}?> <?php if(!empty($row['gen'])){echo $row['gen'] . " ";}?><?php if(!empty($row['year'])){echo $row['year'];}?><?php if(!empty($row['radius'])){echo "-".$row['radius']."";}?></div>
                    </div>
                    <h1 class="title" id="title_cart" data-lang="<?php echo $lng ?>"><?php if($lng == 'ru' && $row['name_ru']){echo $row['name_ru'];} else {echo $row['name'];}?> <?php if(!empty($row['marka'])){echo $row['marka'];}?> <?php if(!empty($row['model'])){echo $row['model'];}?> <?php if(!empty($row['gen'])){echo $row['gen'] . " ";}?><?php if(!empty($row['year'])){echo $row['year'];}?><?php if(!empty($row['radius'])){echo "-".$row['radius']."";}?></h1>
                    <div class="block">
                        <div class="images">
                            <div class="img"><img id='main-img' src="<?php echo 'data:image/jpeg;base64,'.base64_encode( $row['img1'] ).''; ?>" alt=""></div>
                            <div class="img-blocks">
                                <?php if(!empty($row['img1']) && !empty($row['img2'])){echo '<div class="img-block"><img src="data:image/jpeg;base64,'.base64_encode( $row['img1'] ).'" alt=""></div>';}?>
                                <?php if(!empty($row['img2'])){echo '<div class="img-block"><img src="data:image/jpeg;base64,'.base64_encode( $row['img2'] ).'" alt=""></div>';}?>
                                <?php if(!empty($row['img3'])){echo '<div class="img-block"><img src="data:image/jpeg;base64,'.base64_encode( $row['img3'] ).'" alt=""></div>';}?>
                            </div>
                        </div>
                        <div class="info">
                            <div class="in1">
                                <div class="title"><?php echo $translation['c15']?></div>
                                <?php if(!empty($row['all_descr']) || !empty($row['all_descr_ru'])) {if($lng == 'ru' && $row['all_descr_ru']){echo '<div class="all_descr">'.$row['all_descr_ru'].'</div>';} else {echo '<div class="all_descr">'.$row['all_descr'].'</div>';};}?>
                                
                                <?php 
                                if (!empty($desc_arr)) {
                                    echo "<div class='texts' ".(!empty($row['descr1'] && empty($row['descr3'])) ? 'style="flex-direction: unset; flex-wrap: wrap; justify-content: space-between;"' : '').">";
                                    foreach ($desc_arr as $key => $desc) {
                                        if (!empty($desc)) {
                                            echo "<div class='text'><img src='/assets/images/wheel.svg'></img>{$translation['c' . ($key + 2)]} <span>{$desc}</span></div>";
                                        }
                                    }
                                    echo "</div>";
                                }
                                if (!empty($descr1)) {
                                    echo "<div class='texts' ".(!empty($row['descr1'] && empty($row['descr3'])) ? 'style="flex-direction: unset; flex-wrap: wrap; justify-content: space-between;"' : '').">
                                        <div class='ttl_texts' ".(!empty($row['ttl_descr1']) ? 'style="display: block;"' : 'style="display: none;"').">"; 
                                        if(!empty($row['ttl_descr1']) || !empty($row['ttl_descr1_ru'])) {if($lng == 'ru' && $row['ttl_descr1_ru']){echo $row['ttl_descr1_ru'];} else {echo $row['ttl_descr1'];};}
                                        echo "</div>";
                                        if ($lng == 'ru') {
                                            foreach ($descr_1_ru as $key => $desc) {
                                                if (!empty($desc)) {
                                                    echo "<div class='text'><img src='/assets/images/wheel.svg'></img>{$desc}</div>";
                                                }
                                            }
                                        }
                                        else {
                                            foreach ($descr_1 as $key => $desc) {
                                                if (!empty($desc)) {
                                                    echo "<div class='text'><img src='/assets/images/wheel.svg'></img>{$desc}</div>";
                                                }
                                            }
                                        }
                                    echo "</div>";
                                }
                                if (!empty($descr2)) {
                                    echo "<div class='texts' ".(!empty($row['descr1'] && empty($row['descr3'])) ? 'style="flex-direction: unset; flex-wrap: wrap; justify-content: space-between;"' : '').">
                                    <div class='ttl_texts' ".(!empty($row['ttl_descr2']) ? 'style="display: block;"' : 'style="display: none;"').">";
                                    if(!empty($row['ttl_descr2']) || !empty($row['ttl_descr2_ru'])) {if($lng == 'ru' && $row['ttl_descr2_ru']){echo $row['ttl_descr2_ru'];} else {echo $row['ttl_descr2'];};}
                                    echo "</div>";
                                    if ($lng == 'ru') {
                                        foreach ($descr_2_ru as $key => $desc) {
                                            if (!empty($desc)) {
                                                echo "<div class='text'><img src='/assets/images/wheel.svg'></img>{$desc}</div>";
                                            }
                                        }
                                    }
                                    else {
                                        foreach ($descr_2 as $key => $desc) {
                                            if (!empty($desc)) {
                                                echo "<div class='text'><img src='/assets/images/wheel.svg'></img>{$desc}</div>";
                                            }
                                        }
                                    }
                                    echo "</div>";
                                }
                                if (!empty($descr3)) {
                                    echo "<div class='texts' ".(!empty($row['descr1'] && empty($row['descr3'])) ? 'style="flex-direction: unset; flex-wrap: wrap; justify-content: space-between;"' : '').">
                                    <div class='ttl_texts' ".(!empty($row['ttl_descr3']) ? 'style="display: block;"' : 'style="display: none;"').">";
                                    if(!empty($row['ttl_descr3']) || !empty($row['ttl_descr3_ru'])) {if($lng == 'ru' && $row['ttl_descr3_ru']){echo $row['ttl_descr3_ru'];} else {echo $row['ttl_descr3'];};}
                                     echo "</div>";
                                    if ($lng == 'ru') {
                                        foreach ($descr_3_ru as $key => $desc) {
                                            if (!empty($desc)) {
                                                echo "<div class='text'><img src='/assets/images/wheel.svg'></img>{$desc}</div>";
                                            }
                                        }
                                    }
                                    else {
                                        foreach ($descr_3 as $key => $desc) {
                                            if (!empty($desc)) {
                                                echo "<div class='text'><img src='/assets/images/wheel.svg'></img>{$desc}</div>";
                                            }
                                        }
                                    }
                                    echo "</div>";
                                }
                                ?>
                            </div>
                            <div class="in1">
                                <div class="deliv"><?php echo $translation['c16']?></div>
                                <div class="price"><?php echo $translation['c17']?> <span><p id="price"><?php echo $row['price']?></p> грн</span></div>
                                <!-- <option selected="true" disabled="disabled" value="">Обрати</option> -->
                                <?php 
                                if(!empty($row['width']) && $row['width'] != NULL) 
                                {echo '
                                    <div class="load_c">
                                        <div class="load_c_min">
                                        <div class="deliv">'.$translation['c32'].'</div>
                                        <select name="l_c" id="wd_'.$row['id'].'"">
                                            ';
                                            foreach ($width as $key => $desc) {
                                                echo "<option value='{$key}' data-value='{$desc}'>{$desc}</option>";
                                            }
                                echo '</select>
                                    </div>
                                    </div>
                                ';}
                                if(!empty($row['profile']) && $row['profile'] != NULL) 
                                {echo '
                                    <div class="load_c">
                                        <div class="load_c_min">
                                        <div class="deliv">'.$translation['c31'].'</div>
                                        <select name="l_c" id="pr_'.$row['id'].'"">
                                            ';
                                            foreach ($profile as $key => $desc) {
                                                echo "<option value='{$key}' data-value='{$desc}'>{$desc}</option>";
                                            }
                                echo '</select>
                                    </div>
                                    </div>
                                ';}
                                if(!empty($row['rim_size']) && $row['rim_size'] != NULL) 
                                {echo '
                                    <div class="load_c">
                                        <div class="load_c_min">
                                        <div class="deliv">'.$translation['c30'].'</div>
                                        <select name="l_c" id="r_s_'.$row['id'].'"">
                                            ';
                                            foreach ($rim_size as $key => $desc) {
                                                echo "<option value='{$key}' data-value='{$desc}'>{$desc}</option>";
                                            }
                                echo '</select>
                                    </div>
                                    </div>
                                ';}
                                if(!empty($row['load_capacity']) && $row['load_capacity'] != NULL) 
                                {echo '
                                    <div class="load_c">
                                        <div class="load_c_min">
                                        <div class="deliv">'.$translation['c25'].'</div>
                                        <select name="l_c" id="l_c_'.$row['id'].'" onchange="updatePrice(this)">
                                            ';
                                            foreach ($load_capacity as $key => $desc) {
                                                echo "<option value='{$key}' data-value='{$desc}'>{$desc}</option>";
                                            }
                                echo '</select>
                                    </div>
                                    </div>
                                ';}
                                ?>
                                <div class="to-cart">
                                    <div class="tc1"><input type="number" name="piec" id="piec" min="1" value="1"> шт.</div>
                                    <input type="button" value="<?php echo $translation['c10']?>" onclick="addCart(<?php echo $row['id']?>, document.getElementById('price').textContent)">
                                </div>
                            </div>
                        </div>
                        <div class="form">
                            <!-- <img src="/assets/images/rect-good.svg" alt=""> -->
                            <div class="f-title"><?php echo $translation['c18']?></div>
                            <div class="f-dtitle"><?php echo $translation['c19']?></div>
                            <form id="send_form" method="post">
                                <input type="text" name="name1" id="name1" required placeholder="<?php echo $translation['c20']?>">
                                <input type="tel" name="phone1" id="phone1" required placeholder="<?php echo $translation['c21']?>">
                                <input type="submit" value="<?php echo $translation['c22']?>">
                            </form>
                            <div class="alert"><?php echo $translation['c23']?></div>
                            <div class="link-us">
                                <div class="link-us-text"><?php echo $translation['c24']?></div>
                                <a href="viber://chat?number=%2B380951380572"><img src="/assets/images/good/viber.png" alt="5 колесо viber"></a>
                                <a href="https://t.me/mykola_95"><img src="/assets/images/good/tg.svg" alt="5 колесо tg"></a>
                                <a href="https://instagram.com/5koleso_ua?igshid=NTc4MTIwNjQ2YQ=="><img src="/assets/images/good/inst.svg" alt="5 колесо instagram"></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="with_b__inner">
                    <div class="title"><?php if($row['type'] == 'wh') {echo $translation['c26'];} else if ($row['type'] == 'ac') {echo $translation['c28'];}?></div>
                    <?php if($row['type'] == 'wh') {echo '<div class="comments">
                     <div id="bl-a"><img src="/assets/images/bl-a.svg" alt=""></div>
                     <div id="br-a"><img src="/assets/images/br-a.svg" alt=""></div>
                     <div class="owl-carousel">'; 
                        if(count($result) > 0) {
                            foreach ($result as $rows) {
                            echo '<div class="card">
                                <div id="show-good" onclick=location.href="good.php?&id='.$rows['id'].'" class="img"><img src="data:image/jpeg;base64,'.base64_encode( $rows['img1'] ).'"/></div>
                                <div onclick=location.href="/catalog/good.php?&id='.$rows['id'].'" class="title">'.($lng == 'ru' && $rows['name_ru'] ? $rows['name_ru'] : $rows['name']).'</div>
                                <div class="price">'.$rows['price'].' грн</div>
                                <button onclick=location.href="/catalog/good.php?&id='.$rows['id'].'">'.$translation['c27'].'</button>
                            </div>';
                            }
                        }
                        echo '</div>
                        </div>';
                    }
                    else if (($row['type'] == 'ac')) {
                        if (isset($_SESSION['viewed_products'])) {
                            // подготовить запрос для выборки товаров с заданными id
                            $ids = implode(',', $_SESSION['viewed_products']);
                            $q_v = "SELECT * FROM models WHERE id IN ($ids) ORDER BY FIELD(id, $ids)";
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
                            else {
                                echo "<div class='not-view'>
                                    <button onclick=location.href='/catalog/catalog.php'>".$translation['c29']."</button>
                                </div>";
                            }
                        }
                    }
                    ?>
                </div>
                </div>
        </section>
        <?php include($_SERVER['DOCUMENT_ROOT'] . '/footer-bl.php');?>
    </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="/assets/js/owl.carousel.min.js"></script>
<script src="/assets/js/script.js"></script>
<script>
    function goBackOrRedirect(url) {
        if (history.length > 1) {
            history.back();
        } else {
            window.location.href = url;
        }
    }
        $(document).ready(function(){
            $('.owl-carousel').owlCarousel({
                nav: false,
                dots: false,
                loop:true,
                responsiveClass:true,
                responsive:{
                    0:{
                        items:2,
                    },
                    600:{
                        items:2,
                    },
                    1000:{
                        items:3,
                    }
                }
            });
            $('#br-a').click(function() {
            $('.owl-carousel').trigger('next.owl.carousel');
            });

            $('#bl-a').click(function() {
            $('.owl-carousel').trigger('prev.owl.carousel');
            });
        });
    </script>
<script>
    const mainImg = document.getElementById('main-img');
    const imgBlocks = document.querySelectorAll('.img-block');

    imgBlocks.forEach((imgBlock) => {
    imgBlock.addEventListener('click', () => {
        const clickedImg = imgBlock.querySelector('img');
        mainImg.setAttribute('src', clickedImg.getAttribute('src'));
    });
    });
    function updatePrice(select) {
    // Получаем выбранное значение из select
    var load_capacity = parseInt(select.value);
    
    // Создаем массив цен
    var prices = [<?php echo $row['price']; ?>, <?php echo $row['price1']; ?>];
    
    // Обновляем цену в блоке <div class="price">
    var price = prices[load_capacity == 0 ? 0 : 1];
    var priceElement = document.getElementById('price');
    priceElement.innerHTML = price;
}
</script>
</body>
</html>