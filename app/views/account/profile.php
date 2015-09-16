{% extends 'templates/default.php' %}

{% block title %}Update Profile{% endblock %}

{% block content %}
<form action="{{ urlFor('account.profile.post') }}" method="post" autocomplete="off">
    <div class="form-group">
        <label for="user_email">Email address</label>
        <input type="email" class="form-control" id="user_email" placeholder="Email" name="user_email"
               value="{{ request.post('user_email') ? request.post('user_email') : auth.email }}">
        {% if errors.has('user_email') %} <p class="text-danger"> {{ errors.first('user_email') }} </p> {% endif %}
    </div>
    <div class="form-group">
        <label for="user_first_name">Firstname</label>
        <input type="text" class="form-control" id="user_first_name" placeholder="Firstname" name="user_first_name"
               value="{{ request.post('user_first_name') ? request.post('user_first_name') : auth.first_name }}">
        {% if errors.has('user_first_name') %} <p class="text-danger"> {{ errors.first('user_first_name') }} </p> {%
        endif %}
    </div>
    <div class="form-group">
        <label for="user_last_name">Lastname</label>
        <input type="text" class="form-control" id="user_last_name" placeholder="Lastname" name="user_last_name"
               value="{{ request.post('user_last_name') ? request.post('user_last_name') : auth.last_name }}">
        {% if errors.has('user_last_name') %} <p class="text-danger"> {{ errors.first('user_last_name') }} </p> {%
        endif %}
    </div>
    <div class="form-group">
        <label for="user_profile_picture">Profile picture</label>
        <input type="file" id="user_profile_picture" name="user_profile_picture">

        <p class="help-block">Please add your profile picture in PNG, JPG, or JPEG format.</p>
    </div>
    <div class="form-group">
        <input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
        <button type="submit" class="btn btn-success">Update Profile</button>
    </div>
</form>
{% endblock %}