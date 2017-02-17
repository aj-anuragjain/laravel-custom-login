<!Doctype html>
<html>
<head></head>
<body>

    <h1>Login</h1>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action={{ url("/user/register") }} method="post">
        {{ csrf_field() }}
        <label>
            Name
            <input name="name" type="text" required="required"/>
        </label>
        <label>
            Email
            <input name="email" type="email" required="required"/>
        </label>
        <label>
            Phone
            <input name="phone" type="text" required="required" />
        </label>
        <label>
            Password
            <input name="password" type="password" required="required" />
        </label>
        <label>
            Confirm Password
            <input name="password_confirmation" type="password" required="required"/>
        </label>
        <button type="submit">Register</button>
    </form>
</body>
</html>