<div class="head_mob" id="head_mob">
    <div class="container">
        <div class="head_mob__inner">
            <div class="hm1">
                <a href="/" class="header__logo"><img src="/assets/images/logo.webp" alt="5 колесо логотип"></a>
                <div class="header__lang">
                    <a onclick="setLang('uk')" class="lang uk">Укр</a>
                    <div class="lang__line"></div>
                    <a onclick="setLang('ru')" class="lang ru">Рус</a>
                </div>
                <div class="burger_menu">
                    <span>МЕНЮ</span>
                    <div id="burger1" class="burger">
                        <div class="bg-line"></div>
                        <div class="bg-line"></div>
                        <div class="bg-line"></div>
                    </div>
                </div>
            </div>
            <div class="hm2">
                <a href="/#about" data-scroll="#about" class="nav__link"><?php echo $translation['h6']?></a>
                <a href="/#models" data-scroll="#models" class="nav__link"><?php echo $translation['h7']?></a>
                <a href="/catalog/catalog.php" class="nav__link"><?php echo $translation['h14']?></a>
                <a href="/#recomend" data-scroll="#recomend" class="nav__link"><?php echo $translation['h8']?></a>
                <a href="/#access" data-scroll="#access" class="nav__link"><?php echo $translation['h9']?></a>
                <a href="/#rewiews" data-scroll="#rewiews" class="nav__link"><?php echo $translation['h10']?></a>
                <a href="/#contact" data-scroll="#contact" class="nav__link"><?php echo $translation['h11']?></a>
                <div class="we-in">
                    <span><?php echo $translation['h15']?></span>
                    <div class="header__messangers">
                        <a href="viber://chat?number=%2B380951380572" class="messangers-img"><img src="/assets/images/viber-icon.svg" alt="5 колесо viber"></a>
                        <a href="https://t.me/mykola_95" class="messangers-img"><img src="/assets/images/tg-icon.svg" alt="5 колесо telegram"></a>
                        <a href="https://instagram.com/5koleso_ua?igshid=NTc4MTIwNjQ2YQ==" class="messangers-img"><img src="/assets/images/inst-icon.svg" alt="5 колесо instagram"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<header id="header">
    <div class="container">
        <div class="header__block hb1">
        <a href="/" class="header__logo"><img src="/assets/images/logo.webp" alt="5 колесо логотип"></a>
        <div class="header__lang">
            <a onclick="setLang('uk')" class="lang uk">Укр</a>
            <div class="lang__line"></div>
            <a onclick="setLang('ru')" class="lang ru">Рус</a>
        </div>
        <div class="burger_menu">
            <span>МЕНЮ</span>
            <div id="burger" class="burger">
                <div class="bg-line"></div>
                <div class="bg-line"></div>
                <div class="bg-line"></div>
            </div>
        </div>
        <div class="header__messangers">
            <div class="messangers-text"><?php echo $translation['h1']?></div>
            <a href="https://tinyurl.com/yxe3x8j8" class="messangers-img"><img src="/assets/images/viber-icon.svg" alt="5 колесо viber"></a>
            <a href="https://t.me/mykola_95" class="messangers-img"><img src="/assets/images/tg-icon.svg" alt="5 колесо telegram"></a>
            <a href="https://instagram.com/5koleso_ua?igshid=NTc4MTIwNjQ2YQ==" class="messangers-img"><img src="/assets/images/inst-icon.svg" alt="5 колесо instagram"></a>
        </div>
        <div class="header__contacts">
            <a href="tel:+380951380572" class="contacts-num">+38 (095) 138 05 72</a>
            <li class="contacts-time"><?php echo $translation['h2']?></li>
        </div>
        <div class="header__form">
            <?php
            if(!empty($_SESSION['user_mail'])) {
                echo '<div class="form__user1">
                <a href="/profile.php"><img src="/assets/images/user.webp" alt="профиль"></a>
                <a href="#" id="cart-m"><img src="/assets/images/cart.webp" alt="корзина" onclick="showCart()"><div class="cart-item-count" id="ctc"></div></a>
                </div>';
            }
            else {
                echo '<div class="form__user1">
                <a href="#" id="register-btn"><img src="/assets/images/user.webp" alt="профиль"></a>
                <a href="#" id="cart-m"><img src="/assets/images/cart.webp" alt="корзина" onclick="showCart()"><div class="cart-item-count" id="ctc"></div></a>
                </div>';
            }
            ?>
        </div>
        <form class="nav__input" action='/catalog/catalog.php'>
            <input type="search" name="h-search" id="h-search" placeholder="<?php echo $translation['h12']?>">
            <input type="submit" name="search" value="">
            <!-- <button><img src="/assets/images/search.svg" alt="5 колесо поиск"></button> -->
        </form>
    </div>
    <hr>
    <nav class="header__block">
        <a href="/#about" data-scroll="#about" class="nav__link"><?php echo $translation['h6']?></a>
        <a href="/#models" data-scroll="#models" class="nav__link"><?php echo $translation['h7']?></a>
        <a href="/catalog/catalog.php" class="nav__link"><?php echo $translation['h14']?></a>
        <a href="/#recomend" data-scroll="#recomend" class="nav__link"><?php echo $translation['h8']?></a>
        <a href="/#access" data-scroll="#access" class="nav__link"><?php echo $translation['h9']?></a>
        <a href="/#rewiews" data-scroll="#rewiews" class="nav__link"><?php echo $translation['h10']?></a>
        <a href="/#contact" data-scroll="#contact" class="nav__link"><?php echo $translation['h11']?></a>
        <form class="nav__input" action='/catalog/catalog.php'>
            <input type="search" name="h-search" id="h-search" placeholder="<?php echo $translation['h12']?>">
            <input type="submit" name="search" value="">
            <!-- <button><img src="/assets/images/search.svg" alt="5 колесо поиск"></button> -->
        </form>
    </nav>
    </div>
    
