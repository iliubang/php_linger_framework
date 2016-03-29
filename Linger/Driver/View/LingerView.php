<?php
/*
 |------------------------------------------------------------------
 | linger.iliubang.cn
 |------------------------------------------------------------------
 | @author    : liubang 
 | @date      : 16/3/28 下午10:14
 | @copyright : (c) iliubang.cn
 | @license   : MIT (http://opensource.org/licenses/MIT)
 |------------------------------------------------------------------
 */

namespace Linger\Driver\View;
use Linger\Linger;

class LingerView
{
    private $vars = [];

    private $const = [];

    private $tplFile = '';

    private $compileFile = '';

    public function display($tplFile = '', $cacheTime = -1, $cachePath = '', $contentType = 'text/html', $show=true)
    {
        $cacheName = md5($_SERVER['REQUEST_URI']);
        $cacheTime = is_numeric($cacheTime) ? $cacheTime : intval(Linger::C('TPL_CACHE_TIME'));
        $cachePath = !empty($cachePath) ? $cachePath : Linger::C('TPL_CACHE_PATH');
        $content = null;
        if ($cacheTime > 0) {

        }

        if (!$content) {
            $this->tplFile = $this->getTemplateFile($tplFile);
            if (!$this->tplFile) {
                return;
            }
            $this->compileFile = Linger::C('TPL_COMP_PATH') . MODULE . '/' . CONTROLLER . '/' . ACTION . '_' . substr(md5($this->tplFile), 0, 8);
            $this->compile();
            if (!empty($this->vars)) {
                extract($this->vars, EXTR_OVERWRITE);
            }
            ob_start();
            include $this->compileFile;
            $content = ob_get_clean();
            if ($cacheTime > 0) {

            }

            if ($show) {
                $charset = Linger::C('TPL_CHARSET') ? Linger::C('TPL_CHARSET') : 'UTF-8';
                if (!headers_sent()) {
                    header("Content-Type: {$contentType}; charset={$charset}");
                }
                echo $content;
            } else {
                return $content;
            }
        }
    }

    public function render($tplFile = '', $cacheTime = -1, $cachePath = '', $contentType = 'text/html')
    {
        return $this->display($tplFile, $cacheTime, $cachePath, $contentType, false);
    }

    public function assign(string $name, $value)
    {
        $this->vars[$name] = $value;
    }

    private function compile()
    {
        if ($this->compileInvallid()) {
            return false;
        }
        $compiler = new LingerCompiler();
        $compiler->run($this);
    }

    public function compileInvallid()
    {
        //TODO ...
        return true;
    }

    public function getTmpFile()
    {
        return $this->tplFile;
    }
    
    public function getCompileFile()
    {
        return $this->compileFile;
    }
}