<?php
namespace Jos3;
use Jos3\Commands\CommandDiscord;
use Jos3\Commands\CommandLobbyCore;
use Jos3\Commands\CommandSettings;
use Jos3\Commands\CommandShop;
use Jos3\Listeners\ListenerChat;
use Jos3\Listeners\ListenerLogging;
use Lobby\command\ShopCommand;
use muqsit\invmenu\InvMenuHandler;
use pocketmine\permission\DefaultPermissions;
use pocketmine\permission\Permission;
use pocketmine\permission\PermissionManager;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\SingletonTrait;
use pocketmine\utils\TextFormat as C;
use serg1h\lobbycomplement\commands\FlyCommand;

class main extends PluginBase {
    use SingletonTrait;
    public function onLoad(): void
    {
        self::setInstance($this);
    }

    public function onEnable(): void
    {
        $this->getServer()->getLogger()->info("[LobbyCore] LobbyCore ".C::GREEN."enabled");
        $this->getServer()->getCommandMap()->register("discord",new CommandDiscord());
        $this->getServer()->getCommandMap()->register("Fly", new CommandSettings());
        $this->getServer()->getCommandMap()->register("shop",new CommandShop());
        $this->getServer()->getCommandMap()->register("lobbycore",new CommandLobbyCore());
        $this->registerPermission("break.block");
        $this->registerPermission("place.block");
        $this->registerPermission("can.fly");
        $this->getServer()->getPluginManager()->registerEvents(new ListenerLogging(),$this);
        $this->getServer()->getPluginManager()->registerEvents(new ListenerChat(),$this);
        if(!InvMenuHandler::isRegistered()){
            InvMenuHandler::register($this);
        }
    }
    private function registerPermission(string $permission): void {
        $manager = PermissionManager::getInstance();
        $manager->addPermission(new Permission($permission));
        $manager->getPermission(DefaultPermissions::ROOT_OPERATOR)->addChild($permission, true);
    }
}