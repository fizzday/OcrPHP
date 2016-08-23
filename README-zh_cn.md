# OcrPHP
## describe
a simple and beautiful ocr php library which is using for recognize image to text depend on tesseract-ocr (
一个简洁优雅的图像识别转换文字的php类库, 须安装`tesseract-ocr`)

## 使用介绍
[english document](https://github.com/fizzday/OcrPHP)  
[中文文档](https://github.com/fizzday/OcrPHP/blob/master/README-zh_cn.md)
### 使用 composer 安装
```
{
    "require": {
        "fizzday/ocrphp": "dev-master"
    }
}
```
或者
```
composer require fizzday/ocrphp
```
> 注意: 使用之前必须先安装 `tesseract`, 安装方法见我的博客

### 开始使用  
```
use OcrPHP;

OcrPHP::file($file)->run();

// or

OcrPHP::file($file)->lang($lang)->psm($psm)->run($type);
```
将会是这样的 :
```
OcrPHP::file('/var/www/img/test.jpg')->lang('eng')->run();

// or

OcrPHP::file('/var/www/img/test.jpg')->lang(['eng', 'chi_sim'])->psm(3)->run('id');
```
> 说明  

- `$file` -- 本地图片源文件
- `$lang` -- 要识别的语言, 如 英语(eng), 汉语(chi_sim(简体) or chi_tra(繁体)) ......
- `$psm`  -- 识别类型默认为3
- `$type` -- 自定义识别输出的结果, 比如自定义身份证号码, 名片相关信息, 本类提供了身份证号码的输出('id'), 默认为空, 返回完全输出信息


