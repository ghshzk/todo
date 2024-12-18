@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/category.css') }}">
@endsection

@section('content')
<div class="category__alert">
    @if(session('success'))
    <div class="category__alert--success">
        {{ session('success') }}
    </div>
    @endif
    @if($errors->any())
    <div class="category__alert--danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>

<div class="category__content">
    <form class="category-form" action="/categories" method="post">
        @csrf
        <div class="category-form__item">
            <input class="category-form__item-input" type="text" name="name" value="{{ old('name') }}">
        </div>
        <div class="category-form__button">
            <button class="category-form__button-submit" type="submit">作成</button>
        </div>
    </form>
    <div class="category-table">
        <table class="category-table__inner">
            <tr class="category-table__row">
                <th class="category-table__header">category</th>
            </tr>
            @foreach ($categories as $category)
            <tr class="category-table__row">
                <td class="category-table__item">
                    <form class="update-form" action="/categories/update" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="update-form__item">
                            <input class="update-form__item-input" type="text" name="name" value="{{$category['name']}}">
                            <input type="hidden" name="id" value="{{$category['id']}}">
                        </div>
                        <div class="update-form__button">
                            <button class="update-form__button-submit" type="submit">更新</button>
                        </div>
                    </form>
                </td>
                <td class="category-table__item">
                    <form class="delete-form" action="/categories/delete" method="post">
                        @csrf
                        @method('DELETE')
                        <div class="delete-form__button">
                            <button class="delete-form__button-submit" type="submit">削除</button>
                            <input type="hidden" name="id" value="{{$category['id']}}">
                        </div>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection