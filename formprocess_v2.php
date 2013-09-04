<?php
  require('fpdf.php');
  
  //var_dump($_POST);
  
  //Getting values from PMH drop box and assigning it to $h
    $values= $_POST['pmh'];
    foreach ($values as $a){
            $h= $h.$a.", ";
            }
  
    $yes="Patient complains of ";
    $no="Patient denies ";
  
  // creating the message 
  $message= $_POST['age']." year old ".$_POST['race']." ".$_POST['sex']." with past medical history of ".$h."came for follow up of diabetes. ";
  
  // Parsing through checkboxes to identify positive and negative symptoms. Positive symptoms are added to $yes and negative symptoms are added to $no
  
  If ($_POST['polyphagia']=="on") 
      $yes= $yes."polyphagia, ";
  else
      $no= $no."polyphagia, ";
  If ($_POST['polydipsia']=="on") 
      $yes= $yes."polydipsia, ";
  else
      $no= $no."polydipsia, ";
  If ($_POST['polyuria']=="on") 
      $yes= $yes."polyuria, ";
  else
      $no= $no."polyuria, ";
  If ($_POST['nocturia']=="on") 
      $yes= $yes."nocturia, ";
  else
      $no= $no."nocturia, ";
  If ($_POST['vision']=="on") 
      $yes= $yes."blurring of vision, ";
  else
      $no= $no."blurring of vision, ";
  If ($_POST['chest_pain']=="on") 
      $yes= $yes."chest pain, ";
  else
      $no= $no."chest pain, ";
  If ($_POST['sob']=="on") 
      $yes= $yes."shortness of breath, ";
  else
      $no= $no."shortness of breath, ";
  If ($_POST['palpitations']=="on") 
      $yes= $yes."palpitations, ";
  else
      $no= $no."palpitations, ";
  If ($_POST['early_satiety']=="on") 
      $yes= $yes."early satiety, ";
  else
      $no= $no."early satiety, ";
  If ($_POST['nausea']=="on") 
      $yes= $yes."nausea, ";
  else
      $no= $no."nausea, ";
  If ($_POST['vomiting']=="on") 
      $yes= $yes."vomiting, ";
  else
      $no= $no."vomiting, ";
  If ($_POST['constipation']=="on") 
      $yes= $message."constipation, ";
  else
      $no= $no."constipation, ";
  If ($_POST['diarrhea']=="on") 
      $yes= $yes."diarrhea, ";
  else
      $no= $no."diarrhea, ";
    If ($_POST['sexual']=="on") 
      $yes= $yes."sexual dysfunction, ";
  else
      $no= $no."sexual dysfunction, ";
  If ($_POST['pins']=="on") 
      $yes= $yes."pins and needle sensation. ";
  else
      $no= $no."pins and needle sensation. ";
  
  // creating rest of the message
  
  $message= $message.$yes.$no;
  $message= $message."\n \n". "Social History". "\n"."Smoking: ".$_POST['smoking']." X  ".$_POST['number']." ".$_POST['period'];
