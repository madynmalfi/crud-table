<?php
//connect to databse
$conn = mysqli_connect("localhost","degree_admin","Madyn!44","degree_CRUD");

// Check connection
if (mysqli_connect_errno())
  {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
// add new program
if(isset($_POST['addProgram'])){
    $sql = "INSERT INTO Programs (program,programCategory,trainer,rate,venue,hotel) VALUES( '{$_POST['program']}', '{$_POST['programCategory']}', '{$_POST['trainer']}', '{$_POST['rate']}', '{$_POST['venue']}', '{$_POST['hotel']}' )";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

//delete program
if(isset($_POST['delete'])){
    $sql = "DELETE FROM Programs WHERE id='{$_POST['id']}'";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

//update program
if(isset($_POST['update'])){
    $sql = "SELECT * FROM Programs WHERE id = '{$_POST['id']}'";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) {
        //echo $row['program'];
    ?>
        <h3>Update program</h3>
        <form action="" method="post">
            <input type="hidden" name="updateFinal" />
            <input type="hidden" name="id" value="<?php echo $_POST['id']; ?>" />

            <span>Program name: </span>
            <input type="text" name="program" value="<?php echo $row['program']; ?>" required /></br>

            <span>Program category: </span>
            <input type="text" name="programCategory" value="<?php echo $row['programCategory']; ?>" required /></br>

            <span>Program trainer: </span>
            <input type="text" name="trainer" value="<?php echo $row['trainer']; ?>" required /></br>

            <span>Program rate: </span>
            <input type="text" name="rate" value="<?php echo $row['rate']; ?>" required /></br>

            <span>Program venue: </span>
            <input type="text" name="venue" value="<?php echo $row['venue']; ?>" required /></br>

            <span>Program hotel: </span>
            <input type="text" name="hotel" value="<?php echo $row['hotel']; ?>" required /></br>

            <input type="submit" />
        </form>
    <?php
    }
}


if(isset($_POST['updateFinal'])){
    $sql = "UPDATE Programs SET program = '{$_POST['program']}',programCategory = '{$_POST['programCategory']}', trainer = '{$_POST['trainer']}', rate = '{$_POST['rate']}', venue = '{$_POST['venue']}', hotel = '{$_POST['hotel']}'  WHERE id= '{$_POST['id']}' ";
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// add event
if(isset($_POST['addEvent'])){
    ?>
    <form action="" method="post">
        <input type="hidden" name="addEventFinal" />
        <input type="hidden" name="id" value="<?php echo $_POST['id']; ?>" />

        <span>Start date</span>
        <input type="date" name="startDate" /> <br>
        <span>End date</span>
        <input type="date" name="endDate" />
        <span>File Link</span>
        <input type="text" name="file" />

        <input type="submit" />

    </form>
    <?php
}

if(isset($_POST['addEventFinal'])){
    $sql = "INSERT INTO Events (programId, startDate, endDate, file) VALUES('{$_POST['id']}', '{$_POST['startDate']}', '{$_POST['endDate']}', '{$_POST['file']}')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

//delete Event
if(isset($_POST['deleteEvent'])){
    $sql = "DELETE FROM Events WHERE id='{$_POST['id']}'";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>
<style>
input {
    margin: 10px;
    background: white;
    border: 1px solid gray;
    padding: 5px;
}
</style>
<table class="cal" width="890" border="1" cellpadding="0" cellspacing="0" bordercolor="#999999">
        <tbody>
       <tr>
            <th width="166" class="cal-heading" rowspan="2">PROGRAM</th>
            <th width="63" class="cal-heading" rowspan="2">TRAINER</th>
            <th width="40" class="cal-heading" rowspan="2">RATE</th>
            <th width="75" class="cal-heading" rowspan="2">VENUE</th>
            <th width="110" class="cal-heading" rowspan="2">HOTEL</th>
            <th class="cal-year1" colspan="7">2017</th>

            <?php
            if(isset($_GET['admin'])){
                ?>
                    <th>Actions</th>
                <?php
            }
            ?>

        </tr>
<tr><th width="30" class="cal-year1">Jun</th><th width="30" class="cal-year1">Jul</th><th width="30" class="cal-year1">Aug</th><th width="30" class="cal-year1">Sep</th><th width="30" class="cal-year1">Oct</th><th width="30" class="cal-year1">Nov</th><th width="30" class="cal-year1">Dec</th></tr>

<?php

// Get program categories
$sqlCat = "SELECT * FROM Programs GROUP BY programCategory";
$resultCat = $conn->query($sqlCat);

while($rowCat = $resultCat->fetch_assoc()) {
    ?>
    <tr><td height="20" class="cal-category" bgcolor="#e9faff" colspan="29"><?php echo $rowCat['programCategory']; ?></td></tr>
    <?php

    //Get content from database
    //if anther arrangement needed, group by program, arange as needed then for each program get the other data.
    $sql = "SELECT * FROM Programs WHERE programCategory = '{$rowCat['programCategory']}' ORDER BY program DESC, id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        $rowParent = array();
        $checkDone = array();
        $currentRow = "";

        // get progarms for each category
        while($row = $result->fetch_assoc()) {
            $checkExist = false ;
            foreach ($rowParent as $rowChild){
                // check if program name add to table or not
                if (in_array($row["program"], $rowChild)  && $rowChild["id"] != $checkDone[$rowChild['id']]){
                    $currentRow = $rowChild["id"];
                    $checkExist = true;
                    ?>
                    <tr>
                        <td class="cal-program trainer-cell txt-wrap"><?php echo $row["trainer"]; ?></td>
                        <td class="cal-program"><?php echo $row["rate"]; ?></td>
                        <td class="cal-program"><?php echo $row["venue"]; ?></td>
                        <td class="cal-program"><?php echo $row["hotel"]; ?></td>

                    <?php
                }
                $checkDone[$rowChild['id']] = $rowChild['id'];
            }
            // if not added then add program name to the table
            if($checkExist == false){
                    $programName = trim($row['program']);
                    $rowspanSql = "SELECT * FROM Programs WHERE program = '{$programName}'";
                    $rowspanResult = $conn->query($rowspanSql);
                    $rowspan =  $rowspanResult->num_rows;
                ?>
                <tr>
                    <td class="cal-program" rowspan="<?php echo $rowspan; ?>"><?php echo $row["program"]; ?></td>
                    <td class="cal-program trainer-cell txt-wrap"><?php echo $row["trainer"]; ?></td>
                    <td class="cal-program"><?php echo $row["rate"]; ?></td>
                    <td class="cal-program"><?php echo $row["venue"]; ?></td>
                    <td class="cal-program"><?php echo $row["hotel"]; ?></td>

                <?php
            }

            $rowParent[$row['id']] = $row;

            //get events
            $eventSql = "SELECT * FROM Events WHERE programId = '{$row['id']}'";
            $eventResult = $conn->query($eventSql);
            $eventStartDate = array();
            $eventEndDate = array();
            $eventFile = array();
            $StartEndDay = array();
            while($eventRow = $eventResult->fetch_assoc()) {
                $eStartDate = explode("-", $eventRow['startDate']);
                $eEndDate = explode("-", $eventRow['endDate']);

                $eStartDateMonth =  intval($eStartDate[1]);
                $eStartDateDay = intval($eStartDate[2]);
                $eEndDateDay = intval($eEndDate[2]);

                $StartEndDay[$eStartDateMonth] = $eStartDateDay . "-" . $eEndDateDay;
                $eventFile[$eStartDateMonth] = $eventRow['file'];
                $eventId[$eStartDateMonth] = $eventRow['id'];
            }

            ?>

            <td data-id="<?php echo $row['id']; ?>"><a href="<?php echo $row['file']; ?>" class="subtitle9" target="_blank"><?php if(isset($StartEndDay['6'])){ echo $StartEndDay['6'] ; if(isset($_GET['admin'])){ ?> <form action="" method="post"><input type="hidden" name="deleteEvent"/><input type="hidden" name="id" value="<?php echo $eventId['6']; ?>" /><input type="submit" value="delete"/></form> <?php } } ?></a></td>
            <td data-id="<?php echo $row['id']; ?>"><a href="<?php echo $row['file']; ?>" class="subtitle9" target="_blank"><?php if(isset($StartEndDay['7'])){ echo $StartEndDay['7'] ; if(isset($_GET['admin'])){ ?> <form action="" method="post"><input type="hidden" name="deleteEvent"/><input type="hidden" name="id" value="<?php echo $eventId['7']; ?>" /><input type="submit" value="delete"/></form> <?php } } ?></a></td>
            <td data-id="<?php echo $row['id']; ?>"><a href="<?php echo $row['file']; ?>" class="subtitle9" target="_blank"><?php if(isset($StartEndDay['8'])){ echo $StartEndDay['8'] ; if(isset($_GET['admin'])){ ?> <form action="" method="post"><input type="hidden" name="deleteEvent"/><input type="hidden" name="id" value="<?php echo $eventId['8']; ?>" /><input type="submit" value="delete"/></form> <?php } } ?></a></td>
            <td data-id="<?php echo $row['id']; ?>"><a href="<?php echo $row['file']; ?>" class="subtitle9" target="_blank"><?php if(isset($StartEndDay['9'])){ echo $StartEndDay['9'] ; if(isset($_GET['admin'])){ ?> <form action="" method="post"><input type="hidden" name="deleteEvent"/><input type="hidden" name="id" value="<?php echo $eventId['9']; ?>" /><input type="submit" value="delete"/></form> <?php } } ?></a></td>
            <td data-id="<?php echo $row['id']; ?>"><a href="<?php echo $row['file']; ?>" class="subtitle9" target="_blank"><?php if(isset($StartEndDay['10'])){ echo $StartEndDay['10'] ; if(isset($_GET['admin'])){ ?> <form action="" method="post"><input type="hidden" name="deleteEvent"/><input type="hidden" name="id" value="<?php echo $eventId['10']; ?>" /><input type="submit" value="delete"/></form> <?php } } ?></a></td>
            <td data-id="<?php echo $row['id']; ?>"><a href="<?php echo $row['file']; ?>" class="subtitle9" target="_blank"><?php if(isset($StartEndDay['11'])){ echo $StartEndDay['11'] ; if(isset($_GET['admin'])){ ?> <form action="" method="post"><input type="hidden" name="deleteEvent"/><input type="hidden" name="id" value="<?php echo $eventId['11']; ?>" /><input type="submit" value="delete"/></form> <?php } } ?></a></td>
            <td data-id="<?php echo $row['id']; ?>"><a href="<?php echo $row['file']; ?>" class="subtitle9" target="_blank"><?php if(isset($StartEndDay['12'])){ echo $StartEndDay['12'] ; if(isset($_GET['admin'])){ ?> <form action="" method="post"><input type="hidden" name="deleteEvent"/><input type="hidden" name="id" value="<?php echo $eventId['12']; ?>" /><input type="submit" value="delete"/></form> <?php } } ?></a></td>
            <?php
            //if admin show actions
            if(isset($_GET['admin'])){
                ?>
                <th class="cal-program">
                <form action="" method="post">
                    <input type="hidden" name="delete"/>
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
                    <input type="submit" value="delete" />
                </form>

                <form action="" method="post">
                    <input type="hidden" name="update"/>
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
                    <input type="submit" value="update" />
                </form>

                 <form action="" method="post">
                    <input type="hidden" name="addEvent"/>
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
                    <input type="submit" value="add event" />
                </form>
              </th>
                <?php
            }
            ?>
            </tr>
            <?php
        }

    } else {
        echo "0 results";
    }
}

//if admin show add new program inputs
if(isset($_GET['admin'])){
    ?>
    <tr>
        <form action="" method="post">
            <input type="hidden" name="addProgram" />
            <td class="cal-program" rowspan="1"><input type="text" name="program" placeholder="Program name" required ><br><input type="text" name="programCategory" placeholder="Program category" required/></td>
            <td class="cal-program"><input type="text" name="trainer" placeholder="Program trainer" required ><br></td>
            <td class="cal-program"><input type="text" name="rate" placeholder="Program rate" required ><br></td>
            <td class="cal-program"><input type="text" name="venue" placeholder="Program venue" required ><br></td>
            <td class="cal-program"><input type="text" name="hotel" placeholder="Program hotel" required ><br></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
           <th class="cal-program"><input type="submit" /></th>
        </form>
    </tr>
    <?php
}
?>

    </tbody>
</table>

<?php
$conn->close();
?>
