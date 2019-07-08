<p class="text-center">
    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#user{{$row['type_id']}}">
        Edit
    </button>
</p>
<!-- The Modal -->
<div class="modal fade" id="user{{$row['type_id']}}">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;แก้ไขข้อมูลประเภทและราคาจักรยาน</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div id="popupinfo">
                <br>
                <!-- Modal body -->
                <div id="popupinfo">
                    <br>
                    <form method="post" action="{{action('BikePriceController@update',$row['type_id'])}}" id="centerframediv">
                        {{csrf_field()}}
                        <div class="form-group">
                            <div align="left"><label>
                                    <h6>รหัสประเภทจักรยาน :</h6>
                                </label></div>
                            <input type="text" name="type_id" class="form-control"  value="{{ $row['type_id'] }}" disabled/>
                        </div>
                        <div class="form-group">
                            <div align="left"><label>
                                    <h6>ประเภทจักรยาน :</h6>
                                </label></div>
                            <input type="text" name="bike_type" class="form-control"  value="{{ $row['bike_type'] }}"  disabled/>
                        </div>
                        <div class="form-group">
                            <div align="left"><label>
                                    <h6>ราคา :</h6>
                                </label></div>
                            <input type="text" name="price" class="form-control" placeholder="ราคา" value="{{ $row['price'] }}" required/>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="อัพเดต" />
                        </div>
                        <input type="hidden" name="_method" value="PATCH" />
                    </form>
                </div>
            </div>
        </div>
    </div>