<?php
//http://localhost/dothanhlong.org/tools/postgresql_tool/psqlex.php?binfol=C%3A%5CProgram+Files+%28x86%29%5CPostgreSQL%5C9.2%5Cbin&port=5433&dbname=thuadat_dongnai_v4&outfol=D%3A%5Ctmp%5Csqlout&submit_dump2sql=
set_time_limit(0);
function convertstr($str){
	$laststr=substr($str,(strlen($str)-1),1);
	if($laststr!='\\'){
		//return str_replace('\\','/',$str).'/';
		return $str.'\\';
	}else{
		return $str;
	}
}
if(isset($_GET['submit_genbatch'])){
	$f3gpfolder=$_GET['f3gpfolder'];
	$fzipfolder=$_GET['fzipfolder'];
	$f3gpfolder=convertstr($_GET['f3gpfolder']);
	$fzipfolder=convertstr($_GET['fzipfolder']);
	//echo $outfol.$dbname;
	$batchfile='';
	$batchfile.='@ECHO OFF
';
	$batchfile.='setlocal enabledelayedexpansion
';
	$batchfile.='for %%f in ("'.$fzipfolder.'*.zip") do (
';
	$batchfile.='	Copy /b "'.$f3gpfolder.'t1.3gp" + "%%f" "%%f.3gp"
';
	$batchfile.=')
';
	$batchfile.='pause';
	
	
	$size = strlen($batchfile);
	header('Content-Disposition: attachment; filename="redrose.bat"');
	//header('Content-Type: BAT MIME TYPE or something like application/octet-stream');
	header('Content-Type: BAT MIME TYPE');
	header('Content-Lenght: '.$size);
	echo $batchfile;
}
?>