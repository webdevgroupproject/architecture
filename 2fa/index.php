<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <div id="loginstatus">Not logged in</div>
    <div id="loginform">
    Code: <input type="text" id="googlecode" />
        <input type="submit" id="submit-googlecode" value="Submit" />
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $('input#submit-googlecode').on('click', function() {
            var googlecode = $('input#googlecode').val();
            if ($.trim(googlecode) != '') {
                $.post('ajax/check.php', {code: googlecode}, function(data) {
                    $('div#loginstatus').text(data);
                    if (data == 1) {
                        $('div#loginstatus').text('Logged in');
                        $('div#loginform').hide();
                    }else {
                        $('div#loginstatus').text('Login failed);
                    }
                });
            }
        });
    </script>
</body>
</html>