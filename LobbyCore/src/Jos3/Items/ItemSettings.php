<?php
namespace Jos3\Items;


use Jos3\Forms\SettingsForm;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ItemIds;
use pocketmine\item\ItemUseResult;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as C;


class ItemSettings extends ItemFactory {
    private bool $flying;
    public function __construct()
    {
        parent::__construct(new ItemIdentifier(ItemIds::CLOCK,0), C::RESET.C::GOLD."Settings".C::GRAY." [Use]");
    }
    public function onClickAir(Player $player, Vector3 $directionVector): ItemUseResult
    {
        $player->sendForm(new SettingsForm());
        return ItemUseResult::SUCCESS();
    }
}