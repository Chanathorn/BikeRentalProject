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
                <h4 class="modal-title">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เพิ่มข้อมูลสถานะ</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div id="popupinfo">
                <br>
                <form method="POST" action="{{url('admin/dashboard/bikestatus')}}" id="centerframediv">
                    {{csrf_field()}}
                    <div class="form-group">
                        <div align="left"><label>
                                <h6>รหัสสถานะ :</h6>
                            </label></div>
                            <input type="text"  class="form-control" value="<?php $Totalmax = $user1[0]->max; ++$Totalmax; echo $Totalmax;  ?>" disabled/>
                            <input type="hidden" name="status_id" class="form-control" placeholder="ป้อนรหัสสถานะ" value="<?php $Totalmax = $user1[0]->max; ++$Totalmax; echo $Totalmax;  ?>"/>
                    </div>
                    <div class="form-group">
                        <div align="left"><label>
                                <h6>สถานะ:</h6>
                            </label></div>
                            <input type="text" name="status" class="form-control{{ $errors->has('status_id') ? ' is-invalid' : '' }}" placeholder="ป้อนสถานะ" required/>
                            @if ($errors->has('status'))
                            <span class="invalid-feedback" role="alert">
                            <?php $geterror = "ข้อมูล status มีอยู่แล้ว";
                            if ($errors->first('status') ==  $geterror)
                                echo "ข้อมูล \"สถานะ\" มีอยู่แล้ว!";

                            ?>
                        </span>
                        @endif
                     </div>                     
                    <input type="submit" class="btn btn-primary" value="บันทึก" />
                </form>
            </div>
        </div>
    </div>
</div>