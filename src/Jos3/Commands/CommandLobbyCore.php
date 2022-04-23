<?php
namespace Jos3\Commands;

use Jos3\main;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat as C;
use pocketmine\player\Player;

class CommandLobbyCore extends Command {
    public function __construct()
    {
        parent::__construct("lobbycore","Shows you info about the LobbyCore plugin",null,[]);
    }
    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        $Config = main::getInstance()->getConfig();
        if ($sender instanceof Player) {
            $sender->sendMessage(C::GRAY."---------------------------------");
            $sender->sendMessage(C::GREEN."Author: Jos3");
            $sender->sendMessage(C::GREEN."PocketMine-MP API: 4.0.0");
            $sender->sendMessage(C::GRAY."---------------------------------");
        }
        return;
    }
}