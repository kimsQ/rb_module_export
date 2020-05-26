<?php
$maxupsize = str_replace('M','',ini_get('upload_max_filesize'));
$step = $step ? $step : 'step1';
$migset = array
(
	'member'=>'회원정보',
	'board'=>'게시물/댓글',
	'point'=>'포인트',
	'msg'=>'쪽지'
);
?>

<div id="migbox" class="p-4">
	<div class="notice">
		킴스큐 rb1 데이터를 킴스큐 Rb2 이전용 XML데이터를 추출할 수 있습니다.<br>
		킴스큐-Rb2 용 마이그레이션 XML파일을 직접 등록하시거나 주소를 입력해 주세요..<br>
		마이그레이션 후 기존 첨부파일 폴더는 /rb/files/ 폴더안에 업로드해주세요.<br>
		(업로드한 모든 폴더와 파일들은 퍼미션을 일괄적으로 707로 변경해주세요.)
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
		  <label class="custom-control-label" for="mig_member">회원정보 데이터</label>
		</div>

		<div class="custom-control custom-radio mb-2">
			<input type="radio" id="mig_board" name="export_type" value="board" class="custom-control-input">
			<label class="custom-control-label" for="mig_board">게시물/댓글/첨부파일</label>
		</div>

		<div class="submitbox">
			<input type="submit" value=" 다음으로 " class="btn btn-light" />
		</div>

	</form>

	<?php endif?>

	<?php if($step == 'step2'):?>

	<form name="procForm" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>" enctype="multipart/form-data" onsubmit="return saveCheck(this);">
		<input type="hidden" name="r" value="<?php echo $r?>">
		<input type="hidden" name="m" value="<?php echo $module?>">
		<input type="hidden" name="a" value="export">
		<input type="hidden" name="export_type" value="<?php echo $export_type?>">

		<div class="msg mb-4">
			<?php echo $migset[$export_type]?> 데이터를 이전합니다.
			<?php if($export_type!='member'):?>
			<span class="text-danger">(반드시 회원데이터 이전 후 진행하세요)</span>
			<?php else:?>
			<span class="text-danger">(동일한 회원아이디가 존재할 경우 이전에서 제외됩니다)</span>
			<?php endif?>
		</div>

		<table>

			<?php if($export_type == 'board'):?>
			<?php $BBSLIST = getDbArray($table['bbslist'],'site='.$s,'*','gid','asc',0,1)?>
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
				<button type="button" class="btn btn-link"  onclick="history.back();">
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