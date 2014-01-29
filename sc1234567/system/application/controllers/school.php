<?php
class School extends Controller 
{

	var $pageinfo;
	var $url;
	function __construct()
	{
		parent::Controller();
		$this->load->library('session');
		$this->load->helper('url');
		//if ($this->session->userdata('rollid') == '' || $this->session->userdata('database') == '') exit(redirect('login/index'));
		if ($this->session->userdata('rollid') == '' ) exit(redirect('login/index'));
		$this->load->helper('html');
		$this->load->library('table');
	    $this->load->library('parser');	
		$this->load->model('Adminmodel');
		$this->load->database();
		$this->load->library('pagination');
		$this->url = base_url();
		$this->pageinfo = array('title' => 'SCHOOL', 'url' => $this->url, 'pagetitle' => 'Books');
		$this->load->library('session');
$this->load->helper('url');
		$years = $this->Adminmodel->show_rows($table = 'academicyear', $where = array());
		$this->session->set_userdata('years', $years);
	}
	
	function attendance ()
	{
		
	  $sql = "SELECT ClassName,ms,fs,totste,ma,fa,totatt,(totatt/totste)*100 AS attper
		FROM
		(
		SELECT f1.cid,f1.m AS ms,f1.f AS fs,f1.m+f1.f AS totste,f2.m AS ma,f2.f AS fa,f2.m+f2.f AS totatt
		FROM
		(SELECT b.CourseId AS cid, COUNT(*) AS m, (SELECT COUNT(*) FROM student AS a WHERE a.Gender='f' AND a.CourseId=b.CourseId) AS f
		 FROM student b
		WHERE b.Gender='m' 
		GROUP BY b.CourseId,b.Gender
		UNION
		SELECT b.CourseId AS cid,(SELECT COUNT(*) FROM student AS a WHERE a.Gender='m' AND a.CourseId=b.CourseId) AS m, COUNT(*) AS f
		 FROM student b
		WHERE b.Gender='f' 
		GROUP BY b.CourseId,b.Gender
		) AS f1,
		(SELECT b.CourseId AS cid, COUNT(*) AS m,
		(SELECT COUNT(*) FROM dailyattendence AS c, student AS d 
		WHERE c.StudentId = d.StudentRollNo AND c.attendDate='2011-12-04' AND d.Gender='f' AND d.CourseId=b.CourseId) AS f
		FROM dailyattendence AS a, student AS b 
		WHERE a.StudentId = b.StudentRollNo AND a.attendDate='2011-12-04' AND b.Gender='m' 
		GROUP BY b.CourseId,  b.Gender
		UNION
		SELECT b.CourseId AS cid, 
		(SELECT COUNT(*) FROM dailyattendence AS c, student AS d 
		WHERE c.StudentId = d.StudentRollNo AND c.attendDate='2011-12-04' AND d.Gender='m' AND d.CourseId=b.CourseId) AS m,COUNT(*) AS f
		FROM dailyattendence AS a, student AS b 
		WHERE a.StudentId = b.StudentRollNo AND a.attendDate='2011-12-04' AND b.Gender='f' 
		GROUP BY b.CourseId,  b.Gender
		) AS f2
		WHERE
		f1.cid=f2.cid
		
		UNION
		
		SELECT f1.cid,f1.m AS ms,f1.f AS fs,f1.m+f1.f AS totste,0 AS ma,0 AS fa,0 AS totatt
		FROM
		(SELECT b.CourseId AS cid, COUNT(*) AS m, (SELECT COUNT(*) FROM student AS a WHERE a.Gender='f' AND a.CourseId=b.CourseId) AS f
		 FROM student b
		WHERE b.Gender='m' 
		GROUP BY b.CourseId,b.Gender
		UNION
		SELECT b.CourseId AS cid,(SELECT COUNT(*) FROM student AS a WHERE a.Gender='m' AND a.CourseId=b.CourseId) AS m, COUNT(*) AS f
		 FROM student b
		WHERE b.Gender='f' 
		GROUP BY b.CourseId,b.Gender
		) AS f1,
		(SELECT b.CourseId AS cid, COUNT(*) AS m,
		(SELECT COUNT(*) FROM dailyattendence AS c, student AS d 
		WHERE c.StudentId = d.StudentRollNo AND c.attendDate='2011-12-04' AND d.Gender='f' AND d.CourseId=b.CourseId) AS f
		FROM dailyattendence AS a, student AS b 
		WHERE a.StudentId = b.StudentRollNo AND a.attendDate='2011-12-04' AND b.Gender='m' 
		GROUP BY b.CourseId,  b.Gender
		UNION
		SELECT b.CourseId AS cid, 
		(SELECT COUNT(*) FROM dailyattendence AS c, student AS d 
		WHERE c.StudentId = d.StudentRollNo AND c.attendDate='2011-12-04' AND d.Gender='m' AND d.CourseId=b.CourseId) AS m,COUNT(*) AS f
		FROM dailyattendence AS a, student AS b 
		WHERE a.StudentId = b.StudentRollNo AND a.attendDate='2011-12-04' AND b.Gender='f' 
		GROUP BY b.CourseId,  b.Gender
		) AS f2
		WHERE
		f1.cid<>f2.cid
		GROUP BY f1.cid
		HAVING COUNT(*)>1
		) AS m1,course AS m2
		WHERE m1.cid=m2.ClassId
		ORDER BY cid
		";
	   $data['totalattend'] = $this->Homemodel->query_fun($sql);
	   		
	  /*$books = array();
	  $books [] = array(
	  'title' => 'PHP Hacks',
	  'author' => 'Jack Herrington',
	  'publisher' => "O'Reilly"
	  );
	  $books [] = array(
	  'title' => 'Podcasting Hacks',
	  'author' => 'Jack Herrington',
	  'publisher' => "O'Reilly"
	  );
*/  
	
	  $doc = new DOMDocument();
	  $doc->formatOutput = true;
	  
	  $r = $doc->createElement( "attendance" );
	  $doc->appendChild( $r );
	  
	  foreach( $data['totalattend'] as $attend )
	  {
		  
		  $course = $doc->createElement( "course" );
	  	  $r->appendChild( $course );
		  
		  $class = $doc->createElement( "class" );
		  $class->appendChild($doc->createTextNode( $attend->ClassName ));
	  	  $course->appendChild( $class );
		   
		  $tb = $doc->createElement( "totalboys" );
		  $tb->appendChild($doc->createTextNode( $attend->ms ));
		  $course->appendChild( $tb );
		  
		  $tg = $doc->createElement( "totalgirls" );
		  $tg->appendChild($doc->createTextNode( $attend->fs ));
		  $course->appendChild( $tg );
		  
		  $t = $doc->createElement( "total" );
		  $t->appendChild($doc->createTextNode( $attend->totste ));
		  $course->appendChild( $t );
		  
		  $tba = $doc->createElement( "totalboysattend" );
		  $tba->appendChild($doc->createTextNode( $attend->ma ));
		  $course->appendChild( $tba );
		  
		  $tga = $doc->createElement( "totalgirlsattend" );
		  $tga->appendChild($doc->createTextNode( $attend->fa ));
		  $course->appendChild( $tga );
		  
		  $ta = $doc->createElement( "totalattend" );
		  $ta->appendChild($doc->createTextNode( $attend->totatt ));
		  $course->appendChild( $ta );
		  
		  $tp = $doc->createElement( "totalpercent" );
		  $tp->appendChild($doc->createTextNode( $attend->attper ));
		  $course->appendChild( $tp );
	  }
	  
	  
	   $doc->saveXML();
  	   $doc->save("xml/attendance.xml");
	   header("Location:".$this->url.'xml/attendance.xml');
	}
	
