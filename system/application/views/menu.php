<?php

echo "<div class='menu'>";

$yearno = $this->Adminmodel->maxvalue($table = 'academicyear', $fields = array('AcademicYear'), $where = array());
foreach($yearno as $yno){
	if($yno->AcademicYear != NULL){
		$year = $yno->AcademicYear;
	}
}

$attributes = array(
                    'class' => 'sf-menu',
                    'id'    => 'menulist'
              );


/*$num = count($rollmenu);
$str  = '';
$i = 1;
for($i = 1; $i < 6; $i++){
	$str = "<a href='/school/home/listview'>".$i."</a>=> array(";
	foreach($rollmenu as $menu){
		if($i == $menu->MainMenuId){
			$str = $str."<a href='/school/home/listview'>".$menu->SubMenuId."</a>";
		}
	}
	$str = $str.'),';		
}

$list = array($str);*/

$list = array(

            "<a href='".$url."/home/listview'>Home</a>",
			
			"<a href='".$url."/admin/adminview'>Admin</a>" => array(
                                "<a href='".$url."roll/listview'>Rolls</a>",
								"<a href='".$url."user/listview'>Users</a>",
								"<a href='".$url."stafftype/listview'>Staff Type</a>",
                                "<a href='".$url."subject/listview'>Subjects</a>",
                                "<a href='".$url."course/listview'>Courses</a>",
								"<a href='".$url."classsubject/listview/'>Class Subjects</a>",
								"<a href='".$url."examtype/listview'>Exam Types</a>",
								"<a href='".$url."classfees/listview/".$year."'>Class Fees</a>",
								"<a href='".$url."hostelfees/listview/".$year."'>Hostel Fees</a>",
								"<a href='".$url."student/upload/'>Upload Student List</a>",
								"<a href='".$url."expendituretype/listview/".$year."'>Expenditure Type</a>",
								"<a href='".$url."expenditure/listview/".$year."'>Expenditure</a>",
								/*"<a href='".$url."hostelfees/listview/'>Time Table</a>" => array(
									"<a href='".$url."hostelfees/listview/'>Total Periods</a>",
									"<a href='".$url."hostelfees/listview/'>Periods and Timings</a>"	
								)	*/	
								"<a href='".$url."autogenerateid/GenerateRollNo/'>Generate RollNo</a>",
								"<a href='".$url."setting/settingview/'>Settings</a>"
								
                            ),
							
            "<a href='#'>Student</a>" => array(
                                "<a href='".$url."student/listview/".$year."'>Students</a>",
                                "<a href='".$url."attendence/listview/".$year."'>Attendence</a>",
                                "<a href='".$url."marks/listview/".$year."'>Marks</a>",
								"<a href='".$url."schoolfee/listview/".$year."'>School Fees</a>",
								"<a href='".$url."examfee/listview/".$year."'>Exam Fees</a>",
								"<a href='".$url."student/assignlist/".$year."'>Student Class</a>",  
								"<a href='".$url."profile/changepassword'>Change Password</a>",
								"<a href='".$url."profile/myprofile'>Profile</a>",
								"<a href='".$url."login/newinstitute'>Institute</a>"
								
                            ),
							
			"<a href='#'>Staff</a>" => array(
                                "<a href='".$url."staff/listview'>Staff</a>",
                                /*"<a href='".$url."timetable/listview'>Time Table</a>" */
                            ),
			"<a href='#'>Library</a>" => array(
								"<a href='".$url."libraryreg/listview'>Register</a>",
								"<a href='".$url."category/listview'>Category</a>",
                                "<a href='".$url."book/listview'>Books</a>",
                                "<a href='".$url."libraryrecord/listview/".$year."'>Mangement</a>" 
                            ),
			"<a href='#'>Hostel</a>" => array(
								"<a href='".$url."hostelreg/listview/".$year."'>Register</a>",
								"<a href='".$url."hostelrecord/listview/".$year."'>Mangement</a>",
                                "<a href='".$url."hostelrecord/records/view'>Records</a>"
                            ),				
			"<a href='#'>Reports</a>" => array(
								"<a href='".$url."school/reports/strength'>Strength report</a>",
                                "<a href='".$url."school/reports/schoolfees'>School fees report</a>",
                                "<a href='".$url."school/reports/hostelfees'>Hostel fees report</a>",
                                "<a href='".$url."school/reports/expenditure'>Expenditure report</a>"	
                            )
			);	
echo ul($list, $attributes);									
echo "</div>";
?>
