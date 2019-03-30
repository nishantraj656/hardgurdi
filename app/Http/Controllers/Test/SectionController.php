<?php

namespace App\Http\Controllers\Test;

use App\Section;
use App\QuestionS;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          /**SELECT `test_info_tab`.`test_name`,`test_info_tab`.`test_name`,`test_info_tab`.`pic`,`test_info_tab`.`enroll_stud_count`,
`test_info_tab`.`test_price`,`test_info_tab`.`marks_on_correct`,`test_info_tab`.`marks_on_incorrect`,`package_tab`.`subcat_name` from `test_info_tab`
INNER JOIN `package_tab` ON `package_tab`.`package_id` = `test_info_tab`.`package_id` */
$data =DB::table('test_info_tab')
->select('test_info_tab.test_name as title','test_info_tab.test_info_id as infoID','test_info_tab.pic','test_info_tab.enroll_stud_count as count',
'test_info_tab.test_price as price','test_info_tab.marks_on_correct','test_info_tab.marks_on_incorrect','package_tab.subcat_name as package',
'test_info_tab.status','test_info_tab.expDate')
->join('package_tab','package_tab.package_id','=','test_info_tab.package_id')
->where('test_info_tab.issectional',"=",1)
->get();
return view('section.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list =new QuestionSetController();
        $list = $list->list();
        return view('section.create',['list'=>$list]);
    }

    public function filter()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Section $section)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Section $section)
    {
        //
    }
}
