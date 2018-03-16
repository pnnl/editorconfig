<?php
/**
 * Created by PhpStorm.
 * User: will202
 * Date: 3/16/18
 * Time: 3:01 PM
 */

namespace Pnnl\EditorConfig\Task;


use GrumPHP\Task\Context\ContextInterface;
use GrumPHP\Task\TaskInterface;

class EditorConfig implements TaskInterface
{

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return "editorconfig";
    }

    /**
     * {@inheritdoc}
     */
    public function getConfigurableOptions()
    {
        // TODO: Implement getConfigurableOptions() method.
    }

    /**
     * {@inheritdoc}
     */
    public function getConfiguration()
    {
        // TODO: Implement getConfiguration() method.
    }

    /**
     * {@inheritdoc}
     */
    public function canRunInContext(ContextInterface $context)
    {
        // TODO: Implement canRunInContext() method.
    }

    /**
     * {@inheritdoc}
     */
    public function run(ContextInterface $context)
    {
        // TODO: Implement run() method.
    }
}
