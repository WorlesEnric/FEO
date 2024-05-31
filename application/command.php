<?php
namespace app\home\command;
use think\console\Command;
use think\console\Input;
use think\console\Output;
class Test extends Command
{
    protected function configure()
    {
        $this->setName('test')->setDescription('Here is the remark ');
    }
    protected function execute(Input $input, Output $output)
    {
        $schedule = new Scheduletask();
            $schedule -> run();
        $output->writeln("TestCommand:");
    }
}
1
2
3
4
5
6
7
8
9
10
11
12
13
14
15
16
17
18