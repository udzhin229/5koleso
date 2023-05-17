<div id="modal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
        <div class="modal-btn" id="loginBtn"><?php echo $translation['modal1']?></div>
        <div class="modal-btn" id="registerBtn"><?php echo $translation['modal2']?></div>
        </div>
        <div class="modal-body">
        <form id="loginForm">
            <input name="email" type="email" placeholder="<?php echo $translation['modal11']?>" required>
            <label for="emaill"><?php echo $translation['modal3']?></label>
            <input name="pass" type="password" placeholder="<?php echo $translation['modal12']?>" required>
            <label for="pass"><?php echo $translation['modal4']?></label>
            <div class="sub">
                <input type="submit" value="<?php echo $translation['modal1']?>">
                <div class="reset" onclick="openReset(event)"><?php echo $translation['modal5']?></div>
            </div>
        </form>
        <form id="registerForm">
            <input name="name" type="text" placeholder="<?php echo $translation['modal14']?>" required>
            <input name="surname" type="text" placeholder="<?php echo $translation['modal15']?>" required>
            <input name="email" type="email" placeholder="<?php echo $translation['modal11']?>" required>
            <label for="email"><?php echo $translation['modal6']?></label>
            <input name="phone" type="tel" placeholder="<?php echo $translation['modal13']?>" required value="+380" pattern="^\+380\d{9}$" minlength="13" maxlength="13">
            <label for="phone"><?php echo $translation['modal7']?></label>
            <input name="pass" type="password" placeholder="<?php echo $translation['modal12']?>" required>
            <input type="submit" value="<?php echo $translation['modal2']?>">
        </form>
        </div>
    </div>
</div>
<div id="modal1" class="modal1">
    <div class="modal-content1">
        <img src="/assets/images/reg.svg" alt="5 КОЛЕСО регистрация">
        <div class="text"><?php echo $translation['modal8']?></div>
        <button onclick="location.reload()">На сайт</button>
    </div>
</div>
<div id="modal2" class="modal1">
    <div class="modal-content1">
        <img src="/assets/images/ord.svg" alt="5 КОЛЕСО заказ">
        <div class="text"><?php echo $translation['modal9']?></div>
        <div class="d_text"><?php echo $translation['modal10']?></div>
        <button onclick="location.href='/';">На сайт</button>
    </div>
</div>
<div id="modal6" class="modal1">
    <div class="modal-content1">
        <img src="/assets/images/ord.svg" alt="5 КОЛЕСО заказ">
        <div class="text"><?php echo $translation['modal24']?></div>
        <button onclick="location.href='/';">На сайт</button>
    </div>
</div>
<div id="modal3" class="modal1">
    <div class="modal-content1">
        <img src="/assets/images/post.svg" alt="5 КОЛЕСО сброс">
        <div class="text"><?php echo $translation['modal16']?></div>
        <div class="d_text" style="max-width: 160px;"><?php echo $translation['modal17']?></div>
        <button onclick="location.href='/';">На сайт</button>
    </div>
</div>
<div id="modal4" class="modal2">
    <div class="modal-content">
        <div class="modal-header"><?php echo $translation['modal18']?></div>
        <div class="modal-body">
        <form id="sendForm">
            <input name="email" type="email" placeholder="<?php echo $translation['modal11']?>" required>
            <label for="emaill1"><?php echo $translation['modal6']?></label>
            <input type="submit" value="<?php echo $translation['modal19']?>">
        </form>
        </div>
    </div>
</div>
<div id="modal5" class="modal2">
    <div class="modal-content">
        <div class="modal-header"><?php echo $translation['modal20']?></div>
        <div class="modal-body">
        <form id="updatePass">
        <input type="hidden" name="email" value="">
        <input type="password" id="password" name="pass" placeholder="<?php echo $translation['modal12']?>" required>
        <input type="password" id="password1" name="pass1" placeholder="<?php echo $translation['modal21']?>" required>
        <label for="pass1"><?php echo $translation['modal23']?></label>
        <input type="submit" value="<?php echo $translation['modal22']?>">
        </form>
        </div>
    </div>
