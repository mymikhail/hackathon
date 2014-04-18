<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ContentApp</title>

    <link rel="stylesheet" href="/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/css/style.css" />

    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>

    <script src="/js/underscore.min.js"></script>
    <script src="/js/backbone.min.js"></script>

<!--    <link rel="stylesheet" href="/css/jquery.autocomplete.css"/>-->
<!--    <script src="/js/jquery.autocomplete.min.js"></script>-->

    <script src="/js/modules/content.module.js"></script>
    <script src="/js/modules/popup.module.js"></script>
    <script src="/js/modules/search.module.js"></script>
</head>
<body>

	<div class="welcome">		
		    <form class="form-horizontal" action="/" method="get">
			    <div class="control-group">
			    <label class="control-label" for="inputLogin">Login</label>
			    <div class="controls">
			    <input type="text" id="inputLogin" name="Login" placeholder="Login">
			    </div>
			    </div>
			    <div class="control-group">
			    <label class="control-label" for="inputPassword">Password</label>
			    <div class="controls">
			    <input type="password" id="inputPassword" name="Password" placeholder="Password">
			    </div>
			    </div>
			    <div class="control-group">
			    <div class="controls">
			    <button type="submit" class="btn">Sign in</button>
			    </div>
			    </div>
			</form>
	</div>
</body>
</html>
