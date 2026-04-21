<?php

class ics {
    /* Function is to get all the contents from ics and explode all the datas according to the events and its sections */
    function getIcsEventsAsArray($file) {
        $icalString = file_get_contents ( $file );
        $icsDates = array ();
        /* Explode the ICs Data to get datas as array according to string ‘BEGIN:’ */
        $icsData = explode ( "BEGIN:", $icalString );
        /* Iterating the icsData value to make all the start end dates as sub array */
        foreach ( $icsData as $key => $value ) {
			
            $icsDatesMeta [$key] = explode ( "\n", $value );
        }
        /* Itearting the Ics Meta Value */
        foreach ( $icsDatesMeta as $key => $value ) {
            foreach ( $value as $subKey => $subValue ) {
                /* to get ics events in proper order */
				
                $icsDates = $this->getICSDates ( $key, $subKey, $subValue, $icsDates );
            }
        }
        return $icsDates;
    }

    /* funcion is to avaid the elements wich is not having the proper start, end  and summary informations */
    function getICSDates($key, $subKey, $subValue, $icsDates) {
        if ($key != 0 && $subKey == 0) {
            $icsDates [$key] ["BEGIN"] = $subValue;
        } else {
            $subValueArr = explode ( ":", $subValue, 2 );
			//echo $subValueArr[0] .' ----- <br>';
            if (isset($subValueArr[1]) && $subValueArr[1]!='') {
				if(strpos($subValueArr[0], "DTSTART") !== false || strpos($subValueArr[0], "dtstart") !== false){
					$icsDates[$key]['DTSTART'] = $subValueArr[1];
				}else if(strpos($subValueArr[0], "DTEND") !== false || strpos($subValueArr[0], "dtend") !== false){
					$icsDates[$key]['DTEND'] = $subValueArr[1];
				}else{
					$icsDates[$key][$subValueArr[0]] = $subValueArr[1];
				}
                
            }
        }
        return $icsDates;
    }
}