{% extends 'templates/default.php' %}

{% block title %}{{ user.getFullNameOrUsername }}{% endblock %}

{% block content %}
    <h2>{{ user.username }}</h2>
    <img src="{{ user.getAvatarUrl({size:120}) }}" class="profile-image img-circle" alt="Profile Picture for {{ user.username }}">
    <dl>
    {% if user.getFullName %}
        <dt>Fullname</dt>
        <dd>{{ user.getFullName }}</dd>
    {% endif %}
        <dt>Email</dt>
        <dd>{{ user.email }}</dd>
    </dl>
{% endblock %}