<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2018/5/9
 * Time: 15:57
 */

$dst_path = '1.jpg';
$src_path = '2.jpg';
//创建图片的实例
$dst = imagecreatefromstring(file_get_contents($dst_path));
$src = imagecreatefromstring(file_get_contents($src_path));
//获取水印图片的宽高
list($src_w, $src_h) = getimagesize($src_path);
//将水印图片复制到目标图片上，最后个参数50是设置透明度，这里实现半透明效果
imagecopymerge($dst, $src, 10, 10, 0, 0, $src_w, $src_h, 50);
//如果水印图片本身带透明色，则使用imagecopy方法
//imagecopy($dst, $src, 10, 10, 0, 0, $src_w, $src_h);
//输出图片
list($dst_w, $dst_h, $dst_type) = getimagesize($dst_path);

$info = getimagesize($dst_path);//获取图片信息
$type = image_type_to_extension($info[2], false);//通过编号获取图像类型
$fun = "image" . $type;
//-----在浏览器中输出图片
header("Content-type:".$info['mime']);
$fun($dst);//在浏览器中输出图片
//------end
$fun($dst,'3.'.$type); //保存图片

//销毁
imagedestroy($dst);
imagedestroy($src);