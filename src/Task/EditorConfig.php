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
        $resolver = new OptionsResolver();
        $resolver->setDefaults([
            'check_patterns'  => ['*'],
            'exclude'         => '.idea',
            'auto_fix'        => false,
            'dotfiles'        => false,
            'ignore_defaults' => false,
            'list_files'      => false,
        ]);

        $resolver->addAllowedTypes('check_patterns', ['string[]']);
        $resolver->addAllowedTypes('exclude', ['string']);
        $resolver->addAllowedTypes('auto_fix', ['bool']);
        $resolver->addAllowedTypes('dotfiles', ['bool']);
        $resolver->addAllowedTypes('ignore_defaults', ['bool']);
        $resolver->addAllowedTypes('list_files', ['array']);

        return $resolver;
    }

    /**
     * {@inheritdoc}
     */
    public function canRunInContext(ContextInterface $context)
    {
        return ($context instanceof GitPreCommitContext || $context instanceof RunContext);
    }

    /**
     * {@inheritdoc}
     *
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function run(ContextInterface $context)
    {
        $config = $this->getConfiguration();
        /** @var array $check_patterns */
        $check_patterns = $config['check_patterns'];

        /** @var \GrumPHP\Collection\FilesCollection $files */
        $files = $context->getFiles();
        if (0 !== count($check_patterns)) {
            $files = $files->paths($check_patterns);
        }
        $files = $files->extensions(["*"]);

        if (0 === count($files)) {
            return TaskResult::createSkipped($this, $context);
        }

        $arguments = $this->processBuilder->createArgumentsForCommand($this->getName());
        $arguments = $this->addArgumentsFromConfig($arguments, $config);
        $arguments->addFiles($files);

        $process = $this->processBuilder->buildProcess($arguments);
        $process->run();

        if (!$process->isSuccessful()) {
            $output = $process->getErrorOutput();
            return TaskResult::createFailed($this, $context, $output);
        }

        return TaskResult::createPassed($this, $context);
    }

    /**
     * @param ProcessArgumentsCollection $arguments
     *
     * @param array                      $config
     *
     * @return ProcessArgumentsCollection
     */
    protected function addArgumentsFromConfig(
        ProcessArgumentsCollection $arguments,
        array $config
    ) {
        $arguments->addOptionalArgument('--auto-fix', $config['auto_fix']);

        $arguments->addOptionalArgument('--dotfiles', $config['dotfiles']);
        $arguments->addOptionalArgument(
            '--ignore-defaults',
            $config['ignore_defaults']
        );
        $arguments->addOptionalArgument('--list-files', $config['list_files']);
        $arguments->addArgumentArrayWithSeparatedValue(
            '--exclude',
            $config['exclude']
        );

        return $arguments;
    }
}
