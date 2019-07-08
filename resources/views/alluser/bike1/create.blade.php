<p class="text-right">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
        เพิ่มข้อมูล
    </button>
</p>

<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เพิ่มข้อมูลจักรยาน</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div id="popupinfo">
                <br>
                <form method="POST" action="{{ url('home/bike') }}" id="centerframediv">
                    {{csrf_field()}}
                    <div class="form-group">
                        <div align="left"><label>
                                <h6>รหัสจักรยาน :</h6>
                            </label></div>
                        <input type="text" class="form-control{{ $errors->has('bike_id') ? ' is-invalid' : '' }}" value="<?php $Totalmax = $user1[0]->max; ++$Totalmax; echo "B".$Totalmax;  ?>" disabled />
                        <input type="hidden" name="bike_id" class="form-control{{ $errors->has('bike_id') ? ' is-invalid' : '' }}" value="<?php $Totalmax = $user1[0]->max; ++$Totalmax; echo $Totalmax;  ?>" />
                        @if ($errors->has('bike_id'))
                        <span class="invalid-feedback" role="alert">
                            <?php $geterror = "ข้อมูล bike id มีอยู่แล้ว";
                            if ($errors->first('bike_id') ==  $geterror)
                                echo "ข้อมูล \"รหัสจักรยาน\" มีอยู่แล้ว!";

                            ?>
                        </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <div align="left"><label>
                                <h6>ยี่ห้อ :</h6>
                            </label></div>
                        <input type="text" name="brand" class="form-control" placeholder="ป้อนยี่ห้อ" required />
                    </div>
                    <div class="form-group">
                        <div align="left"><label>
                                <h6>รุ่นของจักรยาน :</h6>
                            </label></div>
                        <input type="text" name="generation" class="form-control" placeholder="ป้อนรุ่นของจักรยาน" required />
                    </div>
                    <div class="form-group">
                        <div align="left"><label>
                                <h6>รหัสประเภทจักรยาน :</h6>
                            </label></div>
                        <select name="type_id" id="" class="form-control">
                            @foreach($details1 as $row)
                            <?php
                            echo "<option value=" . $row['type_id'] . ">" . $row['bike_type'] . "</option>";
                            ?>
                            @endforeach
                        </select>
                    </div>
                    <div class=" form-group">
                        <div align="left"><label>
                                <h6>สถานะจักรยาน :</h6>
                            </label></div>
                        <select name="status_id" class="form-control">
                            @foreach($details2 as $row1)
                            <?php
                            if ($row1['status_id'] == 2)
                                echo "";
                            else
                                echo "<option value=" . $row1['status_id'] . ">" . $row1['status'] . "</option>";
                            ?>
                            @endforeach
                        </select>
                    </div>
                    <input type="submit" class="btn btn-primary" value="บันทึก" />
                </form>
            </div>
        </div>
    </div>
</div>