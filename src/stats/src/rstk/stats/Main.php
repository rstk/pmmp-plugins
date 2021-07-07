<?php

declare(strict_types=1);

namespace rstk\stats;

use pocketmine\plugin\PluginBase;

class Main extends PluginBase {
    public function onEnable() {
        $commandMap = $this->getServer()->getCommandMap();
        $commandMap->register($this->getName(), new StatsCommand("stats", $this));
    }
}