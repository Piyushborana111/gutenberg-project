@extends('layout')

@section('content')
<div id="app">
    <books-page category="{{ $category }}"></books-page>
</div>
@endsection
