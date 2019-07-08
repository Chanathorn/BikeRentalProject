@extends('layouts.app')
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
            <form action="{{url('admin/dashboard/users/search')}}" method="POST" role="search">
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
        <td> @include('auth/users/create')</td>
        <table class="table table-bordered table-striped">
            <tr>
                <th>รหัสพนักงาน</th>
                <th>ชื่อ - นามสกุล</th>
                <th>เพศ</th>
                <th>เบอร์โทร</th>
                <th>ที่อยู่</th>
                <th>อีเมล</th>
                <th>แก้ไข</th>
                <th>ลบ</th>
            </tr>

            @foreach($details as $row)
            @if(Auth::user()->email == 'admin@admin.com')
            <tr>
                <td>{{('E').$row['employee_id']}}</td>
                <td>{{$row['name']}} {{$row['lastname']}}</td>
                <td>{{$row['gender']}} </td>
                <td>{{$row['mobile']}} </td>
                <td>{{$row['address']}} </td>
                <td>{{$row['email']}} </td>
                <td> @include('auth/users/edit')</td>
                @if($row['employee_id'] == '899999')
                <td>
                    <a href="javascript:;" data-toggle="modal" onclick="Data" data-target="#Modal" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</a>
                </td>
                @else
                <td>
                    <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$row->employee_id}})" data-target="#DeleteModal" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</a>
                </td>
                @endif
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

<div id="DeleteModal" class="modal fade " role="dialog">
    <div class="modal-dialog ">
        <!-- Modal content-->
        <form action="" id="deleteForm" method="post">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title" color:#ffffff>ยืนยันการลบข้อมูล</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <h3>
                        <p class="text-center">คุณแน่ใจหรือว่าต้องการลบ <br> ข้อมูลรหัสผู้ใช้นี้?</p>
                    </h3>
                </div>
                <div class="modal-footer">
                    <center>
                        <button type="button" class="btn btn-success" data-dismiss="modal">ยกเลิก</button>
                        <button type="submit" name="" class="btn btn-danger" data-dismiss="modal" onclick="formSubmit()">ใช่, ลบ</button>
                    </center>
                </div>
            </div>
        </form>
    </div>
</div>

<div id="Modal" class="modal fade " role="dialog">
    <div class="modal-dialog ">
        <!-- Modal content-->
        <form action="" id="deleteForm" method="post">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title" color:#ffffff></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <h3>
                        <p class="text-center">ข้อมูล <b style="color:red">Admin</b> ไม่สามารถลบได้!! <br></p>
                    </h3>
                </div>
                <div class="modal-footer">
                    <center>
                        <button type="button" class="btn btn-success" data-dismiss="modal">ยกเลิก</button>
                    </center>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    function deleteData(id) {
        var id = id;
        var url = '{{ action("UsersController@destroy", ":id") }}';
        url = url.replace(':id', id);
        $("#deleteForm").attr('action', url);
    }

    function formSubmit() {
        $("#deleteForm").submit();
    }
</script>

@stop