<aside id="offcanvas-sidepanel" class="sidepanel">
  <a href="javascript:void(0)" class="closebtn" id="offcanvas-closebtn" >×</a>
  <div class="custom-cart">
      <div class="d-flex cart-header">
        <h2 class="cart-title">Shopping Bag <span>(<?php echo WC()->cart->get_cart_contents_count() ?>)</span></h2>
        <a href="javascript:void(0)" class="closebtn" onclick="closeSidePanel()">&times;</a>
      </div>
      <div class="mini-cart-contents" id="mini-cart-content">
            <?php woocommerce_mini_cart(); ?>
        </div>
    </div>
</aside>

<!--<button class="openbtn" onclick="openSidePanel()">Sidepanel</button>-->
