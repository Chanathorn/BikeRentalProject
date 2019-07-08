            <p class="text-right">
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#user{{$row['member_id']}}">
                    Edit
                </button>
            </p>
            <!-- The Modal -->
            <div class="modal fade" id="user{{$row['member_id']}}">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;แก้ไขข้อมูลสมาชิก</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div id="popupinfo">
                            <br>
                            <form method="post" action="{{action('MemberGeneralController@update',$row['member_id'])}}" id="centerframediv">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <div align="left"><label>
                                            <h6>รหัสสมาชิก :</h6>
                                        </label></div>
                                    <input type="text" name="member_id" class="form-control{{ $errors->has('member_id') ? ' is-invalid' : '' }}" placeholder="ป้อนรหัสสมาชิก" value="{{('M').$row['member_id']}}" disabled />
                                   <!-- <input type="hidden" name="member_id" class="form-control{{ $errors->has('member_id') ? ' is-invalid' : '' }}" placeholder="ป้อนรหัสสมาชิก" value="{{$row['member_id']}}" /> -->
                                </div>
                                <div class=" form-group">
                                    <div align="left"><label>
                                            <h6>ชื่อ :</h6>
                                        </label></div>
                                    <input type="text" name="name_member" class="form-control" placeholder="ป้อนชื่อ" value="{{$row['name_member']  }}" required />
                                </div>
                                <div class=" form-group">
                                    <div align="left"><label>
                                            <h6>นามสกุล :</h6>
                                        </label></div>
                                    <input type="text" name="lastname_member" class="form-control" placeholder="ป้อนนามสกุล" value="{{ $row['lastname_member'] }}" required />
                                </div>
                                <div class=" form-group">
                                    <div align="left"><label>
                                            <h6>เบอร์โทร :</h6>
                                        </label></div>
                                    <input type="text" name="mobile_member" class="form-control" placeholder="ป้อนเบอร์มือถือ" value="{{ $row['mobile_member'] }}" required />
                                </div>
                                <div class=" form-group">
                                    <div align="left"><label>
                                            <h6>อี-เมล :</h6>
                                        </label></div>
                                    <input type="email" name="email_member" class="form-control" placeholder="ป้อนอีเมล" value="{{ $row['email_member'] }}" required />
                                </div>
                                <div class=" form-group">
                                    <div align="left"><label>
                                            <h6>เพศ :</h6>
                                        </label></div>
                                    <h6> <input type="radio" name="gender_member" value="male" <?php if ($row['gender_member'] == "male") echo 'checked="checked"'; ?>> Male &nbsp;
                                        <input type="radio" name="gender_member" value="female" <?php if ($row['gender_member'] == "female") echo 'checked="checked"'; ?>> Female </h6>
                                </div>
                                <div>
                                    <div class="form-group">
                                        <div align="left"><label>
                                                <h6>ที่อยู่ :</h6>
                                            </label></div>
                                        <textarea class="form-control" name="address_member" row="4" cols="40" required>{{$row['address_member'] }}</textarea><br>
                                    </div>
                                    <div class="form-group">
                                        <div align="left"><label>
                                                <h6>ค่าธรรมเนียม :</h6>
                                            </label></div>
                                        <input type="text" name="fee" class="form-control" placeholder="ค่าธรรมเนียม" value="{{$row['fee'] }}" required />
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="employee_id" value="{{ Auth::user()->employee_id }}" />
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