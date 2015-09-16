{% extends 'templates/default.php' %}

{% block title %}Reset Password{% endblock %}

{% block content %}
<h4>Reset Password Form</h4>
<form action="{{ urlFor('auth.password.reset.post') }}?email={{ email }}&identifier={{ identifier|url_encode }}"
      method="post" autocomplete="off">
    <div class="form-group">
        <label for="new_user_password">New Password</label>
        <input type="password" class="form-control" id="new_user_password" placeholder="New Password"
               name="new_user_password" {% if
               request.post('new_user_password') %} value="{{ request.post('new_user_password') }}" {% endif %} >
        {% if errors.has('new_user_password') %} <p class="text-danger"> {{ errors.first('new_user_password') }} </p> {%
        endif %}
    </div>

    <div class="form-group">
        <label for="new_user_password_confirm">Confirm Password</label>
        <input type="password" class="form-control" id="new_user_password_confirm" placeholder="Confirm Password"
               name="new_user_password_confirm" {% if
               request.post('new_user_password_confirm') %} value="{{ request.post('new_user_password_confirm') }}" {%
        endif %} >
        {% if errors.has('new_user_password_confirm') %} <p class="text-danger"> {{
            errors.first('new_user_password_confirm') }} </p> {% endif %}
    </div>

    <div class="form-group">
        <input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
        <button type="submit" class="btn btn-success">Reset</button>
    </div>
</form>
{% endblock %}

