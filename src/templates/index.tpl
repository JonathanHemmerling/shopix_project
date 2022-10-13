<html>
<head>
    <title>Info</title>
</head>
<body>

<pre>
User Information:

Name: {$name|capitalize}
Address: {$address|escape}
Date: {$smarty.now|date_format: "%b %e, %Y"}
</pre>

</body>
</html>