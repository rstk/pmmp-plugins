<?php

declare(strict_types=1);

namespace rstk\other;

use pocketmine\plugin\PluginBase;

class Main extends PluginBase {
    public function onEnable() {
        $this->getLogger()->info("Other plugin started!");
    }

    public function onLoad() {
        $this->getLogger()->info("Other plugin loaded!");
    }
}
