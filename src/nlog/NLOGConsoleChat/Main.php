<?php

namespace nlog\NLOGConsoleChat;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\server\ServerCommandEvent;

class Main extends PluginBase implements Listener {
	
	public function onEnable() {
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		
	}
	
	/**
	 * $haystack의 앞글자와 $needle이 동일하면 return true
	 * 
	 * @param unknown $haystack
	 * @param unknown $needle
	 */
	public function startsWith($haystack, $needle) {
		// search backwards starting from haystack length characters from the end
		return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== false;
	}
	
	public function onServerCmdEvent (ServerCommandEvent $ev) {
		$msg = $ev->getCommand();
		if (self::startsWith($msg, "/")) {
			$ev->setCommand(substr($msg, 1));
			return;
		}
		$ev->setCancelled(true);
		$this->getServer()->broadcastMessage("§d[Console] {$msg}");
	}
	
	
  }

?>