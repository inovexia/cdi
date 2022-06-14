<div id="minicart-nav" class="minicart">
    <div class="custom-cart">
      <div class="d-flex cart-header">
        <h2 class="cart-title">Shopping Bag </h2>
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
      </div>
      <div class="mini-cart-content" id="mini-cart-content">
            <?php woocommerce_mini_cart(); ?>
      </div>
    </div>
</div>
