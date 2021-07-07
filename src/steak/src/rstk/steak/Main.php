<?php

declare(strict_types=1);

namespace rstk\steak;

use pocketmine\plugin\PluginBase;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\item\Item;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

class Main extends PluginBase implements Listener {
    private $defaultSteakAmount = NULL;

    public function onEnable() {
        // register onJoin/onCommand/etc events
        $this->getServer()->getPluginManager()->registerEvents($this, $this);

        // config
        $this->saveDefaultConfig();
        $this->reloadConfig();

        $this->defaultSteakAmount = $this->getConfig()->get("default-steak-amount");
    
        // finished
        $this->getLogger()->info("Steak plugin started!");
    }

    public function onJoin(PlayerJoinEvent $event) {
        $player = $event->getPlayer();
        $name = $player->getName();
        $inventory = $player->getInventory();

        $this->getServer()->broadcastMessage("$name joined the server!");
        $this->getServer()->broadcastMessage("Key: $this->defaultSteakAmount");
        $item = Item::get(345, 0, 1);
        $inventory->setItem(0, $item);
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool {
        switch ($command->getName()) {
            case "steak":

                if (!$sender instanceof Player) {
                    $sender->sendMessage("This command only works for players!");
                    return false;
                }

                if (!$sender->hasPermission("perms.op")) {
                    $sender->sendMessage("You must be an operator to use this command!");
                    return false;
                }

                $nSteaks = NULL;
                if (isset($args[0])) {
                    $nSteaks = intval($args[0]);

                    if ($nSteaks <= 0) {
                        $sender->sendMessage("Please enter a valid integer!");
                        return false;
                    }
                }

                $nSteaks = $nSteaks == NULL ? intval($this->defaultSteakAmount) : $nSteaks;

                $sender->getInventory()->addItem(Item::get(364, 0, $nSteaks));
                $s = $nSteaks == 1 ? "" : "s";
                $sender->sendMessage("Received $nSteaks steak$s!");
                break;
        }
 
        return true;
    }
}
