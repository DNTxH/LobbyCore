<?php
namespace Jos3\Commands;
use Jos3\main;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as C;

class CommandDiscord extends Command {
    public function __construct()
    {
        parent::__construct("discord", "Run this command to get info about the discord server.", null, ["dsc","dc"]);
    }
    public function execute(CommandSender $sender, string $commandLabel, array $args) : void
    {
        $Config = main::getInstance()->getConfig();
        if ($sender instanceof Player) {
            $sender->sendMessage(C::GRAY."---------------------------------");
            $sender->sendMessage(C::GREEN."             ".$Config->get("discord"));
            $sender->sendMessage(C::GRAY."---------------------------------");
        }
        return;
    }
}
