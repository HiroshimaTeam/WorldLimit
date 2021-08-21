<?php

namespace Refaltor\WorldLimit\Events\Listeners;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerMoveEvent;
use Refaltor\WorldLimit\Traits\WorldLimitTrait;
use Refaltor\WorldLimit\WorldLimit;

class PlayerListener implements Listener
{
    use WorldLimitTrait;


    /** @var WorldLimit  */
    public $worldLimit;


    public function __construct(WorldLimit $worldLimit){
        $this->worldLimit = $worldLimit;
    }

    /**
     * @param PlayerMoveEvent $playerMoveEvent
     */
    public function onMove(PlayerMoveEvent $playerMoveEvent): void {
        $player = $playerMoveEvent->getPlayer();

        $x = $this->getX($this->worldLimit);
        $z = $this->getZ($this->worldLimit);

        if ($player->getX() >= $x || $player->getZ() >= $z) {
            if (in_array($player->getLevel()->getFolderName(), $this->getWorlds($this->worldLimit))) {
                $playerMoveEvent->setCancelled(true);
                $message = str_replace('{player}', $player->getName(), $this->getMessage($this->worldLimit));
                $player->sendMessage($message);
            }
        }
    }
}