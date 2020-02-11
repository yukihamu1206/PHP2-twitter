@extends('layouts.app')

@section('content')
    @include('usrs.users',['users' => $users])
@endsection