<?php
namespace Jos3\Listeners;

use Jos3\Items\ItemNavigator;
use Jos3\Items\ItemSettings;
use Jos3\Items\ItemMotionBuff;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\inventory\InventoryTransactionEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerExhaustEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\player\GameMode;
use pocketmine\player\Player;
use pocketmine\Server;
use pocketmine\utils\TextFormat as C;

class ListenerLogging implements Listener {
    public function onJoin(PlayerJoinEvent $event) {
        $Name = $event->getPlayer()->getName();
        $player = $event->getPlayer();
        $event->setJoinMessage(C::GRAY."[".C::GREEN."+".C::GRAY."]".C::WHITE." ".$Name);
        $player->setGamemode(GameMode::SURVIVAL());
        $player->getInventory()->clearAll();
        $player->getArmorInventory()->clearAll();
        $player->getEffects()->clear();
        $player->teleport(Server::getInstance()->getWorldManager()->getDefaultWorld()->getSafeSpawn());
        $player->getInventory()->setItem(0,new ItemNavigator());
        $player->getInventory()->setItem(4,new ItemMotionBuff());
        $player->getInventory()->setItem(8,new ItemSettings());
    }
    public function onDamage(EntityDamageEvent $event):void {
        if($event->getCause() === EntityDamageEvent::CAUSE_VOID && $event->getEntity() instanceof Player) {
            $event->getEntity()->teleport(Server::getInstance()->getWorldManager()->getDefaultWorld()->getSafeSpawn());
        }
        $event->cancel();
    }
    public function onInteract(PlayerInteractEvent $event):void {
        if(!$event->getPlayer()->hasPermission("place.block")){
            $event->cancel();
        }
    }
    public function onBreak(BlockBreakEvent $event) : void {
        if(!$event->getPlayer()->hasPermission("break.block")){
            $event->cancel();
        }
    }
    public function onQuit(PlayerQuitEvent $event) {
        $Name = $event->getPlayer()->getName();
        $event->setQuitMessage(C::GRAY."[".C::RED."-".C::GRAY."]".C::WHITE." ".$Name);
    }
    public function onExhaust(PlayerExhaustEvent $event): void {
        $event->cancel();
    }
    public function onTransaction(InventoryTransactionEvent $event){
        $event->cancel();
    }
}