<script>

function getDocId(docid)                                                                                                                                   
{

      var ajaxRequest = new XMLHttpRequest();

             var docId = docid;
             var postData = 'docid=' + docId;
            ajaxRequest.onreadystatechange = function() {

                if (ajaxRequest.readyState == 4) {
                    if (ajaxRequest.status == 200) {

                       //alert(ajaxRequest.responseText)
                    }
                }
            }

            ajaxRequest.open('GET', 'http://msigner.mangoca.com:8080/JavaApi/rest/api/' + docId);
            ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            ajaxRequest.send(postData);
            alert("Digital Sign Successfull");
            window.location.href = "list_signeddoc.php";
            //console.log(docId);

}

</script>


<?php

session_start();

if(!isset($_SESSION["uid"])) {
    echo "<script>window.location = 'login.php'</script>";
}
include 'Database.php';


$doc = $_POST["docname"];
$pass = $_POST["passphrase"];
$uid = $_SESSION["uid"];
 
$sql = "SELECT * FROM certificate_info WHERE UID='$uid'";
$result = mysqli_query($conn, $sql);

if (!$result->num_rows > 0) {

  echo "<script>alert('You Do Not Have Any Certificate.Please Upload a Certificate First.')</script>";
  echo "<script>window.location = 'browse_certificate.php'</script>"; 

}

else {

$qry ="select unsigned_documents.ID AS ID,unsigned_documents.documents AS doc,vault.pass AS passphrase  from unsigned_documents,vault where (unsigned_documents.documents = '$doc') AND vault.UID = '$uid' ";

$result = mysqli_query($conn, $qry);

 if ($result->num_rows > 0) {

    $row  = $result->fetch_assoc();
 }

  $docid = $row ['ID'];
  $cert_pass= $row ['passphrase'];
  

  if ($pass != $cert_pass)
  {

    echo "<script>alert('Password Not Match.Please Enter Valid Password')</script>";
    echo "<script>window.location = 'signdoc.php'</script>";

  }

  else{
     
    echo '<script type="text/javascript">getDocId('.$docid.')</script>';
    echo "<script>window.location = 'list_signeddoc.php'</script>"; 
  }
}
?>