	function termfees ()
	{
		
	  $sql = "SELECT sf.RollNo as rollno, s.StudentName as studentname , c.ClassName as class, sf.TermNo as termno, sf.ReceptNo as recieptno, sf.Fees as amount
				FROM student s, schoolfees sf, course c
				WHERE s.StudentRollNo = sf.RollNo 
				   AND s.CourseId = c.ClassId
				   AND YEAR(sf.PaidDate) = YEAR(NOW())
				ORDER BY PaidDate DESC";
	  $data['termfees'] = $this->Homemodel->query_fun($sql);
	  	
	  $doc = new DOMDocument();
	  $doc->formatOutput = true;
	  
	  $r = $doc->createElement( "termfees" );
	  $doc->appendChild( $r );
	  
	  foreach( $data['termfees'] as $attend )
	  {
		  
		  $fees = $doc->createElement( "rollno" );
	  	  $r->appendChild( $fees );
		  
		  $rollno = $doc->createElement( "rollno" );
		  $rollno->appendChild($doc->createTextNode( $attend->rollno ));
	  	  $fees->appendChild( $rollno );
		  
		  $studentname = $doc->createElement( "studentname" );
		  $studentname->appendChild($doc->createTextNode( $attend->studentname ));
	  	  $fees->appendChild( $studentname );
		   
		  $class = $doc->createElement( "class" );
		  $class->appendChild($doc->createTextNode( $attend->class ));
		  $fees->appendChild( $class );
		  
		  $termno = $doc->createElement( "termno" );
		  $termno->appendChild($doc->createTextNode( $attend->termno ));
		  $fees->appendChild( $termno );
		  
		  $recieptno = $doc->createElement( "recieptno" );
		  $recieptno->appendChild($doc->createTextNode( $attend->recieptno ));
		  $fees->appendChild( $recieptno );
		  
		  $amount = $doc->createElement( "amount" );
		  $amount->appendChild($doc->createTextNode( $attend->amount ));
		  $fees->appendChild( $amount );
		  
		 }
	  
	  
	   $doc->saveXML();
  	   $doc->save("xml/termfees.xml");
	   header("Location:".$this->url.'xml/termfees.xml');
	}
	
