<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ContentImport;
use Illuminate\Support\Facades\DB;
use App\Content;
use App\Town;
use FuzzyWuzzy\Fuzz;
use FuzzyWuzzy\Process;
use Goutte\Client;
use Maatwebsite\Excel\HeadingRowImport;


class HomeController extends Controller
{
    private $p_fieldLists;
    
    public function __construct(){
        $this->p_fieldLists = array('Municipality', 'Block', 'Lot', 'Qual', 'Property_Location', 'PropertyClass', 'OwnerName', 'OwnerMailingAddress', 'CityStateZip1', 'SqFt', 'YrBuilt', 'BuildingClass', 'PriorBlock', 'PriorLot', 'PriorQual', 'Updated', 'Zone', 'Account', 'MortgageAccount', 'BankCode', 'SpTaxCd1', 'SpTaxCd2', 'SpTaxCd3', 'SpTaxCd4', 'MapPage', 'AdditionalLots', 'LandDesc', 'BuildingDesc', 'Class4Code', 'Acreage', 'EPLOwn', 'EPLUse', 'EPLDesc', 'EPLStatue', 'EPLInit', 'EPLFurther', 'EPLFacilityName', 'Taxes1', 'Taxes2', 'Taxes3', 'Taxes4', 'SaleDate', 'DeedBook', 'DeedPage', 'SalePrice', 'NUCode', 'Ratio', 'TypeUse', 'Year2', 'Owner2', 'Street2', 'CityStateZip2', 'LandAssmnt2', 'BuildingAssmnt2', 'Exempt2', 'TotalAssmnt2', 'Assessed2', 'Year3', 'Owner3', 'Street3', 'CityStateZip3', 'LandAssmnt3', 'BuildingAssmnt3', 'Exempt3', 'TotalAssmnt3', 'Assessed3', 'Year4', 'Owner4', 'Street4', 'CityStateZip4', 'LandAssmnt4', 'BuildingAssmnt4', 'Exempt4', 'TotalAssmnt4', 'Assessed4', 'Year5', 'Owner5', 'Street5', 'CityStateZip5', 'LandAssmnt5', 'BuildingAssmnt5', 'Exempt5', 'TotalAssmnt5', 'Assessed5', 'Latitude', 'Longitude', 'Neigh', 'VCS', 'StyDesc', 'Style');
    }
    //
    public function index()
    {
        $fieldLists = $this->p_fieldLists;
        return view('home', compact('fieldLists'));
    }

    

    public function isMatched($search_str, $field_array, $search_row){
        $result = "";
        foreach( $field_array as $key=>$value ){
            if( !empty($value) || !empty($search_row[$key])){
                if ($value == "Municipality" ){
                    $municipality = Town::where('town', 'like', '%'.$search_str[$search_row[$key]].'%')->get();
                    if ( !$municipality->isEmpty() ){
                        $municipality = $municipality->first();
                        $search_str[$search_row[$key]] = $municipality['Municipality'];
                    }
                }
                $matchThese[$value] = $search_str[$search_row[$key]];
            }
        }
        // dd($matchThese);
        $results = Content::where($matchThese)->get();
        
        if ( !$results->isEmpty() ){
            $result = $results->first();
        }
        return $result;
    }
    public function isContainedMatched($search_str, $field_array, $search_row){
        $result = "";
        $results = new Content;
        foreach( $field_array as $key=>$value ){
            if( !empty($value) || !empty($search_row[$key])){
                $results = $results->where( $value, 'like', '%'.$search_str[$search_row[$key]].'%' );
            }
        }
        // $results = Content::where( 'Block', 'like', '%'.$search_str[0].'%' );
        // $results = $results->where( 'Lot', 'like', '%'.$search_str[1].'%' );
        // $results = $results->where( 'Property_Location', 'like', '%'.$search_str[3].'%' )->get();
        $results = $results->get();
        if ( !$results->isEmpty() ){
            $result = $results->first();
        }
        return $result;
    }

