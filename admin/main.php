<?php
$maxupsize = str_replace('M','',ini_get('upload_max_filesize'));
$step = $step ? $step : 'step1';
$migset = array
(
	'member'=>'회원정보',
	'board'=>'게시물/댓글',
	'point'=>'포인트',
	'cash'=>'적립금',
	'money'=>'예치금',
	'msg'=>'쪽지'
);
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

<div id="migbox" class="p-4">
	<div class="text-muted mb-2">
		킴스큐 Rb2 이전용 XML데이터를 추출
	</div>

	<?php if($step == 'step1'):?>

	<form name="procForm" action="<?php echo $g['s']?>/" method="get">
		<input type="hidden" name="r" value="<?php echo $r?>">
		<input type="hidden" name="m" value="<?php echo $m?>">
		<input type="hidden" name="module" value="<?php echo $module?>">
		<input type="hidden" name="step" value="step2">

		<div class="mb-3">
			추출할 데이터를 선택해 주세요.
		</div>

		<div class="custom-control custom-radio mb-2">
		  <input type="radio" id="mig_member" name="export_type" value="member" class="custom-control-input" checked>
		  <label class="custom-control-label" for="mig_member">회원 정보</label>
		</div>

		<div class="custom-control custom-radio mb-2">
			<input type="radio" id="mig_point" name="export_type" value="point" class="custom-control-input">
			<label class="custom-control-label" for="mig_point">회원 포인트</label>
		</div>

		<div class="custom-control custom-radio mb-2">
			<input type="radio" id="mig_cash" name="export_type" value="cash" class="custom-control-input">
			<label class="custom-control-label" for="mig_cash">회원 적립금</label>
		</div>

		<div class="custom-control custom-radio mb-2">
			<input type="radio" id="mig_money" name="export_type" value="money" class="custom-control-input">
			<label class="custom-control-label" for="mig_money">회원 예치금</label>
		</div>

		<div class="custom-control custom-radio mb-2">
			<input type="radio" id="mig_msg" name="export_type" value="msg" class="custom-control-input">
			<label class="custom-control-label" for="mig_msg">회원 쪽지</label>
		</div>

		<hr>

		<div class="custom-control custom-radio mb-2">
			<input type="radio" id="mig_board" name="export_type" value="board" class="custom-control-input">
			<label class="custom-control-label" for="mig_board">게시물/댓글/첨부파일</label>
		</div>

		<div class="mt-4">
			<input type="submit" value=" 다음 " class="btn btn-primary" />
		</div>

	</form>

	<?php endif?>

	<?php if($step == 'step2'):?>

	<form name="procForm" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>" enctype="multipart/form-data" onsubmit="return saveCheck(this);">
		<input type="hidden" name="r" value="<?php echo $r?>">
		<input type="hidden" name="m" value="<?php echo $module?>">
		<input type="hidden" name="a" value="export">
		<input type="hidden" name="export_type" value="<?php echo $export_type?>">

		<div class="lead mb-4 text-primary">
			<?php echo $migset[$export_type]?> 데이터를 추출 합니다.
		</div>

		<table>

			<?php if($export_type == 'board'):?>
			<?php $BBSLIST = getDbArray($table['bbslist'],'uid','*','gid','asc',0,1)?>
			<div class="form-group row">
				<label class="col-2 col-form-label">추출대상 게시판</label>
				<div class="col-5">
					<select name="bbs" class="form-control custom-select">
						<option value="">&nbsp;+ 선택하세요</option>
						<option value="" disabled>----------------------------------------------------------------</option>
						<?php while($R=db_fetch_array($BBSLIST)):?>
						<option value="<?php echo $R['uid']?>,<?php echo $R['id']?>,<?php echo $R['name']?>">ㆍ<?php echo $R['name']?>(<?php echo $R['id']?> - <?php echo number_format($R['num_r'])?>개)</option>
						<?php endwhile?>
					</select>
				</div>
			</div>
			<?php endif?>

		</table>


		<div class="row">
			<div class="col-5 offset-2">
				<button type="submit" class="btn btn-primary">
					추출하기
				</button>
				<button type="button" class="btn btn-light"  onclick="history.back();">
					취소
				</button>
			</div>

		</div>

	</form>


	<?php endif?>


</div>

<script type="text/javascript">

//사이트 셀렉터 출력
$('[data-role="siteSelector"]').removeClass('d-none')

var migflag = false;

function saveCheck(f) {
	if (migflag == true)
	{
		alert('데이터를 추출중에 있습니다. 잠시만 기다려 주세요.    ');
		return false;
	}
	if (f.bbs)
	{
		if (f.bbs.value == '')
		{
			alert('추출대상 게시판을 선택해 주세요.    ');
			f.bbs.focus();
			return false;
		}
	}

	if(confirm('이 데이터의 양에 따라 다소 시간이 걸릴 수 있습니다.  \n정말로 실행하시겠습니까?'))
	{
		migflag = true;
		return true;
	}
	return false;
}

</script>
