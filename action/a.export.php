<?php
if(!defined('__KIMS__')) exit;

checkAdmin(0);

function getBBSXml($site,$bbs) {
	global $g,$table;
	static $string;
	$TCD=getDbSelect($table['bbsdata'],($site?'site='.$site.' and ':'').'bbs='.$bbs.' order by gid desc','*');
	while($R=db_fetch_array($TCD)) {
		$string .= "\t".'<item>'."\n";
		$string .= "\t\t".'<display>'.$R['display'].'</display>'."\n";
		$string .= "\t\t".'<hidden>'.$R['hidden'].'</hidden>'."\n";
		$string .= "\t\t".'<mbruid>'.$R['mbruid'].'</mbruid>'."\n";
		$string .= "\t\t".'<subject>'.preg_replace("/\r\n|\r|\n/", "", $R['subject']).'</subject>'."\n";
		$string .= "\t\t".'<content>'.preg_replace("/\r\n|\r|\n/", "", $R['content']).'</content>'."\n";
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
				$string .= "\t\t\t\t".'<c_mbrid>'.$C['mbrid'].'</c_mbrid>'."\n";
				$string .= "\t\t\t\t".'<c_pw>'.$C['pw'].'</c_pw>'."\n";
				$string .= "\t\t\t\t".'<c_subject>'.$C['subject'].'</c_subject>'."\n";
				$string .= "\t\t\t\t".'<c_content>'.$C['content'].'</c_content>'."\n";
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
						$string .= "\t\t\t\t\t\t".'<o_mbrid>'.$O['mbrid'].'</o_mbrid>'."\n";
						$string .= "\t\t\t\t\t\t".'<o_content>'.$O['content'].'</o_content>'."\n";
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
