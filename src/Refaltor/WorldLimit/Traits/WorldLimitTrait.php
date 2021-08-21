<?php

namespace Refaltor\WorldLimit\Traits;

use pocketmine\utils\TextFormat;
use Refaltor\WorldLimit\WorldLimit;

trait WorldLimitTrait
{
    /**
     * @param WorldLimit $worldLimit
     * @param int $x
     */
    public function setX(WorldLimit $worldLimit, int $x): void {
        $worldLimit->data['x'] = $x;
    }


    /**
     * @param WorldLimit $worldLimit
     * @param int $z
     */
    public function setZ(WorldLimit $worldLimit, int $z): void {
        $worldLimit->data['z'] = $z;
    }


    /**
     * @param WorldLimit $worldLimit
     * @param string $message
     */
    public function setMessage(WorldLimit $worldLimit, string $message): void {
        $worldLimit->data['message'] = $message;
    }


    /**
     * @param WorldLimit $worldLimit
     * @param array $worlds
     */
    public function setWorlds(WorldLimit $worldLimit, array $worlds): void {
        $worldLimit->data['worlds'] = $worlds;
    }


    /**
     * @param WorldLimit $worldLimit
     * @return array
     */
    public function getWorlds(WorldLimit $worldLimit): array {
        return $worldLimit->data['worlds'];
    }


    /**
     * @param WorldLimit $worldLimit
     * @return int
     */
    public function getX(WorldLimit $worldLimit): int {
        return $worldLimit->data['x'];
    }


    /**
     * @param WorldLimit $worldLimit
     * @return string
     */
    public function getMessage(WorldLimit $worldLimit): string {
        return $worldLimit->data['message'];
    }


    /**
     * @param WorldLimit $worldLimit
     * @return int
     */
    public function getZ(WorldLimit $worldLimit): int {
        return $worldLimit->data['z'];
    }


    /**
     * @param WorldLimit $worldLimit
     */
    public function checkConfig(WorldLimit $worldLimit): void {
        $config = $worldLimit->getConfig();
        if (!$config->exists('version') || $config->getAll()['version'] !== $worldLimit->version) {
            $worldLimit->getServer()->getLogger()->warning(TextFormat::RED . 'config.yml is not updated,' . TextFormat::GREEN . ' update...');

            $update = rename($worldLimit->getDataFolder() . 'config.yml', $worldLimit->getDataFolder() . 'old_config.yml');

            if ($update) {
                $worldLimit->getServer()->getLogger()->warning(TextFormat::GREEN . 'config.yml is renamed old_config.yml.');
            } else {
                $worldLimit->getServer()->getLogger()->warning(TextFormat::DARK_RED . 'Update not functional.');
                $worldLimit->getServer()->getPluginManager()->disablePlugin($worldLimit);
            }
        }
    }


    /**
     * @param WorldLimit $worldLimit
     */
    public function reloadConfig(WorldLimit $worldLimit): void {
        $this->checkConfig($worldLimit);
        $config = $worldLimit->getConfig()->getAll();
        $this->setX($worldLimit, $config['x']);
        $this->setZ($worldLimit, $config['z']);
        $this->setMessage($worldLimit, strval($config['message']));
        $this->setWorlds($worldLimit, $config['worlds']);
    }
}