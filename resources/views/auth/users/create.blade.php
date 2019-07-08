<p class="text-right">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                    เพิ่มข้อมูล
                </button>
        </div>
        </p>

        <!-- The Modal -->
        <div class="modal fade" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เพิ่มข้อมูลพนักงาน</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div id="popupinfo">
                        <br>
                        <form method="POST" action="{{ url('admin/dashboard/users') }}" id="centerframediv">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">
                                    <h6>{{ __('รหัสพนักงาน :') }}</h6>
                                </label>

                                <div class="col-md-6">
                                    <input  type="text" class="form-control"  value="<?php $Totalmax = $user1[0]->max; ++$Totalmax; echo "E".$Totalmax;  ?>" disabled >
                                    <input id="id" type="hidden" class="form-control{{ $errors->has('employee_id') ? ' is-invalid' : '' }}" name="employee_id" value="<?php $Totalmax = $user1[0]->max; ++$Totalmax; echo $Totalmax;  ?>"  >

                                    @if ($errors->has('employee_id'))
                                    <span class="invalid-feedback" role="alert">
                                    <?php $geterror = "ข้อมูล employee id มีอยู่แล้ว";
                                    if ( $errors->first('employee_id') ==  $geterror)
                                        echo "ข้อมูล \"รหัสพนักงาน\" มีอยู่แล้ว!";
    
                                    ?>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">
                                    <h6>{{ __('ชื่อ :') }}</h6>
                                </label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="lastname" class="col-md-4 col-form-label text-md-right">
                                    <h6>{{ __('นามสกุล :') }}</h6>
                                </label>

                                <div class="col-md-6">
                                    <input id="lastname" type="text" class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}" name="lastname" value="{{ old('lastname') }}" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="mobile" class="col-md-4 col-form-label text-md-right">
                                    <h6>{{ __('เบอร์โทร :') }}</h6>
                                </label>

                                <div class="col-md-6">
                                    <input id="mobile" type="text" class="form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}" name="mobile" value="{{ old('mobile') }}" required autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="mobile" class="col-md-4 col-form-label text-md-right">
                                    <h6>{{ __('เพศ :') }}</h6>
                                </label>
                                <div class="col-md-6" style=" margin: 10px;">
                                    <h6><input type="radio" name="gender" value="male"> Male &nbsp;
                                        <input type="radio" name="gender" value="female"> Female </h6>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="mobile" class="col-md-4 col-form-label text-md-right">
                                    <h6>{{ __('ที่อยู่ :') }}</h6>
                                </label>
                                <div class="col-md-6">
                                    <textarea class="form-control" name="address" row="4" cols="40"></textarea><br>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">
                                    <h6>{{ __('อี-เมล :') }}</h6>
                                </label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                    <?php $geterror = "ข้อมูล email มีอยู่แล้ว";
                                    if ( $errors->first('email') ==  $geterror)
                                        echo "ข้อมูล \"อีเมล\" มีอยู่แล้ว!";
                                    ?>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">
                                    <h6>{{ __('รหัสผ่าน :') }}</h6>
                                </label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="6-12 characters" name="password" minlength="6" maxlength="15" required>

                                    @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">
                                    <h6>{{ __('ยืนยันรหัสผ่าน :') }}</h6>
                                </label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="6-12 characters" minlength="6" maxlength="15" required>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('บันทึก') }}
                                    </button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>