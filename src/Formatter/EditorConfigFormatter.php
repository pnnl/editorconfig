<?php
/**
 * Created by PhpStorm.
 * User: will202
 * Date: 3/16/18
 * Time: 4:34 PM
 */

namespace Pnnl\EditorConfig\Formatter;

use GrumPHP\Formatter\ProcessFormatterInterface;
use Symfony\Component\Process\Process;

class EditorConfigFormatter implements ProcessFormatterInterface
{

    /**
     * {@inheritdoc}
     */
    public function format(Process $process)
    {
        return $process->getOutput();
    }
}
