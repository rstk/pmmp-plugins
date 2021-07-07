<?php

declare(strict_types=1);

namespace rstk\stats;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\Plugin;
use pocketmine\command\PluginIdentifiableCommand;

class StatsCommand extends Command implements PluginIdentifiableCommand {
    
    /**
     * @var Plugin
     */
    private $plugin;

    public function __construct(string $name, Plugin $plugin, string $description = "", ?string $usageMessage = null, array $aliases = []) {
        parent::__construct(
            $name,
            $description,
            $usageMessage,
            $aliases
        );

        $this->plugin = $plugin;
        $this->setDescription($description);
    }

    public function getPlugin(): Plugin {
        return $this->plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {
        $sender->sendMessage("stats command ran");
    }
}