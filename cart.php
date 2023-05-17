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
    <link rel="stylesheet" href="/assets/css/cart.css">
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
                        <div class="title"><?php echo $translation['cart1']?></div>
                        <form id="ord-form">
                            <input type="hidden" name="cart-hid" id="cart-hid" value="">
                            <input type="hidden" name="cart-hid-total" id="cart-hid-total" value="">
                            <label for="name"><?php echo $translation['cart2']?><input type="text" name="name" id="name" required placeholder="Иван"></label>
                            <label for="surname"><?php echo $translation['cart3']?><input type="text" name="surname" id="surname" required placeholder="Иванов"></label>
                            <label for="phone"><?php echo $translation['cart4']?><input type="tel" name="phone" id="phone" value="+380" required pattern="^\+380\d{9}$" minlength="13" maxlength="13" placeholder="+38 (0__)___-__-__"></label>
                            <div class="submit">
                                <input id="ord-submit" type="submit" value="<?php echo $translation['cart1']?>">
                                <div class="text"><?php echo $translation['cart5']?></div>
                            </div>
                        </form>
                    </div>
                    <div class="block2">
                        <div class="title"><?php echo $translation['cart6']?></div>
                        <div id="cart-order"></div>
                        <div class="cart-order-total"><?php echo $translation['cart7']?><span><span id="cart-order-total"></span> грн</span></div>
                    </div>
                </div>
            </div>
        </section>
        <?php include($_SERVER['DOCUMENT_ROOT'] . '/footer-bl.php');?>
    </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="/assets/js/script.js"></script>
<script>
        var form = document.getElementById('ord-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            // Получаем данные формы
            var formData = new FormData(form);
            // Отправляем данные на сервер
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '/assets/bd/send-order.php');
            xhr.send(formData);

            // Получаем ответ от сервера
            xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                // Проверяем ответ сервера
                if (xhr.responseText === 'ok') {
                    var modal2 = document.getElementById('modal2');
                    modal2.style.display = 'grid';
                    localStorage.removeItem('cart');
                } else if (xhr.responseText === 'empty_cart') {
                    // Если корзина localStorage пуста, выводим alert
                    alert('Корзина пуста!');
                } else {
                    // Если ответ отличается от ok или empty_cart, выводим ошибку
                    alert(xhr.responseText);
                    console.log(xhr.responseText);
                }
                } else {
                // Если сервер вернул ошибку, выводим ошибку
                alert('Произошла ошибка');
                }
            }
        };
    });

    document.addEventListener('DOMContentLoaded', function() {
        sC();
    });
    function checkCartNotEmpty() {
        var cart = JSON.parse(localStorage.getItem('cart')) || {};
        var cartIsEmpty = Object.keys(cart).length === 0;
        if (cartIsEmpty) {
            alert('Корзина пуста. Пожалуйста, добавьте товары в корзину.');
        }
        return !cartIsEmpty;
    }
    function updateTotal() {
        var cart = JSON.parse(localStorage.getItem('cart')) || {};
        var total = 0;
        for (var itemId in cart) {
        if (cart.hasOwnProperty(itemId)) {
            var cartItem = cart[itemId];
            total += cartItem.price * cartItem.quantity;
        }
        }
        var totalEl = document.getElementById('cart-order-total');
        if (totalEl) {
        totalEl.innerHTML = total;
        document.getElementById('cart-hid-total').value = JSON.stringify(total);
        }
    }
    function sC() {
        var cart = JSON.parse(localStorage.getItem('cart')) || {};
        var cartHtml = '';
        for (var itemId in cart) {
            if (cart.hasOwnProperty(itemId)) {
                var cartItem = cart[itemId];
                cartHtml += '<div class="cart-item" id="cart-item'+itemId+'">';
                cartHtml += '<div class="cart-main">';
                cartHtml += '<div class="image">';
                cartHtml += '<img src="data:image/jpeg;base64,'+cartItem.img1+'" alt="' + cartItem.marka + '">';
                cartHtml += '</div>';
                cartHtml += '<div style="display: flex; flex-direction: column; justify-content: space-between;">';
                cartHtml += '<div>';
                cartHtml += '<div class="cart-item-title">'+cartItem.name+' '+(cartItem.l_c ? '(' + cartItem.l_c + ')' : '')+' '+(cartItem.wd ? '(' + cartItem.wd + ' / ' : '')+''+(cartItem.pr ? cartItem.pr + ' / ' : '')+''+(cartItem.r_s ? cartItem.r_s + ')' : '')+' '+ cartItem.marka +' '+ cartItem.model +' '+(cartItem.gen ? cartItem.gen + ' ' : '')+''+(cartItem.year ? cartItem.year + '-' : '')+''+cartItem.radius+'</div>';
                cartHtml += '<div class="cart-item-price">' + cartItem.price + ' грн</div>';
                cartHtml += '</div>';
                cartHtml += '<div class="quantity">'+cartItem.quantity+' шт.</div>';
                cartHtml += '</div>';
                cartHtml += '</div>';
                cartHtml += '<div class="cross" onclick="rI(\'' + itemId + '\')">+</div>'
                cartHtml += '</div>';
            }
        }
        var cartorder = document.getElementById('cart-order');
        cartorder.innerHTML = cartHtml;

        document.getElementById('cart-hid').value = JSON.stringify(cart);
        updateTotal();
    }
    function rI(itemId) {
        var cart = JSON.parse(localStorage.getItem('cart')) || {};
        delete cart[itemId];
        localStorage.setItem('cart', JSON.stringify(cart));
        var cartItemEl = document.getElementById('cart-item-' + itemId);
        if (cartItemEl) {
            cartItemEl.remove();
        }
        sC();
        showCartItemCount();
    }
</script>
</body>
</html>