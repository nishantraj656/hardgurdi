@extends('layouts.app')
<style >
    img {
        height:100px;
        width: 100px;
    }
</style>

<script type="text/javascript" src="https://www.google.com/jsapi">
</script>
<script type="text/javascript">

   // Load the Google Transliterate API
   google.load("elements", "1", {
         packages: "transliteration"
       });

   function onLoad() {
     var options = {
         sourceLanguage:
             google.elements.transliteration.LanguageCode.ENGLISH,
         destinationLanguage:
             [google.elements.transliteration.LanguageCode.HINDI],
         shortcutKey: 'ctrl+g',
         transliterationEnabled: true
     };
 
     // Create an instance on TransliterationControl with the required
     // options.
     var control =
         new google.elements.transliteration.TransliterationControl(options);

     // Enable transliteration in the textbox with id
    
     control.makeTransliteratable(['hindi']);
     control.makeTransliteratable(['hindiOptionA']);
     control.makeTransliteratable(['hindiOptionB']);
     control.makeTransliteratable(['hindiOptionC']);
     control.makeTransliteratable(['hindiOptionD']);
     control.makeTransliteratable(['hindiExplaination']);
   }
   google.setOnLoadCallback(onLoad);

 </script>
@section('content')

    <div class="container">
           
        <form action="{{url('Question',$datas->question_id)}}" method="POST" enctype="multipart/form-data">
               
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
              @endif
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="setname">Set Name :</label>
                        <select class="form-control" name="setname">
                        @foreach ($list as $l)
                            @if($l->infoID == $datas->test_info_id)
                            <option value="{{$l->infoID}}" selected='selected'>{{$l->title}}</option>
                            @else 
                            <option value="{{$l->infoID}}" >{{$l->title}}</option>  
                            @endif
                        @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                        <div class="form-group">
                            <label for="setname">Set Section :</label>
                            <select class="form-control" id="section_name_select_newQuestion" name="section">
                            @foreach ($section as $l)
                                @if($l['id'] == $datas->section_id)
                                    <option value="{{$l['id']}}" selected='selected'>{{$l['title']}}</option>
                                @else
                                     <option value="{{$l['id']}}">{{$l['title']}}</option>
                                @endif
                            @endforeach
                            </select>
                        </div>
                </div>
            </div>

            <div class="row">
                    <div class="col-sm-6">
                        
                            <div class="form-group">
                                <label for="setname">Enter Question (English)  :</label>
                            <textarea class="form-control" id="eng" name="eng" rows="5" required>{{json_decode($datas->question_json)->eng->text}}</textarea>
                            <div class="form-group">
                                <label for="pic">Insert Pic:</label>
                                <input type="file" name="picEng">
                                <input name="npicEng" value="{{json_decode($datas->question_json)->eng->pic}}" type="hidden"/>
                             
                                @if(json_decode($datas->question_json)->eng->pic!=null)
                               <img src="{{asset(json_decode($datas->question_json)->eng->pic)}}" class ="img-thumbnail"/>
                               
                                 @endif
                               
                              </div>
                        
                        </div>
                            <div class="form-inline o">
                                <label for="engOptionA" class="m-2">A</label>
                                    <input type="radio" @if (json_decode($datas->answer_json)->eng == 'A')
                                        checked="checked"
                                    @endif value="A" name="engRadio" >
                                <input type="text" value="{{json_decode($datas->option_json)->eng->A->text}}" class="form-control m-2" name="engOptionA" >
                                <div class="form-group">
                                    <label for="pic">Insert Pic:</label>
                                    <input type="file" name="picEngOptionA">
                                    <input name="npicEngOptionA" value="{{json_decode($datas->option_json)->eng->A->pic}}" type="hidden"/>
                             
                                    @if(json_decode($datas->option_json)->eng->A->pic!=null)
                                    <img src="{{asset(json_decode($datas->option_json)->eng->A->pic)}}" class ="img-thumbnail"/>
                                    @endif
                                   
                                  </div>


                            </div>

                            <div class="form-inline o">
                                    <label for="engOptionB" class="m-2">B</label>
                                        <input type="radio" value="B" @if (json_decode($datas->answer_json)->eng == 'B')
                                        checked="checked"
                                    @endif name="engRadio">
                                    <input type="text" value="{{json_decode($datas->option_json)->eng->B->text}}" class="form-control m-2" name="engOptionB" >
                                    <div class="form-group">
                                        <label for="pic">Insert Pic:</label>
                                        <input type="file" name="picEngOptionB">
                                        <input name="npicEngOptionB" value="{{json_decode($datas->option_json)->eng->B->pic}}" type="hidden"/>
                             
                                        @if(json_decode($datas->option_json)->eng->B->pic!=null)
                                    <img src="{{asset(json_decode($datas->option_json)->eng->B->pic)}}" class ="img-thumbnail"/>
                                    @endif
                                       
                                      </div>
                             </div>
                            
                            <div class="form-inline o">
                                    <label for="engOptionC" class="m-2">C</label>
                                        <input type="radio" value="C" @if (json_decode($datas->answer_json)->eng == 'C')
                                        checked="checked"
                                    @endif name="engRadio">
                                    <input type="text" value="{{json_decode($datas->option_json)->eng->C->text}}" class="form-control m-2" name="engOptionC" >
                                    <div class="form-group">
                                        <label for="pic">Insert Pic:</label>
                                        <input type="file" name="picEngOptionC">
                                        <input name="npicEngOptionC" value="{{json_decode($datas->option_json)->eng->C->pic}}" type="hidden"/>
                             
                                        @if(json_decode($datas->option_json)->eng->C->pic!=null)
                                        <img src="{{asset(json_decode($datas->option_json)->eng->C->pic)}}" class ="img-thumbnail"/>
                                        @endif
                                       
                                      </div> 
                            </div>

                            <div class="form-inline o">
                                    <label for="engOptionD" class="m-2">D</label>
                                        <input type="radio" value="D" @if (json_decode($datas->answer_json)->eng == 'D')
                                        checked="checked"
                                    @endif name="engRadio">
                                    <input type="text" value="{{json_decode($datas->option_json)->eng->D->text}}" class="form-control m-2" name="engOptionD" >
                                    <div class="form-group">
                                        <label for="pic">Insert Pic:</label>
                                        <input type="file" name="picEngOptionD">
                                        <input name="npicEngOptionD" value="{{json_decode($datas->option_json)->eng->D->pic}}" type="hidden"/>
                             
                                        @if(json_decode($datas->option_json)->eng->D->pic!=null)
                                    <img src="{{asset(json_decode($datas->option_json)->eng->D->pic)}}" class ="img-thumbnail"/>
                                    @endif
                                      </div>
                            </div>

                            <div class="form-group">
                                    <label for="setname">Explaination (English)  :</label>
                            <textarea class="form-control" id="eng" name="engExplaination" rows="5" >{{json_decode($datas->explaination)->eng->text}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="pic">Insert Pic:</label>
                                    <input type="file" name="picEngExplaination">
                                    <input name="npicEngExplaination" value="{{json_decode($datas->explaination)->eng->pic}}" type="hidden"/>
                                    @if(json_decode($datas->explaination)->eng->pic!=null)
                                    <img src="{{asset(json_decode($datas->explaination)->eng->pic)}}" class ="img-thumbnail"/>
                                    @endif
                                  </div>
                    </div>
                    
               
                    <div class="col-sm-6">
                        
                                <div class="form-group">
                                    <label for="setname">Enter Question (हिंदी)  :</label>
                                    <textarea class="form-control" id="hindi" name="hindi"  rows="5" id = "hindi">{{json_decode($datas->question_json)->hindi->text}}</textarea>
                                    <div class="form-group">
                                        <label for="pic">Insert Pic:</label>
                                        <input type="file" name="picHindi">
                                    <input name="npicHindi" value="{{json_decode($datas->question_json)->hindi->pic}}" type="hidden"/>
                                   
                                        @if(json_decode($datas->question_json)->hindi->pic!=null)
                                        <img src="{{asset(json_decode($datas->question_json)->hindi->pic)}}" class ="img-thumbnail"/>
                                        @endif
                                       
                                      </div>
                                </div>

                                <div class="form-inline o">
                                        <label for="hindiOptionA" class="m-2">क</label>
                                            <input type="radio" value="A"  @if (json_decode($datas->answer_json)->hindi == 'A')
                                            checked="checked"
                                        @endif name="hindiRadio">
                                        <input type="text" class="form-control m-2" value="{{json_decode($datas->option_json)->hindi->A->text}}" name="hindiOptionA" id= "hindiOptionA">
                                        <div class="form-group">
                                            <label for="picHindiOptionA">Insert Pic:</label>
                                            <input type="file" name="picHindiOptionA"/>
                                            <input name="npicHindiOptionA" value="{{json_decode($datas->option_json)->hindi->A->pic}}" type="hidden"/>
                                   
                                            @if(json_decode($datas->option_json)->hindi->A->pic!=null)
                                            <img src="{{asset(json_decode($datas->option_json)->hindi->A->pic)}}" class ="img-thumbnail"/>
                                            @endif
                                          </div>
                                    </div>
        
                                    <div class="form-inline o">
                                            <label for="hindiOptionB" class="m-2">ख</label>
                                                <input type="radio" value="B" @if (json_decode($datas->answer_json)->hindi == 'B')
                                                checked="checked"
                                            @endif name="hindiRadio">
                                            <input type="text" value="{{json_decode($datas->option_json)->hindi->B->text}}" class="form-control m-2" name="hindiOptionB" id="hindiOptionB">
                                            <div class="form-group">
                                                <label for="pic">Insert Pic:</label>
                                                <input type="file" name="picHindiOptionB">
                                                <input name="npicHindiOptionB" value="{{json_decode($datas->option_json)->hindi->B->pic}}" type="hidden"/>
                                   
                                                @if(json_decode($datas->option_json)->hindi->B->pic!=null)
                                            <img src="{{asset(json_decode($datas->option_json)->hindi->B->pic)}}" class ="img-thumbnail"/>
                                            @endif
                                              </div> 
                                     </div>
                                    
                                    <div class="form-inline o">
                                            <label for="hindiOptionC" class="m-2">ग</label>
                                                <input type="radio"  @if (json_decode($datas->answer_json)->hindi == 'C')
                                                checked="checked"
                                            @endif value="C" name="hindiRadio">
                                            <input type="text" class="form-control m-2"  value="{{json_decode($datas->option_json)->hindi->C->text}}" name="hindiOptionC" id="hindiOptionC">
                                            <div class="form-group">
                                                <label for="pic">Insert Pic:</label>
                                                <input type="file" name="picHindiOptionC">
                                                <input name="npicHindiOptionC" value="{{json_decode($datas->option_json)->hindi->C->pic}}" type="hidden"/>
                                   
                                                @if(json_decode($datas->option_json)->hindi->C->pic!=null)
                                            <img src="{{asset(json_decode($datas->option_json)->hindi->C->pic)}}" class ="img-thumbnail"/>
                                            @endif
                                              </div>
                                    </div>
        
                                    <div class="form-inline o">
                                            <label for="hindiOptionD" class="m-2">घ</label>
                                                <input type="radio" value="D"  @if (json_decode($datas->answer_json)->hindi == 'D')
                                                checked="checked"
                                            @endif name="hindiRadio">
                                            <input type="text" class="form-control m-2"  value="{{json_decode($datas->option_json)->hindi->D->text}}" name="hindiOptionD" id="hindiOptionD">
                                            <div class="form-group">
                                                <label for="pic">Insert Pic:</label>
                                                <input type="file" name="picHindiOptionD">
                                                <input name="npicHindiOptionD" value="{{json_decode($datas->option_json)->hindi->D->pic}}" type="hidden"/>
                                   
                                                @if(json_decode($datas->option_json)->hindi->D->pic!=null)
                                            <img src="{{asset(json_decode($datas->option_json)->hindi->D->pic)}}" class ="img-thumbnail"/>
                                            @endif
                                              </div>
                                    </div>

                                    <div class="form-group">
                                            <label for="setname">Explaination (हिंदी)  :</label>
                                    <textarea class="form-control" id="hindiExplaination" name="hindiExplaination" rows="5" id="hindiExplaination">{{json_decode($datas->explaination)->hindi->text}}</textarea>
                                    <div class="form-group">
                                        <label for="pic">Insert Pic:</label>
                                        <input type="file" name="picHindiExplaination">
                                        <input name="npicHindiExplaination" value="{{json_decode($datas->explaination)->hindi->pic}}" type="hidden"/>
                                   
                                        @if(json_decode($datas->explaination)->hindi->pic!=null)
                                        <img src="{{asset(json_decode($datas->explaination)->hindi->pic)}}" class ="img-thumbnail"/>
                                        @endif
                                       
                                      </div> 
                                </div>
                       
                    </div>
            </div>
              


            <div class="row">
              <div class="form-check">
                <input type="checkbox" name="checkBoxPuzzel" value="1" class="form-check-input" id="checkBoxPuzzel" 

                @if($datas->ispuzzle == '1') {{"checked"}} @endif>
                <label class="form-check-label" for="checkBoxPuzzel">is this Puzzel?</label>
              </div>
            </div>
            <br>



            <div class="row">
                <button type="submit" class="btn btn-primary ml-4">Submit</button>
            </div>
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
              
        </form>
    </div>

    <script type="text/javascript">
        $(document).ready(function(){
          if($('#section_name_select_newQuestion').children("option:selected").val()==7){
                  $('.o').hide();
              }
              else{
                  $('.o').show();
              }
  
            
  
            // $("#test_name_select_newQuestion").val(localStorage.getItem("test_id_selected"));
            //   $("#section_name_select_newQuestion").val(localStorage.getItem("section_id_selected"));
  



  
                          $("#test_name_select_newQuestion").change(function(){
                            console.log("Testname changed");
                            // $test_id_selected = $(this).children("option:selected").val()
                            // localStorage.setItem("test_id_selected", $test_id_selected);
              
                          });


             
                      $("#section_name_select_newQuestion").change(function(){
                        

                        console.log("Sectionname changed");
                        // $section_id_selected = $(this).children("option:selected").val()
                        // localStorage.setItem("section_id_selected", $section_id_selected);
          








                      if($(this).children("option:selected").val()==7){
                          $('.o').hide();
                      }
                      else{
                          $('.o').show();
                      }
          
                      });
  
          })
      </script>

@endsection 