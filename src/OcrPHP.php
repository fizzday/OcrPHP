<?php
namespace Fizzday\OcrPHP;

/**
 * Class OcrPHP
 * 图像识别转换文字类
 * @author fizz
 * @email <864759073@qq.com>
 * @time 2016-08-18
 * @package Fizzday\OcrPHP
 *
 * @usage OcrPHP::file('/var/www/img/test.jpg')->lang(['eng', 'ch_sim'])->psm(3)->run('id');
 */

class OcrPHP
{
    /**
     * 要识别的图片
     * @var string
     */
    protected static $file    = '';

    /**
     * 识别结果缓存目录
     * @var string
     */
    protected static $cacheDir = __DIR__.'/cache/';

    /**
     * 识别对象的语言, 如: [eng, ch_sim, ch_tra]
     * @var array
     */
    protected static $lang = [];

    /**
     * 识别的列表划分, 系统默认为3
     * @var string
     */
    protected static $psm = '';

    /**
     * 需要的最终结果
     * @var string
     */
    protected static $result = '';

    /**
     * 执行识别
     * @param string $type
     * @return string
     */
    public static function run($type='')
    {
        // 执行识别
        static::recognize();

        if (!empty($type)) {
            // 判断返回的事物对象
            static::checkType($type);
        }

        // 取出结果
        $result = static::$result;

        // 初始化
        static::reset();

        // 返回结果
        return $result;
    }

    /**
     * 设置图像源
     * @param string $file
     * @return bool|static
     */
    public static function file($file='')
    {
        if (empty($file)) return false;

        if (!file_exists($file)) return false;

        static::$file = $file;

        return new static();
    }

    /**
     * 设置识别结果缓存目录(注意要可写)
     * @param string $cacheDir
     * @return bool|static
     */
    public static function cacheDir($cacheDir='')
    {
        if (empty($cacheDir)) return false;

        if (!is_dir($cacheDir)) return false;

        static::$cacheDir = rtrim($cacheDir, '/').'/';

        return new static();
    }

    /**
     * 设置识别对象的语言
     * @param string $lang
     */
    public static function lang($lang='')
    {
            if (is_array($lang)) {
                static::$lang = array_merge(static::$lang, $lang);
            } else {
                array_push(static::$lang, $lang);
            }
    }

    /**
     * 设置识别类型
     * @param $psm
     */
    public static function psm($psm)
    {
        static::$psm = $psm;
    }

    /**
     * 系统提供的一些文件输出结果, 如身份证号码
     * @param string $type
     * @return static
     */
    protected static function checkType($type='')
    {
        // 取出原始识别结果
        $data = static::$result;

        // 根据不同的返回类型, 做相应处理
        switch ($type) {
            // 身份证号码
            case 'id':
                preg_match('/[\d]{14,17}[\d|X]{1}/', str_replace(' ', '', $data), $matches);
                // 取出号码
                static::$result = $matches[0];
                break;
        }

        return new static();
    }

    /**
     * 执行识别出内容
     * @return static
     */
    protected static function recognize()
    {
        $cmd = "tesseract ";

        // 检查参数
        if (!empty(static::$lang)) {
            $cmd .= "-l ".join(" ", static::$lang);
        }
        if (!empty(static::$psm)) {
            $cmd .= "-psm ".static::$psm;
        }

        // 临时文件名字
        static::$cacheDir = static::$cacheDir.mt_rand(100000, 999999);

        // 执行识别
        system($cmd." ".static::$file." ".static::$cacheDir);

        // 保存结果
        static::$result = file_get_contents(static::$cacheDir.'.txt');

        return new static();
    }

    /**
     * 初始化操作
     */
    protected static function reset()
    {
        unlink(static::$cacheDir.'.txt');
        static::$file    = '';
        static::$cacheDir = __DIR__.'/cache/';
        static::$lang = [];
        static::$psm = '';
        static::$result = '';
    }

}

