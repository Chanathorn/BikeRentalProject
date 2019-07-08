    <p class="text-center">
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#user{{$row['bike_id']}}">
                    Edit
                </button>
            </p>
            <!-- The Modal -->
            <div class="modal fade" id="user{{$row['bike_id']}}">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;แก้ไขข้อมูลจักรยาน</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div id="popupinfo">
                            <br>
                            <form method="post" action="{{action('BikeGeneralController@update',$row['bike_id'])}}" id="centerframediv">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <div align="left"><label>
                                            <h6>รหัสจักรยาน :</h6>
                                        </label></div>
                                    <input type="text"  class="form-control" placeholder="ป้อนรหัสจักรยาน" value="{{('B').$row['bike_id']}}" disabled/> 
                                    <input type="hidden" name="bike_id" class="form-control"  value="{{$row['bike_id']}}" />
                                </div>
                                <div class=" form-group">
                                    <div align="left"><label>
                                            <h6>ยี่ห้อ :</h6>
                                        </label></div>
                                    <input type="text" name="brand" class="form-control" placeholder="ป้อนยี่ห้อ" value="{{$row['brand']  }}" required/>
                                </div>
                                <div class=" form-group">
                                    <div align="left"><label>
                                            <h6>รุ่น :</h6>
                                        </label></div>
                                    <input type="text" name="generation" class="form-control" placeholder="ป้อนรุ่น" value="{{ $row['generation'] }}" required/>
                                </div>
                                <div class=" form-group">
                                    <div align="left"><label>
                                            <h6>ประเภทจักรยาน :</h6>
                                        </label></div>
                                    <select name="type_id" class="form-control" >
                                        <option value="{{$row['type_id']}}">
                                            {{$row['bikeprice']['bike_type']}}
                                        </option>
                                        @foreach($details1 as $row1)
                                        <?php
                                        if ($row1['type_id'] == $row['bikeprice']['type_id'])
                                            echo "";
                                        else
                                            echo "<option value=" . $row1['type_id'] . ">" . $row1['bike_type'] . "</option>";
                                        ?>
                                        @endforeach

                                    </select>
                                </div>
                                <div class=" form-group">
                                    <div align="left"><label>
                                            <h6>สถานะจักรยาน :</h6>
                                        </label></div>
                                    <select name="status_id" class="form-control" <?php if($row['status_id'] == 1) echo "disabled='disabled'"; ?>>
                                        <option value="{{$row['status_id']}}">
                                            {{$row['bikestatus']['status']}}
                                        </option>
                                        @foreach($details2 as $row1)
                                        <?php
                                        if ($row1['status'] == $row['bikestatus']['status'] || $row1['status_id'] == 2)
                                            echo "";
                                        else
                                            echo "<option value=" . $row1['status_id'] . ">" . $row1['status'] . "</option>";
                                        ?>
                                        @endforeach
                                    </select>
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