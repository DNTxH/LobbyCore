<?php
namespace Jos3\Commands;


use Jos3\Forms\SettingsForm;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as C;

class CommandSettings extends Command {
    public function __construct()
    {
        parent::__construct("settings","Configure your server status.",null,["setting"]);
    }
    public function execute(CommandSender $sender, string $commandLabel, array $args){
        $sender->sendForm(new SettingsForm());
    }
}