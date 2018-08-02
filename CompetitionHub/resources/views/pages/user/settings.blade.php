@extends('layouts.app')

@section('content')
<a href="/{{$user->id}}/profile_edit" class="btn btn-info"> Edit Your Profile </a>
    <a href="#" class="btn btn-info"> Reset Account Password </a>
@endsection