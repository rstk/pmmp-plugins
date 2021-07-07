<?php

declare(strict_types=1);

namespace rstk\stats;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\Plugin;
use pocketmine\command\PluginIdentifiableCommand;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class StatsCommand extends Command implements PluginIdentifiableCommand {
    
    /**
     * @var Plugin
     */
    private $plugin;

    public function __construct(string $name, Plugin $plugin) {
        parent::__construct(
            $name,
            "Show server stats",
            "/stats"
        );

        $this->plugin = $plugin;
        //$this->setDescription();
    }

    public function getPlugin(): Plugin {
        return $this->plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {
        $server = $sender->getServer();

        $tpsnow = $server->getTicksPerSecond();
        $tpsavrg = $server->getTicksPerSecondAverage();
        $playercount = count($server->getOnlinePlayers());

        $sender->sendMessage(TextFormat::RED . "=====" . TextFormat::WHITE . " SERVER STATS " . TextFormat::RED . "=====");
        
        $s = $playercount == 1 ? "s" : "";
        $sender->sendMessage(
            TextFormat::GREEN . TextFormat::BOLD . strval($playercount) .
            TextFormat::RESET . TextFormat::GREEN . " player$s online"
        );

        if ($sender instanceof Player) {
            $ping = $sender->getPing();
            $sender->sendMessage(
                TextFormat::BOLD . "Ping: " .
                TextFormat::RESET . $this->getPingColor($ping) . strval($ping)
            );
        }

        $sender->sendMessage(
            TextFormat::BOLD . "TPS: " .
            TextFormat::RESET . $this->getTpsColor($tpsnow) . strval($tpsnow)
        );

        $sender->sendMessage(
            TextFormat::BOLD . "Avrg TPS: " .
            TextFormat::RESET . $this->getTpsColor($tpsavrg) . strval($tpsavrg)
        );

        $sender->sendMessage(TextFormat::RED . "========================");
    }

    private function getTpsColor(float $tps): string {
        if ($tps > 18) {
            return TextFormat::GREEN;
        } elseif ($tps > 15) {
            return TextFormat::YELLOW;
        } else {
            return TextFormat::RED;
        }
    }
    
    private function getPingColor(int $ping): string {
        if ($ping <= 50) {
            return TextFormat::GREEN;
        } elseif ($ping <= 100) {
            return TextFormat::YELLOW;
        } else {
            return TextFormat::RED;
        }
    }
}