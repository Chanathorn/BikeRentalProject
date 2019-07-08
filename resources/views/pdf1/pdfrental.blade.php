<p class="text-center">
    <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#myModalpdf{{$row['rental_id']}}">
        ใบเสร็จ
    </button>
</p>

<!-- The Modal -->
<div class="modal fade" id="myModalpdf{{$row['rental_id']}}">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ใบเสร็จ</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div id="popupinfo">
                <form method="POST" action="{{ action('PDFGeneralController@pdfrental',$row['rental_id'])}}" target="_blank" id="centerframediv">
                    <br>
                    <div class="modal-body">
                        <div class="card" >
                            <div class="card-body">
                                <blockquote class="blockquote mb-0">
                                    {{csrf_field()}}
                                    <img src="https://sv1.picz.in.th/images/2019/05/24/waZNnt.jpg" alt="wqoMek.jpg" border="0" />
                                    <h6>
                                        <p class="text-left"> รหัสการเช่า: {{('HI').$row['rental_id']}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; วันที่ {{date('Y-m-d')}} </p>
                                    </h6>
                                    <h6>
                                        <p class="text-left"> ชื่อ-นามสกุล: {{$row['member']['name_member']}} {{$row['member']['lastname_member']}} </p>
                                    </h6>
                                    <h6>
                                        <p class="text-left"> รหัสสมาชิก: {{('M').$row['member_id']}} </p>
                                    </h6>
                                    <h6>
                                        <p class="text-left"> กำหนดคืน: <?php $date = date_create($row['repatriate']);
                                     echo date_format($date, "d/m/Y"); ?> </p>
                                    </h6>
                                    <br>
                                        <table id="tablepdf">
                                            <tr>
                                                <th><h6><b>รหัสจักรยาน</b></h6></th>
                                                <th><h6><b>ยี่ห้อ</b></h6></th>
                                                <th><h6><b>รุ่น</b></h6></th>
                                                <th><h6><b>ราคา</b></h6></th>
                                            </tr>
                                            <tr>
                                                <td><b>{{('B').$row['bike_id']}}</b></td>
                                                <td><b>{{$row['bike']['brand']}}</b></td>
                                                <td><b>{{$row['bike']['generation']}}</b></td>
                                                <td><b>{{$row['price']}}</b></td>
                                            </tr>
                                        </table>
                                        <br>
                                        <h6>
                                        <p class="text-right"> รับเงิน(Cash)&nbsp;&nbsp;&nbsp;&nbsp;{{$row['received']}} บาท</p>
                                         </h6>
                                         <h6>
                                        <p class="text-right"> เงินทอน&nbsp;&nbsp;&nbsp;&nbsp;{{$row['changecash']}} บาท</p>
                                         </h6>
                                        <h6>
                                            <p class="text-rigth"> พิมพ์โดย: {{ ('E').$row['employee_id']}}  </p>
                                        </h6> <br>
                            </div>
                            <div class="modal-footer">

                                <button type="submit" class="btn btn-success"> ปริ้น </button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>

                            </div>
                            </blockquote>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>