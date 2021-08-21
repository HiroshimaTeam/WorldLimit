<?php

namespace Refaltor\WorldLimit\Commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;
use Refaltor\WorldLimit\Traits\WorldLimitTrait;
use Refaltor\WorldLimit\WorldLimit;

class Reload extends Command
{
    use WorldLimitTrait;

    public $worldLimit;

    public function __construct(WorldLimit $worldLimit)
    {
        parent::__construct('reloadconfig', 'Reload the plugin config.');
        $this->setPermissionMessage(TextFormat::RED . "You do not have permission to use the command.");
        $this->setPermission('worldlimit.reload.use');
        $this->worldLimit = $worldLimit;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if (!$this->testPermission($sender)) {
            return;
        }

        $this->reloadConfig($this->worldLimit);
    }
}