@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <br><br>
            @if(count($errors) > 0)
            <div class="alert alert-danger"id="centerframemodal">
                <ul>@foreach($errors->all() as $error)                         
                     
                         <?php $geterror = "ข้อมูล bike id มีอยู่แล้ว";
                         if($error ==  $geterror)
                         echo "<h3><li>ข้อมูล \"รหัสจักรยาน\" มีอยู่แล้ว!</li></h3><br>";
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
            
            <form action="{{url('admin/dashboard/bike/search')}}" method="POST" role="search">
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
            <div align="right">@include('alluser/bike/create')</div>
            <table class="table table-bordered table-striped">
                <tr>
                    <th>รหัสจักรยาน</th>
                    <th>ยี่ห้อ</th>
                    <th>รุ่น</th>
                    <th>ประเภทจักรยาน</th>
                    <th>ราคา/คัน</th>
                    <th>สถานะ</th>
                    <th>แก้ไข</th>
                    <th>ลบ</th>
                </tr>

                @foreach($details as $row)
                <tr>
                    <td>{{('B').$row['bike_id']}}</td>
                    <td>{{$row['brand']}}</td>
                    <td>{{$row['generation']}}</td>
                    <td>{{$row['bikeprice']['bike_type']}}</td>
                    <td>{{$row['bikeprice']['price']}}</td>
                    <td>{{$row['bikestatus']['status']}}</td>
                    @if(($row['status_id']== 0 || $row['status_id']== 1) && $row['status_id'] != 3)
                    <td>@include('alluser/bike/edit')</td>
                    @endif
                    @if($row['status_id']==2)
                    <td><a href="javascript:;" data-toggle="modal"  data-target="#Modalnotdelete" class="btn btn-xs btn-danger"></i> Edit</a></td>
                    @endif
                    @if($row['status_id']==3)
                    <td><a href="javascript:;" data-toggle="modal"  data-target="#Modalnotdelete1" class="btn btn-xs btn-danger"></i> Edit</a></td>
                    @endif
                    <td>
                        <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$row->bike_id}})" data-target="#DeleteModal" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</a>
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

<div id="Modalnotdelete" class="modal fade " role="dialog">
    <div class="modal-dialog ">
        <!-- Modal content-->
        <form action="" id="deleteForm" method="post">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title" color:#ffffff>แก้ไขข้อมูล</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <h3>
                        <p class="text-center">จักรยานถูก <font color="red"><b>"เช่า"</b></font> อยู่<br>ไม่สามารถแก้ไขข้อมูลได้!!</p>
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

<div id="Modalnotdelete1" class="modal fade " role="dialog">
    <div class="modal-dialog ">
        <!-- Modal content-->
        <form action="" id="deleteForm" method="post">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title" color:#ffffff>แก้ไขข้อมูล</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <h3>
                        <p class="text-center">จักรยาน <font color="red"><b>"หาย"</b></font> <br>ไม่สามารถแก้ไขข้อมูลได้!!</p>
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
                        <p class="text-center">คุณแน่ใจหรือว่าต้องการลบ <br> ข้อมูลจักรยานคันนี้?</p>
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

<script type="text/javascript">
    function deleteData(id) {
        var id = id;
        var url = '{{ action("BikeController@destroy", ":id") }}';
        url = url.replace(':id', id);
        $("#deleteForm").attr('action', url);
    }

    function formSubmit() {
        $("#deleteForm").submit();
    }
</script>
@stop