<p class="text-center">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal{{$row['rental_id']}}"> คืน</button>
</p>
<!-- The Modal -->
<div class="modal fade" id="myModal{{$row['rental_id']}}">
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
                <form method="POST" action="{{ url('admin/dashboard/bikereturn') }}" id="centerframediv">
                    {{csrf_field()}}
                    <div class="form-group">
                        <div align="left"><label>
                                <h6>รหัสการคืน :</h6>
                            </label></div>
                        <input type="text" class="form-control" value="<?php $Totalmax = $user1[0]->max;
                                                                        ++$Totalmax;
                                                                        echo "R".$Totalmax; ?>" disabled />
                        <input type="hidden" name="return_id" class="form-control{{ $errors->has('retern_id') ? ' is-invalid' : '' }}" placeholder="ป้อนรหัสการคืน" value="<?php $Totalmax = $user1[0]->max;
                                                                                                                                                                            ++$Totalmax;
                                                                                                                                                                            echo $Totalmax; ?>" required />
                        @if ($errors->has('retern_id'))
                        <span class="invalid-feedback" role="alert">
                            <?php $geterror = "ข้อมูล retern id มีอยู่แล้ว";
                            if ($errors->first('retern_id') == $geterror)
                                echo "ข้อมูล \"รหัสการการคืน\" มีอยู่แล้ว!";
                            ?>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <div align="left"><label>
                                <h6>รหัสสมาชิก :</h6>
                            </label></div>
                        <input type="text" name="member_id" class="form-control" value="{{('M').$row['member_id']}}" disabled />
                        <input type="hidden" name="member_id" class="form-control" value="{{$row['member_id']}}" />
                    </div>
                    <div class="form-group">
                        <div align="left"><label>
                                <h6>รหัสการเช่า :</h6>
                            </label></div>
                        <input type="text" name="rental_id" class="form-control" value="{{('HI').$row['rental_id']}}" disabled />
                        <input type="hidden" name="rental_id" class="form-control" value="{{$row['rental_id']}}" />
                    </div>
                    <div class="form-group">
                        <div align="left"><label>
                                <h6>รหัสจักรยาน :</h6>
                            </label></div>
                        <input type="text" name="bike_id" class="form-control" value="{{('B').$row['bike_id']}}" disabled />
                        <input type="hidden" name="bike_id" class="form-control" value="{{$row['bike_id']}}" />
                    </div>
                    <div class="form-group">
                        <div align="left"><label>
                                <h6>วันที่คืน :</h6>
                            </label></div>
                        <input type="date" name="return_date" class="form-control" value="{{$row['repatriate']}}" disabled />
                        <input type="hidden" name="return_date" class="form-control" value="{{$row['repatriate']}}" id="d3{{$row['rental_id']}}" onchange="nStr({{$row['rental_id']}})" />
                    </div>
                    <div class="form-group">
                        <div align="left"><label>
                                <h6>รับเงิน :</h6>
                            </label></div>
                        <input type="text" name="received" class="form-control" placeholder="รับเงิน" id="inputrental{{$row['rental_id']}}" onchange="nStr({{$row['rental_id']}})" required />
                    </div>
                    <div class="form-group">
                        <div align="left"><label>
                                <h6>ค่าปรับ :</h6>
                            </label></div>
                        <input type="hidden" name="fine" class="form-control" id="d2{{$row['rental_id']}}" onchange="nStr({{$row['rental_id']}})" />
                        <input type="text" class="form-control" id="d1{{$row['rental_id']}}" disabled />
                    </div>
                    <div class="form-group">
                        <div align="left"><label>
                                <h6>เงินทอน :</h6>
                            </label></div>
                        <input type="text" name="changecash" class="form-control" id="showrental{{$row['rental_id']}}" onchange="nStr({{$row['rental_id']}})" required />
                    </div>
                    <input type="hidden" name="employee_id" value="{{ Auth::user()->employee_id }}" required />
                    <input type="submit" class="btn btn-primary" value="บันทึก" />
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    //disabled input
   
     window.date1 = new Date('{{$row['repatriate']}}');
     window.date2 = new Date('{{date('Y-m-d')}}');
    if (window.date2 > window.date1)
        var diffDays = (window.date2.getDate() - window.date1.getDate()) * 10;
    else
        var diffDays = '0';
    document.getElementById('d1{{$row['rental_id']}}').setAttribute('value', diffDays);
    //hidden type input
     window.date3 = new Date('{{$row['repatriate']}}');
     window.date4 = new Date('{{date('Y-m-d')}}');
    if (window.date4 > window.date3)
        var diffDays1 = (window.date4.getDate() - window.date3.getDate()) * 10;        
    else
        var diffDays1 = '0';
    document.getElementById('d2{{$row['rental_id']}}').setAttribute('value', diffDays1);

    function nStr(x) {
        date5 = new Date(document.getElementById('d3'+x).value);
        console.log('hello');
        var int0 = (window.date4.getDate() - date5.getDate())*10;
        var int1 = document.getElementById('inputrental'+x).value;
        if(int0 == -10){ 
            int2 = (window.date4.getDate() - date5.getDate())+1; 
       }else{ int2 = (window.date4.getDate() - date5.getDate())*10; 
        }
        var n1 = parseInt(int1);
        var n2 = parseInt(int2);
        console.log(n1);
        console.log(n2);
        if (x != 0) {
            console.log('3333');
            if (n1 > n2 && n2 != -10) {
                console.log('hello1');      
                document.getElementById('showrental'+x).value = n1-n2;
            } else {
                if((n1 > n2 && n1==0) || n1 == n2) { console.log('hello222')
                    document.getElementById('showrental'+x).value = 0;
                    } 
                else {
                    console.log('hello3');
                    document.getElementById('showrental'+x).value = "";
                }
            }
        }
    }
</script>