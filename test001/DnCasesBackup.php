<?php
class DnCasesBackup {
	function __construct() {
	}
	/**
	 * [Merchandise][testSearchCopyBidHasOrderIntoStep2] testSearchCopyBidHasOrderIntoStep2
	 * @group testSearchCopyBidHasOrderIntoStep2
	 * @group Web_Auto_New_Auc_C39942
	 * @tmTestCaseId Web_Auto_New_Auc_C39942
	 * @return assert equals
	 * @author xingxing
	 */
	function XtestSearchCopyBidHasOrderIntoStep2(){ //Dn19
	
		//刊登商品
		$Mlink = $this->scenario->ScenarioForPublishAuction('bidNow',$this->getName());
		if($Mlink){
			$merchandiseID = substr($Mlink,-12);
			echo 'merchandiseID:'.$merchandiseID.PHP_EOL;
		}
		//購買
		$this->scenario->ScenarioForCreateAnOrder($Mlink,'bidNow',$this->getName());
	
		//換賬號
		$this->scenario->changeUserLogin($this->testData->testUser1,$this->testData->testPasswd1, $this->getName());
		//進入管理商品頁面
		$listMerchandise = new ListMerchandisePage($this->driver);
		$listMerchandise->open();
		//搜尋商品
		$listMerchandise->searchMerchandiseByID($merchandiseID);
		//已下架
		$listMerchandise->clickShelves();
		//判斷為 有得標者
		$hasOwner = $listMerchandise->getBidHasOwner();
		if('有得標者' == $hasOwner){
			//複製
			$listMerchandise->clickCopyLink();
			//商品複製Step2
			$inputInfo = new InputAuctionContentPage($this->driver);
			//title update
			$title = $inputInfo->getTitle();
	
			//error image
			$this->Selenium->takeErrorScreenShot($this->getName(),'searchCopyBidHasOrderIntoStep2');
			//assert
			$this->assertEquals($this->testData->publishRequiredData['title'],$title);
		}
		//logout
		$this->scenario->doLogout();
		$this->Selenium->takeErrorScreenShot($this->getName(),'logout');
	}
	/**
	 * [Merchandise][testSearchDeleteBidEarly] testSearchDeleteBidEarly
	 * @group testSearchDeleteBidEarly
	 * @group Web_Auto_New_Auc_C39986
	 * @tmTestCaseId Web_Auto_New_Auc_C39427
	 * @tmTestCaseId Web_Auto_New_Auc_C39986
	 * @return assert success
	 * @author xingxing
	 */
	function XtestSearchDeleteBidEarly(){ //Dn21  Dn26
	
		//刊登商品
		$Mlink = $this->scenario->ScenarioForPublishAuction('bidEarly',$this->getName());
		$merchandiseID = ToolGetMIdFormItemPageLink($Mlink);
	
		//進入管理商品頁面
		$listMerchandise = new ListMerchandisePage($this->driver);
		$listMerchandise->open();
		//搜尋商品
		$listMerchandise->searchMerchandiseByID($merchandiseID);
		//預約上架
		$listMerchandise->clickEarlyPublish();
		//刪除
		$listMerchandise->clickDeleteLink();
		$result = $listMerchandise->searchMerchanByID($merchandiseID,'all');
	
		//error image
		$this->Selenium->takeErrorScreenShot($this->getName(),'searchDeleteBidEarly');
		//assert
		$this->assertTrue($result == 0);
		//logout
		$this->scenario->doLogout();
	}
	/**
	 * [Merchandise][testSearchPublishBidEarly] testSearchPublishBidEarly
	 * @group testSearchPublishBidEarly
	 * @group Web_Auto_New_Auc_C39976
	 * @tmTestCaseId Web_Auto_New_Auc_C39417
	 * @tmTestCaseId Web_Auto_New_Auc_C39976
	 * @return assert success
	 * @author xingxing
	 */
	function XtestSearchPublishBidEarly(){ //Dn21 Dn26
	
		//刊登商品
		$Mlink = $this->scenario->ScenarioForPublishAuction('bidEarly',$this->getName());
		$merchandiseID = ToolGetMIdFormItemPageLink($Mlink);
	
		//進入管理商品頁面
		$listMerchandise = new ListMerchandisePage($this->driver);
		$listMerchandise->open();
		//搜尋商品
		$listMerchandise->searchMerchandiseByID($merchandiseID);
		//預約上架
		$listMerchandise->clickEarlyPublish();
		//操作：上架
		$listMerchandise->clickPublishLink();
		$result = $listMerchandise->searchMerchanByID($merchandiseID,'all');
	
		//error image
		$this->Selenium->takeErrorScreenShot($this->getName(),'searchPublishBidEarly');
		//assert
		$this->assertEquals("上架中",$listMerchandise->getItemStatus());
		//$this->assertTrue($result > 0);
		//logout
		$this->scenario->doLogout();
	}
	/**
	 * [Merchandise][testSearchSoldOutDeleteNOOrderBidNow] testSearchSoldOutDeleteNOOrderBidNow
	 * @group testSearchSoldOutDeleteNOOrderBidNow
	 * @group Web_Auto_New_Auc_C39947
	 * @tmTestCaseId Web_Auto_New_Auc_C39370
	 * @tmTestCaseId Web_Auto_New_Auc_C39947
	 * @return assert success
	 * @author xingxing
	 */
	function XtestSearchSoldOutDeleteNOOrderBidNow(){ //Dn21 Dn26
	
		//刊登商品
		$Mlink = $this->scenario->ScenarioForPublishAuction('bidNow',$this->getName());
		$merchandiseID = ToolGetMIdFormItemPageLink($Mlink);
	
		//進入管理商品頁面
		$listMerchandise = new ListMerchandisePage($this->driver);
		$listMerchandise->open();
		//搜尋商品
		$listMerchandise->searchMerchandiseByID($merchandiseID);
		//取消競標，下架
		$listMerchandise->clickCancelBid();
		//已下架 搜尋商品
		$listMerchandise->searchMerchanByID($merchandiseID,'close');
		//刪除
		$listMerchandise->clickDeleteLink();
		$result = $listMerchandise->searchMerchanByID($merchandiseID,'all');
	
		//error image
		$this->Selenium->takeErrorScreenShot($this->getName(),'searchSoldOutDeleteNOOrderBidNow');
		//assert
		$this->assertTrue($result == 0);
		//logout
		$this->scenario->doLogout();
	}
	/**
	 * [Merchandise][testSearchBidNOPriceIntoStep2] testSearchBidNOPriceIntoStep2
	 * @group testSearchBidNOPriceIntoStep2
	 * @group Web_Auto_New_Auc_C39914
	 * @tmTestCaseId Web_Auto_New_Auc_C39914
	 * @return assert equals
	 * @author xingxing
	 */
	function XtestSearchCopyBidNOPriceIntoStep2(){ //Dn19 C39950， C39914已经标Done
	
		//刊登商品
		$Mlink = $this->scenario->ScenarioForPublishAuction('bidNow',$this->getName());
		if($Mlink){
			$merchandiseID = substr($Mlink,-12);
			echo 'merchandiseID:'.$merchandiseID.PHP_EOL;
		}
		//進入管理商品頁面
		$listMerchandise = new ListMerchandisePage($this->driver);
		$listMerchandise->open();
		//搜尋商品
		$listMerchandise->searchMerchandiseByID($merchandiseID);
		//判斷為 無出價
		$hasPriceNum = $listMerchandise->getBidHasPriceNum();
		if($hasPriceNum == 0){
			//複製
			$listMerchandise->clickCopyLink();
			//商品複製Step2
			$inputInfo = new InputAuctionContentPage($this->driver);
			//title update
			$title = $inputInfo->getTitle();
				
			//error image
			$this->Selenium->takeErrorScreenShot($this->getName(),'searchBidNOPriceIntoStep2');
			//assert
			$this->assertEquals($this->testData->publishRequiredData['title'],$title);
		}
		//logout
		$this->scenario->doLogout();
		$this->Selenium->takeErrorScreenShot($this->getName(),'logout');
	}
	/**
	 * [Merchandise][testSearchDeleteDricetdEarly] testSearchDeleteDricetdEarly
	 * @group testSearchDeleteDricetdEarly
	 * @group Web_Auto_New_Auc_C39966
	 * @tmTestCaseId Web_Auto_New_Auc_C39407
	 * @tmTestCaseId Web_Auto_New_Auc_C39966
	 * @return assert success
	 * @author xingxing
	 */
	function XtestSearchDeleteDricetdEarly(){ //Dn21 Dn26
	
		//刊登商品
		$Mlink = $this->scenario->ScenarioForPublishAuction('directEarly',$this->getName());
		$merchandiseID = ToolGetMIdFormItemPageLink($Mlink);
	
		//進入管理商品頁面
		$listMerchandise = new ListMerchandisePage($this->driver);
		$listMerchandise->open();
		//搜尋商品
		$listMerchandise->searchMerchandiseByID($merchandiseID);
		//預約上架
		$listMerchandise->clickEarlyPublish();
		//刪除
		$listMerchandise->clickDeleteLink();
		$result = $listMerchandise->searchMerchanByID($merchandiseID,'all');
	
		//error image
		$this->Selenium->takeErrorScreenShot($this->getName(),'searchDeleteDricetdEarly');
		//assert
		$this->assertTrue($result == 0);
		//logout
		$this->scenario->doLogout();
	}
	/**
	 * [Merchandise][testSearchPublishDricetdEarly] testSearchPublishDricetdEarly
	 * @group testSearchPublishDricetdEarly
	 * @group Web_Auto_New_Auc_C39956
	 * @tmTestCaseId Web_Auto_New_Auc_C39956
	 * @return assert success
	 * @author xingxing
	 */
	function XtestSearchPublishDricetdEarly(){ //Dn21
	
		//刊登商品
		$Mlink = $this->scenario->ScenarioForPublishAuction('directEarly',$this->getName());
		$merchandiseID = ToolGetMIdFormItemPageLink($Mlink);
	
		//進入管理商品頁面
		$listMerchandise = new ListMerchandisePage($this->driver);
		$listMerchandise->open();
		//搜尋商品
		$listMerchandise->searchMerchandiseByID($merchandiseID);
		//預約上架
		$listMerchandise->clickEarlyPublish();
		//click 上架
		$listMerchandise->clickPublishLink();
		$result = $listMerchandise->searchMerchanByID($merchandiseID,'shelve');
	
		//error image
		$this->Selenium->takeErrorScreenShot($this->getName(),'searchPublishDricetdEarly');
		//assert
		$this->assertTrue($result > 0);
		//logout
		$this->scenario->doLogout();
	}
	/**
	 * [Merchandise][testCopyBidPublishTotalFee] testCopyBidPublishTotalFee
	 * @group testCopyBidPublishTotalFee
	 * @group Web_Auto_New_Auc_C62208
	 * @tmTestCaseId Web_Auto_New_Auc_C62208
	 * @return assert equals
	 * @author xingxing
	 */
	function XtestCopyBidPublishTotalFee(){ //Dn11 費用錯位有bug
	
		//刊登商品
		$Mlink = $this->scenario->ScenarioForPublishAuction('bidNow',$this->getName());
		if($Mlink){
			$merchandiseID = substr($Mlink,-12);
			echo 'merchandiseID:'.$merchandiseID.PHP_EOL;
		}
	
		//進入管理商品頁面
		$listMerchandise = new ListMerchandisePage($this->driver);
		$listMerchandise->open();
		//搜尋商品
		$listMerchandise->searchMerchandiseByID($merchandiseID);
		//複製
		$listMerchandise->clickCopyLink();
		//商品複製Step2
		$inputInfo = new InputAuctionContentPage($this->driver);
		//商品刊登費用明細 總計
		$totalFee = $inputInfo->getPublishTotalFee();
		//echo 'total:'.$totalFee;
	
		//error image
		$this->Selenium->takeErrorScreenShot($this->getName(),'copyBidPublishTotalFee');
		//assert
		$this->assertEquals($this->testData->publishTotalFee,$totalFee);
		//logout
		$this->scenario->doLogout();
		$this->Selenium->takeErrorScreenShot($this->getName(),'logout');
	}
	/**
	 * [Search][testCopyEditDirectTypeAndCategoryStep2] testCopyEditDirectTypeAndCategoryStep2
	 * @group testCopyEditDirectTypeAndCategoryStep2
	 * @group Web_Auto_New_Auc_C45614
	 * @tmTestCaseId Web_Auto_New_Auc_C45614
	 * @return assert true
	 * @author xingxing
	 */
	function XtestCopyEditDirectTypeAndCategoryStep2(){ //Dn9
	
		//刊登 SelectType and Category
		$Mlink = $this->scenario->ScenarioForPublishAuction('directNow',$this->getName());
		if($Mlink){
			$merchandiseID = substr($Mlink,-12);
			echo 'merchandiseID:'.$merchandiseID.PHP_EOL;
		}
	
		//pages
		$listMerchandise = new ListMerchandisePage($this->driver);
		$inputAuctionContentPage = new InputAuctionContentPage($this->driver);
		$SelectAuctionTypePage = new SelectAuctionTypePage($this->driver);
	
		//進入管理商品頁面
		$listMerchandise->open();
		//搜尋商品
		$listMerchandise->searchMerchandiseByID($merchandiseID);
		//複製
		$listMerchandise->clickCopyLink();
	
		//編輯商品類別
		$inputAuctionContentPage->clickEditType();
		$SelectAuctionTypePage->clickBidPublish();
		$SelectAuctionTypePage->clickSave();
		$type = $inputAuctionContentPage->getItemTypeContentText();
		//編輯商品分類
		$inputAuctionContentPage->clickEditCategory();
		$SelectAuctionTypePage->clickAuctionType('ISBN');
		$SelectAuctionTypePage->clickSave();
		$category = $inputAuctionContentPage->getItemCategoryContentText();
	
		//error image
		$this->Selenium->takeErrorScreenShot($this->getName(),'copyEditDirectTypeAndCategoryStep2');
		//assert
		$this->assertEquals($this->testData->itemTypeAndCategory['typeBid'],$type);
		$this->assertEquals($this->testData->itemTypeAndCategory['category'],$category);
		//logout
		$this->scenario->doLogout();
		$this->Selenium->takeErrorScreenShot($this->getName(),'logout');
	}
	/**
	 * [Merchandise][testCopyHasPriceBidIntoStep2] testCopyHasPriceBidIntoStep2
	 * @group testCopyHasPriceBidIntoStep2
	 * @group Web_Auto_New_Auc_C39330
	 * @tmTestCaseId Web_Auto_New_Auc_C39330
	 * @return assert success
	 * @author xingxing
	 */
	function XtestCopyHasPriceBidIntoStep2(){ // Dn9Q
	
		//刊登商品
		$Mlink = $this->scenario->ScenarioForPublishAuction('bidNow',$this->getName());
		if($Mlink){
			$merchandiseID = substr($Mlink,-12);
			echo 'merchandiseID:'.$merchandiseID.PHP_EOL;
		}
		//換賬號
		$this->scenario->changeUserLogin('','',$this->getName());
		//競標商品 出價
		$this->scenario->itemPageBuy($Mlink,'bidNow',$this->getName());
	
		//換賬號
		$this->scenario->changeUserLogin($this->testData->testUser1,$this->testData->testPasswd1, $this->getName());
		//進入管理商品頁面
		$listMerchandise = new ListMerchandisePage($this->driver);
		$listMerchandise->open();
		//[管理商品][列表][商品][操作][上架中][競標品][有人出價]click複製
		$listMerchandise->merchandiseManagementItemList('bidNow','競標商品','copy_hasprice',$merchandiseID);
	
		//複製 刊登Step2
		$inputInfo = new InputAuctionContentPage($this->driver);
		//title
		$title = $inputInfo->getTitle();
	
		//error image
		$this->Selenium->takeErrorScreenShot($this->getName(),'copyHasPriceBidIntoStep2');
		//assert
		$this->assertEquals($this->testData->publishRequiredData['title'],$title);
		//logout
		$this->scenario->doLogout();
		$this->Selenium->takeErrorScreenShot($this->getName(),'logout');
	}
	/**
	 * [Merchandise][testEasySubmitClickSaveButton] testEasySubmitClickSaveButton
	 * @group testEasySubmitClickSaveButton
	 * @group Web_Auto_New_Auc_C58715
	 * @tmTestCaseId Web_Auto_New_Auc_C58715
	 * @return assert success
	 * @author xingxing
	 */
	function XtestEasySubmitClickSaveButton(){ //Dn15
	
		//簡易刊登 step1
		$this->scenario->easySubmitStep1('directNow',$this->getName());
	
		//page
		$inputAuctionContentPage = new InputAuctionContentPage($this->driver);
		//商品類別
		$type = $inputAuctionContentPage->getItemTypeContentText();
		//echo 'type:'.$type;
		//商品分類
		$category = $inputAuctionContentPage->getItemCategoryContentText();
		//echo 'category:'.$category;
	
		//error image
		$this->Selenium->takeErrorScreenShot($this->getName(),'easySubmitClickSaveButton');
		//assert
		$this->assertEquals($this->testData->itemTypeAndCategory['typeDirect'],$type);
		$this->assertEquals($this->testData->itemTypeAndCategory['categoryDefault'],$category);
		//logout
		$this->scenario->doLogout();
		$this->Selenium->takeErrorScreenShot($this->getName(),'logout');
	}
	/**
	 * [Merchandise][testClickEasyBeginToPublishPageStep1] testClickEasyBeginToPublishPageStep1
	 * @group testClickEasyBeginToPublishPageStep1
	 * @group Web_Auto_New_Auc_C33718
	 * @tmTestCaseId Web_Auto_New_Auc_C33718
	 * @return assert success
	 * @author xingxing
	 */
	function XtestClickEasyBeginToPublishPageStep1(){ //Dn15
	
		//login
		$myaucPage = new MyAucPage($this->driver);
		$myaucPage->open();
		$myaucPage->login($this->testData->testUser1, $this->testData->testPasswd1);
	
		// navigate to Publish page
		$BeginPublishPage = new BeginPublishPage($this->driver);
		$BeginPublishPage->open();
	
		//find "簡易刊登 的 開始刊登" and click it
		$BeginPublishPage->clickbeginSimplePublishButton();
		//刊登費
		$inputAuctionContentPage = new InputAuctionContentPage($this->driver);
		$categoryText = $inputAuctionContentPage->getTextSelectCategory();
		echo 'categoryText:'.$categoryText;
	
		//error image
		$this->Selenium->takeErrorScreenShot($this->getName(),'clickEasyBeginToPublishPageStep1');
		//assert
		$this->assertEquals('選擇商品類型',$categoryText);
		//logout
		$this->scenario->doLogout();
		$this->Selenium->takeErrorScreenShot($this->getName(),'logout');
	}
	/**
	 * [Search][testSearchCopyBidInManagementItemList] testSearchCopyBidInManagementItemList
	 * @group testSearchCopyBidInManagementItemList
	 * @group Web_Auto_New_Auc_C62566
	 * @tmTestCaseId Web_Auto_New_Auc_C62566
	 * @return assert true
	 * @author xingxing
	 */
	function XtestSearchCopyBidInManagementItemList(){ //Dn18
	
		//刊登商品
		$Mlink = $this->scenario->ScenarioForPublishAuction('bidNow',$this->getName());
		$merchandiseID = ToolGetMIdFormItemPageLink($Mlink);
	
		//進入管理商品頁面
		$listMerchandise = new ListMerchandisePage($this->driver);
		$listMerchandise->open();
		//搜尋商品
		$listMerchandise->searchMerchandiseByID($merchandiseID);
		//複製
		$listMerchandise->clickCopyLink();
		//複製刊登商品
		$Mlink = $this->scenario->operationPublisMerchandise();
	
		//get copy MID
		$merchandiseID = ToolGetMIdFormItemPageLink($Mlink);
	
		//搜尋商品
		$listMerchandise->open();
		$listMerchandise->searchMerchandiseByID($merchandiseID);
		$result = $listMerchandise->getSearchResultNum();
	
		//error image
		$this->Selenium->takeErrorScreenShot($this->getName(),'searchCopyBidInManagementItemList');
		//assert
		$this->assertTrue($result > 0);
		//logout
		$this->scenario->doLogout();
	}
	/**
	 * [Merchandise][testCopyBidItemPage] testCopyBidItemPage
	 * @group testCopyBidItemPage
	 * @group Web_Auto_New_Auc_C62567
	 * @tmTestCaseId Web_Auto_New_Auc_C62567
	 * @return assert equals
	 * @author xingxing
	 */
	function XtestCopyBidItemPage(){ //Dn18
	
		//刊登商品
		$Mlink = $this->scenario->ScenarioForPublishAuction('bidNow',$this->getName());
		$merchandiseID = ToolGetMIdFormItemPageLink($Mlink);
	
		//管理商品 page
		$listMerchandisePage = new ListMerchandisePage($this->driver);
		//進入管理商品
		$listMerchandisePage->open();
		//搜尋商品 by merchandiseID
		$searchR = $listMerchandisePage->searchMerchandiseByID($merchandiseID);
		//複製
		$listMerchandisePage->clickCopyLink();
		//複製刊登商品
		$Mlink = $this->scenario->operationPublisMerchandise();
	
		//get copy MID
		$merchandiseID = ToolGetMIdFormItemPageLink($Mlink);
		//搜尋商品
		$listMerchandisePage->open();
		$listMerchandisePage->searchMerchandiseByID($merchandiseID);
	
		$listMerchandisePage->clickItemName();
		//confirm item page
		$itemPage = new ItemPage($this->driver, '');
		$tCR = $itemPage->confirmTitle($this->testData->publishBidRequiredData['title']);
		$qCR = $itemPage->confirmBidQuantityText($this->testData->publishBidRequiredData['totalQuantityText']);
		$sCR = $itemPage->confirmSaleOrStartPrice($this->testData->publishBidRequiredData['startPrice']);
		$iCR = $itemPage->confirmBidItemStatePublish($this->testData->publishBidRequiredData['itemStateText']);
		$scCR = $itemPage->confirmBidSearch_cityPublish($this->testData->publishBidRequiredData['search_cityText']);
		$cCR = $itemPage->confirmBidContent($this->testData->publishBidRequiredData['content']);
		//確認ItemPage相關字段都修改正確
		if($tCR && $qCR && $sCR && $iCR && $scCR && $cCR){
			$itemPageResult = true;
		}else {
			$itemPageResult = false;
		}
		echo 'tCR:'.$tCR.'   qCR:'.$qCR.'   sCR:'.$sCR.'   iCR:'.$iCR.'  scCR:'.$scCR.'   cCR:'.$cCR
		.'    itemPageResult:'.$itemPageResult.PHP_EOL;
	
		//error image
		$this->Selenium->takeErrorScreenShot($this->getName(),'copyBidItemPage');
		//assert
		$this->assertTrue($itemPageResult);
		//logout
		$this->scenario->doLogout();
	}
	/**
	 * [Search][testPublisBidNameLength] testPublisBidNameLength
	 * @group testPublisBidNameLength
	 * @group Web_Auto_New_Auc_C61596
	 * @tmTestCaseId Web_Auto_New_Auc_C61702
	 * @tmTestCaseId Web_Auto_New_Auc_C61716
	 * @tmTestCaseId Web_Auto_New_Auc_C61739
	 * @tmTestCaseId Web_Auto_New_Auc_C61767
	 * @tmTestCaseId Web_Auto_New_Auc_C61596
	 * @return assert true
	 * @author xingxing
	 */
	function XtestCopyBidNameLength(){ //Dn20
	
		//刊登商品
		$Mlink = $this->scenario->ScenarioForPublishAuction('bidNow',$this->getName());
		$merchandiseID = ToolGetMIdFormItemPageLink($Mlink);
	
		//pages
		$listMerchandise = new ListMerchandisePage($this->driver);
		$inputAuctionContentPage = new InputAuctionContentPage($this->driver);
	
		//管理商品
		$listMerchandise->open();
		$listMerchandise->searchMerchandiseByID($merchandiseID);
		//click 複製
		$listMerchandise->clickCopyLink();
	
		//title 不超過60字
		$titleMaxLength = $inputAuctionContentPage->getTitleMaxlength();
		//echo 'titleMaxLength:'.$titleMaxLength;
		//數量 不超過999
		$qtyMaxLength = $inputAuctionContentPage->getQtyMaxlength();
		//echo 'qtyMaxLength:'.$qtyMaxLength;
		//起標價 不超過3百萬
		$inputAuctionContentPage->sendKeysStartPrice('10000000');
		//拍賣底價 不超過3百萬
		$inputAuctionContentPage->sendKeysReservePricePrice('20000000');
		//立即結標價 不超過3百萬
		$inputAuctionContentPage->sendKeysBuyNowPrice('30000000');
	
		//click next 秀出errorinfo
		$inputAuctionContentPage->clickNext();
		$startPE = $inputAuctionContentPage->getStartPriceError();
		//echo 'start:'.$startPE;
		$reservePE = $inputAuctionContentPage->getReservePriceError();
		//echo 'reserve:'.$reservePE;
		$buyNowPE = $inputAuctionContentPage->getBuynowPriceError();
		//echo 'buynow:'.$buyNowPE;
	
		//error image
		$this->Selenium->takeErrorScreenShot($this->getName(),'copyBidNameLength');
		//assert
		$this->assertEquals(60,$titleMaxLength);
		$this->assertEquals(3,$qtyMaxLength);
		$this->assertEquals('價格設定不得超過3百萬',$startPE);
		$this->assertEquals('價格設定不得超過3百萬',$reservePE);
		$this->assertEquals('價格設定不得超過3百萬',$buyNowPE);
		//logout
		$this->scenario->doLogout();
	}
	/**
	 * [Search][testCopyEditBidTypeAndCategoryStep2] testCopyEditBidTypeAndCategoryStep2
	 * @group testCopyEditBidTypeAndCategoryStep2
	 * @group Web_Auto_New_Auc_C61576
	 * @tmTestCaseId Web_Auto_New_Auc_C61576
	 * @return assert true
	 * @author xingxing
	 */
	function XtestCopyEditBidTypeAndCategoryStep2(){ //Dn20
	
		//刊登 SelectType and Category
		$Mlink = $this->scenario->ScenarioForPublishAuction('bidNow',$this->getName());
		$merchandiseID = ToolGetMIdFormItemPageLink($Mlink);
	
		//pages
		$listMerchandise = new ListMerchandisePage($this->driver);
		$inputAuctionContentPage = new InputAuctionContentPage($this->driver);
		$SelectAuctionTypePage = new SelectAuctionTypePage($this->driver);
	
		//進入管理商品頁面
		$listMerchandise->open();
		//搜尋商品
		$listMerchandise->searchMerchandiseByID($merchandiseID);
		//複製
		$listMerchandise->clickCopyLink();
	
		//編輯商品類別
		$inputAuctionContentPage->clickEditType();
		$SelectAuctionTypePage->clickDirectPublish();
		$SelectAuctionTypePage->clickSave();
		$type = $inputAuctionContentPage->getItemTypeContentText();
		//編輯商品分類
		$inputAuctionContentPage->clickEditCategory();
		$SelectAuctionTypePage->clickAuctionType('ISBN');
		$SelectAuctionTypePage->clickSave();
		$category = $inputAuctionContentPage->getItemCategoryContentText();
	
		//error image
		$this->Selenium->takeErrorScreenShot($this->getName(),'copyEditDirectTypeAndCategoryStep2');
		//assert
		$this->assertEquals($this->testData->itemTypeAndCategory['typeDirect'],$type);
		$this->assertEquals($this->testData->itemTypeAndCategory['category'],$category);
		//logout
		$this->scenario->doLogout();
		$this->Selenium->takeErrorScreenShot($this->getName(),'logout');
	}
	/**
	 * [Merchandise][testSearchUpdateBidNowIntoMerchandiseList] testSearchUpdateBidNowIntoMerchandiseList
	 * @group testSearchUpdateBidNowIntoMerchandiseList
	 * @group Web_Auto_New_Auc_C43038
	 * @tmTestCaseId Web_Auto_New_Auc_C43033
	 * @tmTestCaseId Web_Auto_New_Auc_C43038
	 * @return assert equals
	 * @author xingxing
	 */
	function XtestSearchUpdateBidNowIntoMerchandiseList(){ //Dn20
	
		//刊登商品
		$Mlink = $this->scenario->ScenarioForPublishAuction('bidNow',$this->getName());
		$merchandiseID = ToolGetMIdFormItemPageLink($Mlink);
	
		//進入管理商品頁面
		$listMerchandise = new ListMerchandisePage($this->driver);
		$listMerchandise->open();
		//搜尋商品
		$listMerchandise->searchMerchandiseByID($merchandiseID);
		//修改商品
		$listMerchandise->clickUpdateLink();
		//修改刊登商品
		$Mlink = $this->scenario->operationPublisMerchandise();
		//get update MID
		$merchandiseID = ToolGetMIdFormItemPageLink($Mlink);
		//搜尋商品
		$listMerchandise->open();
		$listMerchandise->searchMerchandiseByID($merchandiseID);
		$result = $listMerchandise->getSearchResultNum();
	
		//error image
		$this->Selenium->takeErrorScreenShot($this->getName(),'searchUpdateBidNowIntoMerchandiseList');
		//assert
		$this->assertTrue($result > 0);
		//logout
		$this->scenario->doLogout();
	}
	/**
	 * [Merchandise][testSearchUpdateDirectNowIntoMerchandiseList] testSearchUpdateDirectNowIntoMerchandiseList
	 * @group testSearchUpdateDirectNowIntoMerchandiseList
	 * @group Web_Auto_New_Auc_C42005
	 * @tmTestCaseId Web_Auto_New_Auc_C42005
	 * @return assert equals
	 * @author xingxing
	 */
	function XtestSearchUpdateDirectNowIntoMerchandiseList(){ //Dn21
	
		//刊登商品
		$Mlink = $this->scenario->ScenarioForPublishAuction('directNow',$this->getName());
		$merchandiseID = ToolGetMIdFormItemPageLink($Mlink);
	
		//進入管理商品頁面
		$listMerchandise = new ListMerchandisePage($this->driver);
		$listMerchandise->open();
		//搜尋商品
		$listMerchandise->searchMerchandiseByID($merchandiseID);
		//修改商品
		$listMerchandise->clickUpdateLink();
		//修改刊登商品
		$Mlink = $this->scenario->operationPublisMerchandise();
		//get update MID
		$merchandiseID = ToolGetMIdFormItemPageLink($Mlink);
		//搜尋商品
		$listMerchandise->open();
		$listMerchandise->searchMerchandiseByID($merchandiseID);
		$result = $listMerchandise->getSearchResultNum();
	
		//error image
		$this->Selenium->takeErrorScreenShot($this->getName(),'searchUpdateDirectNowIntoMerchandiseList');
		//assert
		$this->assertTrue($result > 0);
		//logout
		$this->scenario->doLogout();
	}
	/**
	 * [Merchandise][testSearchSoldOutDeleteNOOrderBidNow] testSearchSoldOutDeleteNOOrderBidNow
	 * @group testSearchSoldOutDeleteNOOrderBidNow
	 * @group Web_Auto_New_Auc_C39947
	 * @tmTestCaseId Web_Auto_New_Auc_C39370
	 * @tmTestCaseId Web_Auto_New_Auc_C39947
	 * @return assert success
	 * @author xingxing
	 */
	function XtestSearchSoldOutDeleteNOOrderBidNow11111111(){ //Dn21 Dn26 重複了
	
		//刊登商品
		$Mlink = $this->scenario->ScenarioForPublishAuction('bidNow',$this->getName());
		$merchandiseID = ToolGetMIdFormItemPageLink($Mlink);
	
		//進入管理商品頁面
		$listMerchandise = new ListMerchandisePage($this->driver);
		$listMerchandise->open();
		//搜尋商品
		$listMerchandise->searchMerchandiseByID($merchandiseID);
		//取消競標，下架
		$listMerchandise->clickCancelBid();
		//已下架 搜尋商品
		$listMerchandise->searchMerchanByID($merchandiseID,'close');
		//刪除
		$listMerchandise->clickDeleteLink();
		$result = $listMerchandise->searchMerchanByID($merchandiseID,'all');
	
		//error image
		$this->Selenium->takeErrorScreenShot($this->getName(),'searchSoldOutDeleteNOOrderBidNow');
		//assert
		$this->assertTrue($result == 0);
		//logout
		$this->scenario->doLogout();
	}
	/**
	 * [Merchandise][testSearchCopyBidHasOrderIntoStep2] testSearchCopyBidHasOrderIntoStep2
	 * @group testSearchCopyBidHasOrderIntoStep2
	 * @group Web_Auto_New_Auc_C39942
	 * @tmTestCaseId Web_Auto_New_Auc_C39942
	 * @return assert equals
	 * @author xingxing
	 */
	function XtestSearchCopyBidHasOrderIntoStep21111111111(){ //Dn19 重複了
	
		//刊登商品
		$Mlink = $this->scenario->ScenarioForPublishAuction('bidNow',$this->getName());
		if($Mlink){
			$merchandiseID = substr($Mlink,-12);
			echo 'merchandiseID:'.$merchandiseID.PHP_EOL;
		}
		//購買
		$this->scenario->ScenarioForCreateAnOrder($Mlink,'bidNow',$this->getName());
	
		//換賬號
		$this->scenario->changeUserLogin($this->testData->testUser1,$this->testData->testPasswd1, $this->getName());
		//進入管理商品頁面
		$listMerchandise = new ListMerchandisePage($this->driver);
		$listMerchandise->open();
		//搜尋商品
		$listMerchandise->searchMerchandiseByID($merchandiseID);
		//已下架
		$listMerchandise->clickShelves();
		//判斷為 有得標者
		$hasOwner = $listMerchandise->getBidHasOwner();
		if('有得標者' == $hasOwner){
			//複製
			$listMerchandise->clickCopyLink();
			//商品複製Step2
			$inputInfo = new InputAuctionContentPage($this->driver);
			//title update
			$title = $inputInfo->getTitle();
	
			//error image
			$this->Selenium->takeErrorScreenShot($this->getName(),'searchCopyBidHasOrderIntoStep2');
			//assert
			$this->assertEquals($this->testData->publishRequiredData['title'],$title);
		}
		//logout
		$this->scenario->doLogout();
		$this->Selenium->takeErrorScreenShot($this->getName(),'logout');
	}
	/**
	 * [Merchandise][testSearchDeleteBidEarly] testSearchDeleteBidEarly
	 * @group testSearchDeleteBidEarly
	 * @group Web_Auto_New_Auc_C39986
	 * @tmTestCaseId Web_Auto_New_Auc_C39427
	 * @tmTestCaseId Web_Auto_New_Auc_C39986
	 * @return assert success
	 * @author xingxing
	 */
	function XtestSearchDeleteBidEarly1111111111(){ //Dn21  Dn26 重複了
	
		//刊登商品
		$Mlink = $this->scenario->ScenarioForPublishAuction('bidEarly',$this->getName());
		$merchandiseID = ToolGetMIdFormItemPageLink($Mlink);
	
		//進入管理商品頁面
		$listMerchandise = new ListMerchandisePage($this->driver);
		$listMerchandise->open();
		//搜尋商品
		$listMerchandise->searchMerchandiseByID($merchandiseID);
		//預約上架
		$listMerchandise->clickEarlyPublish();
		//刪除
		$listMerchandise->clickDeleteLink();
		$result = $listMerchandise->searchMerchanByID($merchandiseID,'all');
	
		//error image
		$this->Selenium->takeErrorScreenShot($this->getName(),'searchDeleteBidEarly');
		//assert
		$this->assertTrue($result == 0);
		//logout
		$this->scenario->doLogout();
	}
	
