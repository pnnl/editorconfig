<?php
/**
 * Created by PhpStorm.
 * User: will202
 * Date: 3/16/18
 * Time: 3:01 PM
 */

namespace Pnnl\EditorConfig\Task;

use GrumPHP\Collection\ProcessArgumentsCollection;
use GrumPHP\Runner\TaskResult;
use GrumPHP\Task\AbstractExternalTask;
use GrumPHP\Task\Context\ContextInterface;
use GrumPHP\Task\Context\GitPreCommitContext;
use GrumPHP\Task\Context\RunContext;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditorConfig extends AbstractExternalTask
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