	function spentamt ()
	{
		
	  $sql = "SELECT ExpenditureFor AS spentfor, BillNo AS bill, Amount AS amt, SpentBy AS spentby FROM expenditure";
	  $data['spentamt'] = $this->Homemodel->query_fun($sql);
	  	
	  $doc = new DOMDocument();
	  $doc->formatOutput = true;
	  
	  $r = $doc->createElement( "spentamt" );
	  $doc->appendChild( $r );
	  $i = 1;
	  foreach( $data['spentamt'] as $attend )
	  {
		  
		  $exp = $doc->createElement("Amount");
	  	  $r->appendChild( $exp );
		  
		  $spentfor = $doc->createElement( "spentfor" );
		  $spentfor->appendChild($doc->createTextNode( $attend->spentfor ));
	  	  $exp->appendChild( $spentfor );
		  
		  $bill = $doc->createElement( "bill" );
		  $bill->appendChild($doc->createTextNode( $attend->bill ));
	  	  $exp->appendChild( $bill );
		   
		  $amt = $doc->createElement( "amt" );
		  $amt->appendChild($doc->createTextNode( $attend->amt ));
		  $exp->appendChild( $amt );
		  
		  $spentby = $doc->createElement( "spentby" );
		  $spentby->appendChild($doc->createTextNode( $attend->spentby ));
		  $exp->appendChild( $spentby );
		  
		  $i++;		  
		 }
	  
	  
	   $doc->saveXML();
  	   $doc->save("xml/spentamt.xml");
	   header("Location:".$this->url.'xml/spentamt.xml');
	}
	
