<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    

    <div align='center'>
        <div>
            <div style="background-color: rgb(209, 206, 206); padding:10px; border-radius:5px; border:none; display:inline-block;">
                <div style="padding: 10px;">
                    <div style="">
                        <h2>Welcome to OVMS</h2>
                    </div>
                    <div style="">
                        <h5>Verify your account inorder to login</h5>
                    </div>
                </div>
                <div>
                    <div>
                        @if (isset($link)||isset($code)||isse($email))
                        <a href={{$link."/verifyUser?site=OVMS&code=".$code."&mail=".$email}}><button style="background-color: aqua;border-radius:5px;border:none;height:40px; width:200px;">VERIFY ACCOUNT</button></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>