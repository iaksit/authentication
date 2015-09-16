<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Website {% block title %}{% endblock %}</title>

    <!-- Latest compiled and minified CSS -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

    {% block stylesheets %}
    <link href="{{ baseUrl }}/ui/css/main.css" rel="stylesheet" type="text/css" media="all"/>
    {% endblock %}

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="container">

    {% include 'templates/partials/navigation.php' %}
    {% include 'templates/partials/messages.php' %}

    {% block content %}
    {% endblock %}

</div>
<!-- /container -->

<footer class="footer">
    <div class="container">
        <p class="text-muted">Designed by <a href="#" title="İbrahim AKŞİT">iaksit</a> &copy; 2015</p>
    </div>
</footer>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{{ baseUrl }}/ui/js/bootstrap.min.js"></script>
</body>
</html>