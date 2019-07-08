<p class="text-right">
    <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#myModalpdf{{$row['member_id']}}">
        บัตรสมาชิก
    </button>
</p>

<!-- The Modal -->
<div class="modal fade" id="myModalpdf{{$row['member_id']}}">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;บัตรสมาชิก</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div id="popupinfo">
                <form method="POST" action="{{ action('PDFController@pdf',$row['member_id'])}}" target="_blank" id="centerframediv">
                    <br>
                    <div class="modal-body" >
                        {{csrf_field()}}
                        <div class="card" style="background-image: url(https://sv1.picz.in.th/images/2019/05/24/wawPPv.jpg">
                            <div class="card-body"> 
                                <blockquote class="blockquote mb-0">
                                    <h5>
                                        <p class="text-left" >ชื่อ-นามสกุล: {{$row['name_member']}}  {{$row['lastname_member']}} </p>
                                    </h5> 
                                    <h5>
                                        <p class="text-left"> รหัสสมาชิก: {{('M').$row['member_id']}}</p>
                                    </h5> 
                                    <h5>
                                        <p class="text-left">วันที่สมัคร: {{$row['created_at']->toDateString()}}</p>
                                    </h5>    
                                    <img align="left" width="128" height="70" src='https://barcode.tec-it.com/barcode.ashx?data={{$row['member_id']}}%0A&code=Code128&multiplebarcodes=false&translate-esc=false&unit=Fit&dpi=96&imagetype=Gif&rotation=0&color=%23000000&bgcolor=%23ffffff&qunit=Mm&quiet=0' alt='Barcode Generator TEC-IT'/>         
                                </blockquote>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">

                        <button type="submit" class="btn btn-success"> ปริ้น </button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>

                    </div>
                </form>

            </div>
        </div>
    </div>
</div>