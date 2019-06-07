<?php

namespace UnknownBallin\BasicAnnouncer;

use pocketmine\Player;
use pocketmine\Server;
use pocketmine\utils\Config;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

class Announce extends PluginBase implements Listener{
	
	public function onEnable():void{
            @mkdir($this->getDataFolder());
            $this->saveDefaultConfig();
            $this->getServer()->getPluginManager()->registerEvents($this, $this);
		    $this->getLogger()->info("Basic Announcer enabled | UnknownBallin");
	}
	public function onDisable():void{
		    $this->getLogger()->info("Basic Announcer disabled | UnknownBallin");
	}
	
	#Broadcast your message with a customizable prefix
	public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args): bool{
			switch($cmd->getName()){
					case "announce":
					if(!$sender->hasPermission("ba.cmd.announce")){
						$sender->sendMessage($this->getConfig()->get("NoPermsMessage"));
					return false;
					}
					if($sender->hasPermission("ba.cmd.announce")){
						$message=implode(" ",$args);
							$this->getServer()->broadcastMessage($this->getConfig()->get("Prefix")." ".$message);
							break;
							}
			}
			return true;
			
	}
}