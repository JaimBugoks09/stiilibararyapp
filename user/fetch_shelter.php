<?php 
include_once "./connections/travelclass.php";
$con = $lib->openConnection();
$get_id = $_GET['id'];
$search = $_GET["search_book"];
$output = '';

$sql = $con->prepare("SELECT * FROM book WHERE shelter_id = $get_id AND book_title LIKE '%$search%'");
$sql->execute();

if($sql->rowCount() > 0)
{
    $output .= "<div class='w3-container city'>";

    while($row = $sql->fetch())
    {

    $output .= "<div id='cont' class='box col s12 m12 l12 left-align' style='box-shadow: 0 2px 10px #222; border-radius: 10px;padding:20px 10px;margin: 10px'>

        <div class='col s7 m8 l8 left-align'>
            <a href='./action.php?id=".$row['book_id']."'>
                <div class='col s5 m5 l5'>
                    <img src='../library_system/admin/upload/".$row['book_image']."' style='border:2px solid dodgerblue;width:60px; height: 60px'>
                </div>
                <div class='col s7 m7 l7 left-align'>  
                    <span style='font-size: 12px; color: #fff'><p>".$row['book_title']."</p></span>
                </div>
            </a>
            <br><br>
            <div class='col s12 m12 l12 left-align'>
                <b><span style='font-size: 12px;'>Book | ".$row['book_pub']."</span></b>
            </div>
        </div>
        <div class='col s5 m4 l4 right-align'>
            <div class='col s12 m12 l12'>";

                if($row['remarks'] == "Available"){
                    $output .= "<span id='remarks' style='color: lime; font-weight: 800>".$row['remarks']."</span>";
                }else{
                    $output .= "<span id='remarks' style='color: red; font-weight: 800'>".$row['remarks']."</span>";
                }

            $output .= "</div>
            <br><br><br><br>
            <div class='col s12 m12 l12'>
                <span class='orange white-text' 
                    style='font-size: 12px; padding: 10px 10px'>Copies: ".$row['book_copies']."</span>
            </div>
        </div>
                        
    </div>";

    }
$output .= "</div>";

echo $output;

}
else
{
    echo "Data Not Found!";
}



; ?>