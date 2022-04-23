<?php
namespace Jos3\Items;
 use pocketmine\item\Item;
 use pocketmine\item\ItemIdentifier;

 class ItemFactory extends Item {
     public function __construct(ItemIdentifier $identifier, string $name)
     {
         $this->setCustomName($name);
         parent::__construct($identifier, $name);
         $this->getNamedTag()->setByte("LobbyCore","1");
     }
 }