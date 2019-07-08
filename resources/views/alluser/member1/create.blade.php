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
                <h4 class="modal-title">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เพิ่มข้อมูลสมาชิก</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div id="popupinfo">
                <br>
                <form method="POST" action="{{ url('home/member') }}" id="centerframediv">
                    {{csrf_field()}}
                    <div class="form-group">
                        <div align="left"><label>
                                <h6>รหัสสมาชิก :</h6>
                            </label></div>
                            <input type="text" class="form-control{{ $errors->has('member_id') ? ' is-invalid' : '' }}"  value="<?php $Totalmax = $user1[0]->max; ++$Totalmax; echo "M".$Totalmax;  ?>" disabled />
                        <input type="hidden" name="member_id" class="form-control{{ $errors->has('member_id') ? ' is-invalid' : '' }}" value="<?php $Totalmax = $user1[0]->max; ++$Totalmax; echo $Totalmax;  ?>"/>
                        @if ($errors->has('member_id'))
                        <span class="invalid-feedback" role="alert">
                            <?php $geterror = "ข้อมูล member id มีอยู่แล้ว";
                            if ($errors->first('member_id') ==  $geterror)
                                echo "ข้อมูล \"รหัสสมาชิก\" มีอยู่แล้ว!";

                            ?>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <div align="left"><label>
                                <h6>ชื่อ :</h6>
                            </label></div>
                        <input type="text" name="name_member" class="form-control" placeholder="ป้อนชื่อ" required />
                    </div>
                    <div class="form-group">
                        <div align="left"><label>
                                <h6>นามสกุล :</h6>
                            </label></div>
                        <input type="text" name="lastname_member" class="form-control" placeholder="ป้อนนามสกุล" required />
                    </div>
                    <div class="form-group">
                        <div align="left"><label>
                                <h6>เบอร์โทร :</h6>
                            </label></div>
                        <input type="text" name="mobile_member" class="form-control" placeholder="ป้อนเบอร์มือถือ" required />
                    </div>
                    <div class="form-group">
                        <div align="left"><label>
                                <h6>อี-เมล :</h6>
                            </label></div>
                        <input type="email" name="email_member" class="form-control" placeholder="ป้อนอีเมล" required />
                    </div>
                    <div class="form-group">
                        <div align="left"><label>
                                <h6>เพศ :</h6>
                            </label></div>
                        <h6><input type="radio" name="gender_member" value="male"  checked>Male &nbsp;
                            <input type="radio" name="gender_member" value="female">Female</h6>
                    </div>
                    <div>
                        <div align="left"><label>
                                <h6>ที่อยู่ :</h6>
                            </label></div>
                        <textarea class="form-control" name="address_member" row="4" cols="40" required></textarea><br>
                    </div>
                    <div class="form-group">
                        <div align="left"><label>
                                <h6>ค่าธรรมเนียม :</h6>
                            </label></div>
                        <input type="text" name="fee" class="form-control" placeholder="ค่าธรรมเนียม" required />
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="employee_id" value="{{ Auth::user()->employee_id }}" required/>
                    </div>
                    <input type="submit" class="btn btn-primary" value="บันทึก" />
                </form>
            </div>
        </div>
    </div>
</div>