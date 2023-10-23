@extends('layouts.app')

@section('content')

<x-alert-success />

    <h1>Список клиентов</h1>

    <x-span-bt-create href="{{ route('user.create') }}">Добавить клиента</x-span-bt-create>

    <x-table>

        <thead>

            <tr>
                <th>ID</th>
                <th>Имя</th>
                <th>Email</th>
                <th>Телефон</th>
                <th>Действия</th>
            </tr>

        </thead>

        <tbody>

            @foreach ($users as $user)

                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>

                        <x-span-bt-edit href="{{ route('user.edit', $user->id) }}">Редактировать</x-span-bt-edit>

                        <x-bt-show href="{{ route('user.show', $user->id) }}">Просмотреть</x-bt-show>

                        <x-span-bt-delete href="{{ route('user.delete', $user->id) }}">Удалить</x-span-bt-delete>

                    </td>

                </tr>

            @endforeach

        </tbody>

    </x-table>

    <x-span-bt-create href="{{ route('admin.dashboard') }}">Назад</x-span-bt-create>

@endsection
