<?php

namespace Refaltor\WorldLimit;

use pocketmine\plugin\PluginBase;
use Refaltor\WorldLimit\Commands\Reload;
use Refaltor\WorldLimit\Events\Listeners\PlayerListener;
use Refaltor\WorldLimit\Traits\WorldLimitTrait;

class WorldLimit extends PluginBase
{
    use WorldLimitTrait;


    /** @var array  */
    public $data = [];

    /** @var string  */
    public $version = "1.0.0";


    public function onLoad(){
        $this->checkConfig($this);
    }

    public function onEnable(){
        $config = $this->getConfig()->getAll();
        $this->setX($this, $config['x']);
        $this->setZ($this, $config['z']);
        $this->setMessage($this, strval($config['message']));
        $this->setWorlds($this, $config['worlds']);

        $this->getServer()->getPluginManager()->registerEvents(new PlayerListener($this), $this);
        $this->getServer()->getCommandMap()->register('WorldLimit', new Reload($this));
    }
}