{% extends 'email/templates/default.php' %}

{% block content %}
<p>You have requested your password change!</p>
<p>Click this link to reset your password : {{ baseUrl }}{{ urlFor('auth.password.reset') }}?email={{ user.email }}&identifier={{ identifier|url_encode }}</p>
{% endblock %}