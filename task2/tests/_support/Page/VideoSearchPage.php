<?php
namespace Page;

class VideoSearchPage
{
    // include url of current page
    public static $URL = 'https://yandex.ru/portal/video';
	
	private $screenShotName = 'screen';
	private $searchInput = '//input[@type="search"]';
	private $searchButton = 'button.websearch-button';
	private $searchResultsBlock = '.serp-item_type_search';
	private $firstVideoPreview = 'div.serp-list div.serp-item__preview';
	private $firstVideoPreviewPlaying = 'div.serp-list div.serp-item__preview div.thumb-preview__target_playing';
	private $yandexLogoImage = 'div a.logo';
	
 
	protected $tester;
	 
	public function __construct(\AcceptanceTester $I)
    {
        $this->tester = $I;
    }
	 
    public static function route($param)
    {
        return static::$URL.$param;
    }
	
	public function fillSearchString($searchRequest)
    {
		$I = $this->tester;
		$I->fillField($this->searchInput, $searchRequest);
    }
	
	public function clickSearchButton()
    {
		$I = $this->tester;
		$I->click($this->searchButton);
    }
	
	public function checkAtLeastOneResultFound()
    {
		$I = $this->tester;
		$I -> seeElement($this->searchResultsBlock);
    }
	
	public function checkVideoIsPlayed()
	{
		// current date and time used to generate screenshot name
		$currentDateTime = date('Ymd His');
		
		$I = $this->tester;
		//take the first screenshot
		$I -> seeVisualChanges($this->screenShotName.$currentDateTime, $this->firstVideoPreview);		
		$I -> seeVisualChanges("yandex_logo".$currentDateTime, $this->yandexLogoImage);
		
		//hover the mouse pointer
		$I -> moveMouseOver($this->firstVideoPreview);	
		
		// wait for video starts playing
		$I -> waitForElement($this->firstVideoPreviewPlaying, 3);
		
		// take the second screenshot and check
		$I -> seeVisualChanges($this->screenShotName.$currentDateTime, $this->firstVideoPreview);
		$I -> dontSeeVisualChanges("yandex_logo".$currentDateTime, $this->yandexLogoImage);
	}
}
