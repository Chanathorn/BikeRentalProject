@extends('layouts.app')
@section('title','Welcome Homepage')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <br><br>
            @if(count($errors) > 0)
            <div class="alert alert-danger"id="centerframemodal">
                <ul>@foreach($errors->all() as $error)                         
                     
                         {{$error}}      
                    @endforeach
                </ul>
            </div>
            @endif
            @if(\Session::has('success'))
            <div class="alert alert-success" id="centerframemodal">
                <p><h3>{{ \Session::get('success') }}</h3></p>
            </div>
            @endif
            <form action="{{url('admin/dashboard/bikereturnindex/search')}}" method="POST" role="search">
                {{ csrf_field() }}
                <div class="input-group">
                    <input type="text" class="form-control" name="q" placeholder="Search">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-search" ></i>
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </span>
                </div>
            </form>
            @if(isset($details))
            <table class="table table-bordered table-striped">
                <tr>
                    <th>รหัสการเช่า</th>
                    <th>รหัสสมาชิก</th>
                    <th>รหัสจักรยาน</th>
                    <th>กำหนดส่งคืน</th>
                    <th>#</th>
                </tr>

                @foreach($details as $row)
                <tr>
                    <td>{{('HI').$row['rental_id']}}</td>
                    <td>{{('M').$row['member_id']}}</td>
                    <td>{{('B').$row['bike_id']}}</td>
                    <td><?php $date = date_create($row['repatriate']);
                        echo date_format($date, "d/m/Y"); ?></td>
                    <td>@include('alluser/bikereturnindex/create')</td>
                </tr>
                @endforeach
            </table>
            {!! $details->render() !!}
            @else
            <h1 id="centerframe"> {{ $message }} </h1>
            @endif
        </div>
    </div>
</div>
@stop