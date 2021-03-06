<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['cvmsaid']==0)) {
  header('location:logout.php');
  } else{



  ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>VTS-1 Visitors</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
      <?php include_once('includes/sidebar.php');?>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
      
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <?php include_once('includes/header.php');?>
            <!-- END HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive table--no-card m-b-30">
                                    <table class="table table-borderless table-striped table-earning" id="tblData" >
                                         <thead>
                                        <tr>
                                            <tr>
                                                <th></th>
                  <th>S.NO</th>
            
                  <th>Full Name</th>
              
              <th>Contact Number</th>
              <th>Email</th>
                   <th>Action</th>
                   <th>Export</th>
                  
                </tr>
                                        </tr>
                                        </thead>
                                       <?php
$ret=mysqli_query($con,"select *from tblvisitor");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>
              
                <tr>
                    <td><input type="checkbox" name="allow"/></td>
                  <td><?php echo $cnt;?></td>
            
                  <td><?php  echo $row['FullName'];?></td>
                  <td><?php  echo $row['MobileNumber'];?></td>
                <td><?php  echo $row['Email'];?></td>
                  <td><a href="visitor-detail.php?editid=<?php echo $row['ID'];?>" title="View Full Details"><i class="fa fa-edit fa-1x"></i></a>
                  <a href="delete-visitor.php?deleteid=<?php echo $row['ID'];?>" title="Remove Visitor"><i class="fa fa-remove fa-1x"></i></a>
                  </td>
               <td><select name="ExportOption" class="form-control">
                    <option>Excel</option>
                    <option>CRM</option>
                    
                </select></td>
                </tr>
                <?php 
$cnt=$cnt+1;
}?>
                                    </table>
                                   
                                </div>
                            </div>
                          
                        </div>
                        <div class="card-footer">
                                        <p style="text-align: center;"><button class="btn btn-primary btn-sm" onclick="exportTableToExcel('tblData', 'members-data')">Export
                                        </button></p>
                                        
                                    </div>
                        
          
<?php include_once('includes/footer.php');?>
          </div>
                </div>
            </div>
        </div>

    </div>
    <script>

function exportTableToExcel(table, filename = ''){
var tab_text="<table border='2px'>";
    var textRange; var j=0;
    var count=1
    
    tab = document.getElementById(table); // id of table

    for(j = 1 ; j < tab.rows.length ; j++) 
    {     
        if(j>1){
                if(tab.rows[j].cells[0].getElementsByTagName('input')[0].checked==true){
                    tab_text=tab_text+"<tr>";
                    // tab_text=tab_text+tab.rows[j].cells[i].outerHTML;
                
             
        for(i=1;i<5;i++)
        {
            if(i==1){
                var prev_Value=tab.rows[j].cells[i].textContent;
                tab.rows[j].cells[i].textContent=count;
                tab_text=tab_text+tab.rows[j].cells[i].outerHTML;
                tab.rows[j].cells[i].textContent=prev_Value;
            }
            else{
            //tab.rows[j].cells
            tab_text=tab_text+tab.rows[j].cells[i].outerHTML;
            }

            
        }
        count++;
        tab_text=tab_text+"</tr>";
        }}
        else{
            tab_text=tab_text+"<tr>";
            for(i=1;i<5;i++)
        {
            //tab.rows[j].cells
            tab_text=tab_text+tab.rows[j].cells[i].outerHTML;
        }            tab_text=tab_text+"</tr>";

        }
        //tab_text=tab_text+"</tr>";
    }

    tab_text=tab_text+"</table>";
    tab_text= tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
    tab_text= tab_text.replace(/<img[^>]*>/gi,""); // remove if u want images in your table
    tab_text= tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

    var ua = window.navigator.userAgent;
    var msie = ua.indexOf("MSIE "); 

    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
    {
        txtArea1.document.open("txt/html","replace");
        txtArea1.document.write(tab_text);
        txtArea1.document.close();
        txtArea1.focus(); 
        sa=txtArea1.document.execCommand("SaveAs",true,"Say Thanks to Sumit.xls");
    }  
    else                 //other browser not tested on IE 11
        sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));  

    return (sa);
}
//     function exportTableToExcel(tableID, filename = ''){
//     var downloadLink;
//     var dataType = 'application/vnd.ms-excel';
//     var tableSelect = document.getElementById(tableID);
//     var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
//     // Specify file name
//     filename = filename?filename+'.xls':'excel_data.xls';
    
//     // Create download link element
//     downloadLink = document.createElement("a");
    
//     document.body.appendChild(downloadLink);
    
//     if(navigator.msSaveOrOpenBlob){
//         var blob = new Blob(['\ufeff', tableHTML], {
//             type: dataType
//         });
//         navigator.msSaveOrOpenBlob( blob, filename);
//     }else{
//         // Create a link to the file
//         downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
//         // Setting the file name
//         downloadLink.download = filename;
        
//         //triggering the function
//         downloadLink.click();
//     }
//    // location.reload();
// }
    </script>
    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>

</html>
<?php }  ?>
