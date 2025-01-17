<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    

    <style>
       
        .main-heading{
              /* font-size: 22px; */
              text-align: center;
             
        }
       </style>

    <title>Layout</title>
</head>
<body>
    
<button id="download-pdf" class = "submit-btn">Download as PDF</button>
<script>
    document.getElementById("download-pdf").addEventListener("click", function () {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();
        
        // Target the specific element you want to convert to PDF
        doc.html(document.body, {
            callback: function (doc) {
                doc.save("layouttry.pdf");
            },
            x: 10,
            y: 10
        });
    });
</script>


                
    <div class="header">
        <br><br><p style="margin:0px;left:0%; top:20px;font-size: 25px;" class="main-heading"><b>Register of Fixed Assets</b></p>
        <?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}
?>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Get the start and end dates from user input
            $year = intval($_POST['year']);
            $start_date = "$year-04-01";
            $end_date = ($year + 1) . "-03-31";
            $place = $_POST['place'];
        }

        
        echo "<div>";
            echo "<p style='margin: 0; font-size: 19px; position: relative;left: 50px; top: 30px; display: inline;'><b>Name and Description of Fixed Asset_______</b></p>";
            echo "<p style='margin: 0; font-size: 19px; position: relative;left: 50px; top:30px; display: inline; color:#4389d4;'><b>ELECTRONIC JOURNALS ".($year+1)." Subscription (FY ". ($year."-".(substr($year+1, -2))).")</b></p>";
        echo "</div>";
         ?>
         <div>
            <div>
                <table id="table1" style="margin: 0; top:30px; position: relative; left: 50px; width: 95% ; height: 50% ;" >
                    <style>
                        table {
                            border-collapse: collapse;
                        }
            
                        th,
                        td {
                            border: 1px solid black;
                            padding: 8px;
                            font-size: 16px;
                        }
                    </style>
                    
                    <tr style="text-align: center;">
                        <th rowspan="2" style="width: 75px;"><b>Date</b></th>
                        <th rowspan="2" style="width: 75px;"><b>Opening Balance</b></th>
                        <th rowspan="2" style="width: 120px;"><b>Particulars of Asset</b></th>
                        <th colspan="2"><b>Particulars of Suppliers</b></th>
                        <th rowspan="2" style="width: 115px;"><b>Location of Asset</b></th>
                        <th colspan="2"><b>Cost of the Asset</b></th>
                        <th rowspan="2" style="width: 125px;"><b>Progressive Expenditure/  <br>Closing Balance<br>9=2+7-8</b></th>
                        <th rowspan="2" style="width: 135px;"><b></b></th>
                        <th rowspan="2" style="width: 135px;"><b></b></th>
                        <th rowspan="2" style="width: 135px;"><b>Remarks</b></th>
                        
                    </tr>
                    <tr style="text-align: center;">
                        <td style="width: 75px;"><b>Name and Address</b></td>
                        <td style="width: 140px;"><b>Bill No. and Date</b></td>
                        <td style="width: 140px;"><b>Additions</b></td>
                        <td style="width: 120px;"><b>Deductions</b></td>
                    </tr>
                    <tr style="text-align: center;" >
                        <td><b>1</b></td>
                        <td><b>2</b></td>
                        <td><b>3</b></td>
                        <td><b>4</b></td>
                        <td><b>5</b></td>
                        <td><b>6</b></td>
                        <td><b>7</b></td>
                        <td><b>8</b></td>
                        <td><b>9</b></td>
                        <td><b>10</b></td>
                        <td><b>11</b></td>
                        <td><b>12</b></td>
                    </tr></b>
                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        // Get the start and end dates from user input
                        $year = intval($_POST['year']);
                        $start_date = $_POST['start_date'];
                        $end_date = $_POST['end_date'];
                        
                        if (!empty($year)) {
                            $start_date = "$year-04-01";
                            $end_date = ($year + 1) . "-03-31";
                        }
                        
                        
                        $place = $_POST['place'];
                    
                        
                        
                        // Database connection details
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $dbname = "assets";

                        // Create connection
                        $conn = new mysqli($servername, $username, $password, $dbname);

                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        
                        // $sql = "SELECT DATE_FORMAT(transactionDate, '%d-%m-%Y') AS transactionDate, DATE_FORMAT(startDate, '%d-%m-%Y') AS startDate, openingBalance, particularsAsset, supplierName, supplierAddress, billNo, DATE_FORMAT(billDate, '%d-%m-%Y') AS billDate, institutionType, additions, deductions, progressiveExpenditure, billUpload FROM asset_entry WHERE institutionType = ? AND transactionDate BETWEEN ? AND ? ORDER BY transactionDate ASC ";
                                                                $sql = "SELECT 
                                                transactionDate, 
                                                startDate, 
                                                openingBalance, 
                                                particularsAsset, 
                                                supplierName, 
                                                supplierAddress, 
                                                billNo, 
                                                billDate, 
                                                institutionType, 
                                                additions, 
                                                deductions, 
                                                progressiveExpenditure, 
                                                billUpload 
                                            FROM asset_entry 
                                            WHERE institutionType = ? 
                                            AND transactionDate BETWEEN ? AND ? 
                                            ORDER BY transactionDate ASC ";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("sss", $place, $start_date, $end_date);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        $commonStartDate = null;
                        $commonOpeningBalance = null;
                        $lastTxDate = null;
                        $firstRow = true;
                        $totalExpend = null;
                        $carrier = null;

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                if ($firstRow) {
                                    $commonStartDate = date('d-m-Y', strtotime($row["startDate"])) ;
                                    $commonOpeningBalance = $row["openingBalance"];
                                    $firstRow = false;

                                    echo "<tr>";
                                    echo "<td><b>". $commonStartDate . "</b></td>";
                                    echo "<td><b>". $commonOpeningBalance . "</b></td>";
                                    echo "<td colspan='3'><b> OPENING BALANCE (B/F " . ($year - 1) . "-" . $year . ")</b></td>";
                                    echo "<td></td><td></td><td></td><td></td><td></td><td></td><td></td>";
                                    echo "<b></tr>";
                                }
                                $lastTxDate = date('d-m-Y', strtotime($row["transactionDate"])) ;
                                $totalExpend = $totalExpend + $row["additions"] - $row["deductions"];
                                $carrier = $totalExpend+$commonOpeningBalance;
                                $billUploads = explode(',', $row["billUpload"]);



                                echo "<tr>";
                                echo "<td>" . date('d-m-Y', strtotime($row["transactionDate"])) . "</td>";
                                echo "<td></td>";
                                echo "<td style='color: #4389d4'>" . $row["particularsAsset"] . "</td>";
                                echo "<td style='color: #4389d4'>" . $row["supplierName"] . "<br>" . $row["supplierAddress"] . "</td>";
                                echo "<td style='color: #4389d4'>" . $row["billNo"] . "<br>" .date('d-m-Y', strtotime($row["billDate"])). "</td>";
                                // to add the bill no as a hyperlink:-
                                // echo "<td style='color: #4389d4'>" . ($row["billUpload"] ? "<a href='" . $row["billUpload"] . "' target='_blank'>" . $row["billNo"] . "</a>" : $row["billNo"]) . "<br>" . $row["billDate"] . "</td>";
                                echo "<td style='color: #4389d4'> Across identified " . $row["institutionType"] . " Labs </td>";
                                echo "<td>" . $row["additions"] . "</td>";
                                echo "<td>" . $row["deductions"] . "</td>";
                                echo "<td>" . $carrier . "</td>";
                                echo "<td >";
                                     foreach ($billUploads as $billUpload) {
                                        echo "<a href='" . $billUpload . "' target='_blank'>View PDF </a><br>";
                                      }
                                echo  "</td>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "</tr>";
                                

                            }
                        } else {
                            echo "<tr><td colspan='9'>No data found</td></tr>";
                        }


                        $conn->close();
                    }
                    echo "
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>";
                    
                    echo "
                    <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th colspan = '3'style='color: #4389d4'><b>Total Expenditure ". $year."-".(substr($year+1, -2))." Rs.</b></th>
                    <th><b>" . $totalExpend . "</b></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    </tr>";
                    
                    echo "
                    <tr>
                        <th></th>
                        <th></th>
                        <th><b>As on " .$lastTxDate. "</b></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th><b>".($commonOpeningBalance + $totalExpend)." </b></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>";
                    
                    ?>
                    


                    
                </table>
            </div>
            <div>
                <br><p style='margin: 0; font-size: 15px; position: relative;left: 50px; top: 30px; display: inline;'>
                    NB:-
                </p>
                <p style='margin: 0; font-size: 15px; position: relative;left: 120px; top: 30px; display: inline;'>
                    1. Separate register be maintained for each category of asset(capital budget head).
                </p>
                <br>
                
                <p style='margin: 0; font-size: 15px; position: relative;left: 154px; top: 30px; display: inline;'>
                    2. At the close of the financial year, the balance in the Assets Register must match with the balance under Gross Block of Schedule 6 excluding figures of Works in Progress.
                </p>
            </div>



        </div>
        

        



    </div>
    
</body>
</html>
