<?php

namespace Themosis\Core\Console;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class ConsoleMakeCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    //protected $signature = 'make:command {name : The name of the command.} {--command=command:name : The terminal command that should be assigned.} {--load-wordpress : Load Wordpress functions into the command.}';

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new console command';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Console command';

    /**
     * Return the stub file path.
     *
     * @return string
     */
    protected function getStub()
    {
        dump($this->getOptions());
        dump($this->getArguments());
        if ($this->option('load-wordpress')) {
            return __DIR__.'/stubs/console-wordpress.stub';
        } else {
            return __DIR__.'/stubs/console.stub';
        }
    }

    /**
     * Replace the class name for the given stub.
     *
     * @param string $stub
     * @param string $name
     *
     * @return string
     */
    protected function replaceClass($stub, $name)
    {
        $stub = parent::replaceClass($stub, $name);

        return str_replace('dummy:command', $this->option('command'), $stub);
    }

    /**
     * Return the default namespace for the class.
     *
     * @param string $rootNamespace
     *
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Console\Commands';
    }

    /**
     * Return the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the command.']
        ];
    }

    /**
     * Return the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            [
                'command',
                null,
                InputOption::VALUE_OPTIONAL,
                'The terminal command that should be assigned.',
                'command:name'
            ],
            [
                'load-wordpress',
                null,
                InputOption::VALUE_NONE,
                'Load Wordpress functions into the command.'
            ]
        ];
    }
}
