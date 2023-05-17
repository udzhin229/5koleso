const anim = document.querySelectorAll('.anim-pl');
const anim_l = document.querySelectorAll('.anim-left');
const anim_r = document.querySelectorAll('.anim-right');

function showBoxes() {
  anim.forEach(box => {
    const boxPosition = box.getBoundingClientRect().top;
    const windowHeight = window.innerHeight;
    if (boxPosition < windowHeight) {
      box.classList.add('show');
    }
  });
}
function showLeft() {
  anim_l.forEach(box => {
    const boxPosition = box.getBoundingClientRect().top;
    const windowHeight = window.innerHeight;
    if (boxPosition < windowHeight) {
      box.classList.add('show');
    }
  });
}
function showright() {
  anim_r.forEach(box => {
    const boxPosition = box.getBoundingClientRect().top;
    const windowHeight = window.innerHeight;
    if (boxPosition < windowHeight) {
      box.classList.add('show');
    }
  });
}

window.addEventListener('scroll', () => {
  showBoxes();
  showLeft();
  showright();
});
window.addEventListener('load', () => {
  showBoxes();
  showLeft();
  showright();
});

$(document).ready(function() {
  $('#send_form').submit(function(event) {
      // Отменяем стандартное поведение формы
      event.preventDefault();

      // Получаем данные формы
      var formData = $('#send_form').serialize();

      // Отправляем данные формы на сервер
      $.ajax({
          type: 'POST',
          url: '/assets/bd/send-form.php', // URL-адрес обработчика на сервере
          data: formData,
          success: function(response) {
              var modal2 = document.getElementById('modal2');
              modal2.style.display = 'grid';
          },
          error: function() {
              // Обработка ошибок
              alert('Ошибка при отправке сообщения!');
          }
      });
  });
});

//Скролл до якорей
$("[data-scroll]").on("click", function() {
  $("#burger").removeClass("active");
  $("#burger1").removeClass("active");
  $("#head_mob").removeClass("active");
  $('body').removeClass('modal-open');
  var blockId = $(this).data('scroll'),
      blockOffset = $(blockId).offset().top;

  $("html, body").animate({
      scrollTop: blockOffset
  }, 1000);
});

//Смена языка
function setLang(lang) {
    document.cookie = 'lang=' + lang + '; path=/';
    location.reload();
}

// Получение элементов
const modal = document.getElementById("modal");
const registerBtn = document.getElementById("register-btn");
const loginHeader = document.getElementById("loginBtn");
const registerHeader = document.getElementById("registerBtn");
const loginForm = document.getElementById("loginForm");
const registerForm = document.getElementById("registerForm");

if (registerBtn) {
    registerBtn.addEventListener("click", () => {
        modal.style.display = "grid";
        registerHeader.classList.add("active");
        loginHeader.classList.remove("active");
        registerForm.style.display = "flex";
        loginForm.style.display = "none";
        document.body.classList.add('modal-open');
    });
}

// Переключение между формами
loginHeader.onclick = function() {
    loginHeader.classList.add("active");
    registerHeader.classList.remove("active");
    loginForm.style.display = "flex";
    registerForm.style.display = "none";
}
registerHeader.onclick = function() {
    registerHeader.classList.add("active");
    loginHeader.classList.remove("active");
    registerForm.style.display = "flex";
    loginForm.style.display = "none";
}
// Закрытие модального окна
modal.addEventListener("click", (event) => {
    if (event.target == modal || event.target.classList.contains("close")) {
        modal.style.display = "none";
        document.body.classList.remove('modal-open');
    }
});

document.addEventListener('DOMContentLoaded', function() {
    showCartItemCount();
});

