<?php

namespace ObjectIndexBundle;

use Doctrine\DBAL\Migrations\Version;
use Doctrine\DBAL\Schema\Schema;
use Pimcore\Extension\Bundle\Installer\MigrationInstaller;
use Pimcore\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;

class Installer extends MigrationInstaller
{
    /**
     *
     */
    protected function beforeInstallMigration()
    {
        $kernel = \Pimcore::getKernel();
        $application = new Application($kernel);
        $application->setAutoExit(false);
        $options = ['command' => 'coreshop:resources:install'];
        $options = array_merge($options, ['--no-interaction' => true, '--application-name object_index']);
        $application->run(new ArrayInput($options));

        $options = ['command' => 'doctrine:schema:update'];
        $options = array_merge($options, ['--no-interaction' => true, '--force' => true]);
        $application->run(new ArrayInput($options));
    }


    /**
     * {@inheritdoc}
     */
    public function migrateInstall(Schema $schema, Version $version)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function migrateUninstall(Schema $schema, Version $version)
    {

    }
}
