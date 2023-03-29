<?php $this->view("eshop/header", $data);  ?>

<section id="form" style="margin-top: 5px;"><!--form-->
	<div class="container">
		<div class="row" style="text-align: center;">
			<div class="col-sm-4 col-sm-offset-1" style="float:none; display:inline-block">
				<div class="login-form"><!--login form-->
					<h2>Login to your account</h2>
					<span style="font-size: 16px; color:red;"><?php check_error(); ?></span>
					<form action="#" method="POST">
						<input type="email" value="<?= isset($_POST['email']) ? $_POST['email'] : "";?>" name="email" placeholder="Email Address" />
						<input type="password"  name="password" placeholder="Password" />						
						<span>
							<input type="checkbox" class="checkbox">
							Keep me signed in
						</span>
						<button type="submit" class="btn btn-default">Login</button>
					</form>
					<br>
					<span>
						Don't have an account yet? Signup <a href="<?= ROOT ?>signup">here</a>
					</span>
				</div><!--/login form-->
			</div>

		</div>
</section><!--/form-->


<?php $this->view("eshop/footer", $data);  ?>