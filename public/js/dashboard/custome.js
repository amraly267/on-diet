// === Submit forms via ajax call ===
function submitForm(form, beforeSendAction, afterCompleteAction, successResponse, errorResponse, ckeditorTextareas)
{
    event.preventDefault();
    var formData = new FormData(form);
    var form = $(form);
    var url = form.attr('action');
    var className = form.className;
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

    $.ajax({
        type: 'POST',
        url: url,
        data: formData,
        contentType: false,
        cache: false,
        processData: false,

        beforeSend: function(){
            $.each(ckeditorTextareas, function(index, value) {
                formData.append(value, CKEDITOR.instances[value].getData());
            });

            beforeSendAction();
        },
        complete: function(){
            afterCompleteAction();
        },
        success: function(response)
        {
            callResponse = response
            successResponse();
        },
        error: function(response)
        {
            callResponse = response
            errorResponse();
        }
    });
}
// === End function ===

// === Delete Row ===
function deleteRow(route, deleteToken)
{
    console.log(route);

    Swal.fire({
        icon: 'question',
        title: title,
        showCancelButton: true,
    }).then((result) => {
        if(result.isConfirmed)
        {
            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                type: 'DELETE',
                url: route,
                data: {"_method": 'DELETE', "_token": deleteToken},
                contentType: false,
                cache: false,
                processData: false,
                success: function (response)
                {
                    Swal.fire({
                        icon: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                    setTimeout(function(){
                        window.location.reload();
                    }, 1000);
                },
                error: function(response)
                {
                    Swal.fire({
                        icon: 'error',
                        title: response.responseJSON.message,
                        showConfirmButton: true,
                    });
                }
            });
        }
    })
}
// === End script ===

// === Concatinate two json into one json ===
function jsonConcat(json1, json2)
{
    for (var key in json2)
    {
        json1[key] = json2[key];
    }
    return json1;
}
// === End script ===

// === Reset form ===
$("#kt_reset").click(function(e){
    e.preventDefault();
    $("form").trigger("reset");
    $("form input").val("");
    if (location.href.includes('?')) {
        history.pushState({}, null, location.href.split('?')[0]);
    }

    window.location.reload();
});
// === End script ===
