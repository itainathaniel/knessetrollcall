<!DOCTYPE html>
<html lang="he">
<head>
    <meta charset="utf-8">
</head>
<body>
<div class="container">

    <table>
        <tr>
            <td width="25%" align="right" valign="top">
                <img src="{{ $knessetMember->image_path() }}">
            </td>
            <td width="75%" align="right" valign="top">
                <h1>{{ $knessetMember->name }}</h1>
                <h2>{{ $knessetMember->party->name }}</h2>
            </td>
        </tr>
    </table>

</div>
</body>
</html>