# OcrPHP
## description
a simple and beautiful ocr php library which can easily recognize the image to text depend on tesseract-ocr (
一个简洁优雅的图像识别转换文字的php类库, 须安装`tesseract-ocr`)

## useage
[english document](https://github.com/fizzday/OcrPHP)  
[中文文档](https://github.com/fizzday/OcrPHP/blob/master/README-zh_cn.md)
### install with composer 
```
{
    "require": {
        "fizzday/ocrphp": "dev-master"
    }
}
```
or
```
composer require fizzday/ocrphp
```
> notice : before recognize , you need install the tesseract engine, which can find in my blog ...

### recognize  
```
use OcrPHP;

OcrPHP::file($file)->run();

// or

OcrPHP::file($file)->lang($lang)->psm($psm)->run($type);
```
it shell like :
```
OcrPHP::file('/var/www/img/test.jpg')->lang('eng')->run();

// or

OcrPHP::file('/var/www/img/test.jpg')->lang(['eng', 'chi_sim'])->psm(3)->run('id');
```
> comment  

- `$file` -- the source file in local
- `$lang` -- the recognize language , like english(eng), chinese(chi_sim or chi_tra) ......
- `$psm`  -- the reconize type default 3
- `$type` -- the Specific results like id_num, business card ......  which can return the info you need directly, default null, thie library have offered the id_num return , you just need the 'id' param in run() func



