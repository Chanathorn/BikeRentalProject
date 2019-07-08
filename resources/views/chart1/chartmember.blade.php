@extends('layouts.app0')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"> </div>
                <div class="panel-body">
                <form method="post" action="{{url('home/chartmember/search')}}">
                {{csrf_field()}}
                <div class="form-group">
                    <input type="text" name="q" class="form-control" placeholder="Search year(AD)"/>
                </div>               
            </form>
                    @if(isset($chart))
                    {!! Charts::styles() !!}
                    {!! $chart->html() !!}
                    {!! Charts::scripts() !!}
                    {!! $chart->script() !!}
                     @else
                     <h1 id="centerframe"> {{ $message }} </h1>
                     @endif  
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection