@extends('layouts.app')
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
     // 'transliterateTextarea'.
     control.makeTransliteratable(['hindi']);
     control.makeTransliteratable(['hindiOptionA']);
     control.makeTransliteratable(['hindiOptionB']);
     control.makeTransliteratable(['hindiOptionC']);
     control.makeTransliteratable(['hindiOptionD']);
     control.makeTransliteratable(['hindiExplaination']);
   }
   google.setOnLoadCallback(onLoad);

//    //Load the Language API.
//    google.load("language", "1");

//    //Call google.language.transliterate() 
//    google.language.transliterate(["Namaste"], "en", "hi", function(result) {
//      if (!result.error) {
//        var container = document.getElementById("transliteration");
//        if (result.transliterations && result.transliterations.length > 0 &&
//            result.transliterations[0].transliteratedWords.length > 0) {
//          console.log(result.transliterations[0].transliteratedWords[0]);
//        }
//      }
//    });
 </script>
 
@section('content')

    <div class="container">
        <form action="{{url('Question')}}" method="POST">
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
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="setname">Set Name :</label>
                        <select class="form-control" name="setname">
                        @foreach ($list as $l)
                        <option value="{{$l->infoID}}">{{$l->title}}</option>   
                        @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                        <div class="form-group">
                            <label for="setname">Set Section :</label>
                            <select class="form-control" name="section">
                            @foreach ($section as $l)
                            <option value="{{$l['id']}}">{{$l['title']}}</option>   
                            @endforeach
                            </select>
                        </div>
                </div>
            </div>

            <div class="row">
                    <div class="col-sm-6">
                        
                            <div class="form-group">
                                <label for="setname">Enter Question (English)  :</label>
                                <textarea class="form-control" id="eng" name="eng" rows="5" required></textarea>
                                <div class="form-group">
                                    <label for="pic">Insert Pic:</label>
                                    <input type="file" name="picEng">
                                   
                                  </div>
                            </div>
                            <div class="form-inline">
                                <label for="engOptionA" class="m-2">A</label>
                                    <input type="radio" value="A" name="engRadio" >
                                <input type="text" class="form-control m-2" name="engOptionA" required>
                                <div class="form-group">
                                    <label for="pic">Insert Pic:</label>
                                    <input type="file" name="picEngOptionA">
                                   
                                  </div>
                                
                            </div>

                            <div class="form-inline">
                                    <label for="engOptionB" class="m-2">B</label>
                                        <input type="radio" value="B" name="engRadio">
                                    <input type="text" class="form-control m-2" name="engOptionB" required>
                                    <div class="form-group">
                                        <label for="pic">Insert Pic:</label>
                                        <input type="file" name="picEngOptionB">
                                       
                                      </div>
                                    
                             </div>
                            
                            <div class="form-inline">
                                    <label for="engOptionC" class="m-2">C</label>
                                        <input type="radio" value="C" name="engRadio">
                                    <input type="text" class="form-control m-2" name="engOptionC" required>
                                    <div class="form-group">
                                        <label for="pic">Insert Pic:</label>
                                        <input type="file" name="picEngOptionC">
                                       
                                      </div>
                                    
                            </div>

                            <div class="form-inline">
                                    <label for="engOptionD" class="m-2">D</label>
                                        <input type="radio" value="D" name="engRadio">
                                    <input type="text" class="form-control m-2" name="engOptionD" required>
                                    <div class="form-group">
                                        <label for="pic">Insert Pic:</label>
                                        <input type="file" name="picEngOptionD">
                                       
                                      </div>
                                    
                            </div>

                            <div class="form-group">
                                    <label for="setname">Explaination (English)  :</label>
                                    <textarea class="form-control" id="eng" name="engExplaination" rows="5" ></textarea>
                                    <div class="form-group">
                                        <label for="pic">Insert Pic:</label>
                                        <input type="file" name="picEngExplaination">
                                       
                                      </div>
                                </div>
                      
                    </div>
                    
               
                    <div class="col-sm-6">
                        
                                <div class="form-group">
                                    <label for="setname">Enter Question (हिंदी)  :</label>
                                    <textarea class="form-control" id="hindi" name="hindi"  rows="5" ></textarea>
                                    <div class="form-group">
                                        <label for="pic">Insert Pic:</label>
                                        <input type="file" name="picHindi">
                                       
                                      </div>
                                </div>

                                <div class="form-inline">
                                        <label for="hindiOptionA" class="m-2">क</label>
                                            <input type="radio" value="A" name="hindiRadio">
                                        <input type="text" class="form-control m-2" name="hindiOptionA" >
                                        <div class="form-group">
                                            <label for="pic">Insert Pic:</label>
                                            <input type="file" name="picHindiOptionA">
                                           
                                          </div>
                                        
                                    </div>
        
                                    <div class="form-inline">
                                            <label for="hindiOptionB" class="m-2">ख</label>
                                                <input type="radio" value="B" name="hindiRadio">
                                            <input type="text" class="form-control m-2" name="hindiOptionB" >
                                            <div class="form-group">
                                                <label for="pic">Insert Pic:</label>
                                                <input type="file" name="picHindiOptionB">
                                               
                                              </div> 
                                     </div>
                                    
                                    <div class="form-inline">
                                            <label for="hindiOptionC" class="m-2">ग</label>
                                                <input type="radio" value="C" name="hindiRadio">
                                            <input type="text" class="form-control m-2" name="hindiOptionC" >
                                            <div class="form-group">
                                                <label for="pic">Insert Pic:</label>
                                                <input type="file" name="picHindiOptionC">
                                               
                                              </div>
                                    </div>
        
                                    <div class="form-inline">
                                            <label for="hindiOptionD" class="m-2">घ</label>
                                                <input type="radio" value="D" name="hindiRadio">
                                            <input type="text" class="form-control m-2" name="hindiOptionD" >
                                            <div class="form-group">
                                                <label for="pic">Insert Pic:</label>
                                                <input type="file" name="picHindiOptionD">
                                               
                                              </div>
                                    </div>

                                    <div class="form-group">
                                            <label for="setname">Explaination (हिंदी)  :</label>
                                            <textarea class="form-control" id="hindiExplaination" name="hindiExplaination" rows="5" ></textarea>
                                            <div class="form-group">
                                                <label for="pic">Insert Pic:</label>
                                                <input type="file" name="picHindiExplaination">
                                               
                                              </div>
                                        </div>
                       
                    </div>
            </div>
              
            <div class="row">
                    <button type="submit" class="btn btn-primary ml-4">Submit</button>
            </div>
            
              
        </form>
    </div>

@endsection