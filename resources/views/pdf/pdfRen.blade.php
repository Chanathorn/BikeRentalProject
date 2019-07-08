<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: normal;
            src: url("{{ public_path('fonts/THSarabunNew.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: bold;
            src: url("{{ public_path('fonts/THSarabunNewBold.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: normal;
            src: url("{{ public_path('fonts/THSarabunNewItalic.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: bold;
            src: url("{{ public_path('fonts/THSarabunNewBoldItalic.ttf') }}") format('truetype');
        }

        table {
            font-family: "THSarabunNew";
            border-style: solid;
            border-width: 2px;
            text-align: center;
            padding-top: 0px;
            border-collapse:collapse;                  
           
        }
        td,th {
            border-style: solid;
            border-width: 2px;
            border-collapse:collapse;      
            height: 71px;
            width: 71px;
        }
        body {
            font-family: "THSarabunNew";
        }
        
    </style>
    <link href="{{ public_path('css/img.css') }}" rel="stylesheet" type="text/css" />
</head>

<body>
                                    {{csrf_field()}}
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="https://sv1.picz.in.th/images/2019/05/24/waZNnt.jpg" alt="wqoMek.jpg" border="0" />
                                    <br>
                                    <font size="5" class="text-left"><b> รหัสการเช่า: {{('HI').$Bikerental->rental_id}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; วันที่ {{date('Y-m-d')}} </b></font><br>
                                    <font size="5" class="text-left"><b> ชื่อ-นามสกุล: {{$Bikerental1->name_member}} {{$Bikerental1->lastname_member}} </b></font><br>
                                    <font size="5" class="text-left"><b> รหัสสมาชิก: {{('M').$Bikerental->member_id}}</b></font><br>
                                    <font size="5" class="text-left"><b> กำหนดคืน: {{$Bikerental->repatriate}}</b></font><br>
                                <table>
                                <tr>            <th><font size="5"><b>รหัสจักรยาน</b></font></th>
                                                <th><font size="5"><b>ยี่ห้อ</b></font></th>
                                                <th><font size="5"><b>รุ่น</b></font></th>
                                                <th><font size="5"><b>ราคา</b></font></th>
                                </tr>
                                <tr >           <td><font size="5"><b>{{('B').$Bikerental->bike_id}}</b></font></td>
                                                <td><font size="5"><b>{{$Bikerental2->brand}}</b></font></td>
                                                <td><font size="5"><b>{{$Bikerental2->generation}}</b></font></td>
                                                <td><font size="5"><b>{{$Bikerental->price}}</b></font></td>
                                </tr>
                               </table>
                               <font size="5"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;รับเงิน(Cash) {{$Bikerental->received}} บาท</b></font><br>
                               <font size="5"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เงินทอน {{$Bikerental->changecash}} บาท</b></font><br>
                               <font size="5"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;พิมพ์โดย: {{ ('E').$Bikerental->employee_id }}</b></font><br>
</body>

</html>