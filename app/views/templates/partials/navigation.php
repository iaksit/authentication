<div class="header clearfix">
    <nav>
        <ul class="nav nav-pills pull-right">
            <li role="presentation" class="active"><a href="{{ urlFor('home') }}">Home</a></li>
            <li role="presentation"><a href="{{ urlFor('user.all') }}">All Users</a></li>
            <li role="presentation"><a href="{{ urlFor('about') }}">About</a></li>
            <li role="presentation"><a href="{{ urlFor('contact') }}">Contact</a></li>

            {% if auth %}
            <li role="presentation"><a href="{{ urlFor('user.profile', {username: auth.username}) }}">Your Profile</a>
            </li>
            <li role="presentation"><a href="{{ urlFor('auth.password.change') }}">Change Password</a>
            </li>
            <li role="presentation"><a href="{{ urlFor('account.profile') }}">Update Profile</a>
            </li>

            {% if auth.isAdmin %}
            <li role="presentation"><a href="{{ urlFor('admin.example') }}">Admin Page</a>
            </li>
            {% endif %}

            <li role="presentation"><a href="{{ urlFor('logout') }}">Logout</a></li>
            {% else %}
            <li role="presentation"><a href="{{ urlFor('register') }}">Register</a></li>
            <li role="presentation"><a href="{{ urlFor('login') }}">Login</a></li>
            {% endif %}
        </ul>
    </nav>
    <h3 class="text-muted">iaksitCMS</h3>
</div>

{% if auth %}
<div class="alert alert-success">
    <img src="{{ auth.getAvatarUrl({size:100}) }}" class="profile-image img-circle" alt="Your Profile Picture">

    <p class="text-danger">Hello dear, {{ auth.getFullNameOrUsername }}</p>
</div>
{% endif %}