{% extends 'templates/default.php' %}

{% block title %}Register{% endblock %}

{% block content %}
<h4>Registration Form</h4>
<form action="{{ urlFor('register.post') }}" method="post" autocomplete="off">

    <div class="form-group">
        <label for="user_name">Username</label>
        <input type="text" class="form-control" id="user_name" placeholder="Username" name="user_name" {% if
               request.post('user_name') %} value="{{ request.post('user_name')}}" {% endif %} >
        {% if errors.first('user_name') %} <p class="text-danger"> {{ errors.first('user_name') }} </p> {% endif %}
    </div>
    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" class="form-control" id="user_password" placeholder="Password" name="user_password" {% if
               request.post('user_password') %} value="{{ request.post('user_password')}}" {% endif %} >
        {% if errors.first('user_password') %} <p class="text-danger"> {{ errors.first('user_password') }} </p> {% endif
        %}
    </div>
    <div class="form-group">
        <label for="user_password_confirm">Confirm Password</label>
        <input type="password" class="form-control" id="user_password_confirm" placeholder="Confirm Password"
               name="user_password_confirm" {% if
               request.post('user_password_confirm') %} value="{{ request.post('user_password_confirm')}}" {% endif %} >
        {% if errors.first('user_password_confirm') %} <p class="text-danger"> {{ errors.first('user_password_confirm')
            }} </p> {% endif %}
    </div>
    <div class="form-group">
        <label for="user_email">Email address</label>
        <input type="email" class="form-control" id="user_email" placeholder="Email" name="user_email" {% if
               request.post('user_email') %} value="{{ request.post('user_email')}}" {% endif %}>
        {% if errors.first('user_email') %} <p class="text-danger"> {{ errors.first('user_email') }} </p> {% endif %}
    </div>
    <div class="form-group">
        <label for="user_first_name">Firstname</label>
        <input type="text" class="form-control" id="user_first_name" placeholder="Firstname" name="user_first_name" {%
               if request.post('user_first_name') %} value="{{ request.post('user_first_name')}}" {% endif %}>
        {% if errors.first('user_first_name') %} <p class="text-danger"> {{ errors.first('user_first_name') }} </p> {%
        endif %}
    </div>
    <div class="form-group">
        <label for="user_last_name">Lastname</label>
        <input type="text" class="form-control" id="user_last_name" placeholder="Lastname" name="user_last_name" {% if
               request.post('user_last_name') %} value="{{ request.post('user_last_name')}}" {% endif %}>
        {% if errors.first('user_last_name') %} <p class="text-danger"> {{ errors.first('user_last_name') }} </p> {%
        endif %}
    </div>
    <div class="form-group">
        <label for="user_profile_picture">Profile picture</label>
        <input type="file" id="user_profile_picture" name="user_profile_picture">

        <p class="help-block">Please add your profile picture in PNG, JPG, or JPEG format.</p>
    </div>

    <div class="form-group">
        <input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
        <button type="submit" class="btn btn-success">Register</button>
    </div>
</form>
{% endblock %}

