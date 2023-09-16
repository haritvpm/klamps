
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
   

    <title>{{ trans('panel.site_title') }}</title>
       
    
    <style>

h1,h2,h3,h4 {
  margin-top:2px;
  margin-bottom:2px;
}

.font-weight-light{
    font-weight: light;
}
.font-weight-bold{
    font-weight: bold;
}
    
    .text-md {
    font-size: 105%;
    }
    .text-lg {
    font-size: 110%;
    }
    .text-110 {
    font-size: 100%;
    }
    

.row {
  //*margin-right: -15px;*/
  margin-left: -15px;
}
.col-xs-1, .col-sm-1, .col-md-1, .col-lg-1, .col-xs-2, .col-sm-2, .col-md-2, .col-lg-2, .col-xs-3, .col-sm-3, .col-md-3, .col-lg-3, .col-xs-4, .col-sm-4, .col-md-4, .col-lg-4, .col-xs-5, .col-sm-5, .col-md-5, .col-lg-5, .col-xs-6, .col-sm-6, .col-md-6, .col-lg-6, .col-xs-7, .col-sm-7, .col-md-7, .col-lg-7, .col-xs-8, .col-sm-8, .col-md-8, .col-lg-8, .col-xs-9, .col-sm-9, .col-md-9, .col-lg-9, .col-xs-10, .col-sm-10, .col-md-10, .col-lg-10, .col-xs-11, .col-sm-11, .col-md-11, .col-lg-11, .col-xs-12, .col-sm-12, .col-md-12, .col-lg-12 {
  position: relative;
  min-height: 1px;
  padding-right: 15px;
  padding-left: 15px;
}

.col-lg-12 {
    width: 100%;
}

.text-center {
  text-align: center;
}

.text-justify{
    text-align: justify;
}

.center {
    display: flex;
    justify-content: center;
    text-align: center;

 
}

.align-middle{
    text-align:center;
}
.align-right{
    text-align:right;
}

.text-monospace{
  /* font-family: monospace;*/
}

body {
  font-family: Helvetica, Arial, sans-serif;
  font-size: 14px;
  line-height: 1.42857143;  
  color: #333;
  background-color: #fff;
}

.bordered-table {
  
    border: 1px solid; 
    border-collapse: collapse;
    
}
th, td {
  padding: 5px;
}

table {
  width: 100%;
  border-spacing: px;

}

.page-break {
    page-break-after: always;
}

ol{
    line-height:180%;
}

    </style>

</head>

