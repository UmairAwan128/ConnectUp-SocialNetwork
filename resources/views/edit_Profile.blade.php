<br><br>
<div class="row">
      
      <div class="col-sm-2">
      </div>

      <div class="col-sm-8">

        <form id="editProfile_form" type="post">
   
            {{ csrf_field() }}
            <table class="table table-bordered table-hover">
                 <tr allign="center">
                    <td colspan="6" class="active"><h2>Edit your profile</h2></td>
                 </tr>
                 <tr>
                     <td style="font-weight: bold;">Change your FirstName</td>
                     <td>
                         <input class="form-control" type="text" name="f_name"  required value="{{ Auth::user()->f_name }}">
                     </td>
                 </tr>
                 <tr>
                     <td style="font-weight: bold;">Change your LastName</td>
                     <td>
                         <input class="form-control" type="text" name="l_name"  required value="{{ Auth::user()->l_name }}">
                     </td>
                 </tr>
                 <tr>
                     <td style="font-weight: bold;"> Your UserName</td>
                     <td>
                         <input class="form-control" type="text" name="name"  required value="{{ Auth::user()->name }}">
                     </td>
                 </tr>
                 <tr>
                     <td style="font-weight: bold;">Description</td>
                     <td>
                         <input class="form-control" type="text" name="about"  required value="{{ Auth::user()->about }}">
                     </td>
                 </tr>
                 <tr>
                     <td style="font-weight: bold;">Relationship status</td>
                     <td>
                         <select class="form-control" name="Relationship">
                             @if(Auth::user()->Relationship != null)
                                  <option selected >{{ Auth::user()->Relationship }}</option>
                                  <option>Single</option>
                             @else                                                
                                   <option selected >Single</option>
                             @endif

                             <option>Engaged</option>
                             <option>Married</option>
                             <option>Single</option>
                             <option>In a Relationship</option>
                         </select>
                     </td>
                 </tr>
                 <tr>
                     <td style="font-weight: bold;">Password</td>
                     <td>
                         <input type="password" name="password" id="mypass" class="form-control" required value="{{ Auth::user()->password }}">
                         <input type="checkbox" id="showPasswordCheck" onclick="show_password()"><strong>Show Password</strong>
                     </td>
                 </tr>
                 <tr>
                     <td style="font-weight: bold;">Email</td>
                     <td>
                         <input type="email" name="email" class="form-control" required value="{{ Auth::user()->email }}">
                     </td>
                 </tr>
                 <tr>
                     <td style="font-weight: bold;">Country</td>
                     <td>
                         <select class="form-control" name="country">
     
                           @if(count($countries) > 0)
                                <option disabled>Select Country</option>
                                @foreach($countries as $country)
                                    {{-- reset($countries)  gets the first element of the array --}}
                                    @if($country->name == Auth::user()->country)  
                                        <option selected id="{{$country->id}}">{{$country->name}}</option>
                                    @else
                                        <option id="{{$country->id}}">{{$country->name}}</option>   
                                    @endif  
                                @endforeach
                           @else
                              <option disabled>No Countires Found</option>
                           @endif

                        </select>
                     </td>
                 </tr>
                 <tr>
                     <td style="font-weight: bold;">Gender</td>
                     <td>
                         <select class="form-control" name="gender">
       
       
                            @if(count($genders) > 0)
                                <option disabled>Select Gender</option>
                            @foreach($genders as $gender)
                         {{-- reset($genders)  gets the first element of the array --}}
                                  @if($gender->name === Auth::user()->gender)  
                                     <option selected id="{{$gender->id}}">{{$gender->name}}</option>
                                  @else
                                     <option id="{{$gender->id}}">{{$gender->name}}</option>
                                  @endif
                            @endforeach
                            @else
                              <option disabled>No Genders Found</option>
                            @endif
                    
                         </select>
                     </td>
                 </tr>
                 <tr>
                        <td style="font-weight: bold;">Birthdate</td>
                        <td>
                            {{-- imp:           Y means 2009         and         y means 09    so use capital Y  --}}
                            <input type="date" name="birthday" class="form-control" required value="{{ date('Y-m-d', strtotime(Auth::user()->birthday)) }}">
                            
                        </td>
      
                   </tr>
                   <tr>
                        <td style="font-weight: bold;">Joined At</td>
                        <td>
                            <input type="date" disabled name="created_at" class="form-control" required value="{{ \Carbon\Carbon::parse(Auth::user()->created_at)->format('Y-m-d')}}">
                        </td>
      
                   </tr>
                       <tr align="center">
                     <td colspan="6">
                         <div class="form-group">
                            <input id="updateUserInfo" type="submit" class="btn btn-info" name="update" style="width:250px;"/>                              
                         </div>
                     </td>
                 </tr>
             </table>
         </form>
      </div>
      <div class="col-sm-2">

      </div>
</div>
