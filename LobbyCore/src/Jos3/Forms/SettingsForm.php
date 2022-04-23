<?php
namespace Jos3\Forms;


use EasyUI\element\Toggle;
use EasyUI\utils\FormResponse;
use EasyUI\variant\CustomForm;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as C;

class SettingsForm extends CustomForm {
    public function __construct()
    {
        parent::__construct("Settings");
    }
    public function onCreation(): void
    {
        $this->addElement("Fly",new Toggle("Fly",false));
    }
    public function onSubmit(Player $player, FormResponse $response): void
    {
        $toggle = $response->getToggleSubmittedChoice("Fly");
        if ($player->hasPermission("can.fly")){
            if ($toggle === true ){
                $player->setAllowFlight(true);
                $player->sendMessage(C::GREEN."Flight mode enabled.");
                $player->setFlying(true);
            } else {
                $player->setAllowFlight(false);
                $player->setFlying(false);
                $player->sendMessage(C::RED."Flight mode disabled.");
            }
        } else {
            $player->sendMessage(C::RED."You have no permission to do this.");
        }
    }
}