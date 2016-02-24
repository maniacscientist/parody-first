var goingTo;

function switchToLogin()
{
	var ride = document.getElementById("formForARide");
	ride.style.left = "calc(50% - 20px)";


	var login = document.getElementById("loginForm");
	var signup = document.getElementById("signupForm");

	login.style.opacity = 1;
	login.style.display = "block";
	signup.style.opacity = 0;
	goingTo = "login";
}

function switchToSignup()
{
	var ride = document.getElementById("formForARide");
	ride.style.left = "calc(50% - 460px + 20px)";


	var login = document.getElementById("loginForm");
	var signup = document.getElementById("signupForm");

	login.style.opacity = 0;
	signup.style.display = "block";
	signup.style.opacity = 1;
	goingTo = "signup";
}

function endOfTheLine()
{
	var login = document.getElementById("loginForm");
	var signup = document.getElementById("signupForm");
	if(goingTo=="login")
	{
		signup.style.display = "none";
	}

	if(goingTo=="signup")
	{
		login.style.display = "none";
	}
}



function setupEvents()
{
	document.getElementById("loginForm").addEventListener('transitionend', endOfTheLine);
	document.getElementById("signupForm").addEventListener('transitionend', endOfTheLine);
}

function loginCallback(code)
{
	if(code==0)
	{
		window.location = "index.php?page=attributes";
	}
	if(code==1)
	{
		showMessage();
	}
}

function loginAgain()
{
	window.location = "index.php";
}

function showMessage()
{
	var message = document.getElementById("message");
	message.style.display = "block";
}
function closeMessage()
{
	var message = document.getElementById("message");
	message.style.display = "none";
}

function Login()
{
	doAction("home/login", "message", "loginFormData", loginCallback);
}

function Signup()
{
	doAction("home/signup", "message", "signupFormData", showMessage);
}

function submitConnectionInfo()
{
	doAction("admin/finishDBCreation", null, "connectionInfo", function() { window.location = "admin.php" });
}

function saveAttributes()
{
	doAction("attributes/save", null, "userAttributes", function() { window.location.reload(); });
}