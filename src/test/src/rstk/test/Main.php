<?php

declare(strict_types=1);

namespace rstk\test;

use pocketmine\plugin\PluginBase;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\item\Item;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;

class Main extends PluginBase implements Listener {
    public function onEnable() {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->info("Test plugin started!");
    }

    public function onJoin(PlayerJoinEvent $event) {
        $player = $event->getPlayer();
        $name = $player->getName();
        $inventory = $player->getInventory();

        $this->getServer()->broadcastMessage("$name joined the server!");
        $item = Item::get(345, 0, 1);
        $inventory->setItem(0, $item);
    }
}