	function reports($url){
		if($url === 'schoolfees'){
			$this->pageinfo = array('title' => 'SCHOOL', 'url' => $this->url,'event' => 'Report', 'pagetitle' => 'Schoolfees');
			$this->load->view('header', $this->pageinfo);
			$this->load->view('menu');
			$this->load->view('reports/schoolfees');
			//$this->load->view('footer');
		}else if($url === 'schoolfeeslist'){
			$data['FromDate'] = $this->input->post('FromDate');
			$data['ToDate'] = $this->input->post('ToDate');
			$data['Year'] = $this->input->post('Year');
			$this->load->view('reports/schoolfeeslist', $data);
		}if($url === 'hostelfees'){
			$this->pageinfo = array('title' => 'SCHOOL', 'url' => $this->url,'event' => 'Report', 'pagetitle' => 'Hostelfees');
			$this->load->view('header', $this->pageinfo);
			$this->load->view('menu');
			$this->load->view('reports/hostelfees');
			//$this->load->view('footer');
		}else if($url === 'hostelfeeslist'){
			$data['FromDate'] = $this->input->post('FromDate');
			$data['ToDate'] = $this->input->post('ToDate');
			$data['Year'] = $this->input->post('Year');
			$this->load->view('reports/hostelfeeslist', $data);
		}else if($url === 'expenditure'){
			$this->pageinfo = array('title' => 'SCHOOL', 'url' => $this->url,'event' => 'Report', 'pagetitle' => 'Expenditure');
			$this->load->view('header', $this->pageinfo);
			$this->load->view('menu');
			$this->load->view('reports/expenditure');
		}else if($url === 'expenditurelist'){
			$FromDate = $this->input->post('FromDate');
			$ToDate = $this->input->post('ToDate');
			$Year = $this->input->post('Year');
			$table = 'expenditure';
			$sql2 = '';
			$sql1 = "SELECT * FROM expenditure WHERE YEAR = '$Year'";
			if((isset($FromDate) && $FromDate != '') && (isset($ToDate) && $ToDate != '')){
				$sql2 = " AND BillDate BETWEEN '$FromDate' AND '$ToDate'";
			}
			$sql = $sql1 . $sql2;	
			$data['expenditure'] = $this->Adminmodel->query_fun($sql);
			$table = 'expendituretype';
			$data['expendituretype'] = $this->Adminmodel->show_rows($table,$where=array());
			$this->load->view('reports/expenditurelist', $data);
		}else if($url === 'strength'){
			$this->pageinfo = array('title' => 'SCHOOL', 'url' => $this->url,'event' => 'Report', 'pagetitle' => 'Student\'s Strength');
			$this->load->view('header', $this->pageinfo);
			$this->load->view('menu');
			$this->load->view('reports/strength');
		}else if($url === 'strengthlist'){
			$Year = $this->input->post('Year');
			$data['year'] = $Year;
			$this->load->view('reports/strengthlist', $data);
		}
	}
	
