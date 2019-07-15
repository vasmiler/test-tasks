<?php 

use Page\VideoSearchPage as VideoSearchPage;

class FirstCest
{
    public function playVideoTest(AcceptanceTester $I)
    {
		$I->wantTo('Check that video has preview');
		$I->amOnPage('/');
		
		$videoSearchPage = new VideoSearchPage($I);
		$videoSearchPage -> fillSearchString('Ураган');
		$videoSearchPage -> clickSearchButton();
		
		$videoSearchPage -> checkAtLeastOneResultFound();
		$videoSearchPage -> checkVideoIsPlayed();
    }
}
