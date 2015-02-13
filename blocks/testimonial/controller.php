<?php  defined('C5_EXECUTE') or die("Access Denied.");

class TestimonialBlockController extends BlockController {
	
	protected $btName = 'Testimonial';
	protected $btDescription = '';
	protected $btTable = 'btDCTestimonial';
	
	protected $btInterfaceWidth = "700";
	protected $btInterfaceHeight = "450";
	
	protected $btCacheBlockRecord = true;
	protected $btCacheBlockOutput = true;
	protected $btCacheBlockOutputOnPost = true;
	protected $btCacheBlockOutputForRegisteredUsers = false;
	protected $btCacheBlockOutputLifetime = CACHE_LIFETIME;
	
	public function getSearchableContent() {
		$content = array();
		$content[] = $this->field_1_textarea_text;
		$content[] = $this->field_2_textbox_text;
		$content[] = $this->field_3_textbox_text;
		return implode(' - ', $content);
	}








}
