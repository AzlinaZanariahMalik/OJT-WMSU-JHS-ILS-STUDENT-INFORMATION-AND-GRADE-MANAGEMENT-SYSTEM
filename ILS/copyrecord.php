<?php 

require_once 'functions/session.php';

if($_SESSION['user_type']!="user")
{
    
    header("Location: accessdenied.php");
    die; 
  
}
 require_once 'functions/connectdb.php'; 
 require_once 'actions/db.php'; 

?>
<?php 
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE user_id = {$user_id}";
$query = $connect->query($sql);
$result = $query->fetch_assoc();

$connect->close();
?>
<!doctype html>
<html lang="en">
    <head>
        <!--- meta tags --->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1"/>

         <!--logo-->
         <link rel="shortcut icon" href="assets/logo.png">
        <!--Bootstrap CSS-->
        <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
         <!-----------JSLOADER------------------>
         <script src="assets/js/load.js"></script>
        <title>Student's Record</title>

        
  
        <style>
            html{
                height: 100%;
            }
            body{
                margin:0;
                min-height: 100%;
                
            }
            .navbar-brand{
                margin-left: 2rem;
                color: #CC5500;
            }
            .dropdown-menu-ad > li > a
            {
                color: #CC5500;
            }
            
            

            .dropdown-menu > li > a:hover
            {
                background-image:none !important;
            }
            .dropdown-menu > li > a:hover
            {
                color:#CC5500;
                background-color: #FED8B1;
            }
        


            .addsection{
        
            margin-right: 2rem;
            }
            .list-group-item{
                text-align:left;
            }
            .form-control:focus{
                border-color: #CC5500;
                box-shadow: 0 0 0 0.2rem rgba(0, 0, 0, 0.075), 0 0 8px rgba(255, 0, 0, 0.6);
            
            }
            .btn-add{
                background-color: #CC5500;
                color: white;
            }
            .btn-add:hover{
                background-color: #C45302;
                color:white;  
                    
            }
            .btn-add:focus{
                border-color: #CC5500;
                box-shadow: 0 0 0 0.2rem rgba(0, 0, 0, 0.075), 0 0 8px rgba(255, 0, 0, 0.6);
                
            }

            .modal-header {
                background: #CC5500;
                color: white;
            }



            .footer {
            position:relative;    
           
            bottom: 0;
            width: 100%;
            height: 60px;
            line-height: 60px;
            background-color: #CC5500;
            
            }

            footer span{
                font-size: 12px;
            }
      
            .btn-record{
                float: right;
                margin-right: 2rem;
            }
          
            .grade{
                float: left;
                margin-left: 5rem;
            }
            .section{
                float: right;
                margin-right: 5rem;
            }
            .year{
                float: left;
                margin-left: 5rem;
            }
            .lrn{
                float: right;
                margin-left:-1rem;
                margin-right: 10rem;
            }
            .report-card-title{
              
                margin-right:9rem;
          
                text-align:center;
            }
            /*------------------------------------LOADER---------------------------------------------*/
         .loader {
            position: fixed;
            z-index: 99;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: white;
            display: flex;
            justify-content: center;
            align-items: center;
        }

            .loader > img {
                width: 100px;
            }

            .loader.hidden {
                animation: fadeOut 1s;
                animation-fill-mode: forwards;
            }

            @keyframes fadeOut {
                100% {
                    opacity: 0;
                    visibility: hidden;
                }
            }
            .btn-add{
            background-color: #CC5500;
            color: white;
        }
        .btn-add:hover{
            background-color: #C45302;
            color:white;  
                
        }
        .btn-add:focus{
            border-color: #CC5500;
            box-shadow: 0 0 0 0.2rem rgba(0, 0, 0, 0.075), 0 0 8px rgba(255, 0, 0, 0.6);
              
        }
           
        </style>
    </head>
    <body style="background-color:#FFF3E0;" >
    <div class="loader">
    <img src="assets/loader.gif" alt="Loading..." />
    </div>
    <?php require_once 'page_sections/adviserNav.php'; ?>
        

         

   


            <section>
            <nav aria-label="breadcrumb" style="margin:2rem">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="adviserindex.php">List of Students  </a></li>
                    <?php
                        include 'functions/connectdb.php';
                        $student = $_GET['student'];
                        $sql=  mysqli_query($con, "SELECT * FROM student_info where student_id = '$student' ");
                        while($row = mysqli_fetch_assoc($sql)) {


                        ?>
                    <li class="breadcrumb-item active" aria-current="page" style="text-transform:capitalize;"><?php echo $row['lastname'] . ', ' . $row['firstname']. ' ' . $row['middlename'] ?>'s Academic Record</li>
                    <?php
                    } mysqli_close($con);
                    ?>
                </ol>
            </nav>
            <div class="container container-fluid cardtablePanel">
                        <div class="card border-light mb-3 shadow text-left" style="height:60rem;">
                            <div class="card-header" style="text-transform:capitalize;">
                            <?php
                                include 'functions/connectdb.php'; 
                                $student = $_GET['student'];
                                $sql=  mysqli_query($con, "SELECT * FROM student_info where student_id = '$student' ");
                                while($row = mysqli_fetch_assoc($sql)) {


                                ?>
                                <?php echo $row['lastname'] . ', ' . $row['firstname']. ' ' . $row['middlename'] ?><a style="align-items:right" href="report.php?student=<?php echo $_GET['student']; ?>"> <button class="btn btn-primary btn-record"><i class="bi bi-printer"></i> Report Card</button></a>
                                <?php
                                } mysqli_close($con);
                                ?>
                            </div>
            
                            <div class="card-body">
                               
                                   
                        
                                    <div class="div-action pull pull-right text-end" style="padding-bottom:20px;">
                                   <button class="btn btn-add" style="float:right;" data-bs-toggle="modal"  data-bs-target="#addModal"><i class="bi bi-plus-lg"></i> Grades</button> </a>
                                           
                                    </div>

                                
                             
                                    <?php
                                include 'actions/addgradebysubject.php';
                                ?> 
                                <p class="h6 report-card-title text-center"> SCHOLASTIC RECORD </p>
                                
                                <div class="table-responsive-sm">
                                <table class="table table-bordered ">
                                <thead class="text-center">
                                <?php
                                      include 'functions/connectdb.php';
                                      $current_user_id = $_SESSION['user_id'];
                                      $student = $_GET['student'];
                                      $yearid = $_GET['yearid'];
                                      $add = mysqli_query($con,"SELECT student_class.sc_id, student_class.student_id, student_class.school_year, student_class.grade, student_class.section, school_year.sy_id, school_year.school_year, student_info.lrn_no as lrn, student_info.lastname as ln, student_info.firstname as fn, student_info.middlename as mn, users.lastname as aln, users.firstname as afn, users.middlename as amn FROM student_class 
                                      INNER JOIN student_info ON student_class.student_id = student_info.student_id  
                                      INNER JOIN school_year ON student_class.school_year = school_year.sy_id
                                      INNER JOIN users ON student_class.adviser_id = users.user_id WHERE student_class.adviser_id = '$current_user_id' && student_class.student_id = '$student' && student_class.school_year='$yearid'");
                                      while($row=mysqli_fetch_assoc($add)){                    
                                ?> 
                                <tr>
                                <th rowspan=2 colspan=7 scope="col">
                                    <p class="text-start" style="font-weight:normal;">&nbsp  School: <u style="font-weight:bold;">Western Mindanao State University  - ILS High School</u>  &nbsp &nbsp   School ID: <u style="font-weight:bold;">600136</u> &nbsp  Disctrict: <u style="font-weight:bold;">Baliwasan</u>   &nbsp  Division: <u style="font-weight:bold;">Zamboanga City</u> &nbsp   Region: <u style="font-weight:bold;">IX</u></p> 
                                    <p class="text-start" style="font-weight:normal;">&nbsp &nbsp Classified as Grade: <u style="font-weight:bold;"> <?php echo $row['grade'] ?>  </u> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Section: <u style="font-weight:bold;">  <?php echo $row['section'] ?>  </u> &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  School Year: <u style="font-weight:bold;">   <?php echo $row['school_year'] ?>   </u> &nbsp &nbsp &nbsp &nbsp Name of Adviser: <u style="font-weight:bold;text-transform:capitalize;">   <?php echo $row['afn'] ?> <?php echo $row['amn'] ?> <?php echo $row['aln'] ?>        </u> </p>   
                                </th>
                                </tr>
                                <?php
                                   } mysqli_close($con);?>
                                </thead>   
                                <thead class="text-center">
                                <tr>
                                <th rowspan=2 scope="col">LEARNING AREAS</th>
                                <th colspan=4 scope="col">QUARTER</th>
                                <th rowspan=2 scope="col">FINAL RATING</th>
                                <th rowspan=2 scope="col">REMARKS</th>
                                </tr>
                                <tr>
                              
                                <th scope="col">1</th>
                                <th scope="col">2</th>
                                <th scope="col">3</th>
                                <th scope="col">4</th>
                                
                                </tr>

                                </thead>
                                <tbody>
                               
                                <tr>
                                <th scope="row"></th>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td> 
                                <td></td>
                                <td></td>
                                </tr>
                                <tr>
                                <?php

                                    include 'functions/connectdb.php';
                                    $student = $_GET['student'];
                                    $student = $_GET['yearid'];
                                    $query = mysqli_query($con,"SELECT total_grade_subject.tgs_id, total_grade_subject.subject_id, total_grade_subject.sy_id, total_grade_subject.1st_grading, total_grade_subject.2nd_grading, total_grade_subject.3rd_grading, total_grade_subject.4th_grading, total_grade_subject.final_grade, total_grade_subject.remarks, subjects.subject as sub, school_year.school_year, school_year.status FROM total_grade_subject 
                                    INNER JOIN subjects ON total_grade_subject.subject_id = subjects.subject_id 
                                    INNER JOIN school_year ON total_grade_subject.sy_id = school_year.SY_ID
                                    WHERE student_id = '$student' && sy_id = '$yearid' && school_year.status= 'Yes' ");
                                    while($row = mysqli_fetch_assoc($query)) {{
                                    
                                ?>
                                   <tr>
                                <tr>
                                <input type="hidden" id="id<?php echo $row["tgs_id"] ?>" name="id" value="<?php echo $row['tgs_id'] ?>">
                                <th scope="row"><?php echo $row['sub'] ?></th>


                                <td class="text-center"><?php echo $row['1st_grading'] ?></td>
                                <td class="text-center"><?php echo $row['2nd_grading'] ?></td>
                                <td class="text-center"><?php echo $row['3rd_grading'] ?></td>
                                <td class="text-center"><?php echo $row['4th_grading'] ?></td>
                                <td class="text-center" name="final_grade"><?php echo $row['final_grade'];?></td>
                                <?php if($remarks=='PASSED'){
                                    ?>
                                    <td class="text-center" name="remarks"><?php echo $row['remarks'] ?></td>
                                <?php 
                                } else {
                                    ?>
                                <td class="text-center" style="color:red;" name="remarks"><?php echo $row['remarks'] ?></td>
                               <?php } ?>
                                
                               
                                </tr>  <?php
                         } }
                                mysqli_close($con);
                                ?>
                                <tr>
                                <th scope="row"></th>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                </tr>
                                <tr>
                                <th scope="row"></th>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                </tr>
                               
                                <tr>
                                <th scope="row"></th>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                 </tr>
                                 
                                 <tr>

                                 <th colspan=5 scope="row" class="text-end">General Average</th>
                                <?php

                                    include 'functions/connectdb.php';
                                    $student = $_GET['student'];
                                    $yearid = $_GET['yearid'];
                                    $query = mysqli_query($con,"SELECT * FROM student_class_info WHERE student_id = '$student' AND syl = '$yearid' ");
                                    while($row = mysqli_fetch_assoc($query)) {{
                                            $general = $row['gen_ave'];
                                    
                                    ?>

                                <?php 

                            if ($general!="")
                            {?>
                                <td><?php echo $row['gen_ave'];?></td>
                                <form class="" action="updatestatus.php" method="POST">
                                            <input name="studentid" type="hidden" value="<?php echo $_GET["student"] ?>">
                                            <input name="sy_id" type="hidden" value="<?php echo $_GET["yearid"] ?>">
                                            <input name="gradelevel" type="hidden" value="<?php echo $_GET["current"] ?>">
                                           
                                            <input name="current" type="hidden" value="<?php echo $_GET["current"] ?>">
                                            <input name="class" type="hidden" value="<?php echo $_GET["class"] ?>">
                                            <input name="yearid" type="hidden" value="<?php echo $_GET["yearid"] ?>">
                                
                                <td><div class="col-md-12">
                                            
                                                    <select class="form-select"  name="actionstatus" id="actionstatus" required>
                                                      
                                                         <option value="1">
                                                            PROMOTED
                                                        </option>
                                                        <option value="2">
                                                            RETAINED
                                                        </option>
                                                        <option value="3">
                                                            DROPPED
                                                        </option>
                                
                                                    </select>
                                                  
                                                </div> </td> 
                                               
                                
                                </tr>
                                <th colspan=8 scope="row"><button class="btn btn-add" name="updatestatus" style="float:right;">Save Changes</button></th>
                                </form>
                                <?php } else{
                                 ?>
                                    <td></td>
                                    <td></td>
                                    </tr>
                                    <th></th>

                            
                                <?php
                                }
                                      } }
                                mysqli_close($con);
                                ?>
                                </tbody>

                                
                           
                               
                                </table>
                                
                                <!--<button class="btn btn-add" style="align-items:right" data-bs-toggle="modal" id="addModalBtn" data-bs-target="#exampleModal"><i class="bi bi-plus-lg"></i> Subject</button>-->
                                </div>


                                <div class="table-responsive-sm">
                                <table class="table table-bordered ">
                                <thead >
                                <tr>
                                <th   scope="col">Remedial Classes</th>
                                <th  colspan=6 scope="col">conducted from (mm/dd/yyyy)_______ to  (mm/dd/yyyy) _______</th>
                                <th   scope="col"></th>
                                </tr>

                                </thead>   
                                <thead class="text-center">
                                <tr>
                                <th  scope="col">Learning Areas</th>
                                <th  colspan=2 scope="col">Final Rating</th>
                                <th  colspan=2 scope="col">Remedial Class Mark</th>
                                <th  colspan=2 scope="col">Recomputed Final Grade</th>
                                <th  scope="col">REMARKS</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                <th scope="row"></th>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                </tr>
                                <tr>
                                <th scope="row"></th>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                </tr>
                                <tr>
                                <th scope="row"></th>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                </tr>
                                
                                </tbody>
                                </table>
                                
                                </div>
                               


                            </div>
                        </div>
                  
        </div>
            </section>

<!-- Footer -->
                <footer class="footer sticky-footer bg-white">
                    <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>WMSU Integrated Laboratory School Junior Highschool &copy; 2022</span>
                    </div>
                    </div>
                </footer>



<!-- ADD GRADES Modal -->
                                    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add Record</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                            <form class="" method="POST">
                                            <input name="studentid" type="hidden" value="<?php echo $_GET["student"] ?>">
                                            <input name="current" type="hidden" value="<?php echo $_GET["current"] ?>">
                                            <input name="class" type="hidden" value="<?php echo $_GET["class"] ?>">
                                            <input name="yearid" type="hidden" value="<?php echo $_GET["yearid"] ?>">

                                            <input name="school" type="hidden" value="Western Mindanao State University - ILS High School">
                                            <input name="school_id" type="hidden" value="600136">
                                            <input name="district" type="hidden" value="Zamboanga City">
                                            <input name="division" type="hidden" value="Baliwasan">
                                            <input name="region" type="hidden" value="IX">

                                            <?php
                                                include 'functions/connectdb.php';
                                                $current_user_id = $_SESSION['user_id'];
                                                $student = $_GET['student'];
                                                $yearid = $_GET['yearid'];
                                                $add = mysqli_query($con,"SELECT student_class.sc_id, student_class.student_id, student_class.school_year, student_class.grade, student_class.section, student_info.lrn_no as lrn, student_info.lastname as ln, student_info.firstname as fn, student_info.middlename as mn, users.lastname as aln, users.firstname as afn, users.middlename as amn FROM student_class INNER JOIN student_info ON student_class.student_id = student_info.student_id  
                                                INNER JOIN users ON student_class.adviser_id = users.user_id WHERE student_class.adviser_id = '$current_user_id' && student_class.student_id = '$student' && student_class.school_year='$yearid'");
                                                while($row=mysqli_fetch_assoc($add)){  
                                                    


                                             ?> 
                                             <input name="sylevel" type="hidden" value="<?php echo $row['school_year'] ?>">
                                             <input name="slevel" type="hidden" value="<?php echo $row['section'] ?>">
                                             <input name="glevel" type="hidden" value="<?php echo $row['grade'] ?>">
                                             <input name="adviser" type="hidden" value="<?php echo $row['afn'] ?> <?php echo $row['amn'] ?> <?php echo $row['aln'] ?>">
                                             <?php
                                                    } mysqli_close($con);?>

                                            <?php
                                                        include 'functions/connectdb.php';
                                                        $add = mysqli_query($con,"SELECT * FROM school_year where status='Yes'");
                                                        while($row=mysqli_fetch_array($add)){
                                                        ?>                                     
                                                    <input   type="hidden" id="schoolyear<?php echo $row[0] ?>"  name="schoolyear" type="text" style="border:0px" value="<?php echo $row[0] ?>" readonly>
                                            <?php } mysqli_close($con); ?>
                                            <div class="col-md-12">
                                                    <label for="quarter" class="form-label">Current Quarter</label>
                                                    <select class="form-select"  name="quarter" id="quarter"  required>
                                                      
                                                    <?php
                                                        include 'functions/connectdb.php';
                                                        $sql = mysqli_query($con,"SELECT * from quarter WHERE status='Yes'"); 
                                                        while($row=mysqli_fetch_array($sql)){
                                                        ?>
                                                         <option value="<?php echo $row[0] ?>">
                                                        <?php echo $row[1] ?>
                                                        </option>
                                                        <?php } mysqli_close($con); ?>
                                                       
                                                    </select>
                                                  
                                                </div> 
                                            <div class="col-md-12">
                                                    <label for="subject" class="form-label">Add Grade by Subject</label>
                                                    <select class="form-select"  name="subject" id="subject"  required>
                                                    <option value="" id="subject" disabled selected>Select Subject</option>   
                                                    <?php
                                                        include 'functions/connectdb.php';
                                                        $sql = mysqli_query($con,"SELECT * from subjects"); 
                                                        while($row=mysqli_fetch_array($sql)){
                                                        ?>
                                                        <option value="<?php echo $row[0] ?>">
                                                        <?php echo $row[1] ?>
                                                        </option>
                                                        <?php } mysqli_close($con); ?>
                                                    </select>
                                                  
                                                </div> 

                                              
                                                  <div class="col-md-5">
                                                    <label for="grades" class="form-label">Enter Grade</label>
                                                    <input type="text" class="form-control" id="grades" name="grades" pattern="[0-9]+" maxlength="2" placeholder="" required>
                                                   
                                                </div>
                                               
                                               

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button class="btn btn-add">Save</button>
                                            </div>
                                             </form>
                                            </div>
                                        </div>
                                        </div>  
                                   <!-- Modal -->
<?php require_once 'page_sections/scripts.php'; ?>              
<?php require_once 'page_sections/footer.php'; ?>