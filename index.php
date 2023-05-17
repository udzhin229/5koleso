<?php
session_start();
require_once ('assets/lang/lang.php');
require_once ('assets/bd/connect.php');
$lang = 'uk';
if(isset($_COOKIE['lang'])) {
    // Проверьте, является ли значение куки 'lang' допустимым
    if($_COOKIE['lang'] == 'ru' || $_COOKIE['lang'] == 'uk') {
        $_SESSION['lang'] = $_COOKIE['lang'];
    }
}
$lng = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'uk';
$translation = $translate[$lng];
$sql = "SELECT DISTINCT brand_name, brand_image FROM car_brands ORDER BY brand_name ASC";
$model = $pdo->query($sql);
$rows = $model->fetchAll(PDO::FETCH_ASSOC);

// Запрос на получение случайных 4 товаров
$stmt = $pdo->prepare("SELECT * FROM models WHERE `type` = 'wh' ORDER BY RAND() LIMIT 4");
$stmt->execute();
$result = $stmt->fetchAll();

$stmt_ac = $pdo->prepare("SELECT * FROM models WHERE `type` = 'ac'");
$stmt_ac->execute();
$result_ac = $stmt_ac->fetchAll();
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
    <link rel="stylesheet" href="/assets/css/index.css">
    <link rel="stylesheet" href="/assets/css/owl.carousel.min.css">
    <title>5 КОЛЕСО</title>
