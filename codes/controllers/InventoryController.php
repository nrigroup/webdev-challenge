<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\UploadForm;
use yii\web\UploadedFile;
use yii\data\SqlDataProvider;

class InventoryController extends \yii\web\Controller
{
	public $error = array();
	
	
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    /**
     * Accepts csv file and process it, saving into the database and display statistical summary
     * 
     * 
     * 
     */    
    public function actionUpload()
    {
				
		$model = new UploadForm();
		
        if (Yii::$app->request->isPost) {
			
            $model->uploadFile = UploadedFile::getInstance($model, 'uploadFile');
                       
            $filePath = Yii::$app->params['fileUploadPath'] . $model->uploadFile->baseName . '.' . $model->uploadFile->extension;
           
            if ($model->upload()) {
								
				$data = $this->parseData($filePath);
				
				$this->saveAllData($data);
				
				$dataProviderCategory = $this->displayStatPerCategory();
				
				$dataProviderMonth = $this->displayStatPerMonth();
	
                return $this->render('upload',[
					'error'=>$this->error, 
					'dataProviderCategory'=>$dataProviderCategory,
					'dataProviderMonth'=>$dataProviderMonth
				]);
            }
            

        }
        
        $dataProvider = $this->displayStatPerCategory();

		
		return $this->render('upload', ['model' => $model]);
	}
	
	/**
	 * Reads file content and convert into array or object
	 * 
	 * @params string	$filePath
	 * @return object
	 *  
	 */	
	private function parseData($filePath)
	{
		
		$catID = \app\models\Categories::getCategoryID('Construction');
	
		$content = file_get_contents($filePath);
		
		$data = array_map('str_getcsv', file($filePath));
		
		array_walk($data, function(&$a) use ($data) {
			$a = array_combine($data[0], $a);
		});
		
		array_shift($data);
		
		$parsedData = array();
		
		foreach($data as $key => $item) 
		{
			
			$parsedData[$key] = (object) array();
			
			$parsedData[$key]->date = date("Y-m-d",strtotime($item['date'])); 						
			$parsedData[$key]->lot_title = $item['lot title']; 	
			$parsedData[$key]->lot_location = $item['lot location']; 	
			$parsedData[$key]->pre_tax_amount = $item['pre-tax amount']; 				
			$parsedData[$key]->tax_amount = $item['tax amount']; 								
			
			$parsedData[$key]->category =  \app\models\Categories::getCategoryID($item['category']); 
			
			$parsedData[$key]->lot_condition = \app\models\LotCondition::getLotConditionID($item['lot condition']);
			
			$parsedData[$key]->tax_name =  \app\models\TaxName::getTaxNameID($item['tax name']);
			
			if(is_null($parsedData[$key]->category)) {
				// category does not exist, so add it
				$parsedData[$key]->category =  \app\models\Categories::addCategory($item['category']);
			}
			
			if(is_null($parsedData[$key]->lot_condition)) {
				// lot condition does not exist, so add it
				$parsedData[$key]->lot_condition =  \app\models\LotCondition::addLotCondition($item['lot condition']);
			}
			
			if(is_null($parsedData[$key]->tax_name)) {
				// tax name does not exist, so add it
				$parsedData[$key]->tax_name =  \app\models\TaxName::addTaxName($item['tax name']);
			}
			
			
		}
		
		return $parsedData;
    
    
		
		
	}
	
	/**
	 * Saves one record into the database
	 * 
	 * @params object $data
	 * @return bool
	 * 
	 */
	public function saveOneData($data)
	{
		$inventoryData = new \app\models\Inventory();
		$inventoryData->date = $data->date;
		$inventoryData->category = $data->category;
		$inventoryData->lot_title = $data->lot_title;
		$inventoryData->lot_location = $data->lot_location;
		$inventoryData->lot_condition = $data->lot_condition;
		$inventoryData->pre_tax_amount = $data->pre_tax_amount;
		$inventoryData->tax_name = $data->tax_name;
		$inventoryData->tax_amount = $data->tax_amount;
		
		
		if($inventoryData->save()) {
			
			return true;
			
		} else {
			
			
			
			$this->error['notsaved'][] = implode(",",(array) $inventoryData->attributes)."\n";

			return false;
		}
		
		
		
		
		
	}
	
	/**
	 * Loops at an object or array and save each item into the database
	 * 
	 * @params object $data
	 * @return bool
	 * 
	 */
	public function saveAllData($data)
	{
		foreach($data as $key => $item) {
			
			$this->saveOneData($item);
			
		}
		
	}
	
	/*
	 * queries into database and display stat summary per category
	 * 
	 */
	public static function displayStatPerCategory()
	{
		
		 
		 $dataProvider = new SqlDataProvider([
			'sql' => "select c.category, sum(i.`tax_amount`) as tax_subtotal
			from inventory i left join categories c on i.`category`=c.`id`
			group by i.`category`",
			
		]);
		
		return $dataProvider;
		
		
		
		
	}
	
	/**
	 * 
	 * queries into database and display stat summary per month
	 * 
	 */
	public static function displayStatPerMonth()
	{
		
		 
		 $dataProvider = new SqlDataProvider([
			'sql' => "select 
								date_format(i.`date`,'%b-%Y') as month, c.category,
								sum(i.`tax_amount`) as tax_subtotal
					from inventory i left join categories c on i.`category`=c.`id`
					group by date_format(i.`date`,'%c-%Y')
					order by i.`date`",
			
		]);
		
		return $dataProvider;
		
		
		
		
	}

}