	/**
	 * **************************************************************************************************************************************************************
	 */
	
	/**
	 * [Merchandise][testUpdateBidEarlyIntoStep1] testUpdateBidEarlyIntoStep1
	 * @group testUpdateBidEarlyIntoStep1
	 * @group Web_Auto_New_Auc_C39431
	 * @tmTestCaseId Web_Auto_New_Auc_C39431
	 * @return assert success
	 * @author xingxing
	 */
	function testUpdateBidEarlyIntoStep1(){
	
		//刊登商品
		$Mlink = $this->scenario->ScenarioForPublishAuction('bidEarly',$this->getName());
		if($Mlink){
			$merchandiseID = substr($Mlink,-12);
			echo 'merchandiseID:'.$merchandiseID.PHP_EOL;
		}
	
		//進入管理商品頁面
		$listMerchandise = new ListMerchandisePage($this->driver);
		$listMerchandise->open();
		//[管理商品][列表][商品][操作][預約上架][競標品]click修改商品
		$listMerchandise->merchandiseManagementItemList('bidEarly','競標商品','update',$merchandiseID);
	
		//商品修改Step1
		$inputInfo = new InputAuctionContentPage($this->driver);
		//title update
		$title = $inputInfo->getTitle();
	
		//error image
		$this->Selenium->takeErrorScreenShot($this->getName(),'updateBidEarlyIntoStep1');
		//assert
		$this->assertEquals($this->testData->publishRequiredData['title'],$title);
		//logout
		$this->scenario->doLogout();
		$this->Selenium->takeErrorScreenShot($this->getName(),'logout');
	}
	/**
	 * [Merchandise][testCopyNOPriceBidIntoStep2] testCopyNOPriceBidIntoStep2
	 * @group testCopyNOPriceBidIntoStep2
	 * @group Web_Auto_New_Auc_C39337
	 * @tmTestCaseId Web_Auto_New_Auc_C39373
	 * @tmTestCaseId Web_Auto_New_Auc_C39337
	 * @return assert success
	 * @author xingxing
	 */
	function testCopyNOPriceBidIntoStep2(){
	
		//刊登商品
		$Mlink = $this->scenario->ScenarioForPublishAuction('bidNow',$this->getName());
		if($Mlink){
			$merchandiseID = substr($Mlink,-12);
			echo 'merchandiseID:'.$merchandiseID.PHP_EOL;
		}
	
		//進入管理商品頁面
		$listMerchandise = new ListMerchandisePage($this->driver);
		$listMerchandise->open();
		//[管理商品][列表][商品][操作][上架中][競標品][無人出價]click複製
		$listMerchandise->merchandiseManagementItemList('bidNow','競標商品','copy_noprice',$merchandiseID);
	
		//複製 刊登Step2
		$inputInfo = new InputAuctionContentPage($this->driver);
		//title
		$title = $inputInfo->getTitle();
	
		//error image
		$this->Selenium->takeErrorScreenShot($this->getName(),'copyNOPriceBidIntoStep2');
		//assert
		$this->assertEquals($this->testData->publishRequiredData['title'],$title);
		//logout
		$this->scenario->doLogout();
		$this->Selenium->takeErrorScreenShot($this->getName(),'logout');
	}
	/**
	 * [Merchandise][testCopyBidEarlyIntoStep2] testCopyBidEarlyIntoStep2
	 * @group testCopyBidEarlyIntoStep2
	 * @group Web_Auto_New_Auc_C39432
	 * @tmTestCaseId Web_Auto_New_Auc_C39432
	 * @return assert success
	 * @author xingxing
	 */
	function testCopyBidEarlyIntoStep2(){
	
		//刊登商品
		$Mlink = $this->scenario->ScenarioForPublishAuction('bidEarly',$this->getName());
		if($Mlink){
			$merchandiseID = substr($Mlink,-12);
			echo 'merchandiseID:'.$merchandiseID.PHP_EOL;
		}
	
		//進入管理商品頁面
		$listMerchandise = new ListMerchandisePage($this->driver);
		$listMerchandise->open();
		//[管理商品][列表][商品][操作][預約上架][競標品]click複製
		$listMerchandise->merchandiseManagementItemList('bidEarly','競標商品','copy',$merchandiseID);
	
		//複製 刊登Step2
		$inputInfo = new InputAuctionContentPage($this->driver);
		//title
		$title = $inputInfo->getTitle();
	
		//error image
		$this->Selenium->takeErrorScreenShot($this->getName(),'copyBidEarlyIntoStep2');
		//assert
		$this->assertEquals($this->testData->publishRequiredData['title'],$title);
		//logout
		$this->scenario->doLogout();
		$this->Selenium->takeErrorScreenShot($this->getName(),'logout');
	}
	/**
	 * [Merchandise][testCopyHasOrderBidIntoStep2] testCopyHasOrderBidIntoStep2
	 * @group testCopyHasOrderBidIntoStep2
	 * @group Web_Auto_New_Auc_C39365
	 * @tmTestCaseId Web_Auto_New_Auc_C39365
	 * @return assert success
	 * @author xingxing
	 */
	function testCopyHasOrderBidIntoStep2(){
	
		//刊登商品
		$Mlink = $this->scenario->ScenarioForPublishAuction('bidNow',$this->getName());
		if($Mlink){
			$merchandiseID = substr($Mlink,-12);
			echo 'merchandiseID:'.$merchandiseID.PHP_EOL;
		}
		//購買
		$this->scenario->ScenarioForCreateAnOrder($Mlink,'bidNow',$this->getName());
	
		//換賬號
		$this->scenario->changeUserLogin($this->testData->testUser1,$this->testData->testPasswd1, $this->getName());
		//進入管理商品頁面
		$listMerchandise = new ListMerchandisePage($this->driver);
		$listMerchandise->open();
		//[管理商品][列表][商品][操作][上架中][競標品][有人出價]click複製
		$listMerchandise->merchandiseManagementItemList('bidNow','競標商品','down_copy_hasorder',$merchandiseID);
	
		//複製 刊登Step2
		$inputInfo = new InputAuctionContentPage($this->driver);
		//title
		$title = $inputInfo->getTitle();
	
		//error image
		$this->Selenium->takeErrorScreenShot($this->getName(),'copyHasOrderBidIntoStep2');
		//assert
		$this->assertEquals($this->testData->publishRequiredData['title'],$title);
		//logout
		$this->scenario->doLogout();
		$this->Selenium->takeErrorScreenShot($this->getName(),'logout');
	}
	/**
	 * [Merchandise][testUpdateNOPriceBidIntoStep1] testUpdateNOPriceBidIntoStep1
	 * @group testUpdateNOPriceBidIntoStep1
	 * @group Web_Auto_New_Auc_C39336
	 * @tmTestCaseId Web_Auto_New_Auc_C39336
	 * @return assert success
	 * @author xingxing
	 */
	function testUpdateNOPriceBidIntoStep1(){
	
		//刊登商品
		$Mlink = $this->scenario->ScenarioForPublishAuction('bidNow',$this->getName());
		if($Mlink){
			$merchandiseID = substr($Mlink,-12);
			echo 'merchandiseID:'.$merchandiseID.PHP_EOL;
		}
		//進入管理商品頁面
		$listMerchandise = new ListMerchandisePage($this->driver);
		$listMerchandise->open();
		//[管理商品][列表][商品][操作][上架中][競標品][無人出價]click管理商品
		$listMerchandise->merchandiseManagementItemList('bidNow','競標商品','update_noprice',$merchandiseID);
	
		//修改 刊登Step1
		$inputInfo = new InputAuctionContentPage($this->driver);
		//title
		$title = $inputInfo->getTitle();
	
		//error image
		$this->Selenium->takeErrorScreenShot($this->getName(),'updateNOPriceBidIntoStep1');
		//assert
		$this->assertEquals($this->testData->publishRequiredData['title'],$title);
		//logout
		$this->scenario->doLogout();
		$this->Selenium->takeErrorScreenShot($this->getName(),'logout');
	}
	/**
	 * [Merchandise][testUpdateHasPriceBidIntoStep1] testUpdateHasPriceBidIntoStep1
	 * @group testUpdateHasPriceBidIntoStep1
	 * @group Web_Auto_New_Auc_C39329
	 * @tmTestCaseId Web_Auto_New_Auc_C39329
	 * @return assert success
	 * @author xingxing
	 */
	function testUpdateHasPriceBidIntoStep1(){
	
		//刊登商品
		$Mlink = $this->scenario->ScenarioForPublishAuction('bidNow',$this->getName());
		if($Mlink){
			$merchandiseID = substr($Mlink,-12);
			echo 'merchandiseID:'.$merchandiseID.PHP_EOL;
		}
		//換賬號
		$this->scenario->changeUserLogin('','',$this->getName());
		//競標商品 出價
		$this->scenario->itemPageBuy($Mlink,'bidNow',$this->getName());
	
		//換賬號
		$this->scenario->changeUserLogin($this->testData->testUser1,$this->testData->testPasswd1, $this->getName());
		//進入管理商品頁面
		$listMerchandise = new ListMerchandisePage($this->driver);
		$listMerchandise->open();
		//[管理商品][列表][商品][操作][上架中][競標品][有人出價]click管理商品
		$listMerchandise->merchandiseManagementItemList('bidNow','競標商品','update_hasprice',$merchandiseID);
	
		//修改 刊登Step1
		$inputInfo = new InputAuctionContentPage($this->driver);
		//title
		$title = $inputInfo->getTitle();
	
		//error image
		$this->Selenium->takeErrorScreenShot($this->getName(),'updateHasPriceBidIntoStep1');
		//assert
		$this->assertEquals($this->testData->publishRequiredData['title'],$title);
		//logout
		$this->scenario->doLogout();
		$this->Selenium->takeErrorScreenShot($this->getName(),'logout');
	}
	////////////////////////////// direct now items /////////////////////////////////////
	/**
	 * [Merchandise][testCopyOrderDricetIntoStep2] testCopyOrderDricetIntoStep2
	 * @group testCopyOrderDricetIntoStep2
	 * @group Web_Auto_New_Auc_C39346
	 * @tmTestCaseId Web_Auto_New_Auc_C39346
	 * @return assert success
	 * @author xingxing
	 */
	function testCopyOrderDricetIntoStep2(){
	
		//刊登商品
		$Mlink = $this->scenario->ScenarioForPublishAuction('directNow',$this->getName());
		if($Mlink){
			$merchandiseID = substr($Mlink,-12);
			echo 'merchandiseID:'.$merchandiseID.PHP_EOL;
		}
		//user5 购买
		$this->scenario->ScenarioForCreateAnOrder($Mlink, 'directNow', $this->getName());
	
		//換user4
		$this->scenario->changeUserLogin($this->testData->testUser1, $this->testData->testPasswd1,$this->getName());
		//進入管理商品頁面
		$listMerchandise = new ListMerchandisePage($this->driver);
		$listMerchandise->open();
		//[管理商品][列表][商品][操作][已下架][直購品][有賣出]click複製
		$listMerchandise->merchandiseManagementItemList('directNow','直購商品','down_copy_order',$merchandiseID);
	
		//商品複製Step2
		$inputInfo = new InputAuctionContentPage($this->driver);
		//title update
		$title = $inputInfo->getTitle();
		//error image
		$this->Selenium->takeErrorScreenShot($this->getName(),'clickCopyLink');
	
		//error image
		$this->Selenium->takeErrorScreenShot($this->getName(),'copyOrderDricetIntoStep2');
		//assert
		$this->assertEquals($this->testData->publishRequiredData['title'],$title);
		//logout
		$this->scenario->doLogout();
		$this->Selenium->takeErrorScreenShot($this->getName(),'logout');
	}
	/**
	 * [Merchandise][testCopyNoOrderDricetIntoStep2] testCopyNoOrderDricetIntoStep2
	 * @group testCopyNoOrderDricetIntoStep2
	 * @group Web_Auto_New_Auc_C39361
	 * @tmTestCaseId Web_Auto_New_Auc_C39361
	 * @return assert success
	 * @author xingxing
	 */
	function testCopyNoOrderDricetIntoStep2(){
	
		//刊登商品
		$Mlink = $this->scenario->ScenarioForPublishAuction('directNow',$this->getName());
	
		if($Mlink){
			$merchandiseID = substr($Mlink,-12);
			echo 'merchandiseID:'.$merchandiseID.PHP_EOL;
		}
		//進入管理商品頁面
		$listMerchandise = new ListMerchandisePage($this->driver);
		$listMerchandise->open();
		//[管理商品][列表][商品][操作][已下架][直購品][沒賣出]click複製
		$listMerchandise->merchandiseManagementItemList('directNow','直購商品','down_copy_noorder',$merchandiseID);
	
		//商品複製Step2
		$inputInfo = new InputAuctionContentPage($this->driver);
		//title update
		$title = $inputInfo->getTitle();
	
		//error image
		$this->Selenium->takeErrorScreenShot($this->getName(),'copyNoOrderDricetIntoStep2');
		//assert
		$this->assertEquals($this->testData->publishRequiredData['title'],$title);
		//logout
		$this->scenario->doLogout();
		$this->Selenium->takeErrorScreenShot($this->getName(),'logout');
	}
	/**
	 * [Merchandise][testUpdateDirectIntoStep1] testUpdateDirectIntoStep1
	 * @group testUpdateDirectIntoStep1
	 * @group Web_Auto_New_Auc_C39319
	 * @tmTestCaseId Web_Auto_New_Auc_C39319
	 * @return assert success
	 * @author xingxing
	 */
	function testUpdateDirectIntoStep1(){
	
		//刊登商品
		$Mlink = $this->scenario->ScenarioForPublishAuction('directNow',$this->getName());
		if($Mlink){
			$merchandiseID = substr($Mlink,-12);
			echo 'merchandiseID:'.$merchandiseID.PHP_EOL;
		}
	
		//進入管理商品頁面
		$listMerchandise = new ListMerchandisePage($this->driver);
		$listMerchandise->open();
		//[管理商品][列表][商品][操作][上架中][直購品]click修改商品
		$listMerchandise->merchandiseManagementItemList('directNow','直購商品','update',$merchandiseID);
	
		//商品修改Step1
		$inputInfo = new InputAuctionContentPage($this->driver);
		//title update
		$title = $inputInfo->getTitle();
	
		//error image
		$this->Selenium->takeErrorScreenShot($this->getName(),'updateDirectIntoStep1');
		//assert
		$this->assertEquals($this->testData->publishRequiredData['title'],$title);
		//logout
		$this->scenario->doLogout();
		$this->Selenium->takeErrorScreenShot($this->getName(),'logout');
	}
	/**
	 * [Merchandise][testUpdateDirectEarlyIntoStep1] testUpdateDirectEarlyIntoStep1
	 * @group testUpdateDirectEarlyIntoStep1
	 * @group Web_Auto_New_Auc_C39411
	 * @tmTestCaseId Web_Auto_New_Auc_C39411
	 * @return assert success
	 * @author xingxing
	 */
	function testUpdateDirectEarlyIntoStep1(){
	
		//刊登商品
		$Mlink = $this->scenario->ScenarioForPublishAuction('directEarly',$this->getName());
		if($Mlink){
			$merchandiseID = substr($Mlink,-12);
			echo 'merchandiseID:'.$merchandiseID.PHP_EOL;
		}
	
		//進入管理商品頁面
		$listMerchandise = new ListMerchandisePage($this->driver);
		$listMerchandise->open();
		//[管理商品][列表][商品][操作][預約上架][直購品]click修改商品
		$listMerchandise->merchandiseManagementItemList('directEarly','直購商品','update',$merchandiseID);
	
		//商品修改Step1
		$inputInfo = new InputAuctionContentPage($this->driver);
		//title update
		$title = $inputInfo->getTitle();
	
		//error image
		$this->Selenium->takeErrorScreenShot($this->getName(),'updateDirectEarlyIntoStep1');
		//assert
		$this->assertEquals($this->testData->publishRequiredData['title'],$title);
		//logout
		$this->scenario->doLogout();
		$this->Selenium->takeErrorScreenShot($this->getName(),'logout');
	}
	/**
	 * [Merchandise][testCopyDricetIntoStep2] testCopyDricetIntoStep2
	 * @group testCopyDricetIntoStep2
	 * @group Web_Auto_New_Auc_C39320
	 * @tmTestCaseId Web_Auto_New_Auc_C39320
	 * @return assert success
	 * @author xingxing
	 */
	function testCopyDricetIntoStep2(){
	
		//刊登商品
		$Mlink = $this->scenario->ScenarioForPublishAuction('directNow',$this->getName());
		if($Mlink){
			$merchandiseID = substr($Mlink,-12);
			echo 'merchandiseID:'.$merchandiseID.PHP_EOL;
		}
	
		//進入管理商品頁面
		$listMerchandise = new ListMerchandisePage($this->driver);
		$listMerchandise->open();
		//[管理商品][列表][商品][操作][上架中][直購品]click複製
		$listMerchandise->merchandiseManagementItemList('directNow','直購商品','copy',$merchandiseID);
	
		//商品複製Step2
		$inputInfo = new InputAuctionContentPage($this->driver);
		//title update
		$title = $inputInfo->getTitle();
	
		//error image
		$this->Selenium->takeErrorScreenShot($this->getName(),'copyDricetIntoStep2');
		//assert
		$this->assertEquals($this->testData->publishRequiredData['title'],$title);
		//logout
		$this->scenario->doLogout();
		$this->Selenium->takeErrorScreenShot($this->getName(),'logout');
	}
	/**
	 * [Merchandise][testCopyDirectEarlyIntoStep2] testCopyDirectEarlyIntoStep2
	 * @group testCopyDirectEarlyIntoStep2
	 * @group Web_Auto_New_Auc_C39412
	 * @tmTestCaseId Web_Auto_New_Auc_C39412
	 * @return assert success
	 * @author xingxing
	 */
	function testCopyDirectEarlyIntoStep2(){
	
		//刊登商品
		$Mlink = $this->scenario->ScenarioForPublishAuction('directEarly',$this->getName());
		if($Mlink){
			$merchandiseID = substr($Mlink,-12);
			echo 'merchandiseID:'.$merchandiseID.PHP_EOL;
		}
	
		//進入管理商品頁面
		$listMerchandise = new ListMerchandisePage($this->driver);
		$listMerchandise->open();
		//[管理商品][列表][商品][操作][預約上架][直購品]click複製
		$listMerchandise->merchandiseManagementItemList('directEarly','直購商品','copy',$merchandiseID);
	
		//複製 刊登Step2
		$inputInfo = new InputAuctionContentPage($this->driver);
		//title
		$title = $inputInfo->getTitle();
	
		//error image
		$this->Selenium->takeErrorScreenShot($this->getName(),'copyDirectEarlyIntoStep2');
		//assert
		$this->assertEquals($this->testData->publishRequiredData['title'],$title);
		//logout
		$this->scenario->doLogout();
		$this->Selenium->takeErrorScreenShot($this->getName(),'logout');
	}
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/**
	 * [Merchandise][testRelistBidEarlyCompleted] testRelistBidEarlyCompleted
	 * @group testRelistBidEarlyCompleted
	 * @group Web_Auto_New_Auc_C45541
	 * @return assert success
	 * @author xingxing
	 */
	function XtestRelistBidEarlyCompleted(){ //競標商品，預約上架，沒有重新刊登
	
		//刊登商品
		$Mlink = $this->scenario->ScenarioForPublishAuction('bidEarly',$this->getName());
		if($Mlink){
			$merchandiseID = substr($Mlink,-12);
			echo 'merchandiseID:'.$merchandiseID.PHP_EOL;
		}
		//pages
		$listMerchandise = new ListMerchandisePage($this->driver);
		$inputInfo = new InputAuctionContentPage($this->driver);
		$PublishAuctionPreViewPage = new PublishAuctionPreViewPage($this->driver);
		$PublishAuctionDonePage = new PublishAuctionDonePage($this->driver);
	
		//進入管理商品頁面
		$listMerchandise->open();
		//搜尋商品
		$listMerchandise->searchMerchanByID($merchandiseID,'appoint');
		//重新刊登
		$listMerchandise->clickRelistBid();
		//click next
		$inputInfo->clickNext();
		//click send
		$PublishAuctionPreViewPage->clickSend();
		//auction link
		$Mlink = $PublishAuctionDonePage->getItemPageText();
		$merchandiseID = substr($Mlink,-12);
	
		//搜尋商品
		$listMerchandise->searchMerchanByID($merchandiseID,'appoint');
		$result = $listMerchandise->getSearchResultNum();
	
		//error image
		$this->Selenium->takeErrorScreenShot($this->getName(),'relistBidEarlyCompleted');
		//assert
		$this->assertTrue($result);
		//logout
		$this->scenario->doLogout();
		$this->Selenium->takeErrorScreenShot($this->getName(),'logout');
	}
	
	
	
}
