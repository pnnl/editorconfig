<?php
/**
 * Created by PhpStorm.
 * User: will202
 * Date: 3/16/18
 * Time: 2:39 PM
 */

namespace Pnnl\EditorConfig\Extension;

use GrumPHP\Extension\ExtensionInterface;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class Loader implements ExtensionInterface
{

    /**
     * {@inheritdoc}
     */
    public function load(ContainerBuilder $container)
    {
        // Load extension configuration
        $location = __DIR__ . "/../../resources/config/";
        $locator = new FileLocator($location);
        $loader = new YamlFileLoader($container, $locator);
        $loader->load("formatters.yml");
        $loader->load("tasks.yml");
    }
}
