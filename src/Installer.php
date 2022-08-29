<?php

namespace AmphiBee\LaravelPintPreCommit;

class Installer
{
    const FETCH_URL = "https://gist.githubusercontent.com/JanniGrabe/c3e3e8989e13c0ec5062bd29befbeef7/raw/5423507c4837525a3e72b0a12c6039923ccb55c8/pre-commit.sh";

    public function install()
    {

        if (!$this->checkGitHookDir())
        {
            throw new \Exception("Not a git repository");
        }
        else
        {
            copy(Installer::FETCH_URL, $this->getGitHookDir() . DIRECTORY_SEPARATOR . 'pre-commit');
            shell_exec("chmod +x " . $this->getGitHookDir() . DIRECTORY_SEPARATOR . 'pre-commit');
        }
    }

    private function getGitHookDir()
    {
        $currentDir = dirname(__FILE__);
        $projectDir = $currentDir . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..'
            . DIRECTORY_SEPARATOR . '..';
        return $projectDir . DIRECTORY_SEPARATOR . '.git' . DIRECTORY_SEPARATOR . 'hooks';
    }

    private function checkGitHookDir()
    {
        return is_dir($this->getGitHookDir());
    }
}
