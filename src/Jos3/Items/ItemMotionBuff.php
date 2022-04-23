<?php
namespace Jos3\Items;
use Jos3\Items\ItemFactory;
use Jos3\main;
use pocketmine\item\ItemIds;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ItemUseResult;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as C;

class ItemMotionBuff extends ItemFactory {
    public function __construct()
    {
        $config = main::getInstance()->getConfig()->get("MotionBuffItem");
        if ($config === "368"){
            $config = "EnderPearl";
        }
        if ($config === "332"){
            $config = "SnowBall";
        }
        parent::__construct(new ItemIdentifier($config,0),C::RESET.C::BLUE.$config.C::GRAY." [Use]");
    }
    public function onClickAir(Player $player, Vector3 $directionVector): ItemUseResult
    {

        $player->setMotion($player->getDirectionVector()->multiply(1.8));
        return ItemUseResult::FAIL();
    }
}