@extends('template')

@section('content')
    <div
        id="root"
        data-trans="{{ $trans }}"
        data-times="{{ $times }}"
    ></div>
@endsection
