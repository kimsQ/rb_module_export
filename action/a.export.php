<?php
if(!defined('__KIMS__')) exit;

checkAdmin(0);

function getMBRXml($site) {
	global $g,$table;
	static $string;
	$TCD=getDbSelect($table['s_mbrdata'],'site='.$site.' order by memberuid desc','*');
	while($R=db_fetch_array($TCD)) {
		$M = getUidData($table['s_mbrid'],$R['memberuid']);
		$string .= "\t".'<item>'."\n";
		$string .= "\t\t".'<id>'.$M['id'].'</id>'."\n";
		$string .= "\t\t".'<pw>'.$M['id'].'</pw>'."\n";
		$string .= "\t\t".'<auth>'.$R['auth'].'</auth>'."\n";

		$string .= "\t\t".'<sosok>'.$R['sosok'].'</sosok>'."\n";
		$string .= "\t\t".'<level>'.$R['level'].'</level>'."\n";
		$string .= "\t\t".'<grade>'.$R['grade'].'</grade>'."\n";

		$string .= "\t\t".'<admin>'.$R['admin'].'</admin>'."\n";
		$string .= "\t\t".'<adm_view>'.$R['adm_view'].'</adm_view>'."\n";
		$string .= "\t\t".'<email>'.$R['email'].'</email>'."\n";
		$string .= "\t\t".'<name>'.$R['name'].'</name>'."\n";
		$string .= "\t\t".'<nic>'.$R['nic'].'</nic>'."\n";
		$string .= "\t\t".'<photo>'.$R['photo'].'</photo>'."\n";
		$string .= "\t\t".'<home>'.$R['home'].'</home>'."\n";
		$string .= "\t\t".'<sex>'.$R['sex'].'</sex>'."\n";
		$string .= "\t\t".'<birth1>'.$R['birth1'].'</birth1>'."\n";
		$string .= "\t\t".'<birth2>'.$R['birth2'].'</birth2>'."\n";
		$string .= "\t\t".'<birthtype>'.$R['birthtype'].'</birthtype>'."\n";
		$string .= "\t\t".'<tel1>'.$R['tel1'].'</tel1>'."\n";
		$string .= "\t\t".'<tel2>'.$R['tel2'].'</tel2>'."\n";
		$string .= "\t\t".'<zip>'.$R['zip'].'</zip>'."\n";
		$string .= "\t\t".'<addr0>'.$R['addr0'].'</addr0>'."\n";
		$string .= "\t\t".'<addr1>'.$R['addr1'].'</addr1>'."\n";
		$string .= "\t\t".'<addr2>'.$R['addr2'].'</addr2>'."\n";
		$string .= "\t\t".'<job>'.$R['job'].'</job>'."\n";
		$string .= "\t\t".'<marr1>'.$R['marr1'].'</marr1>'."\n";
		$string .= "\t\t".'<marr2>'.$R['marr2'].'</marr2>'."\n";
		$string .= "\t\t".'<sms>'.$R['sms'].'</sms>'."\n";
		$string .= "\t\t".'<mailing>'.$R['mailing'].'</mailing>'."\n";
		$string .= "\t\t".'<smail>'.$R['smail'].'</smail>'."\n";
		$string .= "\t\t".'<point>'.$R['point'].'</point>'."\n";
		$string .= "\t\t".'<usepoint>'.$R['usepoint'].'</usepoint>'."\n";
		$string .= "\t\t".'<money>'.$R['money'].'</money>'."\n";
		$string .= "\t\t".'<cash>'.$R['cash'].'</cash>'."\n";
		$string .= "\t\t".'<num_login>'.$R['num_login'].'</num_login>'."\n";
		$string .= "\t\t".'<last_log>'.$R['last_log'].'</last_log>'."\n";
		$string .= "\t\t".'<last_pw>'.$R['last_pw'].'</last_pw>'."\n";
		$string .= "\t\t".'<d_regis>'.$R['d_regis'].'</d_regis>'."\n";
		$string .= "\t\t".'<sns>'.$R['sns'].'</sns>'."\n";
		$string .= "\t\t".'<addfield>'.$R['addfield'].'</addfield>'."\n";
		$string .= "\t".'</item>'."\n";
	}
	return $string;
}

