@extends('layouts.app')
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">

    // Load the Google Transliterate API
    google.load("elements", "1",{ packages: "transliteration" });

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
            var control = new google.elements.transliteration.TransliterationControl(options);
            // Enable transliteration in the textbox with id
            // 'transliterateTextarea'.
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

            @if (session('status'))
            <div class="alert alert-success">
                    <strong>Success!</strong> {{session('status')}}.
                  </div>         
        @endif
        <form action="{{url('Question')}}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
            <a href="{{url('/Question')}}" class="btn btn-success"> List</a>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="setname">Set Name :</label>
                        <select class="form-control" name="setname" id="test_name_select_newQuestion">
                        @foreach ($list as $l)
                        <option value="{{$l->infoID}}" @if(old('setname')==$l->infoID)selected='selected'@endif >{{$l->title}}</option>   
                        @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                        <div class="form-group">
                            <label for="setname">Set Section :</label>
                            <select class="form-control" name="section" id="section_name_select_newQuestion">
                            @foreach ($section as $l)
                            <option value="{{$l['id']}}"  @if(old('section')==$l['id'])selected='selected'@endif>{{$l['title']}}</option>   
                            @endforeach
                            </select>
                        </div>
                </div>
            </div>

            <div class="row">
                    <div class="col-sm-6">
                        
                            <div class="form-group">
                                <label for="setname">Enter Question (English)  :</label>
                                <textarea class="form-control" id="eng" name="eng" rows="5" required>{{ old('eng') }}</textarea>
                                <div class="form-group">
                                    <label for="pic">Insert Pic:</label>
                                    <input type="file" name="picEng">
                                   
                                  </div>
                            </div>
                            <div class="form-inline o ">
                                <label for="engOptionA" class="m-2">A</label>
                                    <input type="radio" value="A"  @if(old('engRadio')=='A') checked="checked"@endif name="engRadio" >
                                <input type="text" class="form-control m-2" value="{{old('engOptionA')}}" name="engOptionA" >
                                <div class="form-group">
                                    <label for="pic">Insert Pic:</label>
                                    <input type="file" name="picEngOptionA">
                                   
                                  </div>
                                
                            </div>

                            <div class="form-inline o">
                                    <label for="engOptionB" class="m-2">B</label>
                                        <input type="radio" value="B" name="engRadio"  @if(old('engRadio')=='B') checked="checked"@endif>
                                    <input type="text" class="form-control m-2" value="{{old('engOptionB')}}" name="engOptionB" >
                                    <div class="form-group">
                                        <label for="pic">Insert Pic:</label>
                                        <input type="file" name="picEngOptionB">
                                       
                            </div>
                                    
                             </div>
                            
                            <div class="form-inline o">
                                    <label for="engOptionC" class="m-2">C</label>
                                        <input type="radio" value="C" name="engRadio"  @if(old('engRadio')=='C') checked="checked"@endif>
                                    <input type="text" class="form-control m-2" value="{{old('engOptionC')}}" name="engOptionC" >
                                    <div class="form-group">
                                        <label for="pic">Insert Pic:</label>
                                        <input type="file" name="picEngOptionC">
                                       
                                      </div>
                                    
                            </div>

                            <div class="form-inline o">
                                    <label for="engOptionD" class="m-2">D</label>
                                        <input type="radio" value="D" name="engRadio"  @if(old('engRadio')=='D') checked="checked"@endif>
                                    <input type="text" class="form-control m-2" value="{{old('engOptionD')}}" name="engOptionD" >
                                    <div class="form-group">
										<label for="pic">Insert Pic:</label>
                                        <input type="file" name="picEngOptionD">
                                       
                                      </div>
                                    
                            </div>

                            <div class="form-inline o">
                                    <label for="engOptionD" class="m-2">E</label>
                                        <input type="radio" value="E" name="engRadio"  @if(old('engRadio')=='E') checked="checked"@endif>
                                    <input type="text" class="form-control m-2" value="{{old('engOptionE')}}" name="engOptionE" >
                                    <div class="form-group">
										<label for="pic">Insert Pic:</label>
                                        <input type="file" name="picEngOptionE">
                                       
                                      </div>
                                    
                            </div>

                            <div class="form-group">
                                    <label for="setname">Explaination (English)  :</label>
                                    <textarea class="form-control" id="eng"  name="engExplaination" rows="5" >{{old('engExplaination')}}</textarea>
                                    <div class="form-group">
                                        <label for="pic">Insert Pic:</label>
                                        <input type="file" name="picEngExplaination">
                                       
                                      </div>
                                </div>
                      
                    </div>
                    
               
                    <div class="col-sm-6">
                        
                                <div class="form-group">
                                    <label for="setname">Enter Question (हिंदी)  :</label>
                                    <textarea class="form-control" id="hindi" name="hindi"  rows="5" >{{old('hindi')}}</textarea>
                                    <div class="form-group">
                                        <label for="pic">Insert Pic:</label>
                                        <input type="file" name="picHindi">
                                       
                                      </div>
                                </div>

                                <div class="form-inline o">
                                        <label for="hindiOptionA" class="m-2">क</label>
                                            <input type="radio" value="A"  name="hindiRadio"  @if(old('hindiRadio')=='A') checked="checked"@endif>
                                <input type="text" class="form-control m-2" value="{{old('hindiOptionA')}}" name="hindiOptionA" id="hindiOptionA">
                                        <div class="form-group">
                                            <label for="pic">Insert Pic:</label>
                                            <input type="file" name="picHindiOptionA">
                                           
                                          </div>
                                        
                                    </div>
        
                                    <div class="form-inline o">
                                            <label for="hindiOptionB" class="m-2">ख</label>
                                                <input type="radio" value="B" name="hindiRadio"  @if(old('hindiRadio')=='B') checked="checked"@endif>
                                            <input type="text" class="form-control m-2" value="{{old('hindiOptionB')}}"  name="hindiOptionB" id = "hindiOptionB">
                                            <div class="form-group">
                                                <label for="pic">Insert Pic:</label>
                                                <input type="file" name="picHindiOptionB">                                              
                                            </div> 
                                    </div>
                                    
                                    <div class="form-inline o">
                                            <label for="hindiOptionC" class="m-2">ग</label>
                                                <input type="radio" value="C" name="hindiRadio"  @if(old('hindiRadio')=='C') checked="checked"@endif>
                                            <input type="text" class="form-control m-2" value="{{old('hindiOptionC')}}"  name="hindiOptionC" id = "hindiOptionC" >
                                            <div class="form-group">
                                                <label for="pic">Insert Pic:</label>
                                                <input type="file" name="picHindiOptionC">
                                               
                                              </div>
                                    </div>
        
                                    <div class="form-inline o">
                                            <label for="hindiOptionD" class="m-2">घ</label>
                                                <input type="radio" value="D" name="hindiRadio"  @if(old('hindiRadio')=='D') checked="checked"@endif>
                                            <input type="text" class="form-control m-2" value="{{old('hindiOptionD')}}"  name="hindiOptionD" id = "hindiOptionD">
                                            <div class="form-group">
                                                <label for="pic">Insert Pic:</label>
                                                <input type="file" name="picHindiOptionD">
                                               
                                              </div>
                                    </div>

                                    <div class="form-inline o">
                                        <label for="hindiOptionD" class="m-2">ङ</label>
                                            <input type="radio" value="E" name="hindiRadio"  @if(old('hindiRadio')=='E') checked="checked"@endif>
                                        <input type="text" class="form-control m-2" value="{{old('hindiOptionE')}}"  name="hindiOptionE" id = "hindiOptionE">
                                        <div class="form-group">
                                            <label for="pic">Insert Pic:</label>
                                            <input type="file" name="picHindiOptionE">
                                           
                                          </div>
                                    </div>

                                    <div class="form-group">
                                            <label for="setname">Explaination (हिंदी)  :</label>
                                            <textarea class="form-control" id="hindiExplaination" name="hindiExplaination" rows="5" id="hindiExplaination">{{old('hindiExplaination')}}</textarea>
                                            <div class="form-group">
                                                <label for="pic">Insert Pic:</label>
                                                <input type="file" name="picHindiExplaination">
                                               
                                              </div>
                                        </div>
                       
                    </div>
            </div>
            
            <div class="row">
              <div class="form-check">
                <input type="checkbox" name="checkBoxPuzzel" value="1" class="form-check-input" id="checkBoxPuzzel">
                <label class="form-check-label" for="checkBoxPuzzel">is this Puzzel?</label>
              </div>
            </div>
            <br>

            <div class="row">
              <button type="submit" class="btn btn-primary ml-4 btn-lg btn-block">Submit</button>      
            </div>
            
              
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

            

                    $("#test_name_select_newQuestion").val(localStorage.getItem("test_id_selected"));
                    $("#section_name_select_newQuestion").val(localStorage.getItem("section_id_selected"));

                    $("#test_name_select_newQuestion").change(function(){
                        console.log("Testname changed");
                        $test_id_selected = $(this).children("option:selected").val()
                        localStorage.setItem("test_id_selected", $test_id_selected);

                    });
                    
                    $("#section_name_select_newQuestion").change(function(){
                        console.log("Sectionname changed");
                        $section_id_selected = $(this).children("option:selected").val()
                    localStorage.setItem("section_id_selected", $section_id_selected);

                    if($(this).children("option:selected").val()==7){
                        $('.o').hide();
                    }
                    else{
                        $('.o').show();
                    }
                });

        });
    </script>
@endsection 