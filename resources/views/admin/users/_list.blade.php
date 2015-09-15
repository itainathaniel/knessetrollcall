<table class="table table-striped">
    <thead>
    <tr>
        <th rowspan="2">#</th>
        <th rowspan="2">שם</th>
        <th rowspan="2">דואר אלקטרוני</th>
        <th rowspan="2">מאומת</th>
        <th colspan="3">עדכוני דואר אלקטרוני</th>
        <th rowspan="2">תאריך הוספה</th>
        <th rowspan="2">תאריך עדכון אחרון</th>
    </tr>
    <tr>
        <th>יומי</th>
        <th>שבועי</th>
        <th>חודשי</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>
                <a href="{{ action('Admin\UsersController@edit', $user) }}">{{ $user->id }}</a>
            </td>
            <td>
                <a href="{{ action('Admin\UsersController@edit', $user) }}">{{ $user->name }}</a>
            </td>
            <td>{{ $user->email }}</td>
            <td>
                @if ($user->verified == 1)
                    <span class="text-success glyphicon glyphicon-ok"></span>
                @else
                    <span class="text-danger glyphicon glyphicon-remove"></span>
                @endif
            </td>
            <td>
                @if ($user->mail_daily)
                    <span class="text-success glyphicon glyphicon-ok" aria-hidden="true"></span>
                @else
                    <span class="text-danger glyphicon glyphicon-remove" aria-hidden="true"></span>
                @endif
            </td>
            <td>
                @if ($user->mail_weekly)
                    <span class="text-success glyphicon glyphicon-ok" aria-hidden="true"></span>
                @else
                    <span class="text-danger glyphicon glyphicon-remove" aria-hidden="true"></span>
                @endif
            </td>
            <td>
                @if ($user->mail_monthly)
                    <span class="text-success glyphicon glyphicon-ok" aria-hidden="true"></span>
                @else
                    <span class="text-danger glyphicon glyphicon-remove" aria-hidden="true"></span>
                @endif
            </td>
            <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
            <td>{{ $user->updated_at->format('d/m/Y H:i') }}</td>
        </tr>
    @endforeach
    </tbody>
</table>