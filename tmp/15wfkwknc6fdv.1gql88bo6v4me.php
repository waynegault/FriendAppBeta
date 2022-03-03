<!--Sign design got from https://getbootstrap.com/docs/5.1/examples/sign-in/ by WG-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Login Page</title>
    <!-- Bootstrap core CSS  - updated by WG to the CDN link from https://getbootstrap.com/docs/5.1/getting-started/introduction/-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template - upodated by WG to point to our app/assets/css/signin.css file -->
    <link href="<?= ($BASE) ?>/app/assets/css/signin.css" rel="stylesheet">
</head>
<body>
<table style="margin-left:auto;margin-right:auto;" >
    <tbody>
    <tr>
        <td>
            <h1>For Demo Purposes Only</h1>
            <p>You can log in as either of the following:</p>
        </td>
    </tr>
    <tr>
        <td><table >
            <thead>
            <tr>
                <b>
                    <th>User</th>
                    <th>Password</th>
                </b>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><li>Mary999@hotmail.com</li>
                </td>
                <td>'Hello123'</td>
<!--                'Hello123'-->
            </tr>
            <tr>
                <td><li>James987@hotmail.com</li>
                </td>
                <td>'Hello123'</td>
            </tr>
            </tbody>
        </table>
            <br>
        </td>
    </tr>
    <tr>
        <td><form class ="form-signin" method="POST" action="authenticate">
            <h1>Please sign in</h1>
            <label for="email">Email address</label><br>
            <input id="email" name="email" required="" type="email" autofocus="" placeholder="name@example.com" /><br><br>
            <label for="password">Password</label><br>
            <input id="password" name="password" required="" type="password" autofocus="" placeholder="Password" /><br><br>
            <button style="align: right;" type="submit">Sign in</button>
        </form></td>
    </tr>
    <tr><td>
        <a href="<?= ($BASE) ?>/Register">New users sign up here</a>

    </td></tr>
    </tbody>

</table>
</body>
</html>
