{% extends 'templates/default.php' %}

{% block title %}Recover Password{% endblock %}

{% block content %}
<h4>Change Password Form</h4>
<form action="{{ urlFor('auth.password.recover.post') }}" method="post" autocomplete="off">
    <div class="form-group">

        <label for="user_email">Enter you email address to recover</label>
        <input type="email" class="form-control" id="user_email" placeholder="Email" name="user_email" {% if
               request.post('user_email') %} value="{{ request.post('user_email')}}" {% endif %}>
        {% if errors.has('user_email') %} <p class="text-danger"> {{ errors.first('user_email') }} </p> {% endif %}
    </div>

    <div class="form-group">
        <input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
        <button type="submit" class="btn btn-danger">Recover</button>
    </div>
</form>
{% endblock %}

