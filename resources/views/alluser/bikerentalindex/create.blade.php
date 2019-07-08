<p class="text-center">
    <button  type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal{{$row['bike_id']}}"> เช่า</button>
</p>

<!-- The Modal -->
<div class="modal fade" id="myModal{{$row['bike_id']}}">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เพิ่มข้อมูลการเช่า</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div id="popupinfo">
                <br>
                <form method="POST" action="{{ url('admin/dashboard/bikerental') }}" id="centerframediv"> <!--{{('R').$user1[0]->max}} -->
                    {{csrf_field()}}
                    <div class="form-group">
                        <div align="left"><label>
                                <h6>รหัสการเช่า :</h6>
                            </label></div>
                        <input type="text" name="rental_id" class="form-control{{ $errors->has('rental_id') ? ' is-invalid' : '' }}" placeholder="ป้อนรหัสจักรยาน" value="<?php $Totalmax = $user1[0]->max; ++$Totalmax; echo "HI".$Totalmax;  ?>" disabled/>  
                        <input type="hidden" name="rental_id" class="form-control{{ $errors->has('rental_id') ? ' is-invalid' : '' }}" placeholder="ป้อนรหัสจักรยาน" value="<?php $Totalmax = $user1[0]->max; ++$Totalmax; echo $Totalmax;  ?>" />
                        @if ($errors->has('rental_id'))
                        <span class="invalid-feedback" role="alert">
                            <?php $geterror = "ข้อมูล rental id มีอยู่แล้ว";
                            if ($errors->first('rental_id') ==  $geterror)
                                echo "ข้อมูล \"รหัสการเช่า\" มีอยู่แล้ว!";
                            ?>
                        </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <div align="left"><label>
                                <h6>รหัสสมาชิก :</h6>
                            </label></div>
                        <input type="text" name="member_id" class="form-control" placeholder="ป้อนรหัสสมาชิก *กรอกเฉพาะตัวเลข*"  required />
                    </div>
                    <div class="form-group">
                        <div align="left"><label>
                                <h6>รหัสจักรยาน :</h6>
                            </label></div>
                            <input type="text"  name="bike_id" class="form-control" value="{{('B').$row['bike_id']}}" disabled />
                            <input type="hidden" name="bike_id" class="form-control" value="{{$row['bike_id']}}"/>
                    </div>
                    <div class="form-group">
                        <div align="left"><label>
                                <h6>กำหนดส่งคืน :</h6>
                            </label></div>
                        <input type="date" name="repatriate" class="form-control" value="{{date('Y-m-d', strtotime('+1 day'))}}" disabled />
                        <input type="hidden" name="repatriate" class="form-control" value="{{date('Y-m-d', strtotime('+1 day'))}}"  />
                    </div>
                    <div class="form-group">
                        <div align="left"><label>
                                <h6>รับเงิน :</h6>
                            </label></div>
                        <input type="text" name="received" class="form-control" placeholder="รับเงิน" id="input{{$row['bike_id']}}" onchange="nStr({{$row['bike_id']}})"   required/>
                
                    </div>
                    <div class="form-group">
                        <div align="left"><label>
                                <h6>ราคา :</h6>
                            </label></div>
                        <input type="text"  class="form-control"  value="{{$row['bikeprice']['price']}}" disabled/>
                        <input type="hidden" name="price" class="form-control" id="input1{{$row['bike_id']}}" onchange="nStr({{$row['bike_id']}})" value="{{$row['bikeprice']['price']}}"/>
                    </div>
                    <div class="form-group">
                        <div align="left"><label>
                                <h6>เงินทอน :</h6>
                            </label></div>
                        <input type="text" name="changecash" class="form-control"  id="show{{$row['bike_id']}}" onchange="nStr({{$row['bike_id']}})" value="" required/>
                    </div>
                    <input type="hidden" name="employee_id" value="{{ Auth::user()->employee_id }}" required/>
                    <input type="submit" class="btn btn-primary" value="บันทึก" />
                </form>
            </div>
        </div>
    </div>
</div>
<script type='text/javascript'>
function nStr(x){
    console.log('hello');
var int1 =document.getElementById('input' +x).value;
var int2 =document.getElementById('input1'+x).value;
var n1 = parseInt(int1);
var n2 = parseInt(int2); 


console.log(x);
console.log(n2);

if (x != 0) { console.log('3333');
 if(n1 > n2){  console.log('hello1'); 
                  document.getElementById('show'+x).value=n1-n2;
   }
  else  { 
         if(n1 == n2){  console.log('hello2'); document.getElementById('show'+x).value =0;  }
         else { console.log('hello3'); document.getElementById('show'+x).value =""; }
        }
   } 
}
</script>