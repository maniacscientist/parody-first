
	<div id="backDrop">

		<div class="proposal">

			<p class="proposalHeader">Don't have an account?</p>

			<hr class="proposalHR"/>

			<p class="proposalBody">
			Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec a diam lectus.
			Sed sit amet ipsum mauris. Donec et mollis dolor
			</p>

			<div class="switcherButton" onclick="switchToSignup()">Sing Up</div>

		</div>

		<div class="proposal">

			<p class="proposalHeader">Have an account?</p>

			<hr class="proposalHR"/>

			<p class="proposalBody">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>

			<div class="switcherButton" onclick="switchToLogin()">Login</div>

		</div>

	</div>

	<div id="formForARide">

		<div class="formPlaceholder">
		<div id="loginForm" class="formContent">

			<p class="proposalHeader">Login</p>

			<hr class="proposalHR"/>

			<form action="" id="loginFormData" name="loginFormData" method="post">
				<input class="uberField" name="email" type="email" placeholder="Email"/>
				<input class="uberField" name="password" type="password" placeholder="Password"/>
			</form>

			<div class="smallSpacer"></div>
			<div class="actionButton" onclick="Login()">Login</div>

			<div class="sideButton">Forgot?</div>

		</div>
		</div>

		<div class="formPlaceholder">
		<div id="signupForm" class="formContent" style="display: none; opacity: 0">

			<p class="proposalHeader">Sign up</p>

			<hr class="proposalHR"/>

			<form action="" id="signupFormData" name="signupFormData" method="post">
				<input class="uberField" name="name" placeholder="Name"/>
				<input class="uberField" name="email" type="email" placeholder="Email"/>
				<input class="uberField" name="password" type="password" placeholder="Password"/>
			</form>

			<div class="smallSpacer"></div>
			<div class="actionButton" onclick="Signup()">Sign up</div>

			<div class="sideButton">Forgot?</div>

		</div>
		</div>

	</div>

	<div class="message" id="message"></div>
