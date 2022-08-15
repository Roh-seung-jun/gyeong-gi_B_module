@extends('header')



@section('contents')

<section id="" class="sub_section">
    <form action="{{route('sign')}}" method="post" class="container">
        @csrf
        <p>id : </p>
        <input type="text" name="id" class="form-control">
        <p>pw :</p>
        <input type="password" name="password" class="form-control">
        <p>name</p>
        <input type="text" name="name" class="form-control">
        <button class="btn btn-outline-success">회원가입</button>
    </form>
</section>
@endsection
