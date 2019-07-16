<?php
function getimgthumb($img){
	$def=explode ('.',$img);
	$img_thumb=$def[0]."_thumb.jpg";
	return $img_thumb;
}
//kiem tra hinh
function kthinh($img,$dirimg){
	if($img==''){
		$getimg='';
	}else{
		$getimg='<img src="'.$dirimg.'/'.$img.'">';
	}
}
//lay danh sach cac  file trong 1 thu muc
function list_files($directory = '.')
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
//list_files();
//list_files('uploads/');
//xoa tat ca thu muc con va file
function remove_dir($dir = null) {
    if (is_dir($dir)) {
        $objects = scandir($dir);
        foreach ($objects as $object) {
            if ($object != "." && $object != "..") {
                if (filetype($dir."/".$object) == "dir") remove_dir($dir."/".$object);
                else unlink($dir."/".$object);
            }
        }
        reset($objects);
        rmdir($dir);
    }
}
//xoa tat ca thu muc con va file (cach 2)
function rmdir_recurse($path) {
    $path = rtrim($path, '/').'/';
    $handle = opendir($path);
    while(false !== ($file = readdir($handle))) {
        if($file != '.' and $file != '..' ) {
            $fullpath = $path.$file;
            if(is_dir($fullpath)) rmdir_recurse($fullpath); else unlink($fullpath);
        }
    }
    closedir($handle);
    rmdir($path);
}
function Thumbnail($src_url, $type, $src_name, $sUploadDir, $iWidth) 
    {
        $dst_path = $sUploadDir; 
        $dst_name = "$src_name";
        //$scale = 0.2;
        $quality = 100; # [0-100], 100 being max.
##########################################################################
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
            default:    echo "Chỉ được upload định dạng GIF, PNG, JPEG (JPG)! <input type=button value=\"Làm l?i\" onClick=\"javascript:history.go(-1);\">";
                    exit();
        }
        imagecopyresampled($dst_img,$src_img,0,0,0,0,$dst_w,$dst_h,ImageSX($src_img),ImageSY($src_img));
        imagejpeg($dst_img,$dst_url,$quality); # output the in-memory file to disk
        imagedestroy($dst_img); # free memory. important if you create many images at once
    }
function Thumbnail_w_h($src_url, $type, $src_name, $sUploadDir, $iWidth, $iHeight) 
    {
        $dst_path = $sUploadDir; 
        $dst_name = "$src_name";
        //$scale = 0.2;
        $quality = 100; # [0-100], 100 being max.
##########################################################################
        $dst_url = $dst_path.$dst_name;
        $src_size= getimagesize("$src_url");
        # calculate h and w for thumb:
        $dst_w=    $iWidth;//$src_size[0]*$scale;
        //$dst_h= $src_size[1]/$src_size[0]*$dst_w;//$scale;
		$dst_h= $iHeight;
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
            default:    echo "Chỉ được upload định dạng GIF, PNG, JPEG (JPG)! <input type=button value=\"Làm l?i\" onClick=\"javascript:history.go(-1);\">";
                    exit();
        }
        imagecopyresampled($dst_img,$src_img,0,0,0,0,$dst_w,$dst_h,ImageSX($src_img),ImageSY($src_img));
        imagejpeg($dst_img,$dst_url,$quality); # output the in-memory file to disk
        imagedestroy($dst_img); # free memory. important if you create many images at once
    }
	
