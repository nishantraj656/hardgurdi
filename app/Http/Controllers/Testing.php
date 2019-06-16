<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Testing extends Controller
{
    function testing()
    {
    	 
		// Get the image and convert into string 
		$img = file_get_contents(
			'http://localhost/laravel/HardiGurdi/HD/public/storage/Set/PC6m6P1C4gEX5rupdZPyrnddZm6k9IHZZeE7pSVS.jpeg'); 
		  
		// Encode the image string data into base64 
		$data = base64_encode($img); 
		  
		// Display the output 
		echo $data; 
    }
}