	function exportstrenth(){
		$i = 1; $total = 0;
		$year = $this->uri->segment(3);
		header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename = Strenthreport.xls");
        header("Pragma: no-cache");
        header("Expires: 0");
		echo "<table class='reporttable' border='0' cellpadding='0' cellspacing='1' >";
		
		echo "<tr style='font-size:12px; font-weight:bold; color:#3e4341; border-right:1px solid #a4a9a8; background-color:#b3c1bb; height:30px; text-align:center;'>";
		echo "<th align='center' rowspan = '2' >Class</th>";
		$sql = "select * from castcategory";
		$castcategory = $this->Adminmodel->query_fun($sql);
		$sql = "select * from course";
		$course = $this->Adminmodel->query_fun($sql);
		foreach($castcategory as $cc){
			echo "<th align='center' colspan = '3' >".$cc->CastCategory."</th>";
		}
		echo "<th align='center'  rowspan = '2' >Class Grand <br />Total</th>";
		echo "</tr>";
		echo '<tr>';
			for($i = 0; $i < count($castcategory); $i++){
				echo'<th align="center" >Boys</th>
				<th align="center" >Girls</th>
				<th align="center" >Total</th>';
			}	
		echo'</tr>';
		foreach($course as $cs){
			$sql = "SELECT studentclass.StudentClass, 
			SUM(IF(student.CastCategoryId = 1 AND student.Gender = 'm', 1, 0)) AS  'OCm',
			SUM(IF(student.CastCategoryId = 1 AND student.Gender = 'f', 1, 0)) AS  'OCf',
			SUM(IF(student.CastCategoryId = 2 AND student.Gender = 'm', 1, 0)) AS  'BCAm',
			SUM(IF(student.CastCategoryId = 2 AND student.Gender = 'f', 1, 0)) AS  'BCAf',
			SUM(IF(student.CastCategoryId = 3 AND student.Gender = 'm', 1, 0)) AS  'BCBm',
			SUM(IF(student.CastCategoryId = 3 AND student.Gender = 'f', 1, 0)) AS  'BCBf',
			SUM(IF(student.CastCategoryId = 4 AND student.Gender = 'm', 1, 0)) AS  'BCCm',
			SUM(IF(student.CastCategoryId = 4 AND student.Gender = 'f', 1, 0)) AS  'BCCf',
			SUM(IF(student.CastCategoryId = 5 AND student.Gender = 'm', 1, 0)) AS  'BCDm',
			SUM(IF(student.CastCategoryId = 5 AND student.Gender = 'f', 1, 0)) AS  'BCDf',
			SUM(IF(student.CastCategoryId = 6 AND student.Gender = 'm', 1, 0)) AS  'STm',
			SUM(IF(student.CastCategoryId = 6 AND student.Gender = 'f', 1, 0)) AS  'STf',
			SUM(IF(student.CastCategoryId = 7 AND student.Gender = 'm', 1, 0)) AS  'SCm',
			SUM(IF(student.CastCategoryId = 7 AND student.Gender = 'f', 1, 0)) AS  'SCf'
			FROM student
			JOIN studentclass ON student.StudentRollNo = studentclass.RollNo
			JOIN castcategory ON student.CastCategoryId = castcategory.CastCategoryId
			WHERE studentclass.StudentClass = $cs->ClassId AND studentclass.Year = '$year' 
			GROUP BY studentclass.RollNo";
			$strengthlist = $this->Adminmodel->query_fun($sql);
			$OCm = 0; $OCf =0; $BCAm = 0; $BCAf = 0; $BCBm = 0; $BCBf = 0; $BCCm = 0;
			$BCCf = 0; $BCDm = 0; $BCDf = 0; $STm = 0; $STf = 0; $SCm = 0; $SCf = 0;
				
					/*foreach($strengthlist as $stl){
						if($stl->OCm != 0){
							$OCm++ ;
						}
						if($stl->OCf != 0){
							$OCf++ ;
						}
						if($stl->BCAm != 0){
							$BCAm++ ;
						}
						if($stl->BCAf != 0){
							$BCAf++ ;
						}
						if($stl->BCBm != 0){
							$BCBm++ ;
						}
						if($stl->BCBf != 0){
							$BCBf++ ;
						}
						if($stl->BCCm != 0){
							$BCCm++ ;
						}
						if($stl->BCCf != 0){
							$BCCf++ ;
						}
						if($stl->BCDm != 0){
							$BCDm++ ;
						}
						if($stl->BCDf != 0){
							$BCDf++ ;
						}
						if($stl->STm != 0){
							$STm++ ;
						}
						if($stl->STf != 0){
							$STf++ ;
						}
						if($stl->SCm != 0){
							$SCm++ ;
						}
						if($stl->SCf != 0){
							$SCf++ ;
						}
					}	*/		
						$OC =  ($OCm+$OCf);
						$BCA = ($BCAm+$BCAf);
						$BCB = ($BCBm+$BCBf);
						$BCC = ($BCCm+$BCCf);
						$BCD = ($BCDm+$BCDf);
						$ST =  ($STm+$STf);
						$SC =  ($SCm+$SCf);
						
						$i= 1;
						if($i % 2){
							$master_tr_bgcolor = 'background-color:#f8fcfc; border-right:1px solid #a4a9a8; padding-left:5px;';
						}else{
							$master_tr_bgcolor = 'background-color:#e4ebec; border-right:1px solid #a4a9a8; padding-left:5px;';
						}
						
						echo "<tr style='" . $master_tr_bgcolor . "'>";
						echo "<td align='center' >".$cs->ClassName."</th>";
						echo "<td align='center' >".$OCm."</td>";
						echo "<td align='center' >".$OCf."</td>";
						echo "<td align='center' >".$OC."</td>";
						echo "<td align='center' >".$BCAm."</td>";
						echo "<td align='center' >".$BCAf."</td>" ;
						echo "<td align='center' >".$BCA."</td>";
						echo "<td align='center' >".$BCBm."</td>";
						echo "<td align='center' >".$BCBf."</td>";
						echo "<td align='center' >".$BCB."</td>";
						echo "<td align='center' >".$BCCm."</td>";
						echo "<td align='center' >".$BCCf."</td>";
						echo "<td align='center' >".$BCC."</td>";
						echo "<td align='center' >".$BCDm."</td>";
						echo "<td align='center' >".$BCDf."</td>";
						echo "<td align='center' >".$BCD."</td>";
						echo "<td align='center' >".$STm."</td>";
						echo "<td align='center' >".$STf."</td>";
						echo "<td align='center' >".$ST."</td>";
						echo "<td align='center' >".$SCm."</td>";
						echo "<td align='center' >".$SCf."</td>";
						echo "<td align='center' >".$SC."</td>";
						echo "<td align='center' >".($OC + $BCA + $BCB + $BCC + $BCD + $ST + $SC)."</td>";
						$total += ($OC + $BCA + $BCB + $BCC + $BCD + $ST + $SC);
						$i++;
		}
			echo "<tr style = 'font-weight:600; font-size:12px;' >";
				echo '<td colspan = "'.((count($castcategory) * 3)+ 1).'" align = "right" >School Grand Total Strenth: </td>';
				echo '<td  align = "center"  >'.$total.'</td>';
			echo "</tr>";			
		echo "</table>";
	}
	