function getBBSXml($site,$bbs) {
	global $g,$table;
	static $string;
	$TCD=getDbSelect($table['bbsdata'],($site?'site='.$site.' and ':'').'bbs='.$bbs.' order by gid desc','*');
	while($R=db_fetch_array($TCD)) {
		$string .= "\t".'<item>'."\n";
		$string .= "\t\t".'<display>'.$R['display'].'</display>'."\n";
		$string .= "\t\t".'<hidden>'.$R['hidden'].'</hidden>'."\n";
		$string .= "\t\t".'<name>'.$R['id'].'</name>'."\n";
		$string .= "\t\t".'<nic>'.$R['id'].'</nic>'."\n";
		$string .= "\t\t".'<id>'.$R['id'].'</id>'."\n";
		$string .= "\t\t".'<pw>'.$R['pw'].'</pw>'."\n";
		$string .= "\t\t".'<subject><![CDATA['.preg_replace("/\r\n|\r|\n/", "", $R['subject']).']]></subject>'."\n";
		$string .= "\t\t".'<content><![CDATA['.preg_replace("/\r\n|\r|\n/", "", $R['content']).']]></content>'."\n";
		$string .= "\t\t".'<tag>'.$R['tag'].'</tag>'."\n";
		$string .= "\t\t".'<hit>'.$R['hit'].'</hit>'."\n";
		$string .= "\t\t".'<comment>'.$R['comment'].'</comment>'."\n";
		$string .= "\t\t".'<oneline>'.$R['oneline'].'</oneline>'."\n";
		$string .= "\t\t".'<score1>'.$R['score1'].'</score1>'."\n";
		$string .= "\t\t".'<score2>'.$R['score2'].'</score2>'."\n";
		$string .= "\t\t".'<singo>'.$R['singo'].'</singo>'."\n";
		$string .= "\t\t".'<d_regis>'.$R['d_regis'].'</d_regis>'."\n";
		$string .= "\t\t".'<d_modify>'.$R['d_modify'].'</d_modify>'."\n";
		$string .= "\t\t".'<ip>'.$R['ip'].'</ip>'."\n";
		$string .= "\t\t".'<agent>'.$R['agent'].'</agent>'."\n";
		$string .= "\t\t".'<adddata>'.$R['adddata'].'</adddata>'."\n";

		if ($R['upload']) {

			$string .= "\t\t".'<upload>';
			$upfiles = getArrayString($R['upload']);
			foreach ($upfiles['data'] as $_val) {
				$U = getUidData($table['s_upload'],$_val);
				if ($U['uid']) {
					$string .= $U['name'].','.$U['tmpname'].','.$U['size'].','.$U['width'].','.$U['height'].','.$U['down'].','.$U['d_regis'].','.$U['folder'].'|';
				}
			}

			$string .= '</upload>'."\n";
		}

		if ($R['comment']) {
			$cmentque = 'parent="bbs'.$R['uid'].'"';
			$CCD=getDbSelect($table['s_comment'],$cmentque.' order by uid desc','*');
		  $string .= "\t\t".'<commentdata>'."\n";
		  while ($C=db_fetch_array($CCD)) {
		  	$string .= "\t\t\t".'<commentarea>'."\n";
		  	$string .= "\t\t\t\t".'<c_display>'.$C['display'].'</c_display>'."\n";
				$string .= "\t\t\t\t".'<c_hidden>'.$C['hidden'].'</c_hidden>'."\n";
				$string .= "\t\t\t\t".'<c_notice>'.$C['notice'].'</c_notice>'."\n";
				$string .= "\t\t\t\t".'<c_name>'.$C['name'].'</c_name>'."\n";
				$string .= "\t\t\t\t".'<c_nic>'.$C['nic'].'</c_nic>'."\n";
				$string .= "\t\t\t\t".'<c_id>'.$C['id'].'</c_id>'."\n";
				$string .= "\t\t\t\t".'<c_pw>'.$C['pw'].'</c_pw>'."\n";
				$string .= "\t\t\t\t".'<c_subject><![CDATA['.$C['subject'].']]></c_subject>'."\n";
				$string .= "\t\t\t\t".'<c_content><![CDATA['.$C['content'].']]></c_content>'."\n";
				$string .= "\t\t\t\t".'<c_html>'.$C['html'].'</c_html>'."\n";
				$string .= "\t\t\t\t".'<c_hit>'.$C['hit'].'</c_hit>'."\n";
				$string .= "\t\t\t\t".'<c_down>'.$C['down'].'</c_down>'."\n";
				$string .= "\t\t\t\t".'<c_oneline>'.$C['oneline'].'</c_oneline>'."\n";
				$string .= "\t\t\t\t".'<c_score1>'.$C['score1'].'</c_score1>'."\n";
				$string .= "\t\t\t\t".'<c_score2>'.$C['score2'].'</c_score2>'."\n";
				$string .= "\t\t\t\t".'<c_singo>'.$C['singo'].'</c_singo>'."\n";
				$string .= "\t\t\t\t".'<c_d_regis>'.$C['d_regis'].'</c_d_regis>'."\n";
				$string .= "\t\t\t\t".'<c_d_modify>'.$C['d_modify'].'</c_d_modify>'."\n";
				$string .= "\t\t\t\t".'<c_d_oneline>'.$C['d_oneline'].'</c_d_oneline>'."\n";
				$string .= "\t\t\t\t".'<c_upload>'.$C['upload'].'</c_upload>'."\n";
				$string .= "\t\t\t\t".'<c_ip>'.$C['ip'].'</c_ip>'."\n";
				$string .= "\t\t\t\t".'<c_agent>'.$C['agent'].'</c_agent>'."\n";
				$string .= "\t\t\t\t".'<c_adddata>'.$C['adddata'].'</c_adddata>'."\n";

				if ($C['oneline']) {
					$onelineque = 'parent='.$C['uid'];
					$OCD=getDbSelect($table['s_oneline'],$onelineque.' order by uid desc','*');
					$string .= "\t\t\t\t".'<onelinedata>'."\n";
					while ($O=db_fetch_array($OCD)) {
						$string .= "\t\t\t\t\t".'<onelinearea>'."\n";
						$string .= "\t\t\t\t\t\t".'<o_name>'.$O['name'].'</o_name>'."\n";
						$string .= "\t\t\t\t\t\t".'<o_nic>'.$O['nic'].'</o_nic>'."\n";
						$string .= "\t\t\t\t\t\t".'<o_id>'.$O['id'].'</o_id>'."\n";
						$string .= "\t\t\t\t\t\t".'<o_content><![CDATA['.$O['content'].']]></o_content>'."\n";
						$string .= "\t\t\t\t\t\t".'<o_html>'.$O['html'].'</o_html>'."\n";
						$string .= "\t\t\t\t\t\t".'<o_singo>'.$O['singo'].'</o_singo>'."\n";
						$string .= "\t\t\t\t\t\t".'<o_d_regis>'.$O['d_regis'].'</o_d_regis>'."\n";
						$string .= "\t\t\t\t\t\t".'<o_d_modify>'.$O['d_modify'].'</o_d_modify>'."\n";
						$string .= "\t\t\t\t\t\t".'<o_ip>'.$O['ip'].'</o_ip>'."\n";
						$string .= "\t\t\t\t\t\t".'<o_agent>'.$O['agent'].'</o_agent>'."\n";
						$string .= "\t\t\t\t\t\t".'<o_adddata>'.$O['adddata'].'</o_adddata>'."\n";
						$string .= "\t\t\t\t\t".'</onelinearea>'."\n";
					}
					$string .= "\t\t\t\t".'</onelinedata>'."\n";
				}
		  	$string .= "\t\t\t".'</commentarea>'."\n";
			}
			$string .= "\t\t".'</commentdata>'."\n";
		}

		$string .= "\t".'</item>'."\n";
	}
	return $string;
}

