<?php  defined('C5_EXECUTE') or die("Access Denied.");

class EventsCalendarBlockController extends BlockController {
	
	protected $btName = 'Events Calendar';
	protected $btDescription = 'An Events Calendar Block';
	protected $btTable = 'btDCEventsCalendar';
	
	protected $btInterfaceWidth = "700";
	protected $btInterfaceHeight = "450";
	
	protected $btCacheBlockRecord = true;
	protected $btCacheBlockOutput = true;
	protected $btCacheBlockOutputOnPost = true;
	protected $btCacheBlockOutputForRegisteredUsers = false;
	protected $btCacheBlockOutputLifetime = CACHE_LIFETIME;
	
	public function getSearchableContent() {
		return $this->field_1_textbox_text;
	}








}
