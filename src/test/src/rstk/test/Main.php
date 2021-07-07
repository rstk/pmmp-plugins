<?php

declare(strict_types=1);

namespace rstk\test;

use pocketmine\plugin\PluginBase;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\item\Item;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

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

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool {
        switch ($command->getName()) {
            case "test":

                if (!($sender instanceof Player)) {
                    $sender->sendMessage("This command only works for players!");
                    return false;
                }

                $nSteaks = 10;
                if (isset($args[0])) {
                    $nSteaks = intval($args[0]);

                    if ($nSteaks <= 0) {
                        $sender->sendMessage("Please enter a valid integer!");
                    }
                }

                $sender->getInventory()->addItem(Item::get(364, 0, $nSteaks));
                $sender->sendMessage("Received $nSteaks steaks!");
                break;
        }

        return true;
    }
}
