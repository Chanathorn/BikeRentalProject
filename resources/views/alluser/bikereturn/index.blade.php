@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <br><br>
            @if(count($errors) > 0)
            <div class="alert alert-danger"id="centerframemodal">
                <ul>@foreach($errors->all() as $error)                         
                     
                         <?php $geterror = "ข้อมูล return id มีอยู่แล้ว";
                         if($error ==  $geterror)
                         echo "<h3><li>ข้อมูล \"รหัสการคืน\" มีอยู่แล้ว!</li></h3><br>";
                         ?>         
                    @endforeach
                </ul>
            </div>
            @endif
            @if(\Session::has('success'))
            <div class="alert alert-success" id="centerframemodal">
                <p><h3>{{ \Session::get('success') }}</h3></p>
            </div>
            @endif
            
            <form action="{{url('admin/dashboard/bikereturn/search')}}" method="POST" role="search">
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
            <div align="right">@include('alluser/bikereturn/create')</div>
            <table class="table table-bordered table-striped">
                <tr>
                    <th>รหัสการคืน</th>
                    <th>รหัสสมาชิก</th>
                    <th>รหัสกการเช่า</th>        
                    <th>รหัสจักรยาน</th>
                    <th>วันที่คืน/หาย</th>
                    <th>รับเงิน</th>
                    <th>ค่าปรับ</th>
                    <th>ค่าปรับของหาย</th>
                    <th>เงินทอน</th>
                    <th>สถานะ</th>
                    <th>รหัสพนักงาน</th>
                    <th>ใบเสร็จ</th>
                </tr>

                @foreach($details as $row)
                <tr>
                    <td>{{('R').$row['return_id']}}</td>
                    <td>{{('M').$row['member_id']}}</td>
                    <td>{{('HI').$row['rental_id']}}</td>
                    <td>{{('B').$row['bike_id']}}</td>               
                    <td><?php $date = date_create($row['return_date']);
                        echo date_format($date, "d/m/Y"); ?></td>
                    <td>{{$row['received']}}</td>
                    <td>{{$row['fine']}}</td>
                    <td>{{$row['finedisappear']}}</td>
                    <td>{{$row['changecash']}}</td>
                    @if($row['bikerentals']['status_rental'] == 99999)
                    <td>เช่า</td>
                    @endif
                    @if($row['bikerentals']['status_rental'] == 99998)
                    <td>คืน</td>
                    @endif
                    @if($row['bikerentals']['status_rental'] == 99997)
                    <td>หาย</td>
                    @endif
                    <td>{{('E').$row['employee_id']}}</td>

                    @if($row['bikerentals']['status_rental'] == 99997)
                    <td>@include('pdf/pdfdisappear')</td>
                    @else
                    <td>@include('pdf/pdfreturn')</td>
                    @endif

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