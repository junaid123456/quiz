<?php
error_reporting(0);

// #########################################
// In this page you will find the code required to create multiple choice exams
// Copy this code and save it to a file name "whatever.php"
// The file name must finish with ".php"
// Save the file to a PHP unable server.
// Please consider adding a link to this service:
//      http://www.phptutorial.info/scripts/multiple_choice/
//
// A website was created based in this script at which allows
//   to create and maintain the test online at:
//      http://www.testak.org
//
// #########################################
//      CONFIGURATION
$title = "Multiple Choice questions";
$address = "mcqs.php";
$randomizequestions ="yes"; // set up as "no" to show questions without randomization
//    END CONFIGURATION
// #########################################

$a = array(
1 => array(
   0 => "Full form of OS is?",
   1 => "Order of significance",
   2 => "Operating system",
   3 => "Open software",
   4 => "Optical Sensor",
   5 => "Operating Signal",
   6 => 2
),
2 => array(
   0 => "The ribbon is used in?",
   1 => "Laser Printer",
   2 => "Plotter",
   3 => "Ink-jet printer",
   4 => "Thermal Printer",
   5 => "Dot Matrix printer",
   6 => 5
),
3 => array(
   0 => "Address book contains?",
   1 => "All",
   2 => "Phone numbers",
   3 => "People Names",
   4 => "Email address",
   5 => "Note Book",
   6 => 1
),
4 => array(
   0 => "Full form of 'DOCOMO'?",
   1 => "Do Communications Over the Mobile network",
   2 => "Do Connect over Mobile",
   3 => "Dongle Communication Over Mobile",
   4 => "Do Communication Or More",
   5 => "Do Communication Off",
   6 => 1
),
5 => array(
   0 => "Joystick is used to?",
   1 => "Both 2 and 3",
   2 => "Move cursor on the screen",
   3 => "Computer games",
   4 => "None of these",
   5 => "All Of these",
   6 => 1
),
6 => array(
   0 => "A DNS translates a domain name into what?",
   1 => "Binary",
   2 => "IP",
   3 => "Hex",
   4 => "Octa",
   5 => "URL",
   6 => 2
),
7 => array(
   0 => "When was the first e-mail sent?",
   1 => "1963",
   2 => "1971",
   3 => "1974",
   4 => "1976",
   5 => "1969",
   6 => 2
),
8 => array(
   0 => "Main memory is also known as?",
   1 => "Auxiliary memory",
   2 => "Primery memory",
   3 => "Secondry memory",
   4 => "None of above",
   5 => "All of above",
   6 => 2
),
9 => array(
   0 => "The term CRM means?",
   1 => "Channel Root Market",
   2 => "Customer Relationship Management",
   3 => "Customer Retention Manager",
   4 => "Customer's Relative Meet",
   5 => "Customer's Relative Mode",
   6 => 2
),
10 => array(
   0 => "Why would a switch be used in a network in preference to a HUB	?",
   1 => "To reduce the network traffic",
   2 => "To prevent the spread of all viruses",
   3 => "To connect a computer directly to the internet",
   4 => "To manage password security at the work station",
   5 => "To Manage Security issues on network",
   6 => 1
),
);

$max=10;

$question=$_POST["question"];

if ($_POST["Randon"]==0){
        if($randomizequestions =="yes"){$randval = mt_rand(1,$max);}else{$randval=1;}
        $randval2 = $randval;
        }else{
        $randval=$_POST["Randon"];
        $randval2=$_POST["Randon"] + $question;
                if ($randval2>$max){
                $randval2=$randval2-$max;
                }
        }
        
$ok=$_POST["ok"] ;

if ($question==0){
        $question=0;
        $ok=0;
        $percentaje=0;
        }else{
        $percentaje= Round(100*$ok / $question);
        }
?>

<HTML><HEAD><TITLE>Multiple Choice Questions:  <?php print $title; ?></TITLE>

<SCRIPT LANGUAGE='JavaScript'>
<!-- 
function Goahead (number){
        if (document.percentaje.response.value==0){
                if (number==<?php print $a[$randval2][6] ; ?>){
                        document.percentaje.response.value=1
                        document.percentaje.question.value++
                        document.percentaje.ok.value++
                }else{
                        document.percentaje.response.value=1
                        document.percentaje.question.value++
                }
        }
        if (number==<?php print $a[$randval2][6] ; ?>){
                document.question.response.value="Correct"
        }else{
                document.question.response.value="Incorrect"
        }
}
// -->
</SCRIPT>

</HEAD>
<BODY BGCOLOR=FFFFFF>

<CENTER>
<H1><?php print "$title"; ?></H1>
<TABLE BORDER=1 CELLSPACING=5 WIDTH=500>

<?php if ($question<$max){ ?>

<TR><TD ALIGN=RIGHT>
<FORM METHOD=POST NAME="percentaje" ACTION="<?php print $URL; ?>">

<BR>Percentaje of correct responses: <?php print $percentaje; ?> %
<BR><input type=submit value="Next >>">
<input type=hidden name=response value=0>
<input type=hidden name=question value=<?php print $question; ?>>
<input type=hidden name=ok value=<?php print $ok; ?>>
<input type=hidden name=Randon value=<?php print $randval; ?>>
<br><?php print $question+1; ?> / <?php print $max; ?>
</FORM>
<HR>
</TD></TR>

<TR><TD>
<FORM METHOD=POST NAME="question" ACTION="">
<?php print "<b>".$a[$randval2][0]."</b>"; ?>
 
<BR>     <INPUT TYPE=radio NAME="option" VALUE="1"  onClick=" Goahead (1);"><?php print $a[$randval2][1] ; ?>
<BR>     <INPUT TYPE=radio NAME="option" VALUE="2"  onClick=" Goahead (2);"><?php print $a[$randval2][2] ; ?>
<?php if ($a[$randval2][3]!=""){ ?>
<BR>     <INPUT TYPE=radio NAME="option" VALUE="3"  onClick=" Goahead (3);"><?php print $a[$randval2][3] ; } ?>
<?php if ($a[$randval2][4]!=""){ ?>
<BR>     <INPUT TYPE=radio NAME="option" VALUE="4"  onClick=" Goahead (4);"><?php print $a[$randval2][4] ; } ?>
<?php if ($a[$randval2][5]!=""){ ?>
<BR>     <INPUT TYPE=radio NAME="option" VALUE="5"  onClick=" Goahead (5);"><?php print $a[$randval2][5] ; } ?>
<BR>     <input type=text name=response size=8>


</FORM>

<?php
}else{
?>
<TR><TD ALIGN=Center>
The Quiz has finished
<BR>Percentaje of correct responses: <?php print $percentaje ; ?> %
<p><A HREF="<?php print $address; ?>">Home Page</a>

<?php } ?>

</TD></TR>
</TABLE>

</CENTER>
</BODY>
</HTML>
