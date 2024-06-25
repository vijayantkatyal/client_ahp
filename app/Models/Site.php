<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $table = 'site_settings';

    protected $fillable = [
        'language','theme', 'name', 'logo', 'agency_id'
    ];

    public static function settings()
    {
        // $url = $_SERVER['HTTP_HOST'];
        
		// $APP_URL_DOMAIN = "domain.com";
        // // if(strpos($url, env('APP_URL_DOMAIN')) != false)
		// if(strpos($url, $APP_URL_DOMAIN) != false)
        // {
        //     $parsedUrl = parse_url($url);
        //     // $host = explode('.', $parsedUrl['host']);
        //     // for server
        //     $host = explode('.', $parsedUrl['path']);
        //     $subdomain = $host[0];
            
        //     if($subdomain != "dashboard")
        //     {
        //         $site = Site::where('unique_name', $subdomain)->first();
        //         if($site)
        //         {
        //             return $site;
        //         }
        //     }
        // }
        // else
        // {
        //     // return Site::where('id', 2)->first();

        //     $url_1 = "http://".$url;
        //     $url_2 = "https://".$url;

        //     $site = Site::where('external_url', $url_1)->orWhere('external_url', $url_2)->first();
        //     if($site)
        //     {
        //         return $site;
        //     }
        // }

		
        
        // app
        return Site::first();

        // agency
        // return Site::where('id', 2)->first();
    }

    public static function topMenu()
    {
        $pages = Page::where('type', '!=', 'custom')->where('show_in_top_menu', true)->select('id', 'name')->get();
        return $pages;
    }

    public static function bottomMenu()
    {
        $pages = Page::where('type', '!=', 'custom')->where('show_in_footer', true)->select('id', 'name')->get();
        return $pages;
    }

    public static function arraySearch($array, $index, $value)
    {
        foreach($array as $arrayInf) {
            if($arrayInf[$index] == $value) {
                return $arrayInf;
            }
        }
        return null;
    }

    public static function objArraySearch($array, $index, $value)
    {
        foreach($array as $arrayInf) {
            if($arrayInf->{$index} == $value) {
                return $arrayInf;
            }
        }
        return null;
	}

    public static function getItem($schema, $block_name, $varName)
    {
        try
        {
            return Site::objArraySearch(json_decode($schema)->blocks, "name", $block_name)->attributes->{$varName}->value;
        }
        catch(\Exception $ex)
        {
            return null;
        }
    }

    public static function getItemCollection($schema, $block_name, $varName)
    {
        try
        {
            return Site::objArraySearch(json_decode($schema)->blocks, "name", $block_name)->attributes->{$varName}->values;
        }
        catch(\Exception $ex)
        {
            return null;
        }
    }

    public static function getItemCollectionParent($schema, $block_name)
    {
        try
        {
            return Site::objArraySearch(json_decode($schema)->blocks, "name", $block_name)->values;
        }
        catch(\Exception $ex)
        {
            return null;
        }
    }
}