	function export_schoolfees(){
		$year = $this->uri->segment(3);
		$from = $this->uri->segment(4);
		$to = $this->uri->segment(5);
		header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename = SchoolFeesReport.xls");
        header("Pragma: no-cache");
        header("Expires: 0");
		
		echo "<table class='reporttable' border='0' cellpadding='0' cellspacing='1' >";
		echo "<tr style='font-size:12px; font-weight:bold; color:#3e4341; border-right:1px solid #a4a9a8; background-color:#b3c1bb; height:30px; text-align:center;'>";
		echo "<th align='center' >#</th>";
		echo "<th align='center' >Role No</th>";
		echo "<th align='center' >Student Name</th>";
		echo "<th align='center' >Class</th>" ;
		echo "<th align='center' >Section </th>";
		echo "<th align='center' >Paid Fees </th>";
		echo "<th align='center' >Remain Fees </th>";
		echo "</tr>";
		
		$i = 1; $schoolTotal = 0; $RschoolTotal = 0;
		$sql1 = ''; $sql2 = ''; $sql3 = ''; $sql4 = ''; $sql = '';
		$this->load->model('Adminmodel');
		$sql = "SELECT course.ClassId FROM course";
		$classlist = $this->Adminmodel->query_fun($sql);
		foreach($classlist as $cl){
			$sql1 = "SELECT course.ClassId, sectionclass.SectionId FROM course
			JOIN sectionclass ON course.ClassId = sectionclass.ClassId
			WHERE course.ClassId = $cl->ClassId";
			if(isset($Year) && $Year != ''){ 
				$sql2 = "  AND sectionclass.Year ='$Year'";
			}
			$sql = $sql1 . $sql2;
			$sectionlist = $this->Adminmodel->query_fun($sql);
			$Tfees = 0; $Trfees = 0;
			foreach($sectionlist as $sl){
				$sql1 ="SELECT course.ClassName, section.SectionName, studentclass.RollNo,student.StudentName, SUM(schoolfees.Fees) as SchoolFees, (classfees.ClassFees - SUM(schoolfees.Fees)) AS RemainFees FROM schoolfees
				JOIN studentclass ON schoolfees.RollNo = studentclass.RollNo
				JOIN classfees ON studentclass.StudentClass = classfees.ClassId
				JOIN student ON studentclass.RollNo = student.StudentRollNo
				JOIN course ON studentclass.StudentClass = course.ClassId
				JOIN section ON studentclass.SectionId = section.SectionId 
				WHERE studentclass.StudentClass = $cl->ClassId AND studentclass.SectionId = $sl->SectionId";
				if(isset($Year) && $Year != ''){ 
					$sql2 = " AND schoolfees.Year = '$Year'";
				}
				if((isset($FromDate) && $FromDate != '') && (isset($ToDate) && $ToDate != '')){
					$sql3 = " AND schoolfees.PaidDate BETWEEN '$from' AND '$to'";
				}
				$sql4 = " GROUP BY studentclass.RollNo";
				$sql = $sql1 . $sql2 . $sql3. $sql4;
				$feeslist = $this->Adminmodel->query_fun($sql);
				$fees = 0; $rfees = 0;
						if(count($feeslist) > 0){
							foreach($feeslist as $fl){
								echo "<tr>";
								echo "<td align='center'>" . $i++ . "</td>";
								echo "<td align='center'>" . $fl->RollNo . "</td>";
								echo "<td align='center'>" . $fl->StudentName . "</td>";
								echo "<td align='center'>" . $fl->ClassName . "</td>";
								echo "<td align='center'>" . $fl->SectionName . "</td>";
								echo "<td align='right' style = 'padding-right:10px;' >" . $fl->SchoolFees . "</td>";
								echo "<td align='right' style = 'padding-right:10px;' >" . $fl->RemainFees . "</td>";
								echo "</tr>";
								$fees += $fl->SchoolFees;
								$rfees += $fl->RemainFees;
							}
							
							echo "<tr>";
							echo "<td align='right' colspan = '5' style = 'background-color:#abcde1; color:#000; font-weight:600' > $fl->ClassName class, '$fl->SectionName' section term fees total:</td>";
							echo "<td align='right' style = 'background-color:#abcde1; color:#000; font-weight:600; padding-right:10px;' >" . number_format($fees, 2). "</td>";
							echo "<td align='right' style = 'background-color:#abcde1; color:#000; font-weight:600; padding-right:10px;' >" . number_format($rfees, 2). "</td>";
							echo "</tr>";
							$Tfees +=$fees;
							$Trfees +=$rfees;
						}
					}	
					
					echo "<tr>";
					echo "<td align='right' colspan = '5' style = 'background-color:#92afc0; color:#000; font-weight:600' > $fl->ClassName class term fees total:</td>";
					echo "<td align='right' style = 'background-color:#92afc0; color:#000; font-weight:600; padding-right:10px;' >" . number_format($Tfees, 2). "</td>";
					echo "<td align='right' style = 'background-color:#92afc0; color:#000; font-weight:600; padding-right:10px;' >" . number_format($Trfees, 2). "</td>";
					echo "</tr>";
					$schoolTotal += $Tfees; 
					$RschoolTotal += $Trfees; 
				}
				
				echo "<tr>";
				echo "<td align='right' colspan = '5' style = 'background-color:#6e96ae; color:#000; font-weight:600' >School term fees grand total:</td>";
				echo "<td align='right'  style = 'background-color:#6e96ae; color:#000; font-weight:600; padding-right:10px;' >" . number_format($schoolTotal, 2). "</td>";
				echo "<td align='right'  style = 'background-color:#6e96ae; color:#000; font-weight:600; padding-right:10px;' >" . number_format($RschoolTotal, 2). "</td>";
				echo "</tr>";
		echo "</table>";
	}
	
}

/* End of file school.php */
/* Location: ./system/application/controllers/school.php */
/* This file is for XML parsing of view pages */