function table_to_array1($table)
{
    $query_tmp=mysqli_query($connection,"SELECT * FROM $table order by id asc");//order by id DESC
	$i=mysqli_num_rows($query_tmp)-1;
	$array=array();
	while($r_tmp=mysqli_fetch_assoc($query_tmp))
	{
		$array[$i]=$r_tmp;
		$i--;
	}
    return $array;
}
function table_to_array2($table)
{
    $query_tmp=mysqli_query($connection,"SELECT * FROM $table");
	$i=0;
	$array=array();
	while($r_tmp=mysqli_fetch_assoc($query_tmp))
	{
		$array[$i]=$r_tmp;
		$i++;
	}
    return $array;
}
function table_to_array_dk($table,$dk,$gt_dk)
{
    $sql_tmp="SELECT * FROM $table WHERE $dk='".$gt_dk."' ORDER BY id asc";
	$query_tmp=mysqli_query($connection,$sql_tmp);
	$i=0;
	$array=array();
	while($r_tmp=mysqli_fetch_assoc($query_tmp))
	{
		$array[$i]=$r_tmp;
		$i++;
	}
    return $array;
}
function table_to_array_dksort($table,$dk,$gt_dk,$sort)
{
    $sql_tmp="SELECT * FROM $table WHERE $dk='".$gt_dk."' ORDER BY id ".$sort."";
	$query_tmp=mysqli_query($connection,$sql_tmp);
	$i=0;
	$array=array();
	while($r_tmp=mysqli_fetch_assoc($query_tmp))
	{
		$array[$i]=$r_tmp;
		$i++;
	}
    return $array;
}
function table_to_array_dknot($table,$dk,$gt_dk)
{
    $sql_tmp="SELECT * FROM $table WHERE $dk!='".$gt_dk."' order by id desc";
	$query_tmp=mysqli_query($connection,$sql_tmp);
	$i=0;
	$array=array();
	while($r_tmp=mysqli_fetch_assoc($query_tmp))
	{
		$array[$i]=$r_tmp;
		$i++;
	}
    return $array;
}
function table_to_array_2dk($table,$dk1,$gt_dk1,$dk2,$gt_dk2)
{
    $sql_tmp="SELECT * FROM $table WHERE $dk1='".$gt_dk1."' and $dk2='".$gt_dk2."' ORDER BY id asc";
	$query_tmp=mysqli_query($connection,$sql_tmp);
	$i=0;
	$array=array();
	while($r_tmp=mysqli_fetch_assoc($query_tmp))
	{
		$array[$i]=$r_tmp;
		$i++;
	}
    return $array;
}
//Goi trang
function call_pages($pages,$table)
{
	$a=table_to_array2($table);
	switch($pages)
	{
		case $a['0']['link']: $page=$a['0']['link']; break;
		case $a['1']['link']: $page=$a['1']['link']; break;
		case $a['2']['link']: $page=$a['2']['link']; break;
		case $a['3']['link']: $page=$a['3']['link']; break;
		case $a['4']['link']: $page=$a['4']['link']; break;
		case $a['5']['link']: $page=$a['5']['link']; break;
		case $a['6']['link']: $page=$a['6']['link']; break;
		case $a['7']['link']: $page=$a['7']['link']; break;
		case $a['8']['link']: $page=$a['8']['link']; break;
		case $a['9']['link']: $page=$a['9']['link']; break;
		case $a['10']['link']: $page=$a['10']['link']; break;
		case $a['11']['link']: $page=$a['11']['link']; break;
		case $a['12']['link']: $page=$a['12']['link']; break;
		case $a['13']['link']: $page=$a['13']['link']; break;
		case $a['14']['link']: $page=$a['14']['link']; break;
		case $a['15']['link']: $page=$a['15']['link']; break;
		case $a['16']['link']: $page=$a['16']['link']; break;
		case $a['17']['link']: $page=$a['17']['link']; break;
		case $a['18']['link']: $page=$a['18']['link']; break;
		case $a['19']['link']: $page=$a['19']['link']; break;
		case $a['20']['link']: $page=$a['20']['link']; break;
	}
	return $page;
}
//Function insert record to table
function insert_table($table,$field,$value,$connection)
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
	mysqli_query($connection,$sql_add_news) or die(mysqli_error());
}
/*Nhom ham kiem tra dang ky thanh vien
1- Ham kiem tra email
*/
function check_email($email) 
{
    if (strlen($email)== 0) 
		return false;
    if (eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$", $email)) 
		return true;
    return false;
}
/*Phan trang*/
function strpage($table,$limit)
{
	$qurry_pt=mysqli_query($connection,"SELECT * FROM $table");
	$record=mysqli_num_rows($qurry_pt);
	$num_page=$record/$limit;
	if($record%$limit!=0)
	{
		$num_page++;
	}
	$str="";
	for($i=1;$i<=$num_page;$i++)
	{
		$str.="&nbsp;<a href='index.php?pages=product&trang=".$i."'>".$i."</a>";
	}
	return $str;
}
function getElement($tbl_table,$element,$where,$id,$connection)
{
	$sql="Select $element from $tbl_table where $where='".$id."'";
	$kq=mysqli_query($connection,$sql) or die (mysqli_error());
	while($row=mysqli_fetch_array($kq)){
		//$element = $result[0];
			$element=$row["$element"];
		}
	mysqli_free_result($kq);
	return $element;
}
function seo_friendly_url($string){
    $string = str_replace(array('[\', \']'), '', $string);
    $string = preg_replace('/\[.*\]/U', '', $string);
    $string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $string);
    $string = htmlentities($string, ENT_COMPAT, 'utf-8');
    $string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string );
    $string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/') , '-', $string);
    return strtolower(trim($string, '-'));
}
function seo_friendly_url_blank($string){
    $string = str_replace(array('[\', \']'), '', $string);
    $string = preg_replace('/\[.*\]/U', '', $string);
    $string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', ' ', $string);
    $string = htmlentities($string, ENT_COMPAT, 'utf-8');
    $string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string );
    $string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/') , ' ', $string);
    return strtolower(trim($string, ' '));
}
?>