$message= $message."\n"."Alcohol: ".$_POST['alcohol']. " X ".$_POST['anumber']." ".$_POST['aperiod'];
  $message=$message."\n"."Drugs: ".$_POST['dugs'];
  $message=$message."\n \n"."Family History"."\n".$_POST['family'];
  $message=$message."\n \n"."Dietetic History"."\n"."Breakfast: ".$_POST['breakfast']."\n"."Lunch: ".$_POST['lunch']."\n"."Dinner: ".$_POST['dinner']."\n"."Snacks: ".$_POST['snacks'];
  $message=$message."\n \n"."Physical Examination"."\n"."HR   ".$_POST['hr']."   "."BP   ".$_POST['bp']."   "."RR   ".$_POST['rr']."   "."Temp   ".$_POST['temp']."\n";
  $message=$message."HEENT         : ".$_POST['heent']."\n";
  $message=$message."Chest         : ".$_POST['chest']."\n";
  $message=$message."CVS           : ".$_POST['cvs']."\n";
  $message=$message."Abdomen       : ".$_POST['abdomen']."\n";
  $message=$message."Neuro         : ".$_POST['neuro']."\n";
  $message=$message."Extremities   : ".$_POST['extremities']."\n";
  $message=$message."Labs:";
  // $message=$message."    ".$_POST['hb']."                          ".$_POST['na']."  ".$_POST['cl']."  ".$_POST['bun']."\n";
  //$message=$message.$_POST['wbc']."     ".$_POST['plt']."                                       ".$_POST['gluc']."\n";
                                               
  //$message=$message."                                ".$_POST['k']."   ".$_POST['bicarb']."  ".$_POST['creat']."  ".$_POST['gluc']."\n";
  // $message=$message."LRTS:   ".$_POST['lrts']."           Lipids: ".$_POST['chol']."/".$_POST['trig']."/".$_POST['hdl']."/".$_POST['ldl']."\n";
  // $message=$message."Hemoglobin A1C: ".$_POST['hba1c']."           Previous HBA1c: ".$_POST['phba1c']."           Urine microalbumin: ".$_POST['um']."\n";
  // $message=$message."Other labs: ".$_POST['ol']."\n";
  // $message=$message."\n \n".$_POST['ap'];
  
  // creating the pdf file
  
  $pdf=new FPDF();
  $pdf->SetLineWidth(0.3);

  $pdf->AddPage();
   
  $pdf->SetMargins(50, 50,150);
  $pdf->SetFont('Arial','',8);
  $pdf->SetXY(30,10);
  $pdf->MultiCell(150,4,$message);
  $xcor=$pdf->GetX(); 
  $ycor=$pdf->GetY();
  
  //drawing cbc line
  
  $pdf->Line($xcor,$ycor+5,$xcor+20,$ycor+15);
  $pdf->Line($xcor,$ycor+15,$xcor+20,$ycor+5);
  
  //drawing cmp line
  $pdf->Line($xcor+60,$ycor+10,$xcor+80,$ycor+10); // straight line
  $pdf->Line($xcor+80,$ycor+10,$xcor+90,$ycor+5);// diagonal upward
  $pdf->Line($xcor+80,$ycor+10,$xcor+90,$ycor+15); //diaganol downward
  $pdf->Line($xcor+66,$ycor+5,$xcor+66,$ycor+15); //dividing line 1
  $pdf->Line($xcor+75,$ycor+5,$xcor+75,$ycor+15); //dividing line 2
  
  //writing lab values
  
 $pdf->setXY($xcor,$ycor);
 $pdf->Text($xcor+9, $ycor+8, $_POST['hb']);
 $pdf->Text($xcor+9,$ycor+14,$_POST['hct']);
 $pdf->Text($xcor+2, $ycor+10, $_POST['wbc']);
 $pdf->Text($xcor+16,$ycor+10,$_POST['plt']);
  
 $pdf->Text($xcor+62, $ycor+8, $_POST['na']);
 $pdf->Text($xcor+62,$ycor+14,$_POST['k']);
 $pdf->Text($xcor+68, $ycor+8, $_POST['cl']);
 $pdf->Text($xcor+68,$ycor+14,$_POST['bicarb']);
  
 $pdf->Text($xcor+77,$ycor+8,$_POST['bun']);
 $pdf->Text($xcor+77, $ycor+14, $_POST['creat']);
 $pdf->Text($xcor+86,$ycor+11,$_POST['gluc']);
  
 
  //Sending the PDF file to browser for downloading to local computer
$pdf->Output('dbinfo.pdf','D');

  ?>
<!--<html>
  
  
  <textarea name="txt1"  rows="10" cols="100">
<?php echo $message; ?>
</textarea>

 
</html> -->
​
