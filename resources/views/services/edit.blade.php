@extends('layouts.app')

@section('content')

    <h1>Редактировать услугу: {{ $service->name }}</h1>

    <x-validation-errors />

    <form action="{{ route('services.update', $service->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Название услуги:</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $service->name) }}">
        </div>

        <div class="form-group">
            <label for="description">Описание</label>
            <input type="text" class="form-control" name="description" id="description" value="{{ old('description', $service->description) }}">
        </div>

        <div class="form-group">
            <label for="price">Стоимость</label>
            <input type="number" class="form-control" name="price" id="price" value="{{ old('price', $service->price) }}">
        </div>

        <div class="form-group">
            <label for="duration_minutes">Длительность</label>
            <input type="text" class="form-control" name="duration_minutes" id="duration_minutes" value="{{ old('duration_minutes', $service->duration_minutes) }}">
        </div>

        <button type="submit" class="btn btn-primary">Сохранить изменения</button>
    </form>
@endsection