</head>
<body>
    <div class="page">
        <?php include($_SERVER['DOCUMENT_ROOT'] . '/modal.php');?>
        <?php include($_SERVER['DOCUMENT_ROOT'] . '/cart-modal.php');?>
        <section class="intro">
            <?php include($_SERVER['DOCUMENT_ROOT'] . '/header.php')?>
            <div class="container">
                <div class="intro__inner">
                    <!-- <img src="/assets/images/form.svg" alt=""> -->
                    <div class="intro__info">
                        <div class="intro__titles">
                            <h1 class="intro__title"><?php echo $translation['i2']?></h1>
                            <h2 class="intro__dtitle"><?php echo $translation['i3']?></h2>
                        </div>
                        <div class="intro__blocks">
                            <div class="intro__block ib1">
                                <div class="block-round">11</div>
                                <div class="block-text"><?php echo $translation['i4']?></div>
                            </div>
                            <div class="intro__block">
                                <div class="block-round">35</div>
                                <div class="block-text"><?php echo $translation['i5']?></div>
                            </div>
                        </div>
                    </div>
                    <div class="intro__form">
                        <div class="text"><?php echo $translation['i1']?></div>
                        <form action="/assets/bd/choose.php" method="get">
                            <select name="mark" id="mark">
                                <option selected="true" disabled="disabled" value=""><?php echo $translation['i7']?></option>
                                <?php
                                foreach ($rows as $row) {
                                    echo '<option value="' . $row['brand_name'] . '">' . $row['brand_name'] . '</option>';
                                }
                                ?>
                            </select>
                            <select name="model" id="model">
                                <option selected="true" disabled="disabled" value=""><?php echo $translation['i6']?></option>
                            </select>
                            <select name="year" id="year">
                                <option selected="true" disabled="disabled" value=""><?php echo $translation['i8']?></option>
                            </select>
                            <input type="submit" value="<?php echo $translation['h12']?>">
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <section class="whatis">
            <img class="bg-whatis anim-down" src="/assets/images/whatis/b-i1.svg" alt="">
            <img class="bg-whatis anim-up" src="/assets/images/whatis/b-i2.svg" alt="">
            <div class="container" style="z-index: 1; position: relative;">
                <div class="block1">
                    <div class="bl-info anim-left">
                        <div class="title"><?php echo $translation['i10']?></div>
                        <div class="dtitle"><?php echo $translation['i11']?></div>
                    </div>
                    <div class="bl-info1 anim-right">
                        <div class="title"><?php echo $translation['i12']?></div>
                        <div class="icons">
                            <div class="bl">
                                <div class="img"><img src="/assets/images/whatis/tool1.svg" alt=""></div>
                                <div class="title"><?php echo $translation['i13']?></div>
                                <div class="text"><?php echo $translation['i14']?></div>
                            </div>
                            <div class="bl">
                                <div class="img"><img src="/assets/images/whatis/tool2.svg" alt=""></div>
                                <div class="title"><?php echo $translation['i15']?></div>
                                <div class="text"><?php echo $translation['i16']?></div>
                            </div>
                            <div class="bl">
                                <div class="img"><img src="/assets/images/whatis/tool3.svg" alt=""></div>
                                <div class="title"><?php echo $translation['i17']?></div>
                                <div class="text"><?php echo $translation['i18']?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="block2 anim-pl">
                    <div class="title"><?php echo $translation['i19']?></div>
                    <div class="bl">
                        <div class="bl-min">
                            <img src="/assets/images/whatis/ben1.svg" alt="">
                            <div class="text"><?php echo $translation['i20']?></div>
                        </div>
                        <hr>
                        <div class="bl-min">
                            <img src="/assets/images/whatis/ben2.svg" alt="">
                            <div class="text"><?php echo $translation['i21']?></div>
                        </div>
                        <hr>
                        <div class="bl-min">
                            <img src="/assets/images/whatis/ben3.svg" alt="">
                            <div class="text"><?php echo $translation['i22']?></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="models" id="models">
            <div class="container">
                <div class="models__inner">
                    <div class="title anim-left"><?php echo $translation['m1']?></div>
                    <div class="blocks">
                        <?php
                        foreach ($rows as $row) {
                            echo '<a href="/catalog/catalog.php?mark=' . $row['brand_name'] . '" class="block anim-pl"><div class="img"><img src="data:image/jpeg;base64,'.base64_encode( $row['brand_image'] ).'"/></div>' . $row['brand_name'] . ' </a>';
                        }
                        ?>
                    </div>
                    <button id="all_see"><?php echo $translation['i23']?></button>
                </div>
            </div>
        </section>
        <section class="recomend" id="recomend">
            <img class="bg-recom anim-down" src="/assets/images/bg-bolt.svg" alt="">
            <img class="bg-recom anim-up" src="/assets/images/bg-dom.svg" alt="">
            <div class="container">
                <div class="recomend__inner">
                    <div class="title anim-left"><?php echo $translation['r1']?></div>
                    <div class="blocks" id="blocks-container">
                        <?php
                        if(count($result) > 0) {
                            foreach ($result as $row) {
                            $desc_str = $row['description'];
                            $desc_arr = explode(";", $desc_str);
                            echo 
                            "<div class='block anim-pl' data-price='".$row['price']."' data-modell='".$row['model']."' data-marka='".$row['marka']."'>
                                <div id='show-good' onclick=location.href='/catalog/good.php?&id=".$row['id']."' class='img'><img src='data:image/jpeg;base64,".base64_encode( $row['img1'] )."'/></div>
                                <div onclick=location.href='/catalog/good.php?&id=".$row['id']."' class='title'>".$row['name']." ".(!empty($row['marka']) ? $row['marka'].' ' : '').(!empty($row['model']) ? $row['model'].' ' : '').(!empty($row['gen']) ? $row['gen'].'/' : '').(!empty($row['year']) ? $row['year'].'' : '').(!empty($row['radius']) ? '-'.$row['radius'].'' : '')."</div>
                                <div class='texts'>";
                                    foreach($desc_arr as $index=>$value){
                                        echo "<div class='text'><img src='/assets/images/wheel.svg'></img>".$translation['c'.($index+2)]." <span>".$value."</span></div>";
                                    }
                        echo   "</div>
                                <div class='price'>".$row['price']." грн</div>
                                <button onclick='addCart(".$row['id'].",".$row['price'].")'>".$translation['c10']."</button>
                            </div>";
                            }
                        } else {
                            echo "По вашему запросу ничего не найдено.";
                        }
                        ?>
                    </div>
                </div>
                <div class="access__inner" id="access">
                    <div class="title anim-left"><?php echo $translation['ac1']?></div>
                    <div class="blocks">
                    <?php
                    foreach ($result_ac as $product) {
                        echo '
                        <div class="block anim-pl">
                            <div class="img">
                                <img src="data:image/jpeg;base64,' . base64_encode($product['img1']) . '" alt="' . $product['name'] . '">
                            </div>
                            <div class="title" id="title_cart" data-lang="'.$lng.'" onclick=\'location.href="/catalog/good.php?id='.$product['id'].'"\'>' . ($lng == 'ru' && $product['name_ru'] ? $product['name_ru'] : $product['name']) . '</div>
                            <div class="price">'.$product['price'].' грн</div>
                            <input type="button" onclick=\'location.href="/catalog/good.php?id='.$product['id'].'"\' value="'.$translation['c27'].'">
                        </div>';
                    };
                    ?>
                    </div>
                </div>
            </div>
        </section>
        <section class="reviews" id="rewiews">
            <div class="container">
                <div class="reviews__inner">
                    <div class="title anim-left"><?php echo $translation['rew1']?></div>
                    <div class="comments anim-pl">
                    <div id="l-ar"><img src="/assets/images/l-ar.svg" alt=""></div>
                    <div id="r-ar"><img src="/assets/images/r-ar.svg" alt=""></div>
                        <div class="owl-carousel">
                            <?php
                                $feed = $pdo->prepare("SELECT * FROM feed WHERE 1");
                                $feed->execute();
                                $feeds = $feed->fetchAll();
                                if ($lng == 'ru') {
                                    foreach ($feeds as $row) {
                                        echo '
                                        <div class="card">
                                            <div class="card-inner">
                                                <div class="up">
                                                    <img src="/assets/images/man.svg" alt="">
                                                    <div class="name">'.$row['name_ru'].'</div>
                                                </div>
                                                <div class="line"></div>
                                                <div class="text">'.$row['text_ru'].'</div>
                                            </div>
                                        </div>
                                        ';
                                    }
                                }
                                else {
                                    foreach ($feeds as $row) {
                                        echo '
                                        <div class="card">
                                            <div class="card-inner">
                                                <div class="up">
                                                    <img src="/assets/images/man.svg" alt="">
                                                    <div class="name">'.$row['name'].'</div>
                                                </div>
                                                <div class="line"></div>
                                                <div class="text">'.$row['text'].'</div>
                                            </div>
                                        </div>
                                        ';
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="about" id="about">
            <img class="bg-about anim-down" src="/assets/images/about/b-i1.svg" alt="">
            <img class="bg-about anim-up" src="/assets/images/about/b-i2.svg" alt="">
            <div class="container">
                <div class="about__inner">
                    <div class="title anim-left"><?php echo $translation['a1']?></div>
                    <div class="dtitle anim-right"><?php echo $translation['a2']?></div>
                    <div class="blocks anim-pl">
                        <div class="block">
                            <div class="block-title"><?php echo $translation['a3']?></div>
                            <div class="slider">
                                <a class="prev" onclick="plusSlides(-1)"><img src="/assets/images/about/ar-l.svg" alt=""></a>
                                <div class="slideshow-container">
                                    <div class="mySlides fade">
                                        <img src="/assets/images/about/p1.webp">
                                    </div>
                                    <div class="mySlides fade">
                                        <img src="/assets/images/about/p2.webp">
                                    </div>
                                </div>
                                <a class="next" onclick="plusSlides(1)"><img src="/assets/images/about/ar-r.svg" alt=""></a>
                            </div>
                            <div class="products">
                                <div class="product"><?php echo $translation['a5']?></div>
                                <div class="product"><?php echo $translation['a6']?></div>
                                <div class="product"><?php echo $translation['a8_1']?></div>
                                <div class="product"><?php echo $translation['a7']?></div>
                                <div class="product"><?php echo $translation['a8']?></div>
                                
                            </div>
                        </div>
                        <div class="block">
                            <div class="block-title"><?php echo $translation['a4']?></div>
                            <div class="block-ben">
                                <img src="/assets/images/about/i1.webp" alt="5 колесо докатка">
                                <div class="block-ben-text"><?php echo $translation['a9']?></div>
                            </div>
                            <div class="block-ben">
                                <img src="/assets/images/about/i2.webp" alt="5 колесо телефон">
                                <div class="block-ben-text"><?php echo $translation['a10']?></div>
                            </div>
                            <div class="block-ben">
                                <img src="/assets/images/about/i3.webp" alt="5 колесо щит">
                                <div class="block-ben-text"><?php echo $translation['a11']?></div>
                            </div>
                            <div class="block-ben">
                                <img src="/assets/images/about/i4.webp" alt="5 колесо коробка">
                                <div class="block-ben-text"><?php echo $translation['a12']?></div>
                            </div>
                            <div class="block-ben">
                                <img src="/assets/images/about/i5.webp" alt="5 колесо фотоаппарат">
                                <div class="block-ben-text"><?php echo $translation['a13']?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="forma" id="contact">
            <div class="container">
                <div class="forma__inner anim-pl">
                    <div class="f">
                        <div class="title"><?php echo $translation['f1']?></div>
                        <div class="dtitle"><?php echo $translation['f2']?></div>
                        <form id="send_form" method="post">
                            <div class="inp">
                                <input type="text" name="name1" id="name1" required placeholder="<?php echo $translation['c20']?>">
                                <input type="tel" name="phone1" id="phone1" required placeholder="<?php echo $translation['c21']?>">
                            </div>
                            <input type="submit" value="<?php echo $translation['c22']?>">
                            <div class="confirm">
                                <input type="checkbox" name="con" id="con" required>
                                <label for="con"><?php echo $translation['f3']?></label>
                            </div>
                        </form>
                    </div>
                    <div class="d_f">
                        <div class="t1"><?php echo $translation['f4']?></div>
                        <a href="tel:+380951380572">+38 (095) 138 05 72</a>
                        <div class="t3"><?php echo $translation['h2']?></div>
                    </div>
                </div>
            </div>
        </section>
        <?php include($_SERVER['DOCUMENT_ROOT'] . '/footer.php');?>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="/assets/js/owl.carousel.min.js"></script>
    <script src="/assets/js/slider.js"></script>
    <script src="/assets/js/script.js"></script>
    <script>
        // Находим кнопку и блоки, которые нужно открыть
        const button = document.getElementById('all_see');
        const blocks = document.querySelectorAll('.models .block:nth-child(n+15)');

        // Добавляем обработчик события на клик по кнопке
        button.addEventListener('click', () => {
        // Перебираем все блоки и меняем их стиль на "display: block"
        blocks.forEach(block => {
            block.style.display = 'flex';
        });
        button.remove();
        });
    </script>
    <script>
        function imgC(kkk) {
            const mainImg = document.getElementById(`main-img_${kkk}`);
            const imgBlocks = document.querySelectorAll(`.img_block_${kkk}`);

            imgBlocks.forEach((imgBlock) => {
            imgBlock.addEventListener('click', () => {
                const clickedImg = imgBlock.querySelector('img');
                mainImg.setAttribute('src', clickedImg.getAttribute('src'));
            });
            });
        }
        function updatePrice(select, id) {
            // Получаем выбранное значение из select
            var load_capacity = parseInt(select.value);
            
            // Создаем массив цен
            var prices = [<?php echo $product['price']; ?>, <?php echo $product['price1']; ?>];
            
            // Обновляем цену в блоке <div class="price">
            var price = prices[load_capacity == 0 ? 0 : 1];
            var priceElement = document.getElementById(`price${id}`);
            priceElement.innerHTML = price;
        }
    </script>
    <script>
        $(document).ready(function(){
            $('.owl-carousel').owlCarousel({
                nav: false,
                dots: false,
                loop: true,
                center:true,
                margin: 10,
                responsiveClass:true,
                responsive:{
                    0:{
                        items:1,
                    },
                    600:{
                        items:2,
                    },
                    1000:{
                        items:3,
                    }
                }
            });
            $('#r-ar').click(function() {
            $('.owl-carousel').trigger('next.owl.carousel');
            });

            $('#l-ar').click(function() {
            $('.owl-carousel').trigger('prev.owl.carousel');
            });
        });
    </script>
    <script>
        //Поиск моделей по форме
        $(document).ready(function() {
            // При изменении марки заполняем select моделей
            $("select[name='mark']").on("change", function() {
                // Очищаем select моделей
                $("select[name='model']").html("<option selected='true' disabled='disabled' value=''><?php echo $translation['i9']?></option>");
                // Если марка выбрана
                if ($(this).val() != "") {
                // Запрашиваем модели для выбранной марки
                console.time("ajax");
                    $.ajax({
                        url: "/assets/bd/get_models.php",
                        type: "POST",
                        data: { mark: $(this).val() },
                    }).done(function(data) {
                        console.timeEnd("ajax");
                        $("select[name='model']").html("<option selected='true' disabled='disabled' value=''><?php echo $translation['i7']?></option>");
                        $("select[name='model']").append(data);
                    });
                }
            });
            // При изменении марки заполняем select моделей
            $("select[name='model']").on("change", function() {
                // Очищаем select моделей
                $("select[name='year']").html("<option selected='true' disabled='disabled' value=''><?php echo $translation['i9']?></option>");
                // Если марка выбрана
                if ($(this).val() != "") {
                // Запрашиваем модели для выбранной марки
                    $.ajax({
                        url: "/assets/bd/get_years.php",
                        type: "POST",
                        data: { model: $(this).val() },
                    }).done(function(data) {
                        $("select[name='year']").html("<option selected='true' disabled='disabled' value=''><?php echo $translation['i8']?></option>");
                        $("select[name='year']").append(data);
                    });
                }
            });
        });
    </script>
</body>
</html>