    public function first_FuzzyMatched($search_str, $field_array, $search_row){
        $result = "";
        $str    = "";
        $emptyCount = 0;
        // dd($field_array);
        foreach( $field_array as $key=>$value ){
            if( !empty($value) || !empty($search_row[$key])){
                // if ( $value == "Block" || $value == "Lot"){
                //     $matchThese[$value] = $search_str[$search_row[$key]];
                // } else {
                //     $str.=$search_str[$search_row[$key]];
                // }
                if ($value == "Municipality" ){
                    $municipality = Town::where('town', 'like', '%'.$search_str[$search_row[$key]].'%')->get();
                    if ( !$municipality->isEmpty() ){
                        $municipality = $municipality->first();
                        $search_str[$search_row[$key]] = $municipality['Municipality'];
                    }
                }
                if( $search_row[$key] < 2 ){
                    $matchThese[$value] = $search_str[$search_row[$key]];
                } else {
                    $str.=$search_str[$search_row[$key]];
                }
                $emptyCount++;
            }
        }

        if ($emptyCount > 3){
            $remainField = implode(',',array_slice($field_array, 2, -1));
            $results = Content::select(DB::raw("CONCAT($remainField) AS aaa"), 'id')->where($matchThese)->get()->pluck('aaa','id')->toArray();
        }elseif ($emptyCount == 3){
            $remainField = $field_array[2];
            $results = Content::select(DB::raw("CONCAT($remainField) AS aaa"), 'id')->where($matchThese)->get()->pluck('aaa','id')->toArray();
        }else{
            $results = "";
        }
        if ( $results ){
            // $fuzz = new Fuzz();
            // $process = new Process($fuzz);
            // $fuzzResult = $process->extractOne($str, $results);
            
            // $id = array_search ($fuzzResult[0], $results);
            // if ( $fuzzResult[1] > 50)
            //     $result = Content::where('id', $id)->get()->first();
            $levenshtein_result = $this->levenshtein_search($results, $str);
            $id = $levenshtein_result[0];
            if ( $levenshtein_result[1] < 10)
                $result = Content::where('id', $id)->get()->first();
        }
        
        return $result;
    }
    public function levenshtein_search($words, $input){
        $shortest = -1;

        // loop through words to find the closest
        foreach ($words as $key=>$word) {

            // calculate the distance between the input word,
            // and the current word
            $lev = levenshtein($input, $word);

            // check for an exact match
            if ($lev == 0) {

                // closest word is this one (exact match)
                $closest = $key;
                $shortest = 0;

                // break out of the loop; we've found an exact match
                break;
            }

            // if this distance is less than the next found shortest
            // distance, OR if a next shortest word has not yet been found
            if ($lev <= $shortest || $shortest < 0) {
                // set the closest match, and shortest distance
                $closest  = $key;
                $shortest = $lev;
            }
        }

        return [$closest, $shortest];
    }
    public function SearchString($text, $pattern, $k){
        $result = -1;
        $m = strlen($pattern);
        $textLen = strlen($text);
        $R = array();
        $patternMask = array();
        $i;
        $d;
    
        if (empty($pattern[0])) return 0;
        if ($m > 31) return -1; //Error: The pattern is too long!
    
        $R = array();
        for ($i = 0; $i <= $k; ++$i)
            $R[$i] = ~1;
    
        for ($i = 0; $i <= 127; ++$i)
            $patternMask[$i] = ~0;
    
        for ($i = 0; $i < $m; ++$i)
            $patternMask[ord($pattern[$i])] &= ~(1 << $i);
    
        for ($i = 0; $i < $textLen; ++$i)
        {
            $oldRd1 = $R[0];
    
            $R[0] |= $patternMask[ord($text[$i])];
            $R[0] <<= 1;
    
            for ($d = 1; $d <= $k; ++$d)
            {
                $tmp = $R[$d];
    
                $R[$d] = ($oldRd1 & ($R[$d] | $patternMask[ord($text[$i])])) << 1;
                $oldRd1 = $tmp;
            }
    
            if (0 == ($R[$k] & (1 << $m)))
            {
                $result = ($i - $m) + 1;
                break;
            }
        }
    
        unset($R);
        return $result;
    }
    public function FuzzyMatched($search_str, $search_result, $remainValues, $field_array, $search_row){
        foreach( $field_array as $index=>$value ){
            if( !empty($value) || !empty($search_row[$index])){
                if ( $index == 0 ){
                    $remainField = $value;
                }else{
                    $remainField.=','.$value;
                }
                
            }
        }
        
        // dd("==============");
        $ratio      = array_fill(0,2000,0);
        $pre_ratio  = array_fill(0,2000,20);
        // $result     = '';
        $end_flag   = false;
        $temp_results = $search_result;
        $row_count = Content::count();
        for($i=0; $i<10; $i++){
            $results = "";
            if( ($i+1)*20000 < $row_count){
                $results = Content::select(DB::raw("CONCAT($remainField) AS aaa"), 'id')->skip($i*20000)->take(20000)->get()->pluck('aaa','id')->toArray();
            }else{
                $results = Content::select(DB::raw("CONCAT($remainField) AS aaa"), 'id')->skip($i*20000)->take($row_count-$i*20000-1)->get()->pluck('aaa','id')->toArray();
                $end_flag = true;
            }

            
            foreach ( $remainValues as $key=>$row ){
                $str = "";
                foreach( $field_array as $index=>$value ){
                    if( !empty($value) || !empty($search_row[$index])){
                        if ($value == "Municipality" ){
                            $municipality = Town::where('town', 'like', '%'.$row[$search_row[$index]].'%')->get();
                            if ( !$municipality->isEmpty() ){
                                $municipality = $municipality->first();
                                $row[$search_row[$index]] = $municipality['Municipality'];
                            }
                        }
                        $str.=$row[$search_row[$index]];
                    }
                }

                // $aa = $this->SearchString($results, $str,1);
                $levenshtein_result = $this->levenshtein_search($results, $str);

                // dd($levenshtein_result);

                // $fuzz = new Fuzz();
                // $process = new Process($fuzz);
                // $fuzzResult = $process->extractOne($str, $results);
                
                // $id = array_search ($fuzzResult[0], $results);
                $id = $levenshtein_result[0];
                $ratio[$key] = $levenshtein_result[1];
                if ( $ratio[$key] < $pre_ratio[$key] ){
                    // dd($temp_results[1]);
                    // if( $ratio[$key] > 30 )
                    $temp_results[$key] = Content::where('id', $id)->get()->first();
                    $pre_ratio[$key] = $ratio[$key];
                }
            }
            

            // if ( $pre_ratio > 60 ){
            //     return $result;
            // }
            if( $end_flag ){
                return $temp_results;
            }
        }

        
        // for($i=0; $i<10; $i++){
        //     $results = "";
        //     if( ($i+1)*20000 < $row_count){
        //         $results = Content::skip($i*20000)->take(20000)->get();
        //     }else{
        //         $results = Content::skip($i*20000)->take($row_count-$i*20000-1)->get();
        //         $end_flag = true;
        //     }

            
        //     foreach( $results as $item ){
        //         foreach ( $remainValues as $key=>$row ){
        //             $str = "";
        //             $source_str = "";
        //             foreach( $field_array as $index=>$value ){
        //                 if( !empty($value) || !empty($search_row[$index])){
        //                     if ($value == "Municipality" ){
        //                         $municipality = Town::where('town', 'like', '%'.$row[$search_row[$index]].'%')->get();
        //                         if ( !$municipality->isEmpty() ){
        //                             $municipality = $municipality->first();
        //                             $row[$search_row[$index]] = $municipality['Municipality'];
        //                         }
        //                     }
        //                     $str.=$row[$search_row[$index]];
        //                     $source_str.=$item[$value];
        //                 }
        //             }

        //             // $str = $row[0].$row[1].$row[3];

        //             // $source_str = $item['Block'].$item['Lot'].$item['Property_Location'];
        //             $fuzz = new Fuzz();
        //             $ratio[$key] = $fuzz->ratio($str, $source_str);
                    
        //             if ( $ratio[$key] > $pre_ratio[$key] ){
        //                 // dd($temp_results[1]);
        //                 if( $ratio[$key] > 20 )
        //                     $temp_results[$key] = $item;
        //                 $pre_ratio[$key] = $ratio[$key];
                        
        //             }
        //         }
        //     }

        //     // if ( $pre_ratio > 60 ){
        //     //     return $result;
        //     // }
        //     if( $end_flag ){
        //         return $temp_results;
        //     }
        // }
        
    }

    

