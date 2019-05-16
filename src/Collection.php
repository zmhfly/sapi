<?php
/**
 * @author: zmh
 * @date: 2019-05-16
 */
namespace Zmhfly\Sapi;

/**
 * 解析
 * @package Zmhfly\Sapi
 */
class Collection
{
    /**
     * @var Controller[]
     */
    public $controllers = [];
    public $classMap = [];

    /**
     * 1、解析控制器
     * 2、解析方法
     * 3、解析注释
     */
    public function __construct($path)
    {
        if (is_string($path)) {
            $path = [$path];
        }
        foreach ($path as $item) {
            $this->scanner($item);
        }
    }

    /**
     * 扫描Controller目录
     *
     * @param string $path
     */
    private function scanner($path)
    {
        $length = strlen($path);
        $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path), \RecursiveIteratorIterator::SELF_FIRST);
        /**
         * @var \SplFileInfo $info
         */
        foreach ($iterator as $info) {
            // 1. 忽略目录
            if ($info->isDir()) {
                continue;
            }
            // 2. 忽然非Controller文件
            $name = $info->getFilename();
            if (preg_match("/^[_a-zA-Z0-9]+Controller\.php$/", $name) === 0) {
                continue;
            }
            // 3. 读取类名
            $class = '\\App\\Controllers\\'.substr($info->getPathname(), $length + 1, -4);
            $this->classMap[] = $class;
        }
    }
}