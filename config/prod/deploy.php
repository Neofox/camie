<?php

use App\BetterDeployer;

return new class extends BetterDeployer
{
    public function configure()
    {
        return $this->getConfigBuilder()
            // SSH connection string to connect to the remote server (format: user@host-or-IP:port-number)
            ->server('ubuntu@51.68.87.113')
            ->deployDir('/var/www/camie')
            ->repositoryUrl('git@github.com:Neofox/camie.git')
            ->repositoryBranch('master')
            ->composerInstallFlags('--prefer-dist --no-interaction --no-dev')
        ;
    }

    // run some local or remote commands before the deployment is started
    public function beforeStartingDeploy()
    {
        $this->runLocal('./vendor/bin/simple-phpunit');
    }

    // run some local or remote commands after the deployment is finished
    public function beforeFinishingDeploy()
    {
        // $this->runRemote('{{ console_bin }} app:my-task-name');
        // $this->runLocal('say "The deployment has finished."');
    }
};
