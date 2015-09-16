{% extends 'templates/default.php' %}

{% block title %}All Users{% endblock %}

{% block content %}
<h2>All Users</h2>

{% if users is empty %}
<div class="alert alert-danger">
    <p>No registered users.</p>
</div>
{% else %}
<div class="container">
    <ul class="unlisted">
        {% for user in users %}
        <li><a href="{{ urlFor('user.profile', {username: user.username}) }}">{{ user.username }}</a>
            {% if user.getFullName %}
            ({{ user.getFullName }})
            {% endif %}
            {% if user.isAdmin %}
            (Administrator)
            {% endif %}
        </li>

        {% endfor %}
    </ul>
</div>
{% endif %}
{% endblock %}