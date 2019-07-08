<p class="text-right">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"> เพิ่มข้อมูล</button>
</p>

<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เพิ่มข้อมูลจักรยานหาย</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div id="popupinfo">
                <br>
                <form method="POST" action="{{ url('admin/dashboard/bikereturncreate') }}" id="centerframediv">
                    {{csrf_field()}}
                    <div class="form-group">
                        <div align="left"><label>
                                <h6>รหัสการคืน :</h6>
                            </label></div>
                        <input type="text" name="return_id" class="form-control{{ $errors->has('return_id') ? ' is-invalid' : '' }}" placeholder="ป้อนรหัสการคืน" required />
                        @if ($errors->has('return_id'))
                        <span class="invalid-feedback" role="alert">
                            <?php $geterror = "ข้อมูล return id มีอยู่แล้ว";
                            if ($errors->first('retern_id') ==  $geterror)
                                echo "ข้อมูล \"รหัสการการคืน\" มีอยู่แล้ว!";
                            ?>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <div align="left"><label>
                                <h6>รหัสสมาชิก :</h6>
                            </label></div>
                        <input type="text" name="member_id" class="form-control" placeholder="ป้อนรหัสการคืน" required/>
                    </div>
                    <div class="form-group">
                        <div align="left"><label>
                                <h6>รหัสการเช่า :</h6>
                            </label></div>
                        <input type="text" name="rental_id" class="form-control" placeholder="ป้อนรหัสการเช่า" required/>
                    </div>
                    <div class="form-group">
                        <div align="left"><label>
                                <h6>รหัสจักรยาน :</h6>
                            </label></div>
                        <input type="text" name="bike_id" class="form-control" placeholder="ป้อนรหัสจักรยาน" required/>
                    </div>
                    <div class="form-group">
                        <div align="left"><label>
                                <h6>วันที่หาย :</h6>
                            </label></div>
                        <input type="date" name="return_date" class="form-control" placeholder="ป้อนวันที่หาย"  required/>
                    </div>
                    <div class="form-group">
                        <div align="left"><label>
                                <h6>รับเงิน :</h6>
                            </label></div>
                        <input type="text" name="received" class="form-control" placeholder="รับเงิน" id="inputrental" onchange="nStr()" required />
                    </div>
                    <div class="form-group">
                        <div align="left"><label>
                                <h6>ค่าปรับ :</h6>
                            </label></div>
                            <input type="text" name="fine" class="form-control" placeholder="ป้อนค่าปรับ" id="d2" onchange="nStr()" required/>
                    </div>
                    <div class="form-group">
                        <div align="left"><label>
                                <h6>เงินทอน :</h6>
                            </label></div>
                        <input type="text" name="changecash" class="form-control" id="showrental" onchange="nStr()" required />
                    </div>
                    <input type="hidden" name="employee_id" value="{{ Auth::user()->employee_id }}" required />
                    <input type="submit" class="btn btn-primary" value="บันทึก" />
                </form>
            </div>
        </div>
    </div>
</div>  
<script type="text/javascript">
    function nStr() {
        console.log('hello');
        var int1 = document.getElementById('inputrental').value;
        var int2 = document.getElementById('d2').value;
        var n1 = parseInt(int1);
        var n2 = parseInt(int2);
        console.log(n1);
        console.log(n2);    
            console.log('3333');
            if (n1 > n2 && n2 != -10) {
                console.log('hello1');      
                document.getElementById('showrental'+x).value = n1-n2;
            }
             else {
                if((n1 > n2 && n1==0) || n1 == n2) { console.log('hello222')
                    document.getElementById('showrental'+x).value = 0;
                    } 
                else {
                    console.log('hello3');
                    document.getElementById('showrental'+x).value = "";               
            }
        }
    }
</script>          