function showCartItemCount() {
    var cart = JSON.parse(localStorage.getItem('cart')) || {};
    var itemCount = 0;
    
    for (var itemId in cart) {
      if (cart.hasOwnProperty(itemId)) {
        itemCount += cart[itemId].quantity;
      }
    }
    var cartItemCountElementCl = document.getElementById('ctc');
    if (itemCount > 0) {
        if (cartItemCountElementCl) {
            cartItemCountElementCl.style.display = 'grid';
            cartItemCountElementCl.innerText = itemCount;
        }      
    } else {
        if (cartItemCountElementCl) {
          cartItemCountElementCl.style.display = 'none';
          cartItemCountElementCl.innerText = '';
        }
        
    }
}
function showCart() {
    var cart = JSON.parse(localStorage.getItem('cart')) || {};
    var cartHtml = '';
    
    for (var itemId in cart) {
      if (cart.hasOwnProperty(itemId)) {
        var cartItem = cart[itemId];
        cartHtml += '<div class="cart-item" id="cart-item'+itemId+'">';
        cartHtml += '<div class="left-cart">';
        cartHtml += '<div class="cross" onclick="removeItem(\'' + itemId + '\')">+</div>'
        cartHtml += '<div class="image">';
        cartHtml += '<img src="data:image/jpeg;base64,'+cartItem.img1+'" alt="' + cartItem.marka + '">';
        cartHtml += '</div>'
        cartHtml += '<div class="cart-item-title">'+cartItem.name+' '+(cartItem.l_c ? '(' + cartItem.l_c + ')' : '')+' '+(cartItem.wd ? '(' + cartItem.wd + ' / ' : '')+''+(cartItem.pr ? cartItem.pr + ' / ' : '')+''+(cartItem.r_s ? cartItem.r_s + ')' : '')+' '+ cartItem.marka +' '+ cartItem.model +' '+(cartItem.gen ? cartItem.gen + ' ' : '')+''+(cartItem.year ? cartItem.year + '-' : '')+''+cartItem.radius+'</div>';
        cartHtml += '<div class="cart-item-quantity">';
        cartHtml += '<button onclick="changeQuantity(\'' + itemId + '\', -1)">-</button>';
        cartHtml += '<div class="quantity">'+cartItem.quantity+'</div>';
        cartHtml += '<button onclick="changeQuantity(\'' + itemId + '\', 1)">+</button>';
        cartHtml += '</div>';
        cartHtml += '</div>';
        cartHtml += '<div class="cart-item-price">' + cartItem.price + ' грн</div>';
        cartHtml += '</div>';
      }
    }
    
    var cartItemsContainer = document.getElementById('cart-items-container');
    if (Object.keys(cart).length === 0) {
      cartItemsContainer.innerHTML = '<span style="text-align: center; font-family: var(--font-roboto); font-size: 20px;">Пусто</span>';
    } else {
      cartItemsContainer.innerHTML = cartHtml;
    }
    
    var cartModal = document.getElementById('cart-modal');
    cartModal.style.display = 'grid';
    updateTotal();
    showCartItemCount();
    document.body.classList.add('modal-open');
}
function changeQuantity(itemId, delta) {
    var cart = JSON.parse(localStorage.getItem('cart')) || {};
    var cartItem = cart[itemId];
    cartItem.quantity += delta;
    if (cartItem.quantity === 0) {
        delete cart[itemId]; // Remove the item from the cart
      }
    localStorage.setItem('cart', JSON.stringify(cart));
    showCart();
}
function removeItem(itemId) {
    var cart = JSON.parse(localStorage.getItem('cart')) || {};
    delete cart[itemId];
    localStorage.setItem('cart', JSON.stringify(cart));
    var cartItemEl = document.getElementById('cart-item-' + itemId);
    if (cartItemEl) {
        cartItemEl.remove();
    }
    showCart();
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
    var totalEl = document.getElementById('cart-items-total');
    if (totalEl) {
      totalEl.innerHTML = total;
    }
}
function addCart(itemId, price) {
  var selectElement = document.getElementById(`l_c_${itemId}`);
  if (selectElement) {
    var selectedOption_l = selectElement.options[selectElement.selectedIndex];
    var l_c = selectedOption_l.getAttribute('data-value');
  }
  var rim_s = document.getElementById(`r_s_${itemId}`);
  if (rim_s) {
    var selectedOption_r = rim_s.options[rim_s.selectedIndex];
    var r_s = selectedOption_r.getAttribute('data-value');
  }
  var prof = document.getElementById(`pr_${itemId}`);
  if (prof) {
    var selectedOption_p = prof.options[prof.selectedIndex];
    var pr = selectedOption_p.getAttribute('data-value');
  }
  var whid = document.getElementById(`wd_${itemId}`);
  if (whid) {
    var selectedOption_w = whid.options[whid.selectedIndex];
    var wd = selectedOption_w.getAttribute('data-value');
  }
  // получаем текущее состояние корзины из localStorage
  var cart = JSON.parse(localStorage.getItem('cart')) || {};
  var piec = document.getElementById('piec');
  if (piec === null) {
    piec = 1;
  } else {
    piec = piec.value;
  }
// проверяем, есть ли товар в корзине, и увеличиваем его количество, если да
var cartItemFound = false;
for (var existingItemId in cart) {
  if (cart.hasOwnProperty(existingItemId)) {
    var existingCartItem = cart[existingItemId];
    if (l_c) {
      if (existingItemId == (itemId + '_' + l_c) && existingCartItem.r_s == r_s && existingCartItem.pr == pr && existingCartItem.wd == wd) {
        existingCartItem.quantity += parseInt(piec);
        localStorage.setItem('cart', JSON.stringify(cart));
        showCart();
        cartItemFound = true;
        break;
      }
    } else if (r_s && pr && wd) {
        if (existingItemId == (itemId + '_' + r_s + '_' + pr + '_' + wd)) {
          existingCartItem.quantity += parseInt(piec);
          localStorage.setItem('cart', JSON.stringify(cart));
          showCart();
          cartItemFound = true;
          break;
      }
    }
    else {
      if (existingItemId == itemId) {
        existingCartItem.quantity += parseInt(piec);
        localStorage.setItem('cart', JSON.stringify(cart));
        showCart();
        cartItemFound = true;
        break;
    }
    }
  }
}
  // если товара с таким l_c нет в корзине, добавляем новый товар
  if (!cartItemFound) {
    showPreloader();
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '/assets/bd/get_product.php');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {
      hidePreloader();
      if (xhr.status === 200) {
        var product = JSON.parse(xhr.responseText);
        // get the selected language from the title element
        var lang = document.getElementById('title_cart').getAttribute('data-lang');
        // get the product name based on the selected language
        var name;
        if (lang == 'ru' && product.name_ru) {
          name = product.name_ru;
        } else {
          name = product.name;
        }
        if (l_c) {
          cart[itemId + '_' + l_c] = {
            quantity: parseInt(piec),
            name: name,
            l_c: l_c,
            marka: product.marka,
            model: product.model,
            gen: product.gen,
            year: product.year,
            radius: product.radius,
            price: price,
            img1: product.img1,
            r_s: r_s,
            pr: pr,
            wd: wd
          }
        }
        else if (r_s && pr && wd) {
          cart[itemId + '_' + r_s + '_' + pr + '_' + wd] = {
            quantity: parseInt(piec),
            name: name,
            l_c: l_c,
            marka: product.marka,
            model: product.model,
            gen: product.gen,
            year: product.year,
            radius: product.radius,
            price: price,
            img1: product.img1,
            r_s: r_s,
            pr: pr,
            wd: wd
          }
        }
        else {
          cart[itemId] = {
            quantity: parseInt(piec),
            name: name,
            l_c: l_c,
            marka: product.marka,
            model: product.model,
            gen: product.gen,
            year: product.year,
            radius: product.radius,
            price: price,
            img1: product.img1,
            r_s: r_s,
            pr: pr,
            wd: wd
          }
        }
        // сохраняем обновленное состояние корзины в localStorage
        localStorage.setItem('cart', JSON.stringify(cart));
        // отображаем модальное окно корзины
        showCart();
      } else {
        console.error('Ошибка получения данных о товаре');
      }
    };

    // передаем идентификатор товара в теле запроса
    var data = 'id=' + encodeURIComponent(itemId) + '&r_s=' + encodeURIComponent(r_s) + '&pr=' + encodeURIComponent(pr) + '&wd=' + encodeURIComponent(wd);
    xhr.send(data);
  }
}
function showPreloader() {
  var preloader = document.getElementById('preloader');
  preloader.style.display = 'grid';
}

