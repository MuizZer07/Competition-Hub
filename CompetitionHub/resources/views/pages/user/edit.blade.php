@extends('layouts.app')

@section('content')
    <a href="/home" class="btn btn-default"> Go Back </a>
    <h1>Edit Your Profile</h1>
    {!! Form::open(['action'=> 'HomeController@updateuser', 'method'=>'POST']) !!}
        <div class="form-group">
            {{ Form::label('name','Name')}}
            {{ Form::text('name', $user->name ,['class'=>'form-control', 'placeholder'=>'User Name'])}}
        </div>
        <div class="form-group">
            {{ Form::label('email','Email')}}
            {{ Form::text('email', $user->email ,['class'=>'form-control', 'placeholder'=>'Email'])}}
        </div>
        <div class="form-group">
            {{ Form::label('phone','Phone Number')}}
            {{ Form::text('phone', $user->phone_number ,['class'=>'form-control', 'placeholder'=>'Phone Number'])}}
        </div>
        <div class="form-group">
            {{ Form::label('institution','Institution')}}
            {{ Form::text('institution', $user->phone_number ,['class'=>'form-control', 'placeholder'=>'Institution'])}}
        </div>
        <div class="form-group">
                {{ Form::label('position','Concentration')}}
                {{ Form::text('position', $user->phone_number ,['class'=>'form-control', 'placeholder'=>'Concentration'])}}
            </div>
        <div class="form-group">
                {{ Form::label('duration','Duration')}}
                {{ Form::text('duration', $user->phone_number ,['class'=>'form-control', 'placeholder'=>'Time duraiton in your Institution'])}}
        </div>
        <div class="form-group">
            {{ Form::label('occupation','Occupation')}}
            {{ Form::text('occupation', $user->occupation ,['class'=>'form-control', 'placeholder'=>'Occupation'])}}
        </div>
        <div class="form-group">
                {{ Form::label('address','Address')}}
                {{ Form::textarea('address', $user->about ,['class'=>'form-control', 'placeholder'=>'Address'])}}
        </div>        
        <div class="form-group">
            {{ Form::label('website','Website')}}
            {{ Form::text('website', $user->website ,['class'=>'form-control', 'placeholder'=>'Website'])}}
        </div>
        <div class="form-group">
                {{ Form::label('about','About')}}
                {{ Form::textarea('about', $user->about ,['class'=>'form-control', 'placeholder'=>'About you'])}}
        </div>
        <div class="form-group">
            {{ Form::label('choose','Choose Preferences') }}
            {!! Form::select('catagory[]', $catagory->pluck('name')->all(), ['class' => 'form-control'],[
                'multiple' => 'multiple', 'id'=>'catagories'
            ]) !!}
        </div>

        {{-- {{ Form::hidden('_method', 'PUT') }} --}}
        {{ Form::submit('Submit', ['class'=>'btn btn-primary']) }}
    {!! Form::close() !!}
    
@endsection