<button class="btn btn-info btn-block" data-toggle="modal" data-target="#three{{$row['rental_id']}}">
    <i class="fa fa-envelope"></i> ส่ง E-mail</button>

<div class="modal fade" id="three{{$row['rental_id']}}" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
		<div class="modal-header bg-info text-white">
			<div class="modal-title">แจ้งเตือนจาก BIKEKPS  {{('HI').$row['rental_id']}}</div>
			<button type="button" class="close text-white" data-dismiss="modal">&times;</button>
      </div>
				<form method="post" action="{{action('EmailsController@post')}}">{{csrf_field()}}   
	              <div class="modal-body">
					<p class="text-center">
          เรียนคุณ {{$row['member']['name_member']}} {{$row['member']['lastname_member']}} <br> คุณมีกำหนดคืนจักรยานที่เช่า วันที่: {{$row['repatriate']}} <br> ขณะนี้วันที่ {{date('Y-m-d')}} ท่านยังไม่ได้ทำการคืนจักรยานที่ทำการเช่ากับทาง BIKEKPS
                    </p>
                 </div>
        <input type="hidden" name="email" value="{{$row['member']['email_member']}}"/>
				<input type="hidden" name="subject" value="แจ้งเตือนการเช่าจักรยาน"/>
				<input type="hidden" name="message" value=" เรียนคุณ {{$row['member']['name_member']}} {{$row['member']['lastname_member']}} คุณมีกำหนดคืนจักรยานที่เช่า วันที่: {{$row['repatriate']}}  ขณะนี้วันที่ {{date('Y-m-d')}} ท่านยังไม่ได้ทำการคืนจักรยานที่ทำการเช่ากับทาง BIKEKPS"/>
	      <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Yes </button>                  
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Cancel</button>
	      </div>
      </form>
    </div>
  </div>
</div>