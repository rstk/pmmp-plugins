<?php

declare(strict_types=1);

namespace rstk\test;

use pocketmine\plugin\PluginBase;

class Main extends PluginBase {
    public function onEnable() {
        $this->getServer()->broadcastMessage("plugin enabled");
    }
}