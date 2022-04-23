<?php
namespace Jos3\Commands;

use Jos3\main;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as C;

class CommandShop extends Command {
    public function __construct()
    {
        parent::__construct("shop","Shows you info about the server shop.",null,[]);
    }
    public function execute(CommandSender $sender, string $commandLabel, array $args) : void
    {
        $Config = main::getInstance()->getConfig();
        if ($sender instanceof Player) {
            $sender->sendMessage(C::GRAY."---------------------------------");
            $sender->sendMessage(C::GREEN."             ".$Config->get("shop"));
            $sender->sendMessage(C::GRAY."---------------------------------");
        }
        return;
    }
}