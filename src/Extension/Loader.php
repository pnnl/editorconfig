<?php
/**
 * Created by PhpStorm.
 * User: will202
 * Date: 3/16/18
 * Time: 2:39 PM
 */

namespace Pnnl\EditorConfig\Extension;

use GrumPHP\Extension\ExtensionInterface;
use Pnnl\EditorConfig\Formatter\EditorConfigFormatter;
use Pnnl\EditorConfig\Task\EditorConfig;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class Loader implements ExtensionInterface
{

    /**
     * {@inheritdoc}
     */
    public function load(ContainerBuilder $container)
    {
        // Create appropriate dependency injection
        // Create Formatter
        $container->register('formatter.editorconfig', EditorConfigFormatter::class);

        // Create the EditorConfig task
        $container->register('task.editorconfig', EditorConfig::class)
            ->addArgument($container->get('config'))
            ->addArgument($container->get("process_builder"))
            ->addArgument($container->get('formatter.editorconfig'))
            ->addTag('grumphp.task', ['config' => 'editorconfig']);
    }
}
