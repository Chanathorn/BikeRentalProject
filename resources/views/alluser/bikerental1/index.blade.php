@extends('layouts.app0')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <br><br>
            @if(count($errors) > 0)
            <div class="alert alert-danger" id="centerframemodal">
                <ul>@foreach($errors->all() as $error)

                    <?php $geterror = "ข้อมูล return id มีอยู่แล้ว";
                    if ($error ==  $geterror)
                        echo "<h3><li>ข้อมูล \"รหัสการคืน\" มีอยู่แล้ว!</li></h3><br>";
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

            <form action="{{url('home/bikerental/search')}}" method="POST" role="search">
                {{ csrf_field() }}
                <div class="input-group">
                    <input type="text" class="form-control" name="q" placeholder="Search หาค่า สถานะเช่า = 99999 ,สถานะคืน =99998">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-search" ></i>
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </span>
                </div>
            </form>

            @if(isset($details))
            <div align="right">@include('alluser/bikerental1/create')</div>
            <table class="table table-bordered table-striped">
                <tr>
                    <th>รหัสการเช่า</th>
                    <th>รหัสสมาชิก</th>
                    <th>รหัสจักรยาน</th>
                    <th>กำหนดส่งคืน</th>
                    <th>รับเงิน</th>
                    <th>ราคาการเช่า</th>
                    <th>เงินทอน</th>
                    <th>สถานะการเช่า</th>
                    <th>ใบเสร็จ</th>
                    <th>ข้อความแจ้งเตือน</th>
                </tr>

                @foreach($details as $row)
                <tr>
                    <td>{{('HI').$row['rental_id']}}</td>
                    <td>{{('M').$row['member_id']}}</td>
                    <td>{{('B').$row['bike_id']}}</td>

                    <td><?php $date = date_create($row['repatriate']);
                        echo date_format($date, "d/m/Y"); ?></td>
                    <td>{{$row['received']}}</td>
                    <td>{{$row['price']}}</td>
                    <td>{{$row['changecash']}}</td>
                    @if($row['status_rental'] == 99999)
                    <td>เช่า</td>
                    @endif
                    @if($row['status_rental'] == 99998)
                    <td>คืน</td>
                    @endif
                    @if($row['status_rental'] == 99997)
                    <td>หาย</td>
                    @endif
                    <td>@include('pdf1/pdfrental')</td>
                    <td>@include('alluser/bikerental/email')</td>
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

<div id="DeleteModal" class="modal fade" role="dialog">
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
                        <p class="text-center">คุณแน่ใจหรือว่าต้องการลบ <br> ข้อมูลการเช่าจักรยานนี้?</p>
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
        var url = '{{action("BikeRentalsGeneralController@destroy", ":id")}}';
        url = url.replace(':id', id);
        $("#deleteForm").attr('action', url);
    }

    function formSubmit() {
        $("#deleteForm").submit();
    }
</script>

@stop