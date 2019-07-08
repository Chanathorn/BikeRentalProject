<p class="text-right">
    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#user{{$row['employee_id']}}">
        Edit
    </button>
    </div>
</p>
<!-- The Modal -->
<div class="modal fade" id="user{{$row['employee_id']}}">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;แก้ไขข้อมูลพนักงาน</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div id="popupinfo">
                <br>
                <form method="POST" action="{{action('admin\UsersController@update',$row['employee_id'])}}" id="centerframediv">
                    @csrf

                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">
                            <h6>{{ __('รหัสพนักงาน :') }}</h6>
                        </label>

                        <div class="col-md-6">
                            <input id="id" type="text" class="form-control{{ $errors->has('employee_id') ? ' is-invalid' : '' }}" name="employee_id" value="{{ ('E').$row['employee_id'] }}" disabled autofocus>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">
                            <h6>{{ __('ชื่อ :') }}</h6>
                        </label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $row['name'] }}" required autofocus>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="lastname" class="col-md-4 col-form-label text-md-right">
                            <h6>{{ __('นามสกุล :') }}</h6>
                        </label>

                        <div class="col-md-6">
                            <input id="lastname" type="text" class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}" name="lastname" value="{{ $row['lastname'] }}" required autofocus>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="mobile" class="col-md-4 col-form-label text-md-right">
                            <h6>{{ __('เบอร์โทร :') }}</h6>
                        </label>

                        <div class="col-md-6">
                            <input id="mobile" type="text" class="form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}" name="mobile" value="{{ $row['mobile'] }}" required autofocus>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="mobile" class="col-md-4 col-form-label text-md-right">
                            <h6>{{ __('เพศ :') }}</h6>
                        </label>
                        <div class="col-md-6" style=" margin: 10px;">
                            <h6> <input type="radio" name="gender" value="male" <?php if ($row['gender'] == "male") echo 'checked="checked"'; ?>>Male &nbsp;
                                <input type="radio" name="gender" value="female" <?php if ($row['gender'] == "female") echo 'checked="checked"'; ?>>Female </h6>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="mobile" class="col-md-4 col-form-label text-md-right">
                            <h6>{{ __('ที่อยู่ :') }}</h6>
                        </label>
                        <div class="col-md-6">
                            <textarea class="form-control" name="address" row="4" cols="40">{{$row['address'] }}</textarea><br>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">
                            <h6>{{ __('อี-เมล :') }}</h6>
                        </label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $row['email']  }}" disabled required>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('อัพเดต') }}
                            </button>
                        </div>
                        <input type="hidden" name="_method" value="PATCH" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>