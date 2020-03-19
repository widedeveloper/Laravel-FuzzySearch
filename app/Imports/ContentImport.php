<?php

namespace App\Imports;

use App\Content;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ContentImport implements ToModel, WithChunkReading, WithBatchInserts, WithStartRow
{
    public function __construct(){
        ini_set('max_execution_time', 9999999999999);
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $fillable = array('Municipality', 'Block', 'Lot', 'Qual', 'Property_Location', 'PropertyClass', 'OwnerName', 'OwnerMailingAddress', 'CityStateZip1', 'SqFt', 'YrBuilt', 'BuildingClass', 'PriorBlock', 'PriorLot', 'PriorQual', 'Updated', 'Zone', 'Account', 'MortgageAccount', 'BankCode', 'SpTaxCd1', 'SpTaxCd2', 'SpTaxCd3', 'SpTaxCd4', 'MapPage', 'AdditionalLots', 'LandDesc', 'BuildingDesc', 'Class4Code', 'Acreage', 'EPLOwn', 'EPLUse', 'EPLDesc', 'EPLStatue', 'EPLInit', 'EPLFurther', 'EPLFacilityName', 'Taxes1', 'Taxes2', 'Taxes3', 'Taxes4', 'SaleDate', 'DeedBook', 'DeedPage', 'SalePrice', 'NUCode', 'Ratio', 'TypeUse', 'Year2', 'Owner2', 'Street2', 'CityStateZip2', 'LandAssmnt2', 'BuildingAssmnt2', 'Exempt2', 'TotalAssmnt2', 'Assessed2', 'Year3', 'Owner3', 'Street3', 'CityStateZip3', 'LandAssmnt3', 'BuildingAssmnt3', 'Exempt3', 'TotalAssmnt3', 'Assessed3', 'Year4', 'Owner4', 'Street4', 'CityStateZip4', 'LandAssmnt4', 'BuildingAssmnt4', 'Exempt4', 'TotalAssmnt4', 'Assessed4', 'Year5', 'Owner5', 'Street5', 'CityStateZip5', 'LandAssmnt5', 'BuildingAssmnt5', 'Exempt5', 'TotalAssmnt5', 'Assessed5', 'Latitude', 'Longitude', 'Neigh', 'VCS', 'StyDesc', 'Style');
        
        foreach($row as $key=>$value){
            $insert_data[$fillable[$key]] = $value;
        }
        
        return new Content($insert_data);
    }
    public function chunkSize(): int
    {
        return 500;
    }
    public function batchSize(): int
    {
        return 500;
    }
    public function startRow(): int 
    {
        return 2;
    }
}
