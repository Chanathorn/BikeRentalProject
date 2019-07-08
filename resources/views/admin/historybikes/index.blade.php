@extends('layouts.app')
@section('title','Welcome Homepage')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <br><br>
            <form action="{{url('admin/dashboard/historybikes/search')}}" method="POST" role="search">
                {{ csrf_field() }}
                <div class="input-group">
                    <input type="text" class="form-control" name="q" placeholder="Search ***If looking for a date search form yyyy-mm-dd">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-search" ></i>
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </span>
                </div>
            </form>

            <form action="{{url('admin/dashboard/historybikes/searchdate')}}" method="POST" role="search">
                {{ csrf_field() }}
                <div class="input-group">
                    <input type="date" class="form-control" name="q" placeholder="Search date"><h3> &nbsp; ถึง &nbsp; </h3>
                    <input type="date" class="form-control" name="qq" placeholder="Search date"> 
                         <button type="submit" class="btn btn-primary">
                            <i class="fa fa-search" ></i>
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </span>
                </div>
            </form>

            @if(\Session::has('success'))
            <div class="alert alert-success">
                <p>{{ \Session::get('success') }}</p>
            </div>
            @endif

            @if(isset($details))
            <table class="table table-bordered table-striped">
                <tr>
                    <th>คีย์หลัก</th>
                    <th>ตาราง</th>
                    <th>รหัสพนักงาน</th>
                    <th>กิจกรรม</th>
                    <th>วันเวลา</th>
                </tr>

                @foreach($details as $row)
                <tr>
                    <td>{{$row['pk']}}</td>
                    <td>{{$row['biketable']}}</td>
                    <td>{{$row['employee_id']}}</td>
                    <td>{{$row['event']}}</td>
                    <td>{{$row['datetime']}}</td>
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