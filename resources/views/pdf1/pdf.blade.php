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
            border-width: 3px;
            height: 240px;
            width: 434px;
        }
        .bg { 
            background-position: center top;
            background-size: 100% auto;
            background-image: url(https://sv1.picz.in.th/images/2019/05/24/wawPPv.jpg);

        }
        .bg1 { 
            background-position: center top;
            background-size: 100% auto;
            background-image: url(https://sv1.picz.in.th/images/2019/05/24/wawC9N.jpg);

        }
    </style>
    <link href="{{ public_path('css/img.css') }}" rel="stylesheet" type="text/css" />
</head>

<body>
    <table class="bg">
        <tr><td>
                <font size="6" class="text-left"><b>&nbsp;&nbsp;ชื่อ-นามสกุล: {{$Member->name_member}} {{$Member->lastname_member}} </b></font><br>
                <font size="6" class="text-left"><b>&nbsp;&nbsp;รหัสสมาชิก: {{('M').$Member->member_id}} </b></font><br>
                <font size="6" class="text-left"><b>&nbsp;&nbsp;วันที่ออกบัตร: {{$Member->created_at->toDateString()}}</b></font><br>
                <img src='https://barcode.tec-it.com/barcode.ashx?data={{$Member->member_id}}%0A&code=Code128&multiplebarcodes=false&translate-esc=false&unit=Fit&dpi=96&imagetype=Gif&rotation=0&color=%23000000&bgcolor=%23ffffff&qunit=Mm&quiet=0' alt='Barcode Generator TEC-IT'/>            
                <td></tr>
    </table>
    <table class="bg1">
        <tr><td>
        <font size="4" class="text-center"><b>&nbsp;&nbsp;ข้อตกลงและเงื่อนไขการใช้บริการ</b></font><br>
                <hr>
                <font size="2" class="text-left"><b>กรุณาอ่านข้อกำหนดและเงื่อนไขต่างๆ ดังต่อไปนี้อย่างละเอียด โดยการใช้บริการ BIKEKPS ถือว่าท่านตกลงที่จะผูกพันตามข้อกำหนดและเงื่อนไขการใช้บริการนี้</b></font><br>
                <font size="2" class="text-left"><b>1.การใช้บริการเช่าจักรยานกับทาง BIKEKPS จะเป็นการเช่าในรูปแบบ เช่าวันนี้คืนพรุ้งนี้</b></font><br>
                <font size="2" class="text-left"><b>1.1.หากคืนหลังกำหนดการคืนจะเสียค่าปรับวันละ 10 บาท ต้องคืนภายในเวลา 9.00-16.30</b></font><br>
                <font size="2" class="text-left"><b>1.2.ต้องทำการคืนจักรยานที่ทำการเช่ากับ ฺBIKEKPS ภายใน 2 เดือน หากเกินกำหนดจะดำเนินคดีตามกฎหมายไทย</b></font><br>
                <font size="2" class="text-left"><b>1.3.ห้ามนำจักรยานออกนอกเขตมหาวิทยาลัยเกษตร์ศาสตร์ วิทยาเขต กำแพงแสน</b></font><br>
                <font size="2" class="text-left"><b>2.หากจักรยานเสียหายทางผู้ใช้บริการจะต้องเป็นผู้รับชอบค่าซ่อมแซมจักรยาน</b></font><br>
            <td></tr>
    </table>
</body>

</html>