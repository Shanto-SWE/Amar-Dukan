<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    <table>
        <tr>
            <td>Dear {{$userDetails['FullName']}}!</td>
        </tr>
        <tr>
            <td>
                Your return request for order no.{{$return_details['order_id']}} with Amar Dukan is {{$return_status}}.
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Thanks & Regards</td>
        </tr>
        <tr>
            <td>Amar Dukan</td>
        </tr>
    </table>
</body>
</html>