</header>
<style>
/* Header */
header {
    padding: 45px 0 44px;
}
.head_mob {
    display: none;
}
.header__block {
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.header__lang {
    display: flex;
    align-items: center;
}
.burger_menu {
    display: none;
}
.header__lang a {
    cursor: pointer;
    font-family: var(--font-roboto);
    font-style: normal;
    font-weight: 400;
    font-size: 11px;
    line-height: 13px;
    text-decoration-line: underline;
    color: #FFFFFF;
}
.header__lang .lang__line {
    margin: 0 8px;
    height: 20px;
    border: 1px solid #FFFFFF;
}
.header__messangers {
    display: flex;
    align-items: center;
}
.header__messangers .messangers-text {
    font-family: var(--font-roboto);
    font-style: normal;
    font-weight: 400;
    font-size: 11px;
    line-height: 13px;
    color: #FFFFFF;
    margin-right: 5px;
    text-align: right;
}
.header__messangers .messangers-img {
    margin-left: 6px;
    display: inherit;
}
.header__contacts {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
}
.header__contacts .contacts-num {
    text-decoration: none;
    font-family: var(--font-roboto);
    font-style: normal;
    font-weight: 900;
    font-size: 20.1319px;
    line-height: 24px;
    text-align: right;
    color: #FFFFFF;
    margin-bottom: 3px;
}
.header__contacts .contacts-time {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    font-family: var(--font-roboto);
    font-style: normal;
    font-weight: 400;
    font-size: 11px;
    line-height: 13px;
    color: #FFFFFF;
    text-align: right;
    list-style: none;
}
.header__contacts .contacts-time::before {
    margin-right: 4px;
    display: block;
    content: '';
    width: 4px;
    height: 4px;
    border-radius: 50%;
    background: linear-gradient(180deg, #FF455B 0%, #D51E34 100%), #E41717;
}
.header__form .form__user {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 8px;
    margin-bottom: 5px;
}
.header__form .form__user1 {
    display: flex;
    align-items: center;
    gap: 27px;
}
.header__form .form__user1 a {
    display: inherit;
    text-decoration: none;
    position: relative;
    max-width: 29px;
}
.header__form .form__user1 a img {
    width: 100%;
}
.header__form .form__user1 a .cart-item-count {
    display: none;
    position: absolute;
    border-radius: 50%;
    top: 0;
    right: -7px;
    width: 14px;
    height: 14px;
    background: linear-gradient(180deg, #FF455B 0%, #D51E34 100%), #D9D9D9;
    place-items: center;
    font-family: var(--font-roboto);
    font-style: normal;
    font-weight: 600;
    font-size: 8px;
    line-height: 9px;
    text-align: right;
    color: #FFFFFF;
}
.header__form .form__user .user-log {
    cursor: pointer;
    font-family: var(--font-roboto);
    font-style: normal;
    font-weight: 400;
    font-size: 11px;
    line-height: 13px;
    text-align: right;
    text-decoration-line: underline;
    color: #FFFFFF;
}
.header__form .form__cart-unlog {
    cursor: pointer;
    display: flex;
    align-items: center;
    width: 100%;
    padding: 4px;
    background: #FFFFFF;
    border-radius: 2px;
}
.header__form .form__cart-unlog .form__cart-text {
    margin-left: 5px;
    font-family: var(--font-roboto);
    font-style: normal;
    font-weight: 400;
    font-size: 11px;
    line-height: 13px;
    color: #212121;
}
header hr {
    border: 1px solid #FFFFFF;
    width: 100%;
    margin: 30px 0 15px;
}
.nav__link {
    text-decoration: none;
    font-family: var(--font-roboto);
    font-style: normal;
    font-weight: 600;
    font-size: 14px;
    line-height: 16px;
    color: #FFFFFF;
}
.header__block:last-child .nav__input {
    display: flex !important;
    align-items: center;
}
.nav__input {
    display: none;
    align-items: center;
}
.nav__input input[type='search'] {
    outline: none;
    font-family: var(--font-roboto);
    font-style: normal;
    font-weight: 400;
    font-size: 11px;
    line-height: 13px;
    color: #212121; 
    height: 21px;
    max-width: 149px;
    width: 100%;
    padding-left: 10px;
}
.nav__input input[type='search']::placeholder {
    font-family: var(--font-roboto);
    font-style: normal;
    font-weight: 400;
    font-size: 11px;
    line-height: 13px;
    color: #212121;
}
.nav__input input[type='submit'] {

    height: 21px;
    width: 31px;
    cursor: pointer;
    padding: 0 5px;
    background: #212121;
    background-image: url('/assets/images/search.svg');
    background-size: contain;
    background-repeat: no-repeat;
    background-position: center;
    border: none;
    border-radius: 0px 2px 2px 0px;
}
@media (max-width: 1200px) {
    .header__form .form__user {
        flex-direction: column;
        gap: 3px;
        align-items: flex-end;
    }
    .header__form .form__cart-unlog {
        max-width: 90px;
        padding: 2px;
    }
    .header__form .form__cart-unlog .form__cart-text {
        font-size: 7px;
        line-height: 9px;
    }
    .header__form .form__user .user-log {
        font-size: 8px;
        line-height: 9px;
    }
    header {
        padding: 20px 0;
    }
    .header__logo {
        max-width: 135px;
    }
    .header__logo img {
        width: 100%;
    }
    .header__lang a {
        font-size: 10px;
        line-height: 12px;
    }
    .header__lang .lang__line {
        margin: 6px;
        height: 18px;
    }
    .header__messangers .messangers-text {
        font-size: 10px;
        line-height: 12px;
        margin-right: 2px;
    }
    .header__messangers .messangers-img {
        margin-left: 5px;
        max-width: 22px;
    }
    .header__messangers .messangers-img img {
        width: 100%;
    }
    .header__contacts .contacts-num {
        font-size: 14px;
        line-height: 15px;
    }
    .header__contacts .contacts-time {
        font-size: 8px;
        line-height: 10px;
    }
    .header__form .form__user1 {
        gap: 7px;
    }
    .header__form .form__user1 a {
        max-width: 22px;
    }
    .header__form .form__user1 a img {
        width: 100%;
    }
    header hr {
        margin: 15px 0 10px;
    }
    .nav__link {
        font-size: 9px;
        line-height: 11px;
    }
    .nav__input input[type='search'] {
        font-size: 9px;
        line-height: 11px;
        height: 18px;
        max-width: 80px;
        padding-left: 7px;
    }
    .nav__input input[type='submit'] {
        height: 18px;
        width: 25px;
        padding: 0 3px;
    }
}
@media (max-width: 600px) {
    header {
        padding: 10px 0 14px;
        background: #111111;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 9;
    }
    /* header.active {
        background: rgb(0 0 0 / 90%);
        backdrop-filter: blur(10px);
        position: fixed;
        top: 0;
        right: 0;
        left: 0;
        bottom: 0;
        z-index: 10;
    } */
    header .modal-header {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 100;
        width: 100%;
        background: rgba(0, 0, 0, 0.8);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
    }
    .head_mob {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        width: 100%;
        z-index: 10;
        background: rgba(0, 0, 0, 0.8);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
    }
    .header__form {
        width: 50%;
    }
    .header__form .form__user1 {
        gap: 15px;
        justify-content: flex-end;
    }
    .header__form .form__user1 a {
        display: inherit;
        width: 25px;
    }
    .header__form .form__user1 a img {
        width: 100%;
    }
    .header__form .form__user1 a .cart-item-count {
        right: -3px;
        width: 8px;
        height: 8px;
        font-size: 4px;
        line-height: 6px;
    }
    .head_mob.active {
        display: block;
    }
    .head_mob .head_mob__inner .hm1 {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .head_mob .head_mob__inner .hm2 {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    .head_mob .head_mob__inner .hm2 .we-in {
        margin-top: 20px; 
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    .head_mob .head_mob__inner .hm2 .we-in span{
        font-family: var(--font-roboto);
        font-style: normal;
        font-weight: 600;
        font-size: 10px;
        line-height: 12px;
        color: #FFFFFF;
    }
    .head_mob .head_mob__inner .nav__link {
        text-decoration: none;
        font-family: var(--font-roboto);
        font-style: normal;
        font-weight: 600;
        font-size: 14px;
        line-height: 16px;
        color: #FFFFFF;
    }
    .head_mob .head_mob__inner {
        padding: 10px 0 14px;
        width: 100%;
        display: flex;
        flex-direction: column;
        gap: 40px;
    }
    .head_mob .head_mob__inner a {
        font-size: 8px;
        line-height: 9px;
    }
    .head_mob .head_mob__inner .lang__line {
        height: 14px;
        margin: 0 6px;
    }
    .head_mob .head_mob__inner .header__logo img {
        width: 100%;
    }
    .head_mob .head_mob__inner .header__logo {
        max-width: 122px;
    }
    .header__block {
        flex-wrap: wrap;
        gap: 10px 0px;
    }
    header .header__logo {
        max-width: 122px;
    }
    .header__contacts {
        align-items: flex-start;
    }
    .header__messangers .messangers-img {
        margin: 0 4px 0 0;
        display: inherit;
        width: 20px;
        height: 20px;
    }
    .header__messangers .messangers-img img{
        width: 100%;
    }
    .burger_menu {
        display: flex;
        align-items: center;
        gap: 15px;
    }
    .burger_menu span {
        font-family: var(--font-roboto);
        font-style: normal;
        font-weight: 600;
        font-size: 9px;
        line-height: 11px;
        color: #FFFFFF;
    }
    .burger_menu .burger {
        width: 21px;
        height: 14px;
        display: grid;
        place-items: center;
        position: relative;
    }
    .burger_menu .burger .bg-line:nth-child(1) {
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        width: 100%;
        border: 1px solid #FFFFFF;
        border-radius: 1px;
        transition: all .2s ease-in-out;
    }
    .burger_menu .burger .bg-line:nth-child(2) {
        width: 100%;
        border: 1px solid #FFFFFF;
        border-radius: 1px;
        transition: all .2s ease-in-out;
    }
    .burger_menu .burger .bg-line:nth-child(3) {
        position: absolute;
        left: 0;
        right: 0;
        bottom: 0;
        width: 100%;
        border: 1px solid #FFFFFF;
        border-radius: 1px;
        transition: all .2s ease-in-out;
    }
    .burger_menu .burger.active .bg-line:nth-child(2) {
        opacity: 0;
    }
    .burger_menu .burger.active .bg-line:nth-child(1) {
        top: 50%;
        transform: translateY(-100%)rotate(45deg);
        -webkit-transform: translateY(-100%)rotate(45deg);
        -moz-transform: translateY(-100%)rotate(45deg);
        -ms-transform: translateY(-100%)rotate(45deg);
        -o-transform: translateY(-100%)rotate(45deg);
    }
    .burger_menu .burger.active .bg-line:nth-child(3) {
        bottom: 50%;
        transform: rotate(-45deg);
        -webkit-transform: rotate(-45deg);
        -moz-transform: rotate(-45deg);
        -ms-transform: rotate(-45deg);
        -o-transform: rotate(-45deg);
    }
    .header__lang a {
        font-size: 8px;
        line-height: 9px;
    }
    .header__lang .lang__line {
        height: 14px;
        margin: 0 6px;
    }
    header .header__logo img {
        width: 100%;
    }
    .header__contacts .contacts-num {
        font-size: 12px;
        line-height: 14px;
    }
    .header__contacts .contacts-time {
        font-size: 6px;
        line-height: 7px;
    }
    .header__form .form__user {
        gap: 7px;
        margin-bottom: 4px;
        justify-content: flex-end;
        flex-direction: unset;
    }
    .header__form .form__user .user-log {
        font-size: 7px;
        line-height: 8px;
    }
    .header__form .form__cart-unlog {
        max-width: 118px;
        font-size: 7px;
        line-height: 8px;
        padding: 2px 4px;
        margin: 0 0 0 auto;
    }
    .header__form .form__cart-unlog img {
        max-width: 10px;
    }
    .header__form .form__cart-unlog .form__cart-text {
        font-size: 7px;
        line-height: 8px;
    }
    .header__messangers {
        order: 2;
    }
    .header__messangers .messangers-text {
        display: none;
    }
    header hr {
        display: none;
    }
    .header__block:last-child {
        display: none;
        position: absolute;
        flex-direction: column;
        align-items: flex-start;
        top: 110px;
    }
    .nav__input {
        display: flex;
        align-items: center;
        order: 3;
    }
    .header__block:last-child .nav__input {
        display: none !important;
    }
    .nav__input input[type='search'] {
        font-size: 7px;
        line-height: 8px;
        height: 14px;
        width: 98px;
        padding-left: 6px;
    }
    .nav__input input[type='search']::placeholder {
        font-size: 7px;
        line-height: 8px;
    }
    .nav__input input[type='submit'] {
        height: 14px;
        width: 20px;
        padding: 0 3px;
    }
    
}
</style>
<script>
    const burger = document.getElementById('burger'); 
    const burger1 = document.getElementById('burger1');
    const header = document.getElementById('head_mob');
    if (burger) {
        burger.addEventListener('click', function() {
                burger.classList.add('active');
                burger1.classList.add('active');
                header.classList.add('active');
                document.body.classList.add('modal-open');
            burger1.addEventListener('click', function() {
                burger.classList.remove('active');
                burger1.classList.remove('active');
                header.classList.remove('active');
                document.body.classList.remove('modal-open');
            });
        });
    }
    function spanCart() {
        var sCart = document.getElementById('cart-item-count');
        sCart.innerText = "<?php echo $translation['h13'] ?>";
    }
</script>