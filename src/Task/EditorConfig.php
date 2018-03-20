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
            'auto_fix'        => false,
            'dotfiles'        => false,
            'ignore_defaults' => false,
            'ignore_patterns' => [],
            'list_files'      => false,
            'triggered_by' => []
        ]);

        $resolver->addAllowedTypes('auto_fix', ['bool']);
        $resolver->addAllowedTypes('dotfiles', ['bool']);
        $resolver->addAllowedTypes('ignore_defaults', ['bool']);
        $resolver->addAllowedTypes('ignore_patterns', ['string[]']);
        $resolver->addAllowedTypes('list_files', ['bool']);
        $resolver->addAllowedTypes('triggered_by', ['string[]']);

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
        /** @var array $config */
        $config = $this->getConfiguration();
        /** @var array $ignorePatterns */
        $ignorePatterns = $config['ignore_patterns'];
        /** @var array $extensions */
        $extensions = $config['triggered_by'];

        /** @var \GrumPHP\Collection\FilesCollection $files */
        $files = $context->getFiles();

        // Remove files that should be ignored
        if (0 !== count($ignorePatterns)) {
            $files = $files->notPaths($ignorePatterns);
        }

        // Check only files with particular extensions
        if (0 !== count($extensions)) {
            $files = $files->extensions($extensions);
        }

        if (0 === count($files)) {
            return TaskResult::createSkipped($this, $context);
        }

        $arguments = $this->processBuilder->createArgumentsForCommand('editorconfig-checker');
        $arguments = $this->addArgumentsFromConfig($arguments, $config);
        $arguments->addFiles($files);

        $process = $this->processBuilder->buildProcess($arguments);
        $process->run();

        if (!$process->isSuccessful()) {
            return TaskResult::createFailed($this, $context,
                $this->formatter->format($process));
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

        return $arguments;
    }
}
