<?php
/**
 * Created by PhpStorm.
 * User: weidada
 * Date: 2018/5/9
 * Time: 15:57
 */

//---------------文字

/*打开图片*/
//1.配置图片路径  $src = "1.jpg";
$src = '1.jpg';
//2.获取图片信息
$info = getimagesize($src);
//3.通过编号获取图像类型
$type = image_type_to_extension($info[2], false);
//4.在内存中创建和图像类型一样的图像
$fun = "imagecreatefrom" . $type;
//5.图片复制到内存
$image = $fun($src);

/*操作图片*/
//1.设置字体的路径
$font = "msyh.ttf";
//2.填写水印内容
$content = "水印内容";
//3.设置字体颜色和透明度
$color = imagecolorallocatealpha($image, 50, 50, 50, 50);
//4.写入文字
// 画布资源 字体大小 旋转角度 x轴 y轴 字体颜色 字体文件 需要渲染的字符串
imagettftext($image, 30, 0, 10, 30, $color, $font, $content);

/*输出图片*/
//浏览器输出头
//header("Content-type:".$info['mime']);
$fun = "image" . $type;
// $fun($image);//在浏览器中输出图片

//添加水印之后的图片  图片路径名称
$fun($image, '4.'.$type); //保存图片
/*销毁图片*/
imagedestroy($image);


//-------------------图片水印

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