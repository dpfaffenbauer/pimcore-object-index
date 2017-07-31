<?php

namespace ObjectIndexBundle\Installer;

use Pimcore\Db;
use Pimcore\Extension\Bundle\Installer\AbstractInstaller;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;

class PimcoreInstaller extends AbstractInstaller
{
    /**
     * {@inheritdoc}
     */
    public function install()
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
    public function uninstall()
    {
    }

    /**
     * {@inheritdoc}
     */
    public function isInstalled()
    {
        return Db::get()->getSchemaManager()->tablesExist(['coreshop_index']);
    }

    /**
     * {@inheritdoc}
     */
    public function canBeInstalled()
    {
        return !$this->isInstalled();
    }

    /**
     * {@inheritdoc}
     */
    public function canBeUninstalled()
    {
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function needsReloadAfterInstall()
    {
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function canBeUpdated()
    {
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function update()
    {
        //InstallHelper::runDoctrineOrmSchemaUpdate();
    }
}
