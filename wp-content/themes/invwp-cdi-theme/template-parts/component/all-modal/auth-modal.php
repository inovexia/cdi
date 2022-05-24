<div id="login-modal" class="modal ">
  <div class="modal-window login-modal">
      <div class="modal-header">
		    <span class="modal-close" data-dismiss="modal">&times;</span>
      </div>
      <div class="modal-body">
        <div class="simple-tabs">

          <div class="tabs">
            <button class="tablinks" onclick="openTab(event, 'tab-content-login')" id="defaultOpenTab">LOGIN</button>
            <button class="tablinks" onclick="openTab(event, 'tab-content-register')">REGISTER</button>
          </div>
          <p class="subtitle">Login to your account</p>

          <div id="tab-content-login" class="tabcontent">
            <?php wc_get_template ('myaccount/custom-login-form.php'); ?>
          </div>

          <div id="tab-content-register" class="tabcontent">
            <?php wc_get_template ('myaccount/custom-registration-form.php'); ?>
          </div>
        </div>
  		</div>
  </div>
</div>
