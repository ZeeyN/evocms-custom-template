<?php

namespace EvolutionCMS\EvoCustom\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class EvoCustomTemplateCommand extends Command
{
    protected $signature   = 'ect:install';

    protected $description = 'Configure after install/update';

    protected $evo;

    public    $directory   = EVO_CORE_PATH . 'custom/config/cms/settings/';

    public    $fileName    = 'EvoCustomTemplateNamespace.php';

    public function __construct()
    {
        parent::__construct();
        $this->evo      = EvolutionCMS();
        $this->fileName = $this->directory . $this->fileName;
    }

    public function handle()
    {
        if (File::isFile($this->fileName)) {
            $name = $this->askRewrite();
        } else {
            $name = 'y';
        }

        if (strtolower($name) == 'y') {
            $namespace =
                $this->ask('Please enter your package namespace? (Like: EvolutionCMS\\\\Example\\\\Controllers\\\\)');
            if (!File::isDirectory($this->directory)) {
                File::makeDirectory($this->directory, 0755, true);
            }
            File::put($this->fileName, '<?php return "' . $namespace . '";');
        }
    }

    public function askRewrite()
    {
        $answer = $this->ask('Config namespace already exist, do you wish rewrite? (Y/N)');
        if (strtolower($answer) != 'y' && strtolower($answer) != 'n') {
            return $this->askRewrite();
        } else {
            return $answer;
        }
    }
}