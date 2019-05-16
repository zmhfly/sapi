<?php
/**
 * @author: zmh
 * @date: 2019-05-16
 */
set_time_limit(0);
date_default_timezone_set('PRC');
$rootPath = rootPath();
 require_once $rootPath."/vendor/autoload.php";

use \Symfony\Component\Console\Input\InputArgument;
use \Symfony\Component\Console\Input\InputInterface;
use \Symfony\Component\Console\Output\OutputInterface;
use \Symfony\Component\Console\Application;
use Zmhfly\Sapi\Collection;

function rootPath()
{
    return getcwd();
}

new Collection([
    "/Users/zong/yaolian/临时文件夹，里面内容可随时清空/zzz/liyang/config\app\Controllers"
]);
exit();


class demoApplication extends Application
{
    /**
     * Gets the name of the command based on input. 基于input得到命令的名字
     *
     * @param InputInterface $input The input interface
     *
     * @return string The command name
     */
    protected function getCommandName(InputInterface $input)
    {
        // This should return the name of your command. 这里返回你命令的名字
        return 'my_command';
    }

    /**
     * Gets the default commands that should always be available.
     * 取得默认命令，它应该是永远可用的
     * @return array An array of default Command instances
     */
    protected function getDefaultCommands()
    {
        // Keep the core default commands to have the HelpCommand
        // which is used when using the --help option
        // 保留核心的默认命令以便拥有HelpCommand，在用户使用--help选项时会用到
        $defaultCommands = parent::getDefaultCommands();
        $defaultCommands[] = new demo();
        return $defaultCommands;
    }

    /**
     * Overridden so that the application doesn't expect the command
     * name to be the first argument.
     * 覆写之，以便程序不再预期这个命令的名字作为第一个参数
     */
    public function getDefinition()
    {
        $inputDefinition = parent::getDefinition();
        // clear out the normal first argument, which is the command name
        // 去除通常情况下的第一个参数，也就是命令的名字
        $inputDefinition->setArguments();
        return $inputDefinition;
    }
}

class demo extends \Symfony\Component\Console\Command\Command
{
    protected function configure()
    {

        $this// 命令的名称 （"php console_command" 后面的部分）
            ->setName('my_command')// 运行 "php console_command list" 时的简短描述
            ->setDescription('Create new model')// 运行命令时使用 "--help" 选项时的完整命令描述
            ->setHelp('This command allow you to create models...')// 配置一个参数
//            ->addArgument('name', InputArgument::REQUIRED, 'what\'s model you want to create ?')// 配置一个可选参数
//            ->addArgument('optional_argument', InputArgument::OPTIONAL, 'this is a optional argument')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // 你想要做的任何操作
//        $optional_argument = $input->getArgument('optional_argument');
//        $output->writeln('creating...');
//        $output->writeln('created '.$input->getArgument('name').' model success !');
//        if ($optional_argument) {
//            $output->writeln('optional argument is '.$optional_argument);
//        }
//        $config = require_once rootPath()."/config/sapi.php";
//        $envConfig = isset($config[$this->getEnv()]) ?:[];
//        $collection = new \Zmhfly\Sapi\Collection($config['controllerPath']);
        $output->writeln('the end.');
    }
    protected function getEnv(){
        return 'development';
    }
}

$console = new demoApplication();
$console->run();