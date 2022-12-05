{include file="./header.tpl"}
    <style type="text/css">{literal}
        .error {
            color: red;
            font-size: large;
        }{/literal}</style>
    <div class="error">
<pre>
{foreach from=$errors item=p}
{$p}
{/foreach}
</pre>
</div>
<div class="changeUserForm">
<h3>Change Userdata</h3>
<form action="/index.php?pageb=ChangeUser" method="post">
<label>
Username: <br />
<input type="text" name="userName" value=""/>
<br/>
<br/>
    First Name: <br />
    <input type="text" name="firstName" value=""/>
    <br/>
    <br/>
    Last Name: <br />
    <input type="text" name="lastName" value=""/>
    <br/>
    <br/>
    Country: <br />
    <input type="text" name="country" value=""/>
    <br/>
    <br/>
    Postcode: <br />
    <input type="text" name="postCode" value=""/>
    <br/>
    <br/>
    City: <br />
    <input type="text" name="city" value=""/>
    <br/>
    <br/>
    Street: <br />
    <input type="text" name="street" value=""/>
    <br/>
    <br/>
    Streetnumber: <br />
    <input type="text" name="streetNumber" value=""/>
    <br/>
    <br/>
    E-Mailadress: <br />
    <input type="text" name="email" value=""/>
    <br/>
    <br/>
    Telefonnumber: <br />
    <input type="text" name="telefonNumber" value=""/>
    <br/>
    <br/>
Password: <br />
<input type="password" name="password" value=""/>
<br />
<br />
Repeat Password: <br />
<input type="password" name="confirmPassword" value=""/>
<br />
<br />
<input type="submit" name="submit" value="Submit">
<br />
</label>
</form>
</div>
<div class="backToLogin">
    <br />
    {foreach from=$home item=q}
        {$q}
    {/foreach}
</div>