<body>
    <div>
        <div>
        

    <div >
        <div >
           
                <div class="center">
                    <img src= "./klamps_logo600w.jpg" width = '150px' >

                    <h3 class="text-center font-weight-light">KERALA LEGISLATIVE  ASSEMBLY MEDIA & PARLIAMENTARY STUDY CENTRE</h3>
                    <h3 class="text-center font-weight-light">CERTIFICATE COURSE IN PARLIAMENTARY PRACTICE AND PROCEDURE</h3>
                    <h4 class="text-center font-weight-light">EXAMINATION  2023</h4>
                    <h4 class="text-center font-weight-bold">HALL TICKET</h4>
                    
                </div>

        </div>
    </div>

    <div >
        <table>
                        <tbody>
                            
                            <tr>
                                <td style="text-align:left;width: 5%;" >
                                    <b>Year</b><br>
                                    <b>Batch</b>
                                </td>
                                <td  >
                                : {{$student->getYear()}} <br>
                                : {{$student->getBatch()}}
                                </td>
                                <td style="text-align:right;" >
                                    <div >
                                                @if($student->photo)
                                                    <img src=".{{ $student->getPhoto('') }}"  width='80px' style='border:2px solid #000000; padding:3px; margin:5px'>
                                                    
                                                @else
                                                    <img src= ".{{  $student->getFallbackPhoto()}}" width='80px' style='border:2px solid #000000; padding:3px; margin:5px'>
                                                @endif
                                    </div>
                                </td>
                            </tr>
                           
                        </tbody>
            </table>
        </div>

            

    <div>
        <div>
                    <div class="mx-5 mt-5">
                    <table class="bordered-table" >
                        <tbody>
                            
                            <tr>
                                <th style="text-align:left;width: 20%;border: 1px solid;" >
                                    {{ trans('cruds.hallTicket.fields.roll_number') }}
                                </th>
                                <td class="text-monospace  text-md " style="border: 1px solid;" >
                                    &nbsp;{{ $rollno_formatted }}
                                </td>
                            </tr>
                            <tr>
                                <th style="text-align:left;width: 20%;border: 1px solid;">
                                    {{ trans('cruds.student.fields.name') }}
                                </th>
                                <td class="text-monospace  text-md" style="border: 1px solid;">
                                    &nbsp;{{ $student->name }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                            

        </div>
    </div>


    
    <div >
        <div >
                    <div style="margin-top: 10px;" >
                    <table   class="bordered-table">
                        <tbody>
                            
                            <tr>
                                <th  style="text-align:left;width: 20%;border: 1px solid;" rowspan="3">
                                    Examination
                                </th>
                                <td class="align-middle" style="width: 8%;border: 1px solid;">
                                    Date
                                </td>
                                <td style="border: 1px solid;">
                                    30.09.2023  and  01.09.2023  
                                </td>
                            </tr>
                            <tr>
                              
                                <td class="align-middle" style="width: 8%">
                                    Time
                                </td>
                                <td style="border: 1px solid;">
                                10.00 am – 12.30 pm   and   2.00 pm – 4.30 pm 
                                </td>
                            </tr>

                            <tr>
                                <td style="text-align:left;border: 1px solid;">
                                    Centre
                                </td>
                                <td style="border: 1px solid;">
                                    {{ App\Models\Student::CENTRE_SELECT[$student->centre] ?? '' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                            

        </div>
    </div>


    <div >
        <div >
        <br><b>Date of Issue</b>  : {{ date('d/m/Y') }}
        </div>
        <div style="text-align:right;">
            <div class="text-right font-weight-bold">
            <img src= "./sig.png" width = '100px' >
            <br>Joint Director,
            <br>K-LAMPS (PS)
            </div>
        </div>
    </div>
    
<hr>
    <div class="row">
       <div>
       <ol type="1" class="text-justify">
       <div class="font-weight-bold text-center"> Instructions to  Learners</div><br>

        <li>Examinees shall report at the Examination Hall at least half an hour before  commencement of the Examination.</li>
        
        <li>Examinees shall strictly follow the instructions of the Invigilator  during the examination.</li>
        
        <li>Examinees will be allowed to appear for the examination only on production of the <b>identity card</b> and <b>hall ticket</b> issued by the Kerala Legislative Assembly Media and Parliamentary Study Centre.</li>
        <li>Mobile phones and other electronic devices which can be used for collection and storage of data/information are not permitted in the Examination Hall.</li>
                    

        </ol>
        
        <div style="text-align:right;">
            P.T.O
        </div>
        <div class="page-break"></div>

        <ol type="1" start="5" class="text-justify">
        <li>Examinees shall not  leave the Examination Hall without the permission of the Invigilator.</li>

        <li>There shall not be an overwriting in the Enrolment Number and if there is any correction, it should be attested by the Invigilator.</li>

        <li>No examinee shall be permitted to leave the examination hall earlier than one hour before the completion time of the examination. </li>
            
        <li>If a person impersonates a candidate, he / she shall be reported to police and the examinee who is impersonated shall be disqualified from appearing any K-LAMPS (PS) Exam for 5 years.</li>
            
        <li>If an examinee is found talking to another examinee or person inside or outside the examination hall without permission, even after being warned, his/her answer book for that particular paper shall be cancelled. </li>
                 
            
        <li>If an examinee receives or attempts to receive help from any source, including consulting books, notes or papers, or any other matter outside the exam hall, or has given help or attempted to give help, his/her answer book for that particular paper shall be cancelled.</li>
            
        <li>If an examinee is found in possession of papers, books or notes or written notes on his clothes, body or table or chair, which is relevant to the examination(s), his/her answer book for that particular paper shall be cancelled. </li>
            
        <li>Examinees are prohibited from bringing into the examination hall any kind of written or printed matter or books etc., and from noting down the answer of any question on the question papers and  hall tickets .</li>
            
        <li>K-LAMPS reserves the right to change the Date of Examination or cancel any Centre of Examination without assigning reasons whatsoever. Candidate shall use the same HALL TICKET, if the date of Examination is altered. </li>
    
        <li>The decision of the Kerala Legislative Assembly Media and Parliamentary Study Centre shall be final on all matters regarding the conduct of the examination.</li>
       </ol>
      

       <div class="font-weight-bold text-center"> * * *</div>
    </div>



    </div>
    </div>
   
</body>

</html>