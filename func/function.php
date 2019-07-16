<?php
//ham xoa tat tan tat
function delete_files($target) {
    if(is_dir($target)){
        $files = glob( $target . '*', GLOB_MARK ); //GLOB_MARK adds a slash to directories returned
 
        foreach( $files as $file )
        {
            delete_files( $file );      
        }
 
        rmdir( $target );
    } elseif(is_file($target)) {
        unlink( $target );  
    }
}
function ddmmyyyy2yyyymmdd($d,$char){
	if($d!=''){
		$def=explode ($char,$d);
		$d1=$def[0];
		$m1=$def[1];
		$y1=$def[2];
		return $y1.'-'.$m1.'-'.$d1;
	}else{
		return '';
	}
}
function yyyymmdd2ddmmyyyy($d,$char){
	if($d!=''){
		$def=explode ($char,$d);
		$d1=$def[2];
		$m1=$def[1];
		$y1=$def[0];
		return $d1.'/'.$m1.'/'.$y1;
	}else{
		return '';
	}
	
}
function yyyymmdd2mmddyyyy($d,$char){
	//db2form
	if($d!=''){
		$def=explode ($char,$d);
		$d1=$def[2];
		$m1=$def[1];
		$y1=$def[0];
		return $m1.'/'.$d1.'/'.$y1;
	}else{
		return '';
	}
	
}
function mmddyyyy2yyyymmdd($d,$char){
	//from2db
	if($d!=''){
		$def=explode ($char,$d);
		$d1=$def[1];
		$m1=$def[0];
		$y1=$def[2];
		return $y1.'-'.$m1.'-'.$d1;
	}else{
		return '';
	}
	
}
//lay tat ca danh sach file trong thu muc
function list_files($directory)
{
    if ($directory != '.')
    {
        $directory = rtrim($directory, '/') . '/';
    }
    
    if ($handle = opendir($directory))
    {
        while (false !== ($file = readdir($handle)))
        {
            if ($file != '.' && $file != '..')
            {
                echo $file.'<br>';
            }
        }
        
        closedir($handle);
    }
}
//list_files('../data/GPS/Images/AnKhuong/Loc.');
//end
function table_to_array1($table)
{
    $sql="SELECT * from ".$table;
	$dbcon = pg_connect("dbname=".PG_DB." password=".PG_PASS." host=".PG_HOST." user=".PG_USER." port=".PG_PORT);
	$query_tmp=pg_query($dbcon,$sql);
	$i=pg_num_rows($query_tmp)-1;
	$array=array();
	while($r_tmp=pg_fetch_assoc($query_tmp))
	{
		$array[$i]=$r_tmp;
		$i--;
	}
    return $array;
}
function table_to_arrayorder($table)//theo thu tu gid
{
    $sql="SELECT * from ".$table." order by gid asc";
	//order by thutu DESC hoặc ASC
	$dbcon = pg_connect("dbname=".PG_DB." password=".PG_PASS." host=".PG_HOST." user=".PG_USER." port=".PG_PORT);
	$query_tmp=pg_query($dbcon,$sql);
	$i=pg_num_rows($query_tmp)-1;
	$array=array();
	while($r_tmp=pg_fetch_assoc($query_tmp))
	{
		$array[$i]=$r_tmp;
		$i--;
	}
    return $array;
}
function table_to_arrayorder_desc($table)//theo thu tu gid
{
    $sql="SELECT * from ".$table." order by gid desc";
	//order by thutu DESC hoặc ASC
	$dbcon = pg_connect("dbname=".PG_DB." password=".PG_PASS." host=".PG_HOST." user=".PG_USER." port=".PG_PORT);
	$query_tmp=pg_query($dbcon,$sql);
	$i=pg_num_rows($query_tmp)-1;
	$array=array();
	while($r_tmp=pg_fetch_assoc($query_tmp))
	{
		$array[$i]=$r_tmp;
		$i--;
	}
    return $array;
}
function table_to_arrayorder_descid($table)//theo thu tu id
{
    $sql="SELECT * from ".$table." order by id desc";
	//order by thutu DESC hoặc ASC
	$dbcon = pg_connect("dbname=".PG_DB." password=".PG_PASS." host=".PG_HOST." user=".PG_USER." port=".PG_PORT);
	$query_tmp=pg_query($dbcon,$sql);
	$i=pg_num_rows($query_tmp)-1;
	$array=array();
	while($r_tmp=pg_fetch_assoc($query_tmp))
	{
		$array[$i]=$r_tmp;
		$i--;
	}
    return $array;
}
function table_to_arrayorderid($table,$sort)//theo thu tu chi dinh
{
    $sql="SELECT * from ".$table." order by id ".$sort."";
	//order by thutu DESC hoặc ASC
	$dbcon = pg_connect("dbname=".PG_DB." password=".PG_PASS." host=".PG_HOST." user=".PG_USER." port=".PG_PORT);
	$query_tmp=pg_query($dbcon,$sql);
	$i=pg_num_rows($query_tmp)-1;
	$array=array();
	while($r_tmp=pg_fetch_assoc($query_tmp))
	{
		$array[$i]=$r_tmp;
		$i--;
	}
    return $array;
}
//them dieu kien where
function table_to_arraywhere($table,$colum,$value)//theo thu tu id
{
    $sql="SELECT * from ".$table." where ".$colum." = '".$value."' order by id desc";
	//order by thutu DESC hoặc ASC
	$dbcon = pg_connect("dbname=".PG_DB." password=".PG_PASS." host=".PG_HOST." user=".PG_USER." port=".PG_PORT);
	$query_tmp=pg_query($dbcon,$sql);
	$i=pg_num_rows($query_tmp)-1;
	$array=array();
	while($r_tmp=pg_fetch_assoc($query_tmp))
	{
		$array[$i]=$r_tmp;
		$i--;
	}
    return $array;
}
function table_to_arraydk($table,$colum,$value,$col_order,$order)//theo thu tu id
{
    $sql="SELECT * from ".$table." where ".$colum." = '".$value."' order by ".$col_order." ".$order."";
	//order by thutu DESC hoặc ASC
	$dbcon = pg_connect("dbname=".PG_DB." password=".PG_PASS." host=".PG_HOST." user=".PG_USER." port=".PG_PORT);
	$query_tmp=pg_query($dbcon,$sql);
	$i=pg_num_rows($query_tmp)-1;
	$array=array();
	while($r_tmp=pg_fetch_assoc($query_tmp))
	{
		$array[$i]=$r_tmp;
		$i--;
	}
    return $array;
}
function table_to_arraydkcustom($table,$where,$col_order,$order)//theo thu tu id
{
    $sql="SELECT * from ".$table." where ".$where." order by ".$col_order." ".$order."";
	//echo $sql;
	//order by thutu DESC hoặc ASC
	$dbcon = pg_connect("dbname=".PG_DB." password=".PG_PASS." host=".PG_HOST." user=".PG_USER." port=".PG_PORT);
	$query_tmp=pg_query($dbcon,$sql);
	$i=pg_num_rows($query_tmp)-1;
	$array=array();
	while($r_tmp=pg_fetch_assoc($query_tmp))
	{
		$array[$i]=$r_tmp;
		$i--;
	}
    return $array;
}
function table_to_array_2dk($table,$dk1,$gt_dk1,$dk2,$gt_dk2)
{
    $sql="SELECT * FROM $table WHERE $dk1='".$gt_dk1."' and $dk2='".$gt_dk2."' ORDER BY id asc";
	$dbcon = pg_connect("dbname=".PG_DB." password=".PG_PASS." host=".PG_HOST." user=".PG_USER." port=".PG_PORT);
	$query_tmp=pg_query($dbcon,$sql);
	$i=pg_num_rows($query_tmp)-1;
	$array=array();
	while($r_tmp=pg_fetch_assoc($query_tmp))
	{
		$array[$i]=$r_tmp;
		$i--;
	}
    return $array;
}
function insert_table($table,$field,$value)
{
	$strfield="";
	$strvalue="";
	for($i=0; $i<count($field)-1; $i++)
	{
		$strfield.=$field[$i].", ";
		$strvalue.="'".$value[$i]."', ";
		
	}
	$strfield.=$field[$i];
	$strvalue.="'".$value[$i]."'";
	$sql_add_news="INSERT INTO $table(".$strfield.") VALUES (".$strvalue.")";
	//echo $sql_add_news;
	$dbcon = pg_connect("dbname=".PG_DB." password=".PG_PASS." host=".PG_HOST." user=".PG_USER." port=".PG_PORT);
	pg_query($dbcon,$sql_add_news);
}
/* function getElement($tbl_table,$element,$where,$id)
{
	$sql="Select $element from $tbl_table where $where='".$id."'";
	$dbcon = pg_connect("dbname=".PG_DB." password=".PG_PASS." host=".PG_HOST." user=".PG_USER." port=".PG_PORT);
	$kq=pg_query($dbcon,$sql);
	while ($row=pg_fetch_array($kq)){
		//$element = $result[0];
			$element=$row["$element"];
		}
	pg_free_result($kq);
	return $element;
} */
function getElement($tbl_table,$element,$where,$id)
{
	$sql="Select $element from $tbl_table where $where='".$id."'";
	$dbcon = pg_connect("dbname=".PG_DB." password=".PG_PASS." host=".PG_HOST." user=".PG_USER." port=".PG_PORT);
	//echo $sql.'<br>';
	$kq = pg_query($dbcon,$sql);
	while($row=pg_fetch_assoc($kq)){
		//$element = $result[0];
			$element=$row["$element"];
		}
	//mysql_free_result($kq);
	pg_free_result($kq);
	return $element;
}
function Delete($table, $where, $id)
{
	$sql = "DELETE FROM $table WHERE $where ='".$id."'";
	$dbcon = pg_connect("dbname=".PG_DB." password=".PG_PASS." host=".PG_HOST." user=".PG_USER." port=".PG_PORT);
	pg_query($dbcon,$sql);
}
function update_table2dk($table,$field,$value,$dk1,$gt_dk1,$dk2,$gt_dk2)
{
	//$sql='UPDATE public.giatrido SET id=?, matram=?, thoigian=?, giatri=?, geom=? WHERE <condition>;';
	
	//$strfield="";
	//$strvalue="";
	$strupdate="";
	for($i=0; $i<count($field)-1; $i++)
	{
		//$strfield.=$field[$i].", ";
		//$strvalue.="'".$value[$i]."', ";
		$strupdate.=$field[$i]."='".$value[$i]."', ";
		
	}
	//$strfield.=$field[$i];
	//$strvalue.="'".$value[$i]."'";
	$strupdate.=$field[$i]."='".$value[$i]."'";
	//$sql_add_news="INSERT INTO $table(".$strfield.") VALUES (".$strvalue.")";
	$sql_add_news="UPDATE $table SET $strupdate WHERE $dk1='".$gt_dk1."' and $dk2='".$gt_dk2."'";
	$dbcon = pg_connect("dbname=".PG_DB." password=".PG_PASS." host=".PG_HOST." user=".PG_USER." port=".PG_PORT);
	pg_query($dbcon,$sql_add_news);
	//return $sql_add_news;
}
function checknumerric($num){
	if(is_numeric($num)){
		return $num;
	}elseif(is_null($num)){
		return 'null';
	}else{
		return "'".$num."'";
	}
}
function update_table($table,$field,$value,$dk1,$gt_dk1)
{
	//$sql='UPDATE public.giatrido SET id=?, matram=?, thoigian=?, giatri=?, geom=? WHERE <condition>;';
	
	//$strfield="";
	//$strvalue="";
	$strupdate="";
	for($i=0; $i<count($field)-1; $i++){
		//$strfield.=$field[$i].", ";
		//$strvalue.="'".$value[$i]."', ";
		
		//$strupdate.=$field[$i]."='".$value[$i]."', ";
		$strupdate.=$field[$i]."=".checknumerric($value[$i]).", ";
	}
	//$strfield.=$field[$i];
	//$strvalue.="'".$value[$i]."'";
	$strupdate.=$field[$i]."=".checknumerric($value[$i]);
	//$sql_add_news="INSERT INTO $table(".$strfield.") VALUES (".$strvalue.")";
	$sql_add_news="UPDATE $table SET $strupdate WHERE $dk1='".$gt_dk1."'";
	//echo $sql_add_news;
	$dbcon = pg_connect("dbname=".PG_DB." password=".PG_PASS." host=".PG_HOST." user=".PG_USER." port=".PG_PORT);
	pg_query($dbcon,$sql_add_news);
	//return $sql_add_news;
}
function postgis2geojson_goc($table,$cols,$where,$geomname,$idname,$srid){
	$p1='{"type": "FeatureCollection",
	"crs": {
		"type": "name",
		"properties": {
			"name": "urn:ogc:def:crs:EPSG::3857"
		}
	}';
		
	/* $sql='SELECT row_to_json(fc)
 FROM ( SELECT \'FeatureCollection\' As type, array_to_json(array_agg(f)) As features
 FROM (SELECT \'Feature\' As type
    , ST_AsGeoJSON(1,ST_Transform(lg.'.$geomname.',3857),15,4)::json As geometry
    , row_to_json(lp) As properties
   FROM '.$table.' As lg
         INNER JOIN (SELECT '.$cols.' FROM '.$table.' where '.$where.') As lp 
       ON lg.'.$idname.' = lp.'.$idname.'  ) As f )  As fc;'; */
	
	$sql='select array_to_json(array_agg(f)) As features FROM (SELECT \'Feature\' As type , row_to_json(lp) As properties , ST_AsGeoJSON(1,ST_Transform(lg.'.$geomname.','.$srid.'),15,4)::json As geometry FROM '.$table.' As lg INNER JOIN (SELECT '.$cols.' FROM '.$table.' where '.$where.') As lp ON lg.'.$idname.' = lp.'.$idname.'  ) As f';
	   
	//echo $sql;
	//echo '<br>';
	$dbcon = pg_connect("dbname=".PG_DB." password=".PG_PASS." host=".PG_HOST." user=".PG_USER." port=".PG_PORT);
	$kq = pg_query($dbcon,$sql);
	while($row=pg_fetch_assoc($kq)){
			$p2=$row["features"];
		}
	pg_free_result($kq);
	if($p2!=''){
		$element=$p1.',"features":'.$p2.'}';
	}else{
		$element=$p1.'}';
	}
	
	return $element;
}
function postgis2geojson($table,$cols,$where,$geomname,$idname,$srid,$subsql){
	$p1='{"type": "FeatureCollection",
	"crs": {
		"type": "name",
		"properties": {
			"name": "urn:ogc:def:crs:EPSG::3857"
		}
	}';
	
	$sql='select array_to_json(array_agg(f)) As features FROM (SELECT \'Feature\' As type , row_to_json(lp) As properties , ST_AsGeoJSON(1,ST_Transform(lg.'.$geomname.','.$srid.'),15,4)::json As geometry FROM '.$table.' As lg INNER JOIN ('.$subsql.') As lp ON lg.'.$idname.' = lp.'.$idname.'  ) As f';
	   
	//echo $sql;
	//echo '<br>';
	$dbcon = pg_connect("dbname=".PG_DB." password=".PG_PASS." host=".PG_HOST." user=".PG_USER." port=".PG_PORT);
	$kq = pg_query($dbcon,$sql);
	while($row=pg_fetch_assoc($kq)){
			$p2=$row["features"];
		}
	pg_free_result($kq);
	if($p2!=''){
		$element=$p1.',"features":'.$p2.'}';
	}else{
		$element=$p1.'}';
	}
	
	return $element;
}
function sumrows($tbl_table,$element,$dk1,$gt_dk1,$dk2,$gt_dk2)
{
	$sql="SELECT SUM(\"$element\"::numeric) as kq FROM $tbl_table WHERE \"$dk1\"='".$gt_dk1."' and \"$dk2\"='".$gt_dk2."'";
	$dbcon = pg_connect("dbname=".PG_DB." password=".PG_PASS." host=".PG_HOST." user=".PG_USER." port=".PG_PORT);
	//echo $sql;
	$kq = pg_query($dbcon,$sql);
	while($row=pg_fetch_assoc($kq)){
			$element=$row["kq"];
		}
	pg_free_result($kq);
	return $element;
}
function datadir2webdir($url){
	//D:/websvr/xampp/dtcs2017/uploads/Landsat5_1996_TNB_phanloai1.jpg
	$def=explode ('uploads',$url);
	return 'uploads'.$def[1];
}
function Thumbnail($src_url, $type, $src_name, $sUploadDir, $iWidth){
	$dst_path = $sUploadDir; 
	$dst_name = "$src_name";
	//$scale = 0.2;
	$quality = 100; # [0-100], 100 being max.
###################################
	$dst_url = $dst_path.$dst_name;
	$src_size= getimagesize("$src_url");
	# calculate h and w for thumb:
	$dst_w=    $iWidth;//$src_size[0]*$scale;
	$dst_h= $src_size[1]/$src_size[0]*$dst_w;//$scale;
	$dst_img=imagecreatetruecolor($dst_w,$dst_h);
	switch($type)
	{
		case "image/jpeg":
		case "image/pjpeg":
		case "image/jpg":    $src_img=ImageCreateFromjpeg($src_url); 
							break;
		
		case "image/gif":    $src_img=imagecreatefromgif($src_url); 
							break;
		case "image/x-png":
		case "image/x-png":     $src_img=imagecreatefrompng($src_url); 
								break;
		default:    echo "Chỉ được upload file có định dạng GIF, PNG, JPEG (JPG)! <input type=button value=\"Làm lại\" onClick=\"javascript:history.go(-1);\">";
				exit();
	}
	imagecopyresampled($dst_img,$src_img,0,0,0,0,$dst_w,$dst_h,ImageSX($src_img),ImageSY($src_img));
	imagejpeg($dst_img,$dst_url,$quality); # output the in-memory file to disk
	imagedestroy($dst_img); # free memory. important if you create many images at once
	
	//Thumbnail("http://my.weather.gov.hk/PDADATA/mtsate/MTSAT1RIR/mtsat_6.jpg", "image/jpeg", date("dmYH")."-thump.jpg", "img/", 72);
}
function checkisdate($d){
	//$d=isdate_tgbatdau
	$isdate=explode('isdate_',$d);
	$arr=array();
	if(count($isdate)>=2){
		if($isdate[0]!=''){
			//echo $d;
			//echo 'khong phai date';
			array_push($arr,false);
			array_push($arr,$d);
		}else{
			//echo $isdate[1];
			//echo 'Dateeeeeee';
			array_push($arr,true);
			array_push($arr,$isdate[1]);
		}
	}else{
		//echo $isdate[0];
		//echo 'khong phai date';
		array_push($arr,false);
		array_push($arr,$isdate[0]);
	}
	return $arr;
}
function checkidempty($id){
	if($id==''){
		$id=null;
	}
	return $id;
}
function checkempty_col2null($inp){
	if(($inp=='')or($inp=="")or($inp=='tentinh')or($inp=='tenhuyen')or($inp=='tenxa')){
		return null;
	}else{
		return $inp;
	}
}
function checkempty_col2khong($inp){
	if(($inp=='')or($inp=="")or($inp=='tentinh')or($inp=='tenhuyen')or($inp=='tenxa')){
		return 0;
	}else{
		return $inp;
	}
}
function onto1($tbl,$v){
	if($tbl=='consudung'){
		if($v=='on'){
			return 1;
		}else{
			return 0;
		}
	}else{
		return $v;
	}
}
function checkintable($tbl,$colname,$vlue){
	//$tbl='angiang_trongtrot_loaicay';
	//$colname='idloaicay';
	//$vlue='C0011';
	$a=table_to_array1($tbl);
	$arr1=array();
	for($i=0;$i<count($a);$i++){
		//$a[$i]['id']
		array_push($arr1,$a[$i][$colname]);
	}
	if(in_array($vlue,$arr1)){
		return true;
	}else{
		return false;
	}
}
function checkisnum($vlue){
	if(is_numeric($vlue)){
		return true;
	}else{
		return false;
	}
}
function checkisdate_yyyymmdd($date){
	//$date="2012-09-12";
	if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
		return true;
	} else {
		return false;
	}
}
function addclass_tr($check){
	if($check==false){
		return '<tr class="redclass">';
	}else{
		return '<tr>';
	}
}
function checkfinal($check,$checkfinal){
	if($checkfinal==false){
		return false;
	}else{
		if($check==false){
			return false;
		}else{
			return true;
		}
	}
}
function addclass_div($check,$str){
	if($check==false){
		return '<div class="redtxt">'.$str.'</div>';
	}else{
		return $str;
	}
}
function writenoti($check,$stt){
	if($check==false){
		return $stt.', ';
	}else{
		return '';
	}
}
?>