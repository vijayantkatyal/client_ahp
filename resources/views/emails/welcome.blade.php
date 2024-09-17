Hi, {{ $name }}.
<br><br>
<b>Welcome to AHP.</b>
<br><br>
Here is your login access.
<br><br>
Login URL: <a href="https://ahp.alphait.ca/login">https://ahp.alphait.ca/login</a>
<br><br>
Email: {{ $email }}
<br><br>
Verification Code: {{ $code }}
<br><br>
<a href="https://ahp.alphait.ca/verify?email={{ $email }}&code={{ $code }}">Verify Account</a>
