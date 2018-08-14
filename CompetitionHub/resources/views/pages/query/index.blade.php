@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
            <div class="card-body">
                    @if(count($queries)>0)
                        <table class="table table-striped">
                            <tr>
                                <th> Query </th>
                                <th></th>
                                <th></th>
                                <th> Replied </th>
                                <th> Response </th>
                            </tr>
                            @foreach($queries as $query)    
                            <tr>
                                <td colspan="3"> <a href="" >{{ $query->query }} </a></td>
                            
                                <td>
                                    @if($query->isReplied)
                                        <a class="btn btn-info">
                                            Yes
                                        </a>
                                    @else
                                        <a class="btn btn-danger">
                                            No
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    @if(!$query->isReplied)
                                        {!! Form::open(['action'=> ['QueryController@update', $query->id], 'method'=>'POST']) !!}
                                            <div class="form-group">
                                                    {{ Form::textarea('reply', '',['class'=>'form-control', 'placeholder'=>'Answer'])}}
                                            </div>
                                            {{ Form::submit('Submit', ['class'=>'btn btn-primary']) }}
                                        {!! Form::close() !!}
                                    @else
                                        {{ $query->reply }}
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    @else
                        You don't have any recent query to answer.
                    @endif
                </div>
        </div>
</div>
@endsection