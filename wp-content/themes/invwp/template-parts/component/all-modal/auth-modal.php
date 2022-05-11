<!--<p><button data-target="login-modal" data-toggle="modal" class="btn btn-default">A Basic Modal</button></p>-->
<!-- Basic modal with title -->
<div id="login-modal" class="modal">
    <div class="modal-window large">
		<span class="close" data-dismiss="modal">&times;</span>
        <!--<h3>A Basic Modal with Title</h3>-->
		<div>
			<!--<p>This is a modal window. You can do the following things with it:</p>
			<ul>
				<li><strong>Read:</strong> modal windows will probably tell you something important so don't forget to read what they say.</li>
				<li><strong>Look:</strong> a modal window enjoys a certain kind of attention; just look at it and appreciate its presence.</li>
				<li><strong>Close:</strong> click on the button below to close the modal.</li>
			</ul>-->
			<div class="simple-tabs">

			  <div class="tabs mb-5 text-center">
				<button class="tablinks" onclick="openTab(event, 'tab-content-login')" id="defaultOpenTab">LOGIN</button>
				<button class="tablinks" onclick="openTab(event, 'tab-content-register')">REGISTER</button>
			  </div>
			  <!--<p class="subtitle">Login to your account</p>-->

			  <div id="tab-content-login" class="tabcontent">
				<?php wc_get_template ('myaccount/custom-login-form.php'); ?>
			  </div>

			  <div id="tab-content-register" class="tabcontent">
				<?php wc_get_template ('myaccount/custom-registration-form.php'); ?>
			  </div>
			</div>
			<!--<button data-dismiss="modal">Close</button>-->
		</div>
		
    </div>
</div>