</div>
<div id="preloader" class="modal1">
    <span class="loader"></span>
</div>
<style>


.loader {
    width: 48px;
    height: 48px;
    border: 5px solid #FFF;
    border-bottom-color: transparent;
    border-radius: 50%;
    display: inline-block;
    box-sizing: border-box;
    animation: rotation 1s linear infinite;
}

@keyframes rotation {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
} 
body.modal-open {
    overflow: hidden;
}
.modal2 {
    cursor: pointer;
    display: none;
    place-items: center;
    position: fixed;
    z-index: 100;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(33, 33, 33, 0.95);
}
.modal2 .modal-content {
    overflow: hidden;
    width: 390px;
    background: #FFFFFF;
    border-radius: 15px;
    position: relative;
    cursor: default;
}
.modal2 .modal-header {
    background: #F0F0F0;
    text-align: center;
    width: 100%;
    padding: 18px 0;
    font-family: var(--font-roboto);
    font-style: normal;
    font-weight: 400;
    font-size: 20px;
    line-height: 23px;
    color: #212121;
}
.modal2 form {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin: 20px auto;
    width: 275px;
    gap: 20px;
}
.modal2 form input:not([type=submit]) {
    width: 100%;
    height: 58px;
    opacity: 0.6;
    border: 1px solid #212121;
    outline: none;
    border-radius: 5px;
    padding-left: 21px;
    font-family: var(--font-roboto);
    font-style: normal;
    font-weight: 400;
    font-size: 16px;
    line-height: 19px;
    color: #212121;
}
.modal2 form input[type=submit] {
    cursor: pointer;
    padding: 0 25px;
    height: 39px;
    background: linear-gradient(180deg, #FF455B 0%, #D51E34 100%);
    border-radius: 5px;
    border: none;
    outline: none;
    font-family: var(--font-roboto);
    font-style: normal;
    font-weight: 400;
    font-size: 16px;
    line-height: 19px;
    color: #FFFFFF;
}
.modal2 form label[for="email"], .modal form label[for="phone"], .modal form label[for="emaill"], .modal form label[for="pass"], .modal2 form label[for="emaill1"], .modal2 form label[for="pass1"]  {
    display: none;
    font-family: var(--font-roboto);
    font-style: normal;
    font-weight: 400;
    font-size: 14px;
    line-height: 17px;
    color: #ff0000;
    align-self: start;
}
.modal1 {
    display: none;
    place-items: center;
    position: fixed;
    z-index: 100;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(33, 33, 33, 0.95);
}
.modal-content1 {
    overflow: hidden;
    width: 325px;
    background: #FFFFFF;
    border-radius: 13px;
    position: relative;
    display: flex;
    padding: 20px 0;
    align-items: center;
    justify-content: space-between;
    flex-direction: column;
    gap: 20px;
}
.modal1 .text {
    text-transform: uppercase;
    font-family: var(--font-roboto);
    font-style: normal;
    font-weight: 400;
    font-size: 25px;
    line-height: 115%;
    max-width: 200px;
    text-align: center;
    color: #212121;
}
.modal1 .d_text {
    font-family: var(--font-roboto);
    font-style: normal;
    font-weight: 400;
    font-size: 16px;
    line-height: 115%;
    text-align: center;
    color: #212121;
    max-width: 230px;
}
.modal1 button {
    width: 105px;
    height: 39px;
    background: linear-gradient(180deg, #FF455B 0%, #D51E34 100%);
    border-radius: 5px;
    font-family: var(--font-roboto);
    font-style: normal;
    font-weight: 400;
    font-size: 16px;
    line-height: 19px;
    text-align: center;
    color: #FFFFFF;
    outline: none;
    border: none;
    cursor: pointer;
}
.modal {
    cursor: pointer;
    display: none;
    place-items: center;
    position: fixed;
    z-index: 100;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(33, 33, 33, 0.95);
}
.modal .modal-content {
    overflow: hidden;
    width: 390px;
    background: #FFFFFF;
    border-radius: 15px;
    position: relative;
    cursor: default;
}

.modal .modal-header {
    display: flex;
    align-items: center;
}
.modal .modal-btn {
    cursor: pointer;
    width: 50%;
    padding: 16px 0;
    text-align: center;
    font-family: var(--font-roboto);
    font-style: normal;
    font-weight: 400;
    font-size: 18px;
    line-height: 21px;
    color: #212121;
    background: #F0F0F0;
}
.modal .modal-btn.active {
    background: #FFFFFF;
}
.modal form {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin: 20px auto;
    width: 275px;
}
.modal form input:not(input:nth-child(1)) {
    margin-top: 20px
}
.modal form input:not([type=submit]) {
    width: 100%;
    height: 58px;
    opacity: 0.6;
    border: 1px solid #212121;
    outline: none;
    border-radius: 5px;
    padding-left: 21px;
    font-family: var(--font-roboto);
    font-style: normal;
    font-weight: 400;
    font-size: 16px;
    line-height: 19px;
    color: #212121;
}
.modal form input[type=submit] {
    cursor: pointer;
    padding: 0 25px;
    height: 39px;
    background: linear-gradient(180deg, #FF455B 0%, #D51E34 100%);
    border-radius: 5px;
    border: none;
    outline: none;
    font-family: var(--font-roboto);
    font-style: normal;
    font-weight: 400;
    font-size: 16px;
    line-height: 19px;
    color: #FFFFFF;
}
.modal form label[for="email"], .modal form label[for="phone"], .modal form label[for="emaill"], .modal form label[for="pass"]  {
    display: none;
    font-family: var(--font-roboto);
    font-style: normal;
    font-weight: 400;
    font-size: 14px;
    line-height: 17px;
    color: #ff0000;
    align-self: start;
}
.modal form .sub {
    display: flex;
    align-items: center;
    justify-content: space-evenly;
    width: 100%;
    margin-top: 20px;
}
.modal form .sub .reset {
    cursor: pointer;
    font-family: var(--font-roboto);
    font-style: normal;
    font-weight: 400;
    font-size: 16px;
    line-height: 19px;
    text-align: right;
    color: #212121;
}
@media (max-width: 600px) {
    .modal1 .modal-content, .modal .modal-content, .modal2 .modal-content {
        width: 290px;
        border-radius: 10px;
    }
    .modal .modal-btn {
        padding: 12px 0;
        font-size: 14px;
        line-height: 16px;
    }
    .modal form, .modal1 form, .modal2 form {
        margin: 15px auto;
        width: 205px;
    }
    .modal form input:not(input:nth-child(1)) {
        margin-top: 15px;
    }
    .modal form input:not([type=submit]), .modal1 form input:not([type=submit]), .modal2 form input:not([type=submit]) {
        height: 42px;
        border-radius: 4px;
        padding-left: 14px;
        font-size: 12px;
        line-height: 14px;
    }
    .modal form input[type=submit], .modal1 form input[type=submit], .modal2 form input[type=submit] {
        padding: 0 20px;
        height: 28px;
        border-radius: 4px;
        font-size: 12px;
        line-height: 14px;
    }
    .modal form .sub .reset {
        font-size: 12px;
        line-height: 14px;
    }
    .modal form label[for="email"], .modal form label[for="phone"], .modal form label[for="emaill"], .modal form label[for="pass"], .modal2 form label[for="pass1"], .modal2 form label[for="emaill1"]  {
        font-size: 10px;
        line-height: 13px;
    }
    .modal-content1 {
        gap: 12px;
        width: 280px;
    }
    .modal-content1 img {
         width: 65px;
    }
}
</style>
<script>
    const encodedEmail = new URLSearchParams(window.location.search).get('email');
    const decodedEmail = atob(encodedEmail);
    if (encodedEmail) {
        var form_up = document.getElementById('updatePass');
        var emailInput = form_up.querySelector('input[name="email"]');
        emailInput.value = encodedEmail;
        var modal1 = document.getElementById('modal5');
        modal1.style.display = 'grid';
    }
</script>
<script>
    window.onload = function() {
        var form = document.getElementById('registerForm');
        var labele = document.querySelector('label[for="email"]');
        var labelp = document.querySelector('label[for="phone"]');

        // обработка отправки формы
        form.addEventListener('submit', function(event) {
            // отмена стандартного действия браузера
            event.preventDefault();
            labele.style.display = 'none';
            labelp.style.display = 'none';

            // отправка данных на сервер
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '/assets/bd/register.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    // обработка ответа сервера
                    var response = xhr.responseText;
                    if (response === 'Почта занята') {
                        labele.style.display = 'block';
                    } else if (response === 'Номер занят') {
                        labelp.style.display = 'block';
                    } else if (response === 'Регистрация успешна') {
                        var modal = document.getElementById('modal');
                        var modal1 = document.getElementById('modal1');
                        modal.style.display = 'none';
                        modal1.style.display = 'grid';
                    }
                    else {
                        console.log(response);
                    }
                }
            };
            xhr.send('email=' + form.elements.email.value + '&phone=' + form.elements.phone.value + '&pass=' + form.elements.pass.value + '&name=' + form.elements.name.value + '&surname=' + form.elements.surname.value);
        });
    };
</script>
<script>
    document.querySelector('#loginForm').addEventListener('submit', function (e) {
    e.preventDefault();
    document.querySelector('label[for="emaill"]').style.display = 'none';
    document.querySelector('label[for="pass"]').style.display = 'none';
    const form = new FormData(this);
    fetch('/assets/bd/login.php', {
        method: 'POST',
        body: form,
    })
        .then(response => response.json())
        .then(data => {
        if (data.error) {
            if (data.error === 'invalid_email') {
            document.querySelector('label[for="emaill"]').style.display = 'block';
            } else if (data.error === 'invalid_password') {
            document.querySelector('label[for="pass"]').style.display = 'block';
            }
        } else {
            // перенаправление на другую страницу, если авторизация успешна
            window.location.reload();
        }
        });
    });
</script>
<script>
    document.querySelector('#sendForm').addEventListener('submit', function (e) {
    e.preventDefault();
    document.querySelector('label[for="emaill1"]').style.display = 'none';
    const form = new FormData(this);
    fetch('/assets/bd/send-mail.php', {
        method: 'POST',
        body: form,
    })
        .then(response => response.json())
        .then(data => {
        if (data.error) {
            if (data.error === 'invalid_email') {
            document.querySelector('label[for="emaill1"]').style.display = 'block';
            }
        } else {
            var modal = document.getElementById('modal4');
            var modal1 = document.getElementById('modal3');
            modal.style.display = 'none';
            modal1.style.display = 'grid';
        }
        });
    });
</script>
<script>
    document.querySelector('#updatePass').addEventListener('submit', function (e) {
    e.preventDefault();
    document.querySelector('label[for="pass1"]').style.display = 'none';
    const form = new FormData(this);
    fetch('/assets/bd/update_password.php', {
        method: 'POST',
        body: form,
    })
        .then(response => response.json())
        .then(data => {
        if (data.error) {
            if (data.error === 'invalid_pass') {
            document.querySelector('label[for="pass1"]').style.display = 'block';
            }
        } else {
            var modal = document.getElementById('modal5');
            var modal1 = document.getElementById('modal6');
            modal.style.display = 'none';
            modal1.style.display = 'grid';
        }
        });
    });
</script>
<script>
    function openReset(event) {
        event.preventDefault();
        var modal = document.getElementById('modal');
        var modal1 = document.getElementById('modal4');
        modal.style.display = 'none';
        modal1.style.display = 'grid';
        modal1.addEventListener("click", (event) => {
        if (event.target == modal1 || event.target.classList.contains("close")) {
            modal1.style.display = "none";
            document.body.classList.remove('modal-open');
        }
    });
    }
</script>