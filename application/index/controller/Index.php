<?php
namespace app\index\controller;

use PhpOffice\PhpWord\PhpWord;

class Index
{
    public function index()
    {
        return '<style type="text/css">*{ padding: 0; margin: 0; } .think_default_text{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p> ThinkPHP V5<br/><span style="font-size:30px">十年磨一剑 - 为API开发设计的高性能框架</span></p><span style="font-size:22px;">[ V5.0 版本由 <a href="http://www.qiniu.com" target="qiniu">七牛云</a> 独家赞助发布 ]</span></div><script type="text/javascript" src="https://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script><script type="text/javascript" src="https://e.topthink.com/Public/static/client.js"></script><think id="ad_bd568ce7058a1091"></think>';
    }
    
    public function test()
    {
	//获取表单提交的压缩文件
	//$file = $_FILES['file'];
	//获取文件名
	//$name = $file['name'];
	//获取绝对路径
	$path = getcwd().'/';
	//定义文件保存路径
	//$filepath= $path.'uploads/'.$name;
	//使用PHP函数移动文件
	//$res = move_uploaded_file($file['tmp_name'],$filepath);
	//实例化ZipArchive类
	//$zip = new \ZipArchive();
	//打开压缩文件，打开成功时返回true
	//if ($zip->open($filepath) === true) {
	    //解压文件到获得的路径a文件夹下
	//    $zip->extractTo($path.'/zip/');
	    //关闭
	//    $zip->close();
	//    echo 'ok';
	//} else {
	//    echo 'error';
	//}
	$dir1 = scandir($path.'zip');
	$dirs = scandir($path.'zip/'.$dir1[2].'/合格');
	$images = [];
	for($i=2;$i<count($dirs);$i++){
	    $images[] = $path.'zip/'.$dir1[2].'/合格/'.$dirs[$i];
	}
	var_dump($images);die;

    }


    public function test2()
    {
        $path = getcwd().'/';
        $phpWord = new PhpWord();
        $title = "标题";
        $num = 10;
        $mean = "测试11";
        $section = $phpWord->addSection();
        $phpWord->addTitleStyle(2, array('bold' => true, 'size' => 14, 'name' => 'Arial', 'Color' => '333'), array('align' => 'center'));
        $section->addTitle("$title", 2);
        $section->addTextBreak(1);
        $section->addText("姓名：                                                    题量： $num                                                    分数：          ");
        $tableStyle = array(
            'borderSize' => 6,
            'borderColor' => '006699'
        );
        $table = $section->addTable($tableStyle);
        $fancyTableCellStyle = array('valign' => 'center');
        $cellRowSpan = array('vMerge' => 'restart', 'valign' => 'center');
        $cellRowContinue = array('vMerge' => 'continue');
        $fontStyle['name'] = 'Arial';
        $fontStyle['size'] = 14;
        $thStyle['name'] = 'Arial';
        $thStyle['size'] = 12;
        $thStyle['bold'] = true;
        $paraStyle['align'] = 'center';
        $table->addRow(500);
        $table->addCell(3500, $fancyTableCellStyle)->addText('答题区', $thStyle, $paraStyle);
        $table->addCell(1000, $fancyTableCellStyle)->addText('批改区', $thStyle, $paraStyle);
        $table->addCell(3500, $fancyTableCellStyle)->addText('答题区', $thStyle, $paraStyle);
        $table->addCell(1000, $fancyTableCellStyle)->addText('批改区', $thStyle, $paraStyle);
        $len = ceil($num / 2);
        for ($i = 0; $i < $len; $i++) {
            $table->addRow(500);
            $table->addCell(3500, $fancyTableCellStyle)->addText(($i * 2 + 1) . '.' . $mean[$i * 2], $fontStyle);
            $table->addCell(1000, $cellRowSpan)->addText(' ');
            if ($num % 2 != 0 && $i == $len - 1) {
                $table->addCell(3500, $fancyTableCellStyle)->addText('');
            } else {
                $table->addCell(3500, $fancyTableCellStyle)->addText(($i * 2 + 2) . '.' . $mean[$i * 2 + 1], $fontStyle);
            }
            $table->addCell(1000, $cellRowSpan)->addText(' ');
            $table->addRow(1000);
            $table->addCell(3500, $fancyTableCellStyle)->addText('答案:');
            $table->addCell(null, $cellRowContinue);
            if ($num % 2 != 0 && $i == $len - 1) {
                $table->addCell(3500, $fancyTableCellStyle)->addText('');
            } else {
                $table->addCell(3500, $fancyTableCellStyle)->addText('答案:');
            }

            $table->addCell(null, $cellRowContinue);
        }
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save("./Public/doc/word.docx");
    }

}



