<?php
namespace Jos3\Listeners;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\utils\TextFormat as C;

class ListenerChat implements Listener {
    public function onChat(PlayerChatEvent $event ) {
        $name = $event->getPlayer()->getName();
        $message = $event->getMessage();
        $event->setFormat(C::YELLOW.$name.C::GRAY." »".C::WHITE.$message);
    }
}