// 회원
if ($export_type == 'member') {

	$filename = 'member.xml';
	$filepath = $g['path_var'].'xml/'.$filename;

	$fp = fopen($filepath,'w');
	fwrite($fp,"<?xml version=\"1.0\" encoding=\"utf-8\"?>\n");
	fwrite($fp,"<DATA>\n");
	fwrite($fp,"\t<title>KIMSQ_RB_MEMBER</title>\n");
	fwrite($fp,"\t<!-- 회원정보 -->\n");
	fwrite($fp,getMBRXml($s));
	fwrite($fp,"</DATA>\n");
	fclose($fp);
	@chmod($filepath,0707);

	$filesize = filesize($filepath);

	header("Content-Type: application/octet-stream");
	header("Content-Length: " .$filesize);
	header('Content-Disposition: attachment; filename="'.$filename.'"');
	header("Cache-Control: private, must-revalidate");
	header("Pragma: no-cache");
	header("Expires: 0");

	$fp = fopen($filepath, 'rb');
	if (!fpassthru($fp)) fclose($fp);
	exit;

}

//게시물,댓글
if ($export_type == 'board') {

	$bbsexp		= explode(',',$bbs);
	$bbsuid		= $bbsexp[0];
	$bbsid		= $bbsexp[1];
	$bbsname	= $bbsexp[2];

	$filename = 'bbs_'.$bbsid.'.xml';
	$filepath = $g['path_var'].'xml/'.$filename;

	$fp = fopen($filepath,'w');
	fwrite($fp,"<?xml version=\"1.0\" encoding=\"utf-8\"?>\n");
	fwrite($fp,"<DATA>\n");
	fwrite($fp,"\t<title>KIMSQ_RB_BBS</title>\n");
	fwrite($fp,"\t<!-- ".$bbsname."-게시판 -->\n");
	fwrite($fp,getBBSXml($s,$bbsuid));
	fwrite($fp,"</DATA>\n");
	fclose($fp);
	@chmod($filepath,0707);

	$filesize = filesize($filepath);

	header("Content-Type: application/octet-stream");
	header("Content-Length: " .$filesize);
	header('Content-Disposition: attachment; filename="'.$filename.'"');
	header("Cache-Control: private, must-revalidate");
	header("Pragma: no-cache");
	header("Expires: 0");

	$fp = fopen($filepath, 'rb');
	if (!fpassthru($fp)) fclose($fp);
	exit;

}

?>
