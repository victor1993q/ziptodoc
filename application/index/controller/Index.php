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
//	//获取表单提交的压缩文件
//	$file = $_FILES['file'];
//	//获取文件名
//	$name = $file['name'];
//	//获取绝对路径
	$path = getcwd().'/';
	//定义文件保存路径
//	$filepath= $path.'uploads/'.$name;
//	//使用PHP函数移动文件
//	$res = move_uploaded_file($file['tmp_name'],$filepath);
	//实例化ZipArchive类
//	$zip = new \ZipArchive();
//	//打开压缩文件，打开成功时返回true
//	if ($zip->open($filepath) === true) {
	    //解压文件到获得的路径a文件夹下
//	    $zip->extractTo($path.'/zip/');
//	    //关闭
//	    $zip->close();
        $phpWord = new PhpWord();
        $section = $phpWord->addSection();
        $dir1 = scandir($path.'zip');
        $dirs = scandir($path.'zip/'.$dir1[2].'/合格');
        $images = [];
        for($i=2;$i<count($dirs);$i++){
            $images[] = $path.'zip/'.$dir1[2].'/合格/'.$dirs[$i];

            //添加文字内容
            $fontStyle = [
                'name' => 'Microsoft Yahei UI',
                'size' => ,
                'color' => '#ff6600',
                'bold' => true
            ];
            $textrun = $section->addTextRun();
//            var_dump($this->getName($dirs[$i])[0][0]);
            $textrun->addText($this->getName($dirs[$i])[0][0], $fontStyle);
            $section->addImage($path.'zip/'.$dir1[2].'/合格/'.$dirs[$i], array('width'=>64, 'height'=>64));
        }
//        die;

        $file = 'test.docx';
        header("Content-Description: File Transfer");
        header('Content-Disposition: attachment; filename="' . $file . '"');
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Expires: 0');
        $xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $xmlWriter->save("php://output");
//	} else {
//	    echo 'error';
//	}



    }


    public function test2()
    {
        $path = getcwd().'/';
        $phpWord = new PhpWord();
        $title = "标题";
        $num = 1;
        $mean = [];
        $section = $phpWord->addSection();
        //添加文字内容
        $fontStyle = [
            'name' => 'Microsoft Yahei UI',
            'size' => 20,
            'color' => '#ff6600',
            'bold' => true
        ];
        $textrun = $section->addTextRun();
        $textrun->addText('你好，这是生成的Word文档。 ', $fontStyle);
        //链接
        $section->addLink('https://www.baidu.com', '欢迎访问百度', array('color' => '0000FF', 'underline' => \PhpOffice\PhpWord\Style\Font::UNDERLINE_SINGLE));
        $section->addTextBreak();
        $file = 'test.docx';
        header("Content-Description: File Transfer");
        header('Content-Disposition: attachment; filename="' . $file . '"');
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Expires: 0');
        $xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $xmlWriter->save("php://output");


    }


    public function test3()
    {
        $title = "12317这张桌子33211";
        $return = $this->getName($title);
        var_dump($return);
    }

    private function getName($title) {
        preg_match_all("/[\x{4e00}-\x{9fa5}]+/u",$title,$regs);
        return $regs;
    }
}



