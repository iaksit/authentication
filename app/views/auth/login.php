{% extends 'templates/default.php' %}

{% block title %}Login{% endblock %}

{% block content %}
<h4>Login Form</h4>
<form action="{{ urlFor('login.post') }}" method="post" autocomplete="off">
    <div class="form-group">
        <label for="user_identifier">Username/Email</label>
        <input type="text" class="form-control" id="user_identifier" placeholder="Username or email"
               name="user_identifier" {% if
               request.post('user_identifier') %} value="{{ request.post('user_identifier')}}" {% endif %} >
        {% if errors.first('user_identifier') %} <p class="text-danger"> {{ errors.first('user_identifier') }} </p> {%
        endif %}
    </div>

    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" class="form-control" id="user_password" placeholder="Password" name="user_password" {% if
               request.post('user_password') %} value="{{ request.post('user_password')}}" {% endif %} >
        {% if errors.first('user_password') %} <p class="text-danger"> {{ errors.first('user_password') }} </p> {% endif
        %}
    </div>

    <div class="form-group">
        <div class="checkbox">
            <label for="remember">
                <input type="checkbox" name="remember" id="remember"> Remember me
            </label>
        </div>
    </div>

    <div class="form-group">
        <a href="{{ urlFor('auth.password.recover') }}" title="Forgot your password?">Forgot your password?</a>
        <input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
        <button type="submit" class="btn btn-primary">Login</button>
    </div>
</form>
{% endblock %}

