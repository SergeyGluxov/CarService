@extends('layouts.app')
@section('content')
    <passport-component></passport-component>
@endsection

<?php
if(isset($_GET["send"]))
{
    send_mail();

    $msg_box = "<span style='color: green;'>Сообщение успешно отправлено!</span>";
}else{
}

?>

</head>
    <body>
    <form action="http://127.0.0.1:8000/admin/users_settings" method="get">
        <p>Число:<br><input type="date" name="date"/> </p>
        <input type="Submit" name="send" value="Записаться" />


    </form>
    </body>