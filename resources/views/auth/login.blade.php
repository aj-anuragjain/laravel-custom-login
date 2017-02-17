Login to continue
<br/>
@if(!empty($errormsg))
    {{ $errormsg }}
@endif

<form action="/user/login" method="post">
    {{ csrf_field() }}
    <label>
        Email/Phone
        <input name="username" type="text" required="required" />
    </label>
    <label>
        <input name="password" type="password" required="required" />
    </label>
    <button type="submit">Login</button>
</form>