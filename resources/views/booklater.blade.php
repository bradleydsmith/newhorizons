<br>
<br>

@extends('layouts.app')

@section('content')
<div id="wrapper">

<!-- Write here -->
<div class="welcometext">
 Add Book Later form
 <br>
 <body>
  <h1 align= "center"> New Horizon Car Sharing </h1>



  <p>

  </p><br><br><br><br>

<!--<div class="book-form__block-select">#}
{#                            <div class="inner-block">#}-->
                               <div class="book-form__text">Choose your area:</div>
                               <select name="location">
                                    <option disabled>Location</option>
                                    <option value="Melbourne CBD">Melbourne CBD</option>
                                    <option value="other">other</option>
                                    <!--<option value="East Melbourne">East Melbourne</option>
                                    <option selected value="South Melbourne">South Melbourne</option>
                                    <option value="North Melbourne">North Melbourne</option>
                                    <option value="West Melbourne">West Melbourne</option>-->
                                </select>
                           </div><br><br><br><br>

<!--<div class="book-form__block-select">#}
{#                            <div class="inner-block">#}-->
                                <div class="book-form__text">Car type:</div>
                                <select name="type">
                                    <option disabled>type</option>
                                    <option value="coupe">coupe</option>
                                    <option value="sedan">sedan</option>
                                    <option value="SUV">SUV</option>

                                </select>
                            </div><br><br><br><br>


<!--<div class="inner-block second-block">#}-->
                                <div class="book-form__text">Date and Time</div>
                                <select name="Date and Time">
                                    <option selected value="Jan">Jan</option>
                                    <option value="February">Feb</option>
                                    <option value="March">Mar</option>
                                    <option value="April">Apr</option>
                                    <option value="May">May</option>
                                    <option value="June">Jun</option>
                                    <option value="Jule">Jul</option>
                                    <option value="August">Aug</option>
                                    <option value="September">Sept</option>
                                    <option value="October">Oct</option>
                                    <option value="November">Nov</option>
                                    <option value="December">Dec</option>
                                </select>
                                <select name="day">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                    <option value="24">24</option>
                                    <option value="25">25</option>
                                    <option value="26">26</option>
                                    <option value="27">27</option>
                                    <option value="28">28</option>
                                    <option value="29">29</option>
                                    <option value="30">30</option>
                                    <option value="31">31</option>
                                </select>
                                <select name="time">
                                    <option value="08:00 AM">08:00 AM</option>
                                    <option value="09:00 AM">09:00 AM</option>
                                    <option value="10:00 AM">10:00 AM</option>
                                    <option value="11:00 AM">08:00 AM</option>
                                    <option value="12:00 PM">12:00 PM</option>
                                    <option value="13:00 PM">13:00 PM</option>
                                    <option value="14:00 PM">14:00 PM</option>
                                    <option value="15:00 PM">15:00 PM</option>
                                </select>
                            </div>


          <p>

          <input type="button" value="Show avaliable cars" onclick="()">

          </p>
     </body>

</div>

<!------------------>

</div>  <!--wrapper div -->

@endsection