    public function getResult($search_str, $field_value, $search_row){
        $result = $this->isMatched( $search_str, $field_value, $search_row);
        if ( $result ){ return $result; }
        // $result = $this->isContainedMatched( $search_str, $field_value, $search_row );
        // if ( $result ){ return $result; }
        // $result = $this->first_FuzzyMatched( $search_str, $field_value, $search_row );
        // if ( $result ){ return $result; }
        return '';
    }

    public function search(Request $request)
    {
        
        $search_row = $request['search_sel'];
        $field_value = $request['data_sel'];
        // $this->validate($request, [
        //     'file'  => 'required|mimes:xls,xlsx'
        // ]);
        
        // get the search condtion array of file
        $rows = Excel::toArray(new UsersImport, $request->file('file'));
        $remainFlag = false;
        
        foreach ( $rows[0] as $key=>$row )
        {
            $result = "";
            if ( $key > 0 ) {
                $conditionContents[] = $row;
                // $result = $this->getResult($row, $field_value, $search_row);
                $result = "";
                // get empty values
                if ( empty($result) ){
                    $remainFlag = true;
                    $remainValues[$key] = $row;
                }
                $search_first_result[$key] = $result;
                
            }else {
                $conditionHeaders = $row;
            }
        }
        // dd($remainValues);
        // get the fuzzy matched result
        // $remainFlag = false;
        if ( $remainFlag ){
            $search_result = $this->FuzzyMatched($rows[0], $search_first_result, $remainValues, $field_value, $search_row);
        } else {
            $search_result = $search_first_result;
        }
        // dd("++++++++++++++++");
        $fieldLists = $this->p_fieldLists;
        // dd("Search End");
        return ['content' => (string)view('result_view')->with(compact('search_result', 'fieldLists', 'conditionHeaders', 'conditionContents', 'search_row'))];
        // return redirect('/')->with('success', 'All good!');
    }


    public function getHeaderRow(Request $request)
    {
        $headings = (new HeadingRowImport)->toArray($request->file('file'));
        return ['headings' => $headings[0]];
    }

    public function import(Request $request) 
    {
        Excel::import(new ContentImport,$request->file('file'));
        // $client = new Client();
        // $crawler = $client->request('GET', 'http://tax1.co.monmouth.nj.us/cgi-bin/prc6.cgi?&ms_user=monm&passwd=data&srch_type=0&adv=0&out_type=0&district=1400');
        // $crawler = $client->click($crawler->selectLink('Sign in')->link());
        // $form = $crawler->selectButton('Sign in')->form();
        // $crawler = $client->submit($form, array('login' => 'fabpot', 'password' => 'xxxxxx'));
        // $crawler->filter('.flash-error')->each(function ($node) {
        //     print $node->text()."\n";
        // });
        
        return back();
    }
    
}
