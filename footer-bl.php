<footer>
    <div class="container">
        <div class="parent">
            <div class="div1"><img src="/assets/images/logo.webp" alt=""></div>
            <div class="div2">
                <a class="tel" href="tel:+380951380572">+38 (095) 138 05 72</a>
                <div class="t1"><?php echo $translation['h2']?></div>
                <div class="mess">
                    <div class="mess-text"><?php echo $translation['h1']?></div>
                    <a href="viber://chat?number=%2B380951380572" class="mess-img"><img src="/assets/images/good/viber.svg" alt="5 колесо viber"></a>
                    <a href="https://t.me/mykola_95" class="mess-img"><img src="/assets/images/good/tg.svg" alt="5 колесо telegram"></a>
                    <a href="https://instagram.com/5koleso_ua?igshid=NTc4MTIwNjQ2YQ==" class="mess-img"><img src="/assets/images/good/inst.svg" alt="5 колесо instagram"></a>
                </div>
                <a class="mail" href="mailto:Gnsv83@gmail.com "><img src="/assets/images/mail.svg" alt="">Gnsv83@gmail.com</a>
            </div>
            <div class="div3">
                <div class="t1">Докатки на авто<br><a href="#"><?php echo $translation['foo1']?></a></div>
                <div class="t1"><?php echo $translation['foo2']?><a href="#">CapJeka</a><br><a href="https://nexon-studio.com/">NexonStudio</a></div>
            </div>
        </div>
    </div>
</footer>
<style>
/* footer */ 
footer {
    padding: 20px 0;
    width: 100%;
    background: url("/assets/images/bg-black.webp");
    background-repeat: no-repeat;
    background-size: cover;
    color: #ffffff;
}
footer a {
    color: #ffffff;
}
footer .parent {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    grid-template-rows: 1fr;
    grid-column-gap: 0px;
    grid-row-gap: 0px;
    align-items: center;
}
footer .div1 { grid-area: 1 / 1 / 2 / 2; display: flex; align-items: center; justify-content: flex-start;}
footer .div2 { grid-area: 1 / 2 / 2 / 3; display: flex; flex-direction: column; align-items: center;}
footer .div2 .tel {
    font-family: var(--font-roboto);
    font-style: normal;
    font-weight: 900;
    font-size: 20.1319px;
    line-height: 24px;
    
    text-decoration: none;
}
footer .div2 .t1 {
    font-family: var(--font-roboto);
    font-style: normal;
    font-weight: 400;
    font-size: 11px;
    line-height: 13px;
    
}
footer .div2 .mess {
    margin: 20px 0;
    display: flex;
    align-items: center;
    gap: 6px;
}
footer .div2 .mess .mess-text {
    font-family: var(--font-roboto);
    font-style: normal;
    font-weight: 400;
    font-size: 11px;
    line-height: 13px;
    text-align: right;
}
footer .div2 .mess a {
    text-decoration: none;
    display: inherit;
}
footer .div2 .mail {
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 5px;
    font-family: var(--font-roboto);
    font-style: normal;
    font-weight: 600;
    font-size: 16px;
    line-height: 19px;
    
}
footer .div3 { grid-area: 1 / 3 / 2 / 4; display: flex; align-items: center; justify-content: space-between;}
footer .div3 .t1 {
    font-family: 'Roboto';
    font-style: normal;
    font-weight: 400;
    font-size: 11px;
    line-height: 13px;
    text-align: left;
    
}
footer .div3 .t1 a {
    
}
footer .div3 .t1:last-child {
    text-align: right;
}
footer .div3 .t1:last-child a {
    text-decoration: none;
}
@media (max-width: 1200px) {
    footer .parent {
        display: grid;
        grid-template-columns: .6fr 1fr .6fr;
        grid-template-rows: 1fr;
        grid-column-gap: 0px;
        grid-row-gap: 0px;
        align-items: center;
    }
    footer .div1 img{
        width: 100%;
    }
    footer .div3 {
        flex-direction: column;
        gap: 15px;
    }
    footer .div3 .t1 {
        text-align: center;
    }
}
@media (max-width: 600px) {
    footer {
        padding: 0;
    }
    footer .parent {
        display: grid;
        grid-template-rows: repeat(3, 1fr);
        grid-template-columns: 1fr;
        grid-column-gap: 0px;
        grid-row-gap: 0px;
        justify-items: center;
    }
    footer .div1 { grid-area: 1 / 1 / 2 / 2; display: flex; align-items: center; justify-content: flex-start;}
    footer .div2 { grid-area: 2 / 1 / 3 / 2; display: flex; flex-direction: column; align-items: center;}
    footer .div3 { gap: 20px; grid-area: 3 / 1 / 4 / 2; display: flex; align-items: center; justify-content: space-between; flex-direction: column;}
    footer .div3 .t1 {
        text-align: center !important;
    }
}
</style>