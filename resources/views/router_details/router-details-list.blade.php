<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import Router Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<style>
    .prevent:disabled {
  background: #dddddd;
}
</style>
<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        {{ $message }}
                    </div>
                @endif
                @if ($message = Session::get('error'))
                    <div class="alert alert-error">
                        {{ $message }}
                    </div>
                @endif
                <form action="/save-router-details" method="POST" id="router-form">
                {{ csrf_field() }}
                    <table id="router" class="table table-bordered data-table mt-5">
                        <thead class="table-light">
                            <tr>
                                <th>Sap Id</th>
                                <th>Hostname</th>
                                <th>Loopback</th>
                                <th>Mac Address</th> 
                                <th>Action</th>   
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = "1";?>
                            @if(isset($finalData) && !empty($finalData))
                                @foreach($finalData as $route)
                                    <tr id="{{$i}}">
                                        <td ondblclick="edit(this)"><input type="text"  name="sapid[]"  value="{{ $route['sapid'] }}" required="required"></td>
                                        <td ondblclick="edit(this)"><input type="text" name="hostname[]" value="{{ $route['hostname'] }}" required="required"></td>
                                        <td ondblclick="edit(this)"><input type="text" name="loopback[]" value="{{ $route['loopback'] }}" required="required"></td>
                                        <td ondblclick="edit(this)"><input type="text" name="macaddress[]" value="{{ $route['macaddress'] }}" required="required"></td>
                                        <td><button type="button" class="btn btn-danger delete-row" id="deleteButton">Delete</button></td>
                                    </tr>
                                    <?php $i++; ?>
                                @endforeach
                            @endif    
                        </tbody>
                    </table>
                    <input type='submit' name='submit' value='Submit' class="btn btn-success prevent">
                </form>
            </div>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="/path/to/cdn/jquery.slim.min.js"></script>
<script src="/path/to/jquery.prevent-duplicate-submit.js"></script>

<script>

function changeColor(){
    let length = $("table").find('tr').eq(1).children('td').length-1;
    $("table").find('tr').each(function (i, allTd ) {
        if($(allTd).find('td').eq(0).children().val() != undefined){
       
            var isRed = false;
            for(var tdCount = 0; tdCount < length; tdCount++){
                if($(allTd).find('td').eq(tdCount).children().val() === "" && !$(allTd).find('td').eq(tdCount).children().hasClass('delete-row')){
                    $(allTd).css("background-color", "red");
                    isRed = true;
                    return true;
                }
            }
            if (!isRed) {
                $(allTd).css("background-color", "")
            }
            var currBackground = false;
            $("table").find('tr').each(function (j, ids ) {
                if(ids.id != allTd.id && $(ids).find('td').eq(0).children().val() != undefined){
                    var isDuplicate = false;
                   
                    for(var tdCount = 0; tdCount < length; tdCount++){
                       
                       
                            var areEqual = $(ids).find('td').eq(tdCount).children().val().toUpperCase() === $(allTd).find('td').eq(tdCount).children().val().toUpperCase();
                            if(!areEqual) {
                               
                                isDuplicate = true;
                                break;
                            }
                    }    
                    if(!isDuplicate){
                        currBackground = true;
                       
                        $(allTd).css("background-color", "#808080");
                        return false;
                    }
                }
            });
            if(!currBackground){
               
                $(allTd).css("background-color", "")
            }
        }
    });
}    
$( document ).ready(function() {
    changeColor()
   
});    
function edit(el) {
  el.childNodes[0].removeAttribute("disabled");
  el.childNodes[0].focus();
  window.getSelection().removeAllRanges();

}

function disable(el) {
    changeColor()
    el.setAttribute("disabled","");
}

$("#router").on("click", "#deleteButton", function() {
   $(this).closest("tr").remove();
});

$("input").change(function(){
    var x=$(this).val();
    var z=0;
    $("input").each(function(){
        var y=$(this).val();
        if(x==y){
            z=z+1;
        }
    });
    if(z>1){
        alert(x.concat(" Remove duplicate values")); 
    }
 })

</script>
</body>
</html>