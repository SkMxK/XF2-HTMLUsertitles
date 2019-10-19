<?php

namespace SkMxK\HTMLTitles;

use XF\AddOn\AbstractSetup;
use XF\AddOn\StepRunnerInstallTrait;
use XF\AddOn\StepRunnerUninstallTrait;
use XF\AddOn\StepRunnerUpgradeTrait;
use XF\Db\Schema\Alter;

class Setup extends AbstractSetup
{
	use StepRunnerInstallTrait;
	use StepRunnerUpgradeTrait;
	use StepRunnerUninstallTrait;

    public function installStep1()
    {
        $this->schemaManager()->alterTable('xf_user', function(Alter $table) {
            $table->addColumn('custom_title_type', 'enum')->values(['user_set','admin_set'])->setDefault('user_set');
        });
    }

    public function uninstallStep1()
    {
        $this->schemaManager()->alterTable('xf_user', function(Alter $table) {
            $table->dropColumns('custom_title_type');
        });
    }
}