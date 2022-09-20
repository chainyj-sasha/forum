<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
</head>
<body>

    <h3>Список всех юзеров</h3>

<table>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Active</th>
        <th>Admin</th>
    </tr>
    @foreach($users as $user)

        <tr>
            <td>{{ $user->name}}</td>
            <td>{{ $user->email }}</td>
            @if($user->active)
                <td><a href="{{ route('admin.user.active', ['id' => $user->id]) }}">Активен</a></td>
            @else
                <td><a href="{{ route('admin.user.active', ['id' => $user->id]) }}">Забанен</a></td>
            @endif

            @if($user->admin)
                <td><a href="{{ route('admin.user.status', ['id' => $user->id]) }}">Админ</a></td>
            @else
                <td><a href="{{ route('admin.user.status', ['id' => $user->id]) }}">Юзер</a></td>
            @endif

        </tr>

    @endforeach
</table>

</body>
</html>
