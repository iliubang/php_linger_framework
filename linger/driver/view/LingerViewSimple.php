<?php
/*
 |------------------------------------------------------------------
 | 简单的模板引擎
 |------------------------------------------------------------------
 | @author    : liubang
 | @date      : 2016/3/29 15:48
 | @copyright : (c) iliubang.cn
 | @license   : MIT (http://opensource.org/licenses/MIT)
 |------------------------------------------------------------------
 */
namespace linger\driver\view;

class LingerViewSimple extends LingerViewAbstract
{

        public function __construct()
        {
                parent::__construct();
        }

        /**
         * @param $tplFile
         * @param int $cacheTime
         * @param null $cachePath
         * @param string $contentType
         * @param bool $show
         * @throws \Exception
         * @return void
         */
        public function display($tplFile, $cacheTime = -1, $cachePath = NULL, $contentType = 'text/html', $show = TRUE)
        {
                \extract($this->vars, EXTR_OVERWRITE);
                $filePath = $this->tmplPath . '/' . $tplFile;
                if (\file_exists($filePath)) {
                        include $filePath;
                } else {
                        throw new \Exception('template file ' . $filePath . ' is not exists.');
                }
        }

        /**
         * @param        $tplFile
         * @param int    $cacheTime
         * @param null   $cachePath
         * @param string $contentType
         *
         * @return mixed
         */
        public function render($tplFile, $cacheTime = -1, $cachePath = NULL, $contentType = 'text/html')
        {
                \ob_start();
                $this->display($tplFile, $cacheTime, $cachePath, $contentType, FALSE);
                $html = \ob_get_contents();
                \ob_clean();
                return $html;
        }
}
