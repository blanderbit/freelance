<?php

class geo_location
{
    public function __construct()
    {
    }

    /**
     * Get country or get all countries
     *
     * @param string $country_name
     * @param string $language
     * @return array
     */
    public function get_country($country_name=null, $language='en'){
        $countries = [];

        if($country_name != null){
            $where = " WHERE title_".$language."='$country_name';";
        }else{
            $where = "";
        }

        $query = "SELECT `country_id`, `title_$language` FROM `_countries` ".$where;

        if ($res = sql::$con->query($query)) {
            while ($data = $res->fetch_array(MYSQLI_ASSOC)) {
                $countries[] = $data;
            }

            if(is_object($res)){
                $res->close();
                sql::$con->store_result();
            }
        }



        return $countries;
    }

    /**
     * Get region with region name or country ID
     *
     * @param int $country_id
     * @param string $region_name
     * @param string $language
     * @return array
     */
    public function get_region($country_id=null, $region_name=null, $language='en'){

        $regions = [];
        $where = "";

        if($region_name != null){
            $where = " WHERE title_".$language."='$region_name'";
        }

        if($country_id != null){
            if(trim($where) == ''){
                $where .= " WHERE `country_id`='$country_id';";
            }else{
                $where .= " AND `country_id`='$country_id';";
            }
        }

        $query = "SELECT `country_id`, `region_id`, `title_$language` FROM `_regions` ".$where;

        if ($res = sql::$con->query($query)) {
            while ($data = $res->fetch_array(MYSQLI_ASSOC)) {
                $regions[] = $data;
            }

            if(is_object($res)){
                $res->close();
                sql::$con->store_result();
            }
        }



        return $regions;
    }

    /**
     * Get city with city name or region ID or country ID
     *
     * @param int $country_id
     * @param int $region_id
     * @param string $city_name
     * @param string $language
     * @return array
     */
    public function get_city($country_id=null, $region_id=null, $city_name=null, $language='en'){

        $cities = [];
        $where = "";

        if($city_name != null){
            $where = " WHERE title_".$language."='$city_name'";
        }

        if($region_id != null){
            if(trim($where) == ''){
                $where .= " WHERE `region_id`='$region_id'";
            }else{
                $where .= " AND `region_id`='$region_id'";
            }
        }

        if($country_id != null){
            if(trim($where) == ''){
                $where .= " WHERE `country_id`='$country_id';";
            }else{
                $where .= " AND `country_id`='$country_id';";
            }
        }

        $query = "SELECT `city_id`, `country_id`, `important`, `region_id`, `title_$language` FROM `_cities` ".$where;

        if ($res = sql::$con->query($query)) {
            while ($data = $res->fetch_array(MYSQLI_ASSOC)) {
                $cities[] = $data;
            }

            if(is_object($res)){
                $res->close();
                sql::$con->store_result();
            }
        }

        return $cities;
    }

    public function __destruct()
    {
    }
}

$geo_location = new geo_location();