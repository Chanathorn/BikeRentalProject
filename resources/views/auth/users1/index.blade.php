@extends('layouts.app0')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <br><br>
            @if(count($errors) > 0)
            <div class="alert alert-danger" id="centerframemodal">
                <ul>@foreach($errors->all() as $error)

                    <?php $geterror = "ข้อมูล employee id มีอยู่แล้ว";
                    $geterror1 = "ข้อมูล email มีอยู่แล้ว";
                    if ($error ==  $geterror)
                        echo "<h3><li>ข้อมูล \"รหัสพนักงาน\" มีอยู่แล้ว!</li></h3><br>";
                    if ($error ==  $geterror1)
                        echo "<h3><li>ข้อมูล \"อีเมล\" มีอยู่แล้ว!</li></h3>";
                    ?>
                    @endforeach
                </ul>
            </div>
            @endif
            @if(\Session::has('success'))
            <div class="alert alert-success" id="centerframemodal">
                <p>
                    <h3>{{ \Session::get('success') }}</h3>
                </p>
            </div>
            @endif         
         <!--   <form action="{{url('home/users/search')}}" method="POST" role="search">
                {{ csrf_field() }}
                <div class="input-group">
                    <input type="text" class="form-control" name="q" placeholder="Search">
                        <button type="submit" class="btn btn-primary">
                        <i class="fa fa-search" ></i>
                            <span class="glyphicon glyphicon-search"></span> 
                        </button>
                    </span>
                </div>
            </form> -->

        @if(isset($details))
        <table class="table table-bordered table-striped">
            <tr>
                <th>รหัสพนักงาน</th>
                <th>ชื่อ - นามสกุล</th>
                <th>เพศ</th>
                <th>เบอร์โทร</th>
                <th>ที่อยู่</th>
                <th>อีเมล</th>
                <th>แก้ไข</th>

            </tr>

            @foreach($details as $row)
            @if($row['employee_id'] == Auth::user()->employee_id )
            <tr>
                <td>{{('E').$row['employee_id']}}</td>
                <td>{{$row['name']}} {{$row['lastname']}}</td>
                <td>{{$row['gender']}} </td>
                <td>{{$row['mobile']}} </td>
                <td>{{$row['address']}} </td>
                <td>{{$row['email']}} </td>
                <td> @include('auth/users1/edit')</td>
            </tr>
            @endif
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