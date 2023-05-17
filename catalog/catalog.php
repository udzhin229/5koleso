<?php
session_start();
require_once '../assets/bd/connect.php';
require_once ('../assets/lang/lang.php');
$lang = 'uk';
if(isset($_COOKIE['lang'])) {
    if($_COOKIE['lang'] == 'ru' || $_COOKIE['lang'] == 'uk') {
        $_SESSION['lang'] = $_COOKIE['lang'];
    }
}
$lng = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'uk';
$translation = $translate[$lng];
// проверяем, были ли переданы параметры поиска
if(!empty($_GET['mark']) || !empty($_GET['model']) || !empty($_GET['year']) || !empty($_GET['h-search'])) {
    $query = "SELECT * FROM models WHERE `type` = 'wh'";
    $params = array();

    // добавляем условия WHERE в зависимости от переданных параметров
    if(!empty($_GET['mark'])) {
        $mark = $_GET['mark'];
        $query .= " AND marka = ?";
        $params[] = $mark;
    }
    if(!empty($_GET['model'])) {
        $model = $_GET['model'];
        $query .= " AND model = ?";
        $params[] = $model;
    }
    if(!empty($_GET['year'])) {
        $year = $_GET['year'];
        $query .= " AND year = ?";
        $params[] = $year;
    }
    if(!empty($_GET['sort'])) {
        $sort = $_GET['sort'];
        $query .= " ORDER BY $sort";
    }
    if(!empty($_GET['h-search'])) {
        $search_terms = explode(' ', $_GET['h-search']);
        $query = "SELECT * FROM models WHERE 1=1";
        $conditions = array();
        foreach($search_terms as $term) {
            $conditions[] = "((marka LIKE ? OR model LIKE ? OR year LIKE ? OR gen LIKE ? OR radius LIKE ?) OR (marka LIKE ? OR model LIKE ? OR year LIKE ? OR gen LIKE ? OR radius LIKE ?))";
            $params[] = "$term";
            $params[] = "$term";
            $params[] = "$term";
            $params[] = "$term";
            $params[] = "$term";
            $params[] = "%$term%";
            $params[] = "%$term%";
            $params[] = "%$term%";
            $params[] = "%$term%";
            $params[] = "%$term%";
        }
        $query .= " AND (" . implode(' AND ', $conditions) . ")";
        $query .= " ORDER BY id DESC";
    }
    $stmt = $pdo->prepare($query);
    $stmt->execute($params);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $query = "SELECT * FROM models WHERE `type` = 'wh'";
    $result = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
}

$model = $pdo->query("SELECT DISTINCT brand_name, brand_image FROM car_brands ORDER BY brand_name ASC")->fetchAll(PDO::FETCH_ASSOC);
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
    <link rel="stylesheet" href="/assets/css/catalog.css">
    <title>Каталог</title>
