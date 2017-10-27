<?php

/**
 * This is project's console commands configuration for Robo task runner.
 *
 * @see http://robo.li/
 */
class RoboFile extends \Robo\Tasks
{
    public function watchPackage(): void
    {
        $this->taskWatch()
            ->monitor(['app', 'resources', 'routes'], function () {
                $this->say('Starting package publish...');
                $result = $this->taskExecStack()
                    ->stopOnFail()
                    ->exec('php artisan clear-compiled')
                    ->exec('php artisan cache:clear')
                    ->exec('php artisan route:clear')
                    ->exec('php artisan view:clear')
                    ->exec('php artisan config:clear')
                    ->exec('composer dump-autoload')
                    ->run();

                if ($result->wasSuccessful()) {
                    $this->say('Published successfully.');
                } else {
                    $this->say('There were errors while publishing. Message: ' . $result->getMessage());
                }
            })->run();
    }
}