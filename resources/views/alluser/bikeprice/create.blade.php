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
                <h4 class="modal-title">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เพิ่มข้อมูลประเภทและราคาจักรยาน</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div id="popupinfo">
                <br>
                <form method="POST" action="{{ url('admin/dashboard/bikeprice') }}" id="centerframediv">
                    {{csrf_field()}}
                    <div class="form-group">
                        <div align="left"><label>
                                <h6>รหัสประเภทจักรยาน :</h6>
                            </label></div>
                            <input type="text"  class="form-control" value="<?php $Totalmax = $user1[0]->max; ++$Totalmax; echo $Totalmax;  ?>" disabled/>
                            <input type="hidden" name="type_id" class="form-control" value="<?php $Totalmax = $user1[0]->max; ++$Totalmax; echo $Totalmax;  ?>" placeholder="รหัสประเภทจักรยาน" required/>
                    </div>
                    <div class="form-group">
                        <div align="left"><label>
                                <h6>ประเภทจักรยาน :</h6>
                            </label></div>
                        <input type="text" name="bike_type" class="form-control" placeholder="ประเภทจักรยาน" required />
                    </div>
                    <div class="form-group">
                        <div align="left"><label>
                                <h6>ราคา :</h6>
                            </label></div>
                        <input type="text" name="price" class="form-control" placeholder="ราคา" required/>
                    </div>              
                    <input type="submit" class="btn btn-primary" value="บันทึก" />
                </form>
            </div>
        </div>
    </div>
</div>
