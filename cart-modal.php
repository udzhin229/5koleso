<div class="cart-modal" id="cart-modal">
  <div class="modal-content">
    <div class="header"><?php echo $translation['cart-m1']?></div>
    <div id="cart-items-container"></div>
    <div class="cart-items-total"><?php echo $translation['cart-m2']?> <span id="cart-items-total"></span> грн</div>
    <div class="cart-buttons">
      <a id="close" href="#"><?php echo $translation['cart-m3']?></a>
      <a href="/cart.php"><?php echo $translation['cart-m4']?></a>
    </div>
  </div>
</div>
<style>
.cart-modal {
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
.cart-modal .modal-content {
    padding: 30px 20px 30px 26px;
    overflow: hidden;
    width: 640px;
    background: #FFFFFF;
    border-radius: 15px;
    position: relative;
    cursor: default;
    display: flex;
    flex-direction: column;
  }
.cart-modal .modal-content .header {
    font-family: var(--font-roboto);
    font-style: normal;
    font-weight: 600;
    font-size: 30px;
    line-height: 35px;
    color: #212121;
}
.cart-modal .modal-content #cart-items-container {
  margin: 24px 0 45px;
  display: flex;
  flex-direction: column;
  gap: 25px;
  max-height: 230px;
  overflow-y: scroll;
  overflow-x: hidden;
  padding-right: 10px;
}
.cart-modal .modal-content .cart-item {
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.cart-modal .modal-content .cart-item .left-cart {
    display: flex; 
    align-items: center; 
    width: 100%;
    max-width: 438px;
  }
.cart-modal .modal-content .cart-item .cross {
  cursor: pointer;
  transform: rotate(-45deg);
  align-self: flex-start;
  font-family: var(--font-roboto);
  font-style: normal;
  font-weight: 400;
  font-size: 20px;
  color: #212121;
  margin-right: 10px;
}
.cart-modal .modal-content .cart-item .image {
  width: 98px;
  height: 98px;
  border: 1px solid #212121;
  border-radius: 7px;
  overflow: hidden;
  display: grid;
  place-items: center;
}
.cart-modal .modal-content .cart-item .image > img {
  width: 100%;
}
.cart-modal .modal-content .cart-item .cart-item-quantity {
  width: 89px;
  height: 30px;
  background: #FFFFFF;
  border: 1px solid #212121;
  border-radius: 5px;
  display: flex;
  align-items: center;
}
.cart-modal .modal-content .cart-item .cart-item-quantity > button {
  border: none;
  outline: none;
  cursor: pointer;
  background: transparent;
  font-family: var(--font-roboto);
  font-style: normal;
  font-weight: 400;
  font-size: 20px;
  line-height: 130%;
  color: #212121;
  width: 33.3%;
  padding: 0;
}
.cart-modal .modal-content .cart-item .cart-item-quantity > .quantity {
  border-left: 1px solid #212121;
  border-right: 1px solid #212121;
  font-family: var(--font-roboto);
  font-style: normal;
  font-weight: 400;
  font-size: 20px;
  line-height: 130%;
  color: #212121;
  width: 33.3%;
  text-align: center;
}
.cart-modal .modal-content .cart-item .cart-item-title {
  font-family: var(--font-roboto);
  font-style: normal;
  font-weight: 400;
  font-size: 20px;
  line-height: 130%;
  color: #212121;
  max-width: 190px;
  margin: 0 15px 0 25px;
  width: 100%;
}
.cart-modal .modal-content .cart-item .cart-item-price {
  font-family: var(--font-roboto);
  font-style: normal;
  font-weight: 400;
  font-size: 20px;
  line-height: 130%;
  color: #212121;
}
.cart-modal .modal-content .cart-items-total {
  align-self: flex-end;
  font-family: var(--font-roboto);
  font-style: normal;
  font-weight: 600;
  font-size: 30px;
  line-height: 35px;
  text-align: right;
  color: #212121;
}
.cart-modal .modal-content .cart-buttons {
  margin-top: 15px;
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.cart-modal .modal-content .cart-buttons a {
  text-decoration: none;
  border-radius: 4px;
  border: 1px solid #FF455B;
  background: transparent;
  width: 100%;
  max-width: 220px;
  padding: 9px;
  font-family: var(--font-roboto);
  font-style: normal;
  font-weight: 400;
  font-size: 16px;
  line-height: 130%;
  color: #212121;
  text-align: center;
}
.cart-modal .modal-content .cart-buttons a:last-child {
  background: linear-gradient(180deg, #FF455B 0%, #D51E34 100%);
  color: #FFFFFF;
}
@media (max-width: 1200px) {
  .cart-modal .modal-content {
    width: 600px;
  }
  
}
@media (max-width: 600px) {
  .cart-modal .modal-content {
    padding: 15px;
    width: 290px;
    border-radius: 7px;
  }
  .cart-modal .modal-content .header {
    font-size: 15px;
    line-height: 18px;
  }
  .cart-modal .modal-content #cart-items-container {
    margin: 15px 0 10px;
    gap: 12px;
    max-height: 210px;
    padding-right: 10px;
  }
  .cart-modal .modal-content .cart-items-total {
    font-size: 15px;
    line-height: 18px;
  }
  .cart-modal .modal-content .cart-buttons {
    flex-direction: column-reverse;
    gap: 10px;
    justify-content: unset;
    margin-top: 10px;
  }
  .cart-modal .modal-content .cart-buttons a {
    border-radius: 4px;
    max-width: 138px;
    padding: 5px 0;
    font-size: 10px;
  }
  .cart-modal .modal-content .cart-buttons a:last-child {
    border-radius: 4px;
    max-width: 210px;
    padding: 9px 0;
    font-size: 16px;
  }
  .cart-modal .modal-content .cart-item .left-cart {
    max-width: 180px;
  }
  .cart-modal .modal-content .cart-item .cross {
    font-size: 14px;
    margin-right: 4px;
  }
  .cart-modal .modal-content .cart-item .image {
    width: 44px;
    height: 44px;
  }
  .cart-modal .modal-content .cart-item .cart-item-title {
    width: 100%;
    font-size: 9px;
    max-width: 80px;
    margin: 0 0 0 5px;
  }
  .cart-modal .modal-content .cart-item .cart-item-quantity {
    width: 40px;
    height: 13px;
  }
  .cart-modal .modal-content .cart-item .cart-item-quantity > .quantity {
    font-size: 9px;
  }
  .cart-modal .modal-content .cart-item .cart-item-quantity > button {
    font-size: 9px;
  }
  .cart-modal .modal-content .cart-item .cart-item-price {
    font-size: 12px;
  }
}
</style>
<script>
  const cart_modal = document.getElementById('cart-modal');
  const close = document.getElementById('close');
    cart_modal.addEventListener("click", (event) => {
        if (event.target == cart_modal || event.target.classList.contains("close")) {
            cart_modal.style.display = "none";
            document.body.classList.remove('modal-open');
        }
    });
    close.addEventListener("click", (event) => {
      event.preventDefault();
        cart_modal.style.display = "none";
        document.body.classList.remove('modal-open');
    });
</script>