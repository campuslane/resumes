<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use App\Models\Resume;
use App\Models\Item;
use Illuminate\Http\Request;

Route::get('dom', function(){
	$dom = new DOMDocument;

	$html = '
	<p>Here is some text.</p><ul><li>one</li><li>two</li><li>three</li></ul><p>Some trailing text.</p>

	';
	$dom->loadHTML($html);
	$elements = $dom->getElementsByTagName('*');
	foreach ($elements as $element) {


		print '<pre>';
		print_r($element);
		print '</pre>';
		
		
	    //echo $element->nodeValue, PHP_EOL;
	    //echo '<br>';
	}

});

Route::get('/', function () {

	//$resume = Resume::with('items')->find(1);
	//
	$resumeId = 1;

    return view('resumes.resume', compact('resumeId'));
});

Route::get('word', function() {
	return view('word');
});

Route::post('/resume', function(Request $request){

	$resumeId = $request->resume_id;

	return Resume::with('items')->find($resumeId)->items;
});

Route::post('/job-add', function(Request $request){

	$job = $request->item;

	return Item::create($job);

	
});

Route::post('/edit-item', function(Request $request){

	$id = $request->id;

	return Item::find($id);
	
	
});

Route::get('document', function(){

	// Creating the new document...
	$phpWord = new \PhpOffice\PhpWord\PhpWord();

	/* Note: any element you append to a document must reside inside of a Section. */

	// Adding an empty Section to the document...
	$section = $phpWord->addSection();

	// Adding Text element to the Section having font styled by default...
	// $section->addText(
	//     htmlspecialchars(
	//         '"Learn from yesterday, live for today, hope for tomorrow. '
	//             . 'The important thing is not to stop questioning." '
	//             . '(Albert Einstein)'
	//     )
	// );

	/*
	 * Note: it's possible to customize font style of the Text element you add in three ways:
	 * - inline;
	 * - using named font style (new font style object will be implicitly created);
	 * - using explicitly created font style object.
	 */

	// Adding Text element with font customized inline...
	// $section->addText(
	//     htmlspecialchars(
	//         '"Great achievement is usually born of great sacrifice, '
	//             . 'and is never the result of selfishness." '
	//             . '(Napoleon Hill)'
	//     ),
	//     array('name' => 'Tahoma', 'size' => 10)
	// );

	// Adding Text element with font customized using named font style...
	$fontStyleName = 'resumeHeader';
	$phpWord->addFontStyle(
	    $fontStyleName,
	    array('name' => 'Myriad Pro', 'size' => 12, 'color' => '888888', 'bold' => false)
	);
	$section->addText(
	    htmlspecialchars(
	        'PROFESSIONAL EXPERIENCE'
	    ),
	    $fontStyleName
	);

	//$section = $phpWord->addSection();

	$fontStyleName = 'resumeText';
	$phpWord->addFontStyle(
	    $fontStyleName,
	    array('name' => 'Arial', 'size' => 10, 'bold' => false)
	);
	$section->addText(
	    htmlspecialchars(
	        App\Models\Item::where('type', 'job')->first()->job_content
	    ),
	    $fontStyleName
	);

	// Adding Text element with font customized using explicitly created font style object...
	// $fontStyle = new \PhpOffice\PhpWord\Style\Font();
	// $fontStyle->setBold(true);
	// $fontStyle->setName('Tahoma');
	// $fontStyle->setSize(13);
	// $myTextElement = $section->addText(
	//     htmlspecialchars('"Believe you can and you\'re halfway there." (Theodor Roosevelt)')
	// );
	// $myTextElement->setFontStyle($fontStyle);

	// Saving the document as OOXML file...
	$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
	$objWriter->save('helloChicken.docx');
	return redirect('/helloChicken.docx');

	// return 'done';

	// // Saving the document as ODF file...
	// $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'ODText');
	// $objWriter->save('helloWorld.odt');

	// // Saving the document as HTML file...
	// $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');
	// $objWriter->save('helloWorld.html');


});
