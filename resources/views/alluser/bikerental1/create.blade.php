<p class="text-right">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">เพิ่มข้อมูล</button>
</p>

<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เพิ่มข้อมูลการเช่าจักรยาน</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div id="popupinfo">
                <br>
                <form method="POST" action="{{ url('home/bikerental') }}" id="centerframediv">
                    {{csrf_field()}}
                    <div class="form-group">
                        <div align="left"><label>
                                <h6>รหัสการเช่า :</h6>
                            </label></div>
                        <input type="text" name="rental_id" class="form-control{{ $errors->has('rental_id') ? ' is-invalid' : '' }}" placeholder="ป้อนรหัสจักรยาน" required />
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
                        <input type="text" name="member_id" class="form-control" placeholder="ป้อนรหัสสมาชิก" required />
                    </div>
                    <div class="form-group">
                        <div align="left"><label>
                                <h6>รหัสจักรยาน :</h6>
                            </label></div>
                        <input type="text" name="bike_id" class="form-control" placeholder="ป้อนรหัสจักรยาน" required />
                    </div>
                    <div class="form-group">
                        <div align="left"><label>
                                <h6>กำหนดส่งคืน :</h6>
                            </label></div>
                        <input type="date" name="repatriate" class="form-control" placeholder="ป้อนกำหนดส่งคืน" required />
                    </div>
                    <div class="form-group">
                        <div align="left"><label>
                                <h6>รับเงิน :</h6>
                            </label></div>
                        <input type="text" name="received" class="form-control" placeholder="ป้อนรับเงิน" id='input1' onkeyup='nStr()' required />
                    </div>
                    <div class="form-group">
                        <div align="left"><label>
                                <h6>ราคา :</h6>
                            </label></div>
                        <input type="text" name="price" class="form-control" placeholder="ป้อนราคา" id="input2"  onkeyup='nStr()' required />
                    </div>
                    <div class="form-group">
                        <div align="left"><label>
                                <h6>เงินทอน :</h6>
                            </label></div>
                        <input type="text" name="changecash" class="form-control" placeholder="ป้อนเงินทอน" id="show" required />
                    </div>
                    <input type="hidden" name="employee_id" value="{{ Auth::user()->employee_id }}" required />
                    <input type="submit" class="btn btn-primary" value="บันทึก" />
                </form>
            </div>
        </div>
    </div>
</div>
<script type='text/javascript'>
function nStr(){
var int1 =document.getElementById('input1').value;
var int2=document.getElementById('input2').value; 
var n1 = parseInt(int1);
var n2 = parseInt(int2); 
var show=document.getElementById('show');

if (int1.length > 0) { 
if (isNaN(int2)){
document.getElementById("show").value="";
} 
else if (int2.length >0){
 if(n1 > n2){ document.getElementById("show").value =n1-n2; }
  else { 
  if( n1 == n2){document.getElementById("show").value =0;}
  else
  document.getElementById("show").value =""; }
} 
else if (int1.length > 0){
document.getElementById("show").value ="";
} 
}
}

</script>