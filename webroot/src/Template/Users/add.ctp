<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Add User') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('username');
            echo $this->Form->control('password');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

<!-- BEGIN LOGIN FORM -->
		<form class="login-form" action="index.html" method="post">
			<div class="form-title">
				<span class="form-title">Welcome.</span>
				<span class="form-subtitle">Please login.</span>
			</div>
			<div class="alert alert-danger display-hide">
				<button class="close" data-close="alert"></button>
				<span>
				Enter any username and password. </span>
			</div>
			<div class="form-group">
				<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
				<label class="control-label visible-ie8 visible-ie9">Username</label>
				<input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username"/>
			</div>
			<div class="form-group">
				<label class="control-label visible-ie8 visible-ie9">Password</label>
				<input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password"/>
			</div>
			<div class="form-actions">
				<button type="submit" class="btn btn-primary btn-block uppercase">Login</button>
			</div>
			<div class="form-actions">
				<div class="pull-left">
					<label class="rememberme check">
					<input type="checkbox" name="remember" value="1"/>Remember me </label>
				</div>
				<div class="pull-right forget-password-block">
					<a href="javascript:;" id="forget-password" class="forget-password">Forgot Password?</a>
				</div>
			</div>
			<div class="login-options">
				<h4 class="pull-left">Or login with</h4>
				<ul class="social-icons pull-right">
					<li>
						<a class="social-icon-color facebook" data-original-title="facebook" href="#"></a>
					</li>
					<li>
						<a class="social-icon-color twitter" data-original-title="Twitter" href="#"></a>
					</li>
					<li>
						<a class="social-icon-color googleplus" data-original-title="Goole Plus" href="#"></a>
					</li>
					<li>
						<a class="social-icon-color linkedin" data-original-title="Linkedin" href="#"></a>
					</li>
				</ul>
			</div>
			<div class="create-account">
				<p>
					<a href="javascript:;" id="register-btn">Create an account</a>
				</p>
			</div>
		</form>
		<!-- END LOGIN FORM -->
		<!-- BEGIN FORGOT PASSWORD FORM -->
		<form class="forget-form" action="index.html" method="post">
			<div class="form-title">
				<span class="form-title">Forget Password ?</span>
				<span class="form-subtitle">Enter your e-mail to reset it.</span>
			</div>
			<div class="form-group">
				<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email"/>
			</div>
			<div class="form-actions">
				<button type="button" id="back-btn" class="btn btn-default">Back</button>
				<button type="submit" class="btn btn-primary uppercase pull-right">Submit</button>
			</div>
		</form>
		<!-- END FORGOT PASSWORD FORM -->
		<!-- BEGIN REGISTRATION FORM -->
		<form class="register-form" action="index.html" method="post">
			<div class="form-title">
				<span class="form-title">Sign Up</span>
			</div>
			<p class="hint">
				 Enter your personal details below:
			</p>
			<div class="form-group">
				<label class="control-label visible-ie8 visible-ie9">Full Name</label>
				<input class="form-control placeholder-no-fix" type="text" placeholder="Full Name" name="fullname"/>
			</div>
			<div class="form-group">
				<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
				<label class="control-label visible-ie8 visible-ie9">Email</label>
				<input class="form-control placeholder-no-fix" type="text" placeholder="Email" name="email"/>
			</div>
			<div class="form-group">
				<label class="control-label visible-ie8 visible-ie9">Address</label>
				<input class="form-control placeholder-no-fix" type="text" placeholder="Address" name="address"/>
			</div>
			<div class="form-group">
				<label class="control-label visible-ie8 visible-ie9">City/Town</label>
				<input class="form-control placeholder-no-fix" type="text" placeholder="City/Town" name="city"/>
			</div>
			<div class="form-group">
				<label class="control-label visible-ie8 visible-ie9">Country</label>
				<select name="country" class="form-control">
					<option value="">Country</option>
					<option value="AF">Afghanistan</option>
					<option value="AL">Albania</option>
					<option value="DZ">Algeria</option>
				</select>
			</div>
			<p class="hint">
				 Enter your account details below:
			</p>
			<div class="form-group">
				<label class="control-label visible-ie8 visible-ie9">Username</label>
				<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username"/>
			</div>
			<div class="form-group">
				<label class="control-label visible-ie8 visible-ie9">Password</label>
				<input class="form-control placeholder-no-fix" type="password" autocomplete="off" id="register_password" placeholder="Password" name="password"/>
			</div>
			<div class="form-group">
				<label class="control-label visible-ie8 visible-ie9">Re-type Your Password</label>
				<input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Re-type Your Password" name="rpassword"/>
			</div>
			<div class="form-group margin-top-20 margin-bottom-20">
				<label class="check">
				<input type="checkbox" name="tnc"/>
				<span class="loginblue-font">I agree to the </span>
				<a href="#" class="loginblue-link">Terms of Service</a>
				<span class="loginblue-font">and</span>
				<a href="#" class="loginblue-link">Privacy Policy </a>
				</label>
				<div id="register_tnc_error">
				</div>
			</div>
			<div class="form-actions">
				<button type="button" id="register-back-btn" class="btn btn-default">Back</button>
				<button type="submit" id="register-submit-btn" class="btn btn-primary uppercase pull-right">Submit</button>
			</div>
		</form>
		<!-- END REGISTRATION FORM -->
