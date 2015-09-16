{% extends 'templates/default.php' %}

{% block title %}Change Password{% endblock %}

{% block content %}
<h4>Change Password Form</h4>
<form action="{{ urlFor('auth.password.change.post') }}" method="post" autocomplete="off">
    <div class="form-group">
        <label for="old_user_password">Old Password</label>
        <input type="password" class="form-control" id="old_user_password" placeholder="Old Password"
               name="old_user_password" {% if
               request.post('old_user_password') %} value="{{ request.post('old_user_password') }}" {% endif %} >
        {% if errors.has('old_user_password') %} <p class="text-danger"> {{ errors.first('old_user_password') }} </p> {% endif %}
    </div>
    <div class="form-group">
        <label for="new_user_password">New Password</label>
        <input type="password" class="form-control" id="new_user_password" placeholder="New Password"
               name="new_user_password" {% if
               request.post('new_user_password') %} value="{{ request.post('new_user_password') }}" {% endif %} >
        {% if errors.has('new_user_password') %} <p class="text-danger"> {{ errors.first('new_user_password') }} </p> {% endif %}
    </div>

    <div class="form-group">
        <label for="new_user_password_confirm">Confirm Password</label>
        <input type="password" class="form-control" id="new_user_password_confirm" placeholder="Confirm Password"
               name="new_user_password_confirm" {% if
               request.post('new_user_password_confirm') %} value="{{ request.post('new_user_password_confirm') }}" {%
        endif %} >
        {% if errors.has('new_user_password_confirm') %} <p class="text-danger"> {{ errors.first('new_user_password_confirm') }} </p> {% endif %}
    </div>

    <div class="form-group">
        <input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
        <button type="submit" class="btn btn-success">Change</button>
    </div>
</form>
{% endblock %}