</head>
<body style="background: #ffffff">
    <div class="page">
        <?php include($_SERVER['DOCUMENT_ROOT'] . '/modal.php')?>
        <?php include($_SERVER['DOCUMENT_ROOT'] . '/header.php')?>
        <?php include($_SERVER['DOCUMENT_ROOT'] . '/cart-modal.php')?>
        <div class="dheader">
            <div class="container">
                <form action="/assets/bd/choose.php" method="get">
                    <select name="mark" id="mark">
                        <option selected="true" disabled="disabled" value=""><?php echo $translation['i7']?></option>
                        <?php
                        foreach ($model as $row) {
                            echo '<option value="' .$row['brand_name']. '">' . $row['brand_name'] . '</option>';
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
        <section class="catalog">
            <div class="container">
                <div class="catalog__inner">
                    <h1 class="title"><?php echo $translation['c1'] ?></h1>
                    <div class="info__block">
                        <div class="info">
                            <div class="text"><span style="cursor: pointer;" onclick="window.location.href='/catalog/catalog.php'">Докатки на авто</span><?php if(!empty($_GET['mark'])) {echo "<img src='/assets/images/catalog/vector.svg' alt='vector'>" . $_GET['mark'] ."";} elseif (!empty($_GET['h-search'])) {echo "<img src='/assets/images/catalog/vector.svg' alt='vector'> " .$translation['s']. " (" . $_GET['h-search'] .")";} ?><?php if(!empty($_GET['model'])) {echo "<img src='/assets/images/catalog/vector.svg' alt='vector'>" . $_GET['model'] ."";} ?><?php if(!empty($_GET['year'])) {echo "<img src='/assets/images/catalog/vector.svg' alt='vector'>" . $_GET['year'] ."";} ?></div>
                        </div>
                        <div class="info">
                            <select name="filter" id="filter">
                                <option selected='true' disabled='disabled' value="none"><?php echo $translation['c7'] ?></option>
                                <option value="p-asc"><?php echo $translation['c8'] ?></option>
                                <option value="p-desc"><?php echo $translation['c9'] ?></option>
                                <option value="m-asc"><?php echo $translation['c11'] ?></option>
                                <option value="m-desc"><?php echo $translation['c12'] ?></option>
                                <?php if(empty($mark)) {
                                    echo '<option value="ma-asc">'.$translation['c13'].'</option>
                                    <option value="ma-desc">'.$translation['c14'].'</option>';
                                }
                                ?>
                                
                            </select>
                        </div>
                    </div>
                    <div class="blocks" id="blocks-container">
                        <?php
                        if(count($result) > 0) {
                            foreach ($result as $row) {
                            $desc_str = $row['description'];
                            $desc_arr = explode(";", $desc_str);
                            echo 
                            "<div class='block' data-price='".$row['price']."' data-modell='".$row['model']."' data-marka='".$row['marka']."'>
                            <div id='show-good' onclick=\"location.href='good.php?id=".$row['id']."'\" class='img'><img src='data:image/jpeg;base64,".base64_encode($row['img1'])."'/></div>
                            <div onclick=\"location.href='/catalog/good.php?id=".$row['id']."'\" class='title' id='title_cart' data-lang='".$lng."'>".$row['name']." ".(!empty($row['marka']) ? $row['marka'].' ' : '').(!empty($row['model']) ? $row['model'].' ' : '').(!empty($row['gen']) ? $row['gen'].' ' : '').(!empty($row['year']) ? $row['year'].'' : '').(!empty($row['radius']) ? '-'.$row['radius'].'' : '')."</div>
                            <div class='texts'>";
                                    foreach($desc_arr as $index=>$value){
                                        echo "<div class='text'>".$translation['c'.($index+2)]." <span>".$value."</span></div>";
                                    }
                        echo   "</div>
                                <div class='price'><span id='price'>".$row['price']."</span> грн</div>
                                <button onclick='addCart(".$row['id'].",".$row['price'].")'>".$translation['c10']."</button>
                            </div>";
                            }
                        } else {
                            echo "<div style='font-family: var(--font-roboto); font-size: 24px;'>По вашему запросу ничего не найдено.</div>";
                        }
                        ?>
                    </div>
                    <?php 
                        if(count($result) > 0) {
                            echo ' <div class="pagin">
                                <a href="#" class="pagination-prev">«</a>
                                <div class="pagination"></div>
                                <a href="#" class="pagination-next">»</a>
                            </div>';
                        }
                        else {
                            echo '';
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
        function submitForm(element) {
            element.form.submit();
        }
    </script>
    <script>
        $(document).ready(function() {
            var $blocksContainer = $('#blocks-container');
            var $blocks = $('.block');
            var pageNumber = 1;
            
            $(document).on('click', '.pagination-link', function(e) {
                e.preventDefault();
                pageNumber = $(this).data('page');
                renderPagination();
                showPage(pageNumber);
            });

            if ($.isEmptyObject(localStorage.getItem('filter-value'))) {
                var selectedValue = 'none';
            }
            else {
                var selectedValue = localStorage.getItem('filter-value') || 'none';
            }
            $('#filter').val(selectedValue);
            
            // Sort the blocks on page load
            sortBlocks(selectedValue);

            $('#filter').on('change', function() {
                var order = $(this).val();
                sortBlocks(order);
                showPage(pageNumber);
                // Save the selected value to localStorage
                localStorage.setItem('filter-value', order);
            });
            function sortBlocks(order) {
                

                if (order === 'p-asc') {
                    $blocks.sort(function(a, b) {
                    var priceA = parseInt($(a).data('price'));
                    var priceB = parseInt($(b).data('price'));
                    return priceA - priceB;
                    });
                } else if (order === 'p-desc') {
                    $blocks.sort(function(a, b) {
                    var priceA = parseInt($(a).data('price'));
                    var priceB = parseInt($(b).data('price'));
                    return priceB - priceA;
                    });
                }
                else if (order === 'm-asc') {
                    $blocks.sort(function(a, b) {
                    var modelA = $(a).data('modell');
                    var modelB = $(b).data('modell');
                    return modelA.localeCompare(modelB);
                    });
                }
                else if (order === 'm-desc') {
                    $blocks.sort(function(a, b) {
                    var modelA = $(a).data('modell');
                    var modelB = $(b).data('modell');
                    return modelB.localeCompare(modelA);
                    });
                }
                else if (order === 'ma-asc') {
                    $blocks.sort(function(a, b) {
                    var markaA = $(a).data('marka');
                    var markaB = $(b).data('marka');
                    return markaA.localeCompare(markaB);
                    });
                }
                else if (order === 'ma-desc') {
                    $blocks.sort(function(a, b) {
                    var markaA = $(a).data('marka');
                    var markaB = $(b).data('marka');
                    return markaB.localeCompare(markaA);
                    });
                }
                $blocks.detach().appendTo($blocksContainer);
            }

            // Pagination

            var itemsPerPage = 16; // Change this value as per your requirement
            var totalItems = $('.block').length;
            var totalPages = Math.ceil(totalItems / itemsPerPage);

            function showPage(pageNumber) {
            var startIndex = (pageNumber - 1) * itemsPerPage;
            var endIndex = startIndex + itemsPerPage;
            $('.block').hide().slice(startIndex, endIndex).show();
            }

            function renderPagination() {
            var paginationHtml = '';
            if (totalPages <= 7) {
                for (var i = 1; i <= totalPages; i++) {
                    var activeClass = (i === pageNumber) ? ' active' : '';
                    paginationHtml += '<a href="#" class="pagination-link' + activeClass + '" data-page="' + i + '">' + i + '</a>';
                }
            } else {
                if (pageNumber <= 4) {
                for (var i = 1; i <= 5; i++) {
                    var activeClass = (i === pageNumber) ? ' active' : '';
                    paginationHtml += '<a href="#" class="pagination-link' + activeClass + '" data-page="' + i + '">' + i + '</a>';
                }
                paginationHtml += '<span class="pagination-ellipsis">&hellip;</span>';
                paginationHtml += '<a href="#" class="pagination-link" data-page="' + totalPages + '">' + totalPages + '</a>';
                } else if (pageNumber >= totalPages - 3) {
                paginationHtml += '<a href="#" class="pagination-link" data-page="1">1</a>';
                paginationHtml += '<span class="pagination-ellipsis">&hellip;</span>';
                for (var i = totalPages - 4; i <= totalPages; i++) {
                    var activeClass = (i === pageNumber) ? ' active' : '';
                    paginationHtml += '<a href="#" class="pagination-link' + activeClass + '" data-page="' + i + '">' + i + '</a>';
                }
                } else {
                paginationHtml += '<a href="#" class="pagination-link" data-page="1">1</a>';
                paginationHtml += '<span class="pagination-ellipsis">&hellip;</span>';
                for (var i = pageNumber - 2; i <= pageNumber + 2; i++) {
                    var activeClass = (i === pageNumber) ? ' active' : '';
                    paginationHtml += '<a href="#" class="pagination-link' + activeClass + '" data-page="' + i + '">' + i + '</a>';
                }
                paginationHtml += '<span class="pagination-ellipsis">&hellip;</span>';
                paginationHtml += '<a href="#" class="pagination-link" data-page="' + totalPages + '">' + totalPages + '</a>';
                }
            }
            
            $('.pagination').html(paginationHtml);
            }
            function prevPage() {
                if (pageNumber > 1) {
                    pageNumber--;
                    renderPagination();
                    showPage(pageNumber);
                }
            }

            function nextPage() {
                if (pageNumber < totalPages) {
                    pageNumber++;
                    renderPagination();
                    showPage(pageNumber);
                }
            }
            $(document).on('click', '.pagination-prev', function(e) {
                e.preventDefault();
                prevPage();
            });

            $(document).on('click', '.pagination-next', function(e) {
                e.preventDefault();
                nextPage();
            });
            showPage(1);
            renderPagination();

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