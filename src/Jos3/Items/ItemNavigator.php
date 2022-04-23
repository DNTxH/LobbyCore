<?php
namespace Jos3\Items;

use Jos3\main;
use muqsit\invmenu\InvMenu;
use muqsit\invmenu\transaction\InvMenuTransaction;
use muqsit\invmenu\transaction\InvMenuTransactionResult;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ItemIds;
use pocketmine\item\ItemUseResult;
use pocketmine\item\VanillaItems;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as C;

class ItemNavigator extends ItemFactory {
    public function __construct()
    {
        parent::__construct(new ItemIdentifier(ItemIds::COMPASS,"0"),C::RESET.C::YELLOW."Navigator".C::GRAY." [Use]");
    }
    public function onClickAir(Player $player, Vector3 $directionVector): ItemUseResult
    {
        $menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
        $SwordItemIp = main::getInstance()->getConfig()->get("SwordItemIP");
        $SwordItemName = main::getInstance()->getConfig()->get("SwordItemName");
        $BowItemIp = main::getInstance()->getConfig()->get("BowItemIP");
        $BowItemName = main::getInstance()->getConfig()->get("BowItemName");
        $GAppleItemIp = main::getInstance()->getConfig()->get("GAppleItemIP");
        $GAppleItemName = main::getInstance()->getConfig()->get("GAppleItemName");

        $menu->getInventory()->setContents([
            22 => VanillaItems::DIAMOND_SWORD()->setCustomName(C::RESET.C::RED.$SwordItemName.C::GRAY." [Click]")->setLore([C::RESET.C::GRAY."ip: \n".$SwordItemIp]),
            30 => VanillaItems::BOW()->setCustomName(C::RESET.C::RED.$BowItemName.C::GRAY." [Click]")->setLore([C::RESET.C::GRAY."ip: \n".$BowItemIp]),
            32 => VanillaItems::GOLDEN_APPLE()->setCustomName(C::RESET.C::RED.$GAppleItemName.C::GRAY." [Click]")->setLore([C::RESET.C::GRAY."ip: \n".$GAppleItemIp])
        ]);
        $menu->setListener(function (InvMenuTransaction $transaction): InvMenuTransactionResult{
            if($transaction->getItemClicked()->getId() === ItemIds::DIAMOND_SWORD){
                $player = $transaction->getPlayer();
                $SwordItemIp = main::getInstance()->getConfig()->get("SwordItemIP");
                $player->transfer($SwordItemIp);
            }
            if($transaction->getItemClicked()->getId() === ItemIds::BOW){
                $player = $transaction->getPlayer();
                $BowItemIp = main::getInstance()->getConfig()->get("BowItemIP");
                $player->transfer($BowItemIp);
            }
            if($transaction->getItemClicked()->getId() === ItemIds::GOLDEN_APPLE){
                $player = $transaction->getPlayer();
                $GAppleItemIp = main::getInstance()->getConfig()->get("GAppleItemIP");
                $player->transfer($GAppleItemIp);
            }
            return $transaction->discard();
        });
        $menu->send($player);
        return ItemUseResult::SUCCESS();
    }
}