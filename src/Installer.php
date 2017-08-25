<?php

namespace ObjectIndexBundle;

use Doctrine\DBAL\Migrations\Version;
use Doctrine\DBAL\Schema\Schema;
use Pimcore\Extension\Bundle\Installer\MigrationInstaller;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;

class Installer extends MigrationInstaller
{
    /**
     * {@inheritdoc}
     */
    protected function beforeInstallMigration()
    {
        $kernel = \Pimcore::getKernel();
        $application = new Application($kernel);
        $application->setAutoExit(false);
        $options = ['command' => 'doctrine:schema:update'];
        $options = array_merge($options, ['--no-interaction' => true, '--force' => true]);
        $application->run(new ArrayInput($options));

        $options = ['command' => 'cache:clear'];
        $options = array_merge($options, ['--no-warmup']);
        $application->run(new ArrayInput($options));
    }

    /**
     * {@inheritdoc}
     */
    public function migrateInstall(Schema $schema, Version $version)
    {
        //Nothing to do here
    }

    /**
     * {@inheritdoc}
     */
    public function migrateUninstall(Schema $schema, Version $version)
    {
        //Nothing to do here
    }
}
