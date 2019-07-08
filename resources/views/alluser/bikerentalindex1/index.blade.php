@extends('layouts.app0')
@section('title','Welcome Homepage')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <br><br>
            @if(count($errors) > 0)
            <div class="alert alert-danger" id="centerframemodal">
                <ul>@foreach($errors->all() as $error)
                    <?php $geterror = "ข้อมูล rental id มีอยู่แล้ว";
                    if ($error ==  $geterror)
                        echo "<h3><li>ข้อมูล \"รหัสการเช่า\" มีอยู่แล้ว!</li></h3><br>";
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
            <form action="{{url('home/bikerentalindex/search')}}" method="POST" role="search">
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

                    <th>รหัสจักรยาน</th>
                    <th>ยี่ห้อ</th>
                    <th>รุ่น</th>
                    <th>ประเภทจักรยาน</th>
                    <th>ราคา/คัน</th>
                    <th>สถานะ</th>
                    <th>#</th>
                </tr>     
                @foreach($details as $row) 
                <tr>
                    <td>{{('B').$row['bike_id']}}</td>
                    <td>{{$row['brand']}}</td>
                    <td>{{$row['generation']}}</td>
                    <td>{{$row['bikeprice']['bike_type']}}</td>
                    <td>{{$row['bikeprice']['price']}}</td>
                    <td>{{$row['bikestatus']['status']}}</td>
                    <td>
                        <div>@include('alluser/bikerentalindex1/create')</div>    
                    </td>
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