function hidePreloader() {
  var preloader = document.getElementById('preloader');
  preloader.style.display = 'none';
}

// function addCart(itemId) {
//   var l_c = document.getElementById('l_c').value;
//   // получаем текущее состояние корзины из localStorage
//   var cart = JSON.parse(localStorage.getItem('cart')) || {};
//   var piec = document.getElementById('piec');
//   if (piec === null) {
//     piec = 1;
//   } else {
//     piec = piec.value;
//   }

//   var isItemAlreadyInCart = false;
//   // проверяем, есть ли товар с таким же значением l_c в корзине
//   for (var cartItemId in cart) {
//     if (cart.hasOwnProperty(cartItemId)) {
//       var cartItem = cart[cartItemId];
//       if (cartItem.l_c === l_c) {
//         // если товар с таким же значением l_c уже есть в корзине, увеличиваем его количество
//         cartItem.quantity += parseInt(piec);
//         isItemAlreadyInCart = true;
//         break;
//       }
//     }
//   }

//   if (!isItemAlreadyInCart) {
//     // добавляем новый товар в корзину
//     var xhr = new XMLHttpRequest();
//     xhr.open('POST', '/assets/bd/get_product.php');
//     xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

//     xhr.onload = function() {
//       if (xhr.status === 200) {
//         var product = JSON.parse(xhr.responseText);
//         cart[itemId] = {
//           quantity: parseInt(piec),
//           name: product.name,
//           l_c: l_c,
//           marka: product.marka,
//           model: product.model,
//           gen: product.gen,
//           year: product.year,
//           radius: product.radius,
//           price: product.price,
//           img1: product.img1
//         };

//         // сохраняем обновленное состояние корзины в localStorage
//         localStorage.setItem('cart', JSON.stringify(cart));

//         // отображаем модальное окно корзины
//         showCart();
//       } else {
//         console.error('Ошибка получения данных о товаре');
//       }
//     };

//     // передаем идентификатор товара в теле запроса
//     var data = 'id=' + encodeURIComponent(itemId);
//     xhr.send(data);
//   } else {
//     // сохраняем обновленное состояние корзины в localStorage
//     localStorage.setItem('cart', JSON.stringify(cart));

//     // отображаем модальное окно корзины
//     showCart